<?php

namespace App\Exports;

use App\Models\Response;
use App\Models\User;
use App\Models\Tester;
use App\Models\TestCase;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use Intervention\Image\ImageManagerStatic as Image;


class ExportTestersResponse implements FromView, WithHeadings,ShouldAutoSize, WithDrawings, WithStyles
{

    protected $session;

    public function __construct($session)
    {

        $this->session = $session;

    }


    public function view(): View
    {
        $session = $this->session;

        $testCases = TestCase::where('session_id',$session->id)->get(); //fetching all testcases within that session
        $testcases = $testCases->map(function($testCase){
            return [$testCase->testCaseText,$testCase->testCaseImage];
        });

        $userIds = Tester::where('projects_id',$session->projects_id)->pluck('user_id'); //Fetching all testers within that session
        $usersInfo = User::whereIn('id', $userIds)->select('id', 'username')->get();

        $testersInfo = $usersInfo->map(function($userInfo) use ($session, $testCases) {
            $status = "";

            $countResponses = Response::where('session_id', $session->id)
                ->where('user_id', $userInfo->id)
                ->count();

                if($countResponses == count($testCases)){
                    $status = "RESPONSES SUBMITTED";
                }
                else if($countResponses == 0 && count($testCases) > 0 ){
                    $status = "NO RESPONSE";
                }
                else{
                    $countUnansweredTestCases = count($testCases)-$countResponses;
                    $status = $countUnansweredTestCases . " TESTCASES LEFT TO ANSWER";
                }



            return [$userInfo->username,$status];
        });

        $responses = Response::where('session_id',$session->id)->whereIn('user_id',$userIds)->get();
        $r = $responses->map(function($response){
            $username = User::where('id',$response->user_id)->pluck('username');
            return [$username,$response->responseText,$response->desktop,$response->mobile,$response->status];
        });

        //for each user, count response, check if response=test case
        return view('exports.testerResponses',[
            'testcases' => $testcases,
            'testersInfo' => $testersInfo,
            'responses' => $r,
        ]);



    }

    public function drawings()
    {
        $session = $this->session;
        $testcases = TestCase::where('session_id',$session->id)->get(); //fetching all testcases within that session

        $drawings = [];

        foreach ($testcases as $index => $testCase) {
            $imagePath = str_replace('/', '\\', storage_path('app\public\\' . $testCase->testCaseImage));
            if (file_exists($imagePath)) {
                $desiredWidth = 250; // Desired width in pixels
                $desiredHeight = 120; // Desired height in pixels

                $img = Image::make($imagePath);
                $originalWidth = $img->getWidth();
                $originalHeight = $img->getHeight();

                $scale = min($desiredWidth / $originalWidth, $desiredHeight / $originalHeight);
                $scaledWidth = $originalWidth * $scale;
                $scaledHeight = $originalHeight * $scale;

                $img->resize($scaledWidth, $scaledHeight);

                $tempPath = tempnam(sys_get_temp_dir(), 'excel') . '.png'; // Use PNG encoding format
                $img->save($tempPath);

                $drawing = new Drawing();
                $drawing->setName('Test Case Image');
                $drawing->setDescription('Image');
                $drawing->setPath($tempPath);
                $drawing->setOffsetX(5);
                $drawing->setOffsetY(5);
                $drawing->setWidth($scaledWidth);
                $drawing->setHeight($scaledHeight);
                $drawing->setCoordinates('B' . ($index + 8));

                $drawings[] = $drawing;
            }
        }

        return $drawings;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            4 => ['alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT]],
        ];
    }





    public function headings(): array
    {
        return[
            'Test Case Text',
            'Test Case Image',
        ];
    }

}
