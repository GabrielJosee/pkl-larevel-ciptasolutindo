<?php

namespace App\Http\Controllers;

use App\Models\TimBasket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Absensi;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanAbsensiController extends Controller
{
 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {   
        $absen = Absensi::where('data_state', 0)->get();

        if (!Session::get('start_date')) {
            $start_date = date('Y-m-d');
        } else {
            $start_date = Session::get('start_date');
        }

        if (!Session::get('end_date')) {
            $end_date = date('Y-m-d');
            $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
        } else {
            $end_date = Session::get('end_date');
            $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
        }

        $absen = $absen->where('created_at', '>=', $start_date)->where('created_at', '<=', $stop_date);

        return view('content/Laporan/LaporanAbsensi', compact('absen', 'start_date', 'end_date'));
    }

    public function filter(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        Session::put('start_date', $start_date);
        Session::put('end_date', $end_date);

        return redirect('/laporan-absensi-hadir');
    }

    public function CetakPDF()
    {
        $filename = 'Laporan Absensi.pdf';

        $absen = Absensi::where('data_state', 0)->get();

        if (!Session::get('start_date')) {
            $start_date = date('Y-m-d');
        } else {
            $start_date = Session::get('start_date');
        }

        if (!Session::get('end_date')) {
            $end_date = date('Y-m-d');
            $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
        } else {
            $end_date = Session::get('end_date');
            $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
        }
        $absen = $absen->where('created_at', '>=', $start_date)->where('created_at', '<=', $stop_date);
        $html = view()->make('content/Laporan/CetakLaporanAbsensi', ['absen' => $absen, 'start_date' => $start_date, 'end_date' => $end_date])->render();
        $pdf = new PDF;
        $pdf::SetTitle('Laporan Absensi');
        $pdf::AddPage();
        $pdf::writeHTML($html);
        $pdf::Output(public_path($filename), 'F');
        return response()->download(public_path($filename));
    }

    public function CetakExcel()
    {
        $absen = Absensi::where('data_state', 0)->get();


        if (!Session::get('start_date')) {
            $start_date = date('Y-m-d');
        } else {
            $start_date = Session::get('start_date');
        }

        if (!Session::get('end_date')) {
            $end_date = date('Y-m-d');
            $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
        } else {
            $end_date = Session::get('end_date');
            $stop_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
        }
        $absen = $absen->where('created_at', '>=', $start_date)->where('created_at', '<=', $stop_date);

        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getDefaultStyle()
        ->getFont()
        ->setName('Arial')
        ->setSize('12');
        $activeWorksheet->getColumnDimension('A')->setWidth(5);
        $activeWorksheet->getColumnDimension('B')->setWidth(20);
        $activeWorksheet->getColumnDimension('C')->setWidth(20);
        $activeWorksheet->getColumnDimension('D')->setWidth(20);
        $activeWorksheet->getColumnDimension('E')->setWidth(20);
        $activeWorksheet->getColumnDimension('F')->setWidth(30);

        $activeWorksheet->setCellValue('A1', 'Laporan Absensi');
        $activeWorksheet->getStyle('A1')->getFont()->setSize('16')->setBold(true);
        $activeWorksheet->mergeCells('A1:F1');

        $activeWorksheet->setCellValue('A2', 'Periode ' . $start_date . ' s/d ' . $end_date);
        $activeWorksheet->getStyle('A2')->getFont()->setSize('12');
        $activeWorksheet->mergeCells('A2:F2');
        $activeWorksheet->getStyle('A1:A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $activeWorksheet
            ->setCellValue('A3', 'No')
            ->setCellValue('B3', 'Nama Player')
            ->setCellValue('C3', 'Jadwal Latihan')
            ->setCellValue('D3', 'Jam Mulai')
            ->setCellValue('E3', 'Jam Selesai')
            ->setCellValue('F3', 'Jam Absen');
        $activeWorksheet->getStyle('A3:F3')->getFont()->setBold(true);
        $activeWorksheet->getStyle('A3:F3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];

        $cell = 4;
        $no = 1;
        foreach ($absen as $si) {
            $activeWorksheet->getStyle('A' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('B' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            $activeWorksheet->getStyle('C' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('D' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('E' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('F' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet
                ->setCellValue('A' . $cell, $no)
                ->setCellValue('B' . $cell, $si->CallPlayer['player_name'])
                ->setCellValue('C' . $cell, $si->CallJadwal['name_training'])
                ->setCellValue('D' . $cell, $si->CallJadwal['start_time'])
                ->setCellValue('E' . $cell, $si->CallJadwal['end_time'])
                ->setCellValue('F' . $cell, $si['attendance_datetime']);
            $no++;
            $activeWorksheet->getStyle('A3:F' . $cell)->applyFromArray($styleArray);
            $cell++;
        }
        
        $activeWorksheet->getStyle('A' . $cell . ':F' . $cell)->getFont()->setBold(true);


        $writer = new Xlsx($spreadsheet);
        $writer->save('Laporan Absensi.xlsx');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Absensi.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }


}
