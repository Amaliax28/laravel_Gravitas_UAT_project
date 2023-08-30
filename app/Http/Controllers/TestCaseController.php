<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Session;
use App\Models\TestCase;
use Illuminate\Http\Request;

class TestCaseController extends Controller
{
    // Show all Test Cases
    public function index(Project $project, Session $session){
        $testcases = TestCase::latest()
                    ->where('session_id',$session->id)
                    ->paginate(5);

        return view('testcase.index', compact('project', 'session','testcases'));
    }


    // show create test case form
    public function create(Project $project, Session $session){
        return view('testcase.create',[
            'project' => $project,
            'session' => $session
        ]);
    }

    /*

    public function store(Request $request, Project $project, Session $session)
    {
        $formFields = $request->validate([
            'testCaseText' => 'required',
            'testCaseTime' => 'required'
        ]);

        if($request->hasFile('testCaseImage')){
            $formFields['testCaseImage'] = $request->file('testCaseImage')->store('testcase','public');
        }

        $formFields['session_id'] = $session->id;
        $formFields['user_id'] = auth()->id();

        TestCase::create($formFields);

        return back()->with('message','Test Case created Successfully!');

    }
    */

    public function store(Request $request, Project $project, Session $session)
    {
        $formFields = $request->validate([
            'testCaseText' => 'required',
            'testCaseTime' => 'required'
        ]);

        if($request->hasFile('testCaseImage')){
            $image = $request->file('testCaseImage');
            $imageName = time() . '-' . $image->getClientOriginalName();

            $image->move(public_path('uploaded_files'), $imageName);

            $formFields['testCaseImage'] = $imageName;
        }

        $formFields['session_id'] = $session->id;
        $formFields['user_id'] = auth()->id();

        TestCase::create($formFields);

        return back()->with('message','Test Case created Successfully!');

    }



    // Show Edit Test Case Form
    public function edit(Project $project, Session $session){
        $testcases = TestCase::oldest()
        ->where('session_id',$session->id)
        ->paginate(1);

        if ($testcases->isEmpty()) {
            return back()->with('message','No Test Case Found');
        }
        $userIDs =$testcases->pluck('user_id'); // Retrieve users info that created the test case
        $user = User::whereIn('id', $userIDs)->first(); //Retrieve user info that created the test case

        return view('testcase.edit', compact('project', 'session','testcases','user'));
    }


    //Update Tets Case
    public function update(Request $request, Project $project, Session $session, TestCase $testCase){

        $formFields = $request -> validate([
            'testCaseText' => 'required',
            'testCaseTime' => 'required'

        ]);



        if($request->hasFile('testCaseImage')){
            $image = $request->file('testCaseImage');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('uploaded_files'), $imageName);
            $formFields['testCaseImage'] = $imageName;
            //$formFields['testCaseImage'] = $request->file('testCaseImage')->store('testcase','public');
        }

        $testCase->update($formFields);

        return back()->with('message','Updated Successfully!');
    }

    // Delete Test Case

    public function destroy(Project $project, Session $session, TestCase $testCase){
        // Make sure only project creator can delete
       if($project->user_id != auth()->id()){
           abort('403','Unauthorized Action');
       }
       $testCase->delete();
       return back()->with('message',"Test Case Deleted");

   }

}
