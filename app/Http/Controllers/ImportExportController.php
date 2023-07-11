<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Session;
use App\Models\TestCase;
use Illuminate\Http\Request;
use App\Exports\ExportResponses;
use App\Exports\ExportTestersResponse;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{

    public function export(Session $session, $testerID)
    {
        $testcase = TestCase::where('session_id',$session->id)->get();
        $user = User::where('id',$testerID)->first();
        $project = Project::where('id', $session->projects_id)->first();


        return Excel::download(new ExportResponses($session, $testerID, $testcase), $user->username.'-'. $session->sessionName.'-Project-'. $project->projectName.'.xlsx');
    }

    public function exportAll(Session $session)
    {
        $project = Project::where('id', $session->projects_id)->first();
        $testcase = TestCase::where('session_id',$session->id)->get();
        return Excel::download(new ExportTestersResponse($session),$project->projectName. ' - '.$session->sessionName.'.xlsx');


    }


}
