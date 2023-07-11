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

class SessionController extends Controller
{
        // Show All Sessions
        public function index($project_id){

                $projectIds = Project::pluck('id');
                $testerIds = Tester::whereIn('projects_id', $projectIds)->pluck('user_id');
                $usernames = User::whereIn('id', $testerIds)->pluck('username')->toArray();
                $testers = implode(", ", array_map('strval', $usernames));

                $project = Project::findOrFail($project_id);
                $sessions = Session::latest()
                            ->filter(request(['search']))
                            ->where('projects_id',$project->id)
                            ->paginate(5);
                $sessionIDs = Session::where('projects_id', $project_id)->pluck('id');
                $responses = Response::whereIn('session_id', $sessionIDs)->where('user_id',auth()->id())->get();

                $sessionsDuration = Session::where('projects_id', $project_id)->pluck('sessionTime');

                $totalDuration = 0;
                if(!empty($sessionsDuration)){
                    foreach($sessionsDuration as $sessionDuration){
                        $totalDuration += $sessionDuration;
                    }
                }
                else{
                    $totalDuration += 0;

                }

                $projectField['projectTime'] = $totalDuration;
                $project->update($projectField);

                //return view('sessions.index', compact('project', 'sessions','testers','responses','totalDuration'));

                return view('sessions.index', [
                    'project' => $project,
                    'sessions' => $sessions,
                     'testers' => $testers,
                     'responses' => $responses,
                     'totalDuration' => $totalDuration ,
                ]);



        }

        public function show(){}

        // Store new session data
        public function store(Request $request, $project_id){

            $project = Project::where('id', $project_id)->first();
            // Make sure only project creator can edit
            if ($project->user_id != auth()->id() && auth()->user()->roles != 'admin') {
                abort(403, 'Unauthorized Action');
            }

            $formFields = $request -> validate([
                'sessionName' => 'required',
                'sessionStartDate' => 'required',
                'sessionDesc' => 'required',
                'status' => 'required'
            ]);

            $formFields['projects_id'] = $project_id;

            Session::create($formFields);
            return back()->with('message','Session Created Successfully!');
        }

        // Update Session Data
        public function update(Request $request, Project $project, Session $session){


            if(auth()->user()->roles != "admin"){ //users who not admin can edit only session that they have created
                // Make sure only project creator can update
                if($project->user_id != auth()->id()  ){
                    abort('403','Unauthorized Action');
                }
            }

            $formFields = $request -> validate([
                'sessionName' => 'required',
                'sessionStartDate' => 'required',
                'sessionDesc' => 'required',
                'status' => 'required'
            ]);

            $session->update($formFields);
            return back()->with('message','Session Updated Successfully!');
        }

        // Delete Session
        public function destroy(Project $project, Session $session){
            // Make sure only project creator can delete
            if ($project->user_id != auth()->id() && auth()->user()->roles != "admin") {
                abort('403','Unauthorized Action');
           }
           $session->delete();
           return back()->with('message',"Sessions Deleted");

       }


}
