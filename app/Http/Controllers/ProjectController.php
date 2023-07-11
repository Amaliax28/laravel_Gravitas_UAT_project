<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tester;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //show all projects
    public function index(){
        $user = auth()->user();
        $allProjectsDurations = Project::pluck('projectTime');

        $totalDuration = 0;
        if(!empty($allProjectsDurations)){

           foreach($allProjectsDurations as $allProjectDuration){
                $totalDuration += $allProjectDuration;
           }
        }
        else{
            $totalDuration += 0;

        }

        // FOR ADMIN
        if($user->roles == "admin"){
            return view('projects.index', [
                'projects' => Project::latest()
                            ->filter(request(['search']))
                            ->paginate(5),
                'totalDuration' => $totalDuration

            ]);
        }
        else{ //FOR TESTER
            // retrieve all project IDs assigned to the tester
            $projectIds = Tester::where('user_id', auth()->id())->pluck('projects_id');

            // retrieve only the projects that have IDs in the $projectIds array
            $projects = Project::latest()
                ->filter(request(['search']))
                ->whereIn('id', $projectIds)
                ->paginate(5);
                return view('projects.index', [
                    'totalDuration' => $totalDuration,
                    'projects' => $projects
                ]);
        }

    }

    public function MyProjects(){
        return view('projects.myprojects', [
            'projects' => Project::latest() //return  project id from tester table then return that projects
                ->filter(request(['search']))
                ->where('user_id', auth()->id()) // see only projects created
                ->paginate(5)
        ]);

    }

    //Store Project Data
    public function store(Request $request){
        //dd($request->file('projectImg')->store('projects','public'));

        $formFields = $request -> validate([
            'projectName' => 'required',
            'projectDetails' => 'required',
            'status' => 'required',
        ]);

        if($request->hasFile('projectImg')){
            $formFields['projectImg'] = $request->file('projectImg')->store('projects','public');
        }

        $formFields['user_id'] = auth()->id();

        $project = Project::create($formFields);

        // For Assigning Testers
        $tester = $request->input('tester');
        $testerArray = explode(",",$tester);

        foreach($testerArray as $t){
            $t = trim($t);//remove whitespace
            $user = User::where('username', $t)->first();
            //check if testers username exist
            if (!$user) {
                // user with the given username doesn't exist
                // handle the error or redirect back with an error message
                return back()->with('message','username not found');
            }
            else{
                // if ade store project id and user id
                $formFields2 = [
                    'projects_id' => $project->id,
                    'user_id' => $user->id
                ];
                Tester::create($formFields2);
            }
        }


        return redirect('/my-projects');
    }

    //Update Project Data
    public function update(Request $request, Project $project){

        // Make sure only project creator can edit
        if($project->user_id != auth()->id() && auth()->user()->roles != 'admin'){
            abort('403','Unauthorized Action');
        }

        $formFields = $request -> validate([
            'projectName' => 'required',
            'projectDetails' => 'required',
            'status' => 'required',
        ]);




        if($request->hasFile('projectImg')){
            $formFields['projectImg'] = $request->file('projectImg')->store('projects','public');
        }

        if($request->filled('tester')){
            $tester = $request->input('tester');
            $testerArray = explode(",",$tester);

            foreach($testerArray as $t){
                $t = trim($t);//remove whitespace

                $user = User::where('username', $t)->first();

                //check if testers username exist
                if (!$user) {
                    // user with the given username doesn't exist
                    // handle the error or redirect back with an error message
                    return back()->with('message','username not found');
                }
                else{//username found

                    $addedUser = Tester::where('user_id', $user->id)->where('projects_id', $project->id)->first();

                    if (!$addedUser) { // If user is not yet added
                        $formFields2 = [
                            'projects_id' => $project->id,
                            'user_id' => $user->id
                        ];
                        Tester::create($formFields2);
                    } else {
                        return back()->with('message', "Only Add User Who Hasn't Been Assigned to This Project" );
                    }

                }
            }
        }


        $project->update($formFields);

        return back()->with('message','Project Updated Successfully!');
    }

    //Delete Project
    public function destroy(Project $project){
         // Make sure only project creator can delete
        $user = auth()->user();


        if($project->user_id != auth()->id() && $user->roles !="admin"){
            abort('403','Unauthorized Action');
        }
        $project->delete();
        return redirect('/')->with('message',"Project Deleted");

    }
}
