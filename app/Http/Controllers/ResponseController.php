<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tester;
use App\Models\Project;
use App\Models\Session;
use App\Models\Response;
use App\Models\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class ResponseController extends Controller
{
    // Show Submitted Responses
    public function index(Project $project, Session $session, $testerID){

        $tester = User::where('id',$testerID)->first(); //get tester info

        $responses = Response::where('session_id', $session->id)
                    ->where('user_id', $testerID)->get();

        $testcase = TestCase::where('session_id',$session->id)->get();

        if($responses->count() == 0){
                return back()->with('message', "This user has not yet begun responding");
        }

        if(count($responses) == count($testcase)){ //check if user has answere all test cases

            $testcase1 = TestCase::where('session_id',$session->id)->paginate(1);

            $responses1 = Response::where('session_id', $session->id)
                                    ->where('user_id', $tester->id)->paginate(1);

            $testCaseCreator = User::where('id',$testcase1->first()->user_id)->first();
            return view('responses.index',[
                'project' => $project,
                'testcases' => $testcase1,
                'session' => $session,
                'responses' => $responses1,
                'tester' => $tester,
                'testCaseCreator' => $testCaseCreator

            ]);
        }
        else{
            return back()->with('message', "This user hasn't submitted a full response yet");
        }

    }

    // Show Response Form
    public function create(Project $project, Session $session)
    {

        // Get all Test Case IDs for this session
        $testcaseIDs = TestCase::where('session_id', $session->id)->pluck('id');

        // To check if the test case has a respons already
        $responses = Response::where('user_id',auth()->user()->id)
                            ->whereIn('test_cases_id',$testcaseIDs)
                            ->paginate(1);


        if ($testcaseIDs->count() > 0) {
            $testcases = TestCase::where('session_id', $session->id)
                ->whereIn('id', $testcaseIDs)
                ->paginate(1);

            $user = User::find($testcases->first()->user_id);

            $testcasesCount = TestCase::where('session_id', $session->id)
            ->whereIn('id', $testcaseIDs)
            ->count();

            $responsesCount = Response::where('user_id', auth()->user()->id)
            ->whereIn('test_cases_id', $testcaseIDs)
            ->count();

            $currentDateTime = Carbon::now();
            $currentTime = $currentDateTime->format('H:i:s');

            if($testcasesCount == $responsesCount ){
                return view('responses.edit',[
                    'testcases' => $testcases,
                    'session' => $session,
                    'user' => $user,
                    'responses' =>$responses,
                ]);

            }
            else if ($responses->total() > 0 && !$responses->isEmpty()) { //IF THERE IS A RESPONSE
                return view('responses.show', [
                    'project' => $project,
                    'testcases' => $testcases,
                    'session' => $session,
                    'user' => $user,
                    'responses' =>$responses,
                    'currentTime' => $currentTime

                ]);
            }
            else{ //IF THERE IS NO RESPONSES
                return view('responses.show', [
                    'project' => $project,
                    'testcases' => $testcases,
                    'session' => $session,
                    'user' => $user,
                    'currentTime' => $currentTime

                ]);
            }

        }
        else{
            return back()->with('message', 'No Test Cases Made For This Session Yet. Please Come Back Later');
        }
    }

    public function store(Request $request, Session $session, TestCase $testcase){

        $status = false;

        // Get all Test Case IDs for this session
        $testcases = TestCase::where('session_id', $session->id)
        ->orderBy('created_at')
        ->get();

        $lastTestCaseId = $testcases->last()->id;

        $testcaseDate = strtotime($testcase->created_at);

        foreach($testcases as $t){
            $tdate =strtotime($t->created_at);

            if($tdate < $testcaseDate){ // To get the previous testcases (testcase before's date is less than the current)
                 // Check the questions before are answered
                $responseExists = Response::where('user_id',auth()->user()->id)
                ->where('test_cases_id',$t->id)
                ->exists();

                if($responseExists){ //check if the previous testcases has responses, if yes, can submit
                    $status = true;
                }
                else{
                    $status = false;
                    return back()->with('message','Submit Answer On Previous Page First!');
                }

            }
            else{//first page
                $status = true;
            }

        }

        // Check if user has already answered the test case
        $exists = Response::where('user_id',auth()->user()->id)
                ->where('test_cases_id',$testcase->id)
                ->exists();

        if($exists){

            return back()->with('message','You have already answered this test case!');

        }
        else{
            if($status){
                if($request['priorities'] == "Priorities"){
                    return back()->with('message', 'Please set the priorities of this response!');
                }

                $formFields = $request->validate([
                    'desktop' => 'required',
                    'mobile' => 'required',
                    'priorities' => 'required'
                ]);

                if ($request->filled('responseText')) {
                    $formFields['responseText'] = $request['responseText'];
                }

                if($request->hasFile('feedbackFile')){
                    $file = $request->file('feedbackFile');
                    $uniqueName = uniqid() . '_' . $file->getClientOriginalName();
                    $formFields['feedbackFile']  = $file->storeAs('feedback/files', $uniqueName, 'public');
                }

                if($request->hasFile('feedbackImg')){
                    $img = $request->file('feedbackImg');
                    $uniqueName = uniqid() . '_' . $img->getClientOriginalName();
                    $formFields['feedbackImg'] = $img->storeAs('feedback/images', $uniqueName,'public');
                }

                $formFields['session_id'] = $session->id;
                $formFields['user_id'] = auth()->id();
                $formFields['test_cases_id'] = $testcase->id;
                $formFields['status'] = "PENDING";



                Response::create($formFields);




                if($testcase->id == $lastTestCaseId){
                    return redirect('/project/'.$session->projects_id.'/sessions')->with('message',"Response Submitted!");

                }

                return back()->with('message', 'Response Submitted Successfully!');
            }

        }


    }

    public function update(Request $request, Session $session, $tester_id, $responseId, $testcaseId)
    {

        $response = Response::where('id',$responseId)->first();

        if(auth()->user()->id == $tester_id || auth()->user()->roles == "admin"){
            $formFields = $request->validate([
                'desktop' => 'required',
                'mobile' => 'required',
                'priorities' => 'required'
            ]);

            if ($request->filled('responseText')) {
                $formFields['responseText'] = $request->input('responseText');
            }

            $formFields['status'] = "UPDATED";


            $response->update($formFields);

            return back()->with('message', 'Response is updated!');
        }
        else{

                abort('403','Unauthorized Action');
        }


    }

    public function updateStatus(Request $request, Response $response){

        $sessionId = $response->session_id;

        if (empty($request['responseTime'])) {
            return back()->with('message', 'Please set the response time before submitting.');
        }

        $formFields = $request->validate([
            'responseTime' => 'required'
        ]);



        $formFields['status'] = $request->statusHidden;

        $response->update($formFields);

        $responses = Response::where('session_id',$sessionId)->where('status','pending');
        $formFields['status'] = "ONGOING";
        $responses->update($formFields);




        if($request->statusHidden == "COMPLETE"){
            $msg = "Complete";
        }else if($request->statusHidden == "INCOMPLETE"){
            $msg = "Incomplete";
        }

        return back()->with('message', 'Marked as '.$msg.'!');

    }


}
