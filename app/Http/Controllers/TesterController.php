<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tester;
use App\Models\Project;
use App\Models\Session;
use App\Models\Response;
use App\Models\TestCase;
use Illuminate\Http\Request;

class testerController extends Controller
{

    public function index(Project $project, Session $session)
    {
        $userIds = Tester::where('projects_id', $project->id)->pluck('user_id');
        $users = User::whereIn('id', $userIds)->filter(request(['search']))->paginate(5);

        /*$responses = Response::where('session_id', $session->id)
            ->whereIn('user_id', $userIds)
            ->first();*/
        $responses = Response::where('session_id', $session->id)
            ->whereIn('user_id', $userIds)
            ->get();
        $testcases = TestCase::where('session_id',$session->id)->get();

        $duration = 0;
        $sumDuration = 0;
        /*
        foreach($testcases as $testcase){
            $responseTime = Response::where('test_cases_id',$testcase->id)->first();

            $testCaseSesonds = strtotime($testcase->testCaseTime) - strtotime('00:00:00');
            $responseSeconds = strtotime($responseTime->responseTime) - strtotime('00:00:00');

            $duration = $testCaseSesonds - $responseSeconds;
            $sumDuration += $duration;
        }*/

        foreach($responses as $response){
            $testCaseTime = TestCase::where('id',$response->test_cases_id)->first();

            $testCaseSesonds = strtotime($testCaseTime->testCaseTime) - strtotime('00:00:00');

            if($response->responseTime){
                $responseSeconds = strtotime($response->responseTime) - strtotime('00:00:00');
                $duration = $responseSeconds - $testCaseSesonds;
            }
            else{
                $duration = 0;
            }

            $sumDuration += $duration;

        }


        $sessionField['sessionTime'] = $sumDuration;
        $session->update($sessionField);

        $sumDurationFormatted = gmdate('H:i:s', $sumDuration);

        $testcaseCount = $testcases->count();

    return view('testers.index', [
        'testers' => $users,
        'project' => $project,
         'session' => $session,
         'response' => $responses ?? ($responses->count() === 0 ? null : $responses),
         'testcaseCount' => $testcaseCount ?? ($testcases->count() === 0 ? null : $testcaseCount),
         'duration' => $sumDurationFormatted ? $sumDurationFormatted : null
    ]);





    }

    public function showTestersWithoutSession(Project $project, Session $session)
    {
        $userIds = Tester::where('projects_id', $project->id)->pluck('user_id');
        $users = User::whereIn('id', $userIds)->filter(request(['search']))->paginate(5);

        return view('testers.index', [
            'testers' => $users,
            'project' => $project,
        ]);
    }

    // Remove User from being a tester
    public function destroy(Project $project,$tester_id){
        // Make sure only project creator can delete
        $user = auth()->user();
        $tester = Tester::where('user_id',$tester_id)->where('projects_id',$project->id);

       if($project->user_id != auth()->id() && $user->roles !="admin"){
            abort('403','Unauthorized Action');
        }

        $tester->delete();
        return back()->with('message',"User removed");
   }


}
