<?php
namespace App\Exports;

use App\Models\User;
use App\Models\Tester;
use App\Models\Response;
use App\Models\TestCase;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Intervention\Image\ImageManagerStatic as Image;





class ExportResponses implements FromCollection, WithHeadings, WithDrawings, ShouldAutoSize, WithColumnWidths, WithEvents, WithStyles
{
    /**
    * @return Collection
    */

    protected $testcase;
    protected $testerID;
    protected $session;

    public function __construct($session,$testerID,$testcase)
    {

        $this->session = $session;
        $this->testerID = $testerID;
        $this->testcase = $testcase;
    }

    public function collection()
    {

        $testerId = $this->testerID;
        if($testerId == 0){
            $testerId = Tester::where('projects_id',$this->session->projects_id)->pluck('user_id');


            $responses = Response::select('responseText', 'mobile', 'desktop')
            ->whereIn('user_id', $testerId)
            ->where('session_id', $this->session->id)
            ->get();

        }
        else{

            $responses = Response::select('responseText', 'mobile', 'desktop')
            ->where('user_id', $testerId)
            ->where('session_id', $this->session->id)
            ->get();
        }


        $transformedResponses = $responses->map(function ($response, $index) {
            $testCase = $this->testcase[$index] ?? null;

            return [
                'image' => '', // Empty column for the image
                'testcase' => $testCase ? $testCase->testCaseText : null,
                'mobile' => $response->mobile,
                'desktop' => $response->desktop,
                'responseText' => $response->responseText,
            ];
        });

        return $transformedResponses;
    }



    public function drawings()
    {
        $drawings = [];

        foreach ($this->testcase as $index => $testCase) {
            $imagePath = str_replace('/', '\\', storage_path('app/public/' . $testCase->testCaseImage));
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
                $drawing->setCoordinates('A' . ($index + 2));

                $drawings[] = $drawing;
            }
        }

        return $drawings;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $index = 2;
                foreach ($this->testcase as $testCase) {
                    $event->sheet->getDelegate()->getRowDimension($index)->setRowHeight(100);
                    $index++;
                }
            },
        ];
    }


    public function columnWidths(): array
    {
        return [
            'A' => 40, // Set column A width to 15 units

        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '002060'],
            ],
        ]);
    }


    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'Image',
            'Requirements',
            'Mobile',
            'Desktop',
            'Feedback',
        ];
    }
}
