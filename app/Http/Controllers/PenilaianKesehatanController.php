<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenilaianKesehatan;
use App\Models\JadwalKesehatan;
use App\Models\KategoriKesehatan;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PDF;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PenilaianKesehatanController extends Controller
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

     
    public function index()
    {
        $pnl = PenilaianKesehatan::where('data_state','=',0)->get();
        return view('content/PenilaianKesehatan/ListPenilaian', compact('pnl'));
    }


    public function screenTambah()
    {
        $jk = JadwalKesehatan::where('data_state', '=', 0)->get();
        $kt = KategoriKesehatan::where('data_state', '=', 0)->get();
        $player = Player::where('data_state', '=', 0)->get();
        $monthname = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
        $yearnum = [
            1 => '2020',
            2 => '2021',
            3 => '2022',
            4 => '2023',
        ];
        return view('content.PenilaianKesehatan.TambahPenilaian', compact('jk', 'kt', 'player', 'monthname', 'yearnum'));
    }


    public function tambah(Request $request)
    {
        $request->validate([
            'health_assessment_schedule_id' => 'required',
            'health_assessment_categories_id' => 'required',
            'mark_health' => 'required',
            'id_player' => 'required'
        ]);

        $pnl = [
            'health_assessment_schedule_id' => $request->health_assessment_schedule_id,
            'health_assessment_categories_id' => $request->health_assessment_categories_id,
            'mark_health' => $request->mark_health,
            'id_player' => $request->id_player,
        ];
        PenilaianKesehatan::create($pnl);
        $message = 'Penilaian Kesehatan Berhasil Di Tambahkan';
        return redirect()->to('/penilaiankesehatan')->with('message', $message);
    }

    public function edit($health_assessment_id)
    {
        $jk = JadwalKesehatan::where('data_state', '=', 0)->get();
        $kt = KategoriKesehatan::where('data_state', '=', 0)->get();
        $player = Player::where('data_state', '=', 0)->get();
        $pnl = PenilaianKesehatan::where('health_assessment_id', $health_assessment_id)->first();
        $MONTH = $pnl->CallJadwalKe->month_period;
        $YEAR = $pnl->CallJadwalKe->year_period;
        $KATKES = $pnl->CallKategoriKe->name_assessment;
        $PLAYNAME = $pnl->CallPlayKe->player_name;
        $monthname = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
        $yearnum = [
            1 => '2020',
            2 => '2021',
            3 => '2022',
            4 => '2023',
        ];
        return view('content/PenilaianKesehatan/EditPenilaian', compact('pnl', 'jk', 'kt', 'player', 'KATKES','YEAR','MONTH', 'PLAYNAME', 'monthname', 'yearnum'));
    }
    public function update(Request $request, $health_assessment_id)
    {
        $request->validate([
            'health_assessment_schedule_id' => 'required',
            'health_assessment_categories_id' => 'required',
            'mark_health' => 'required',
            'id_player' => 'required'
        ]);

        $pnl = [
            'health_assessment_schedule_id' => $request->health_assessment_schedule_id,
            'health_assessment_categories_id' => $request->health_assessment_categories_id,
            'mark_health' => $request->mark_health,
            'id_player' => $request->id_player,
        ];
        PenilaianKesehatan::where('health_assessment_id', $health_assessment_id)->update($pnl);
        $message = 'Penilaian Kesehatan Berhasil Di Edit';
        return redirect()->to('/penilaiankesehatan')->with('message', $message);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function CetakPenilaianKesehatan()
    {
        $filename = 'penilaian kesehatan.pdf';
        $health_assessment_id = PenilaianKesehatan::where('data_state', '=', 0)->get();
        $html = view()->make('content/PenilaianKesehatan/CetakPenilaianKesehatan', ['health_assessment_id' => $health_assessment_id])->render();
        $pdf = new PDF;
        $pdf::SetTitle('penilaian kesehatan');
        $pdf::AddPage();
        $pdf::writeHTML($html);
        $pdf::Output(public_path($filename), 'F');
        return response()->download(public_path($filename));
    }

    public function CetakPenilaianExcel()
    {
        $pnl = PenilaianKesehatan::where('data_state', '=', 0)->get();
        $monthname = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
        $yearnum = [
            1 => '2020',
            2 => '2021',
            3 => '2022',
            4 => '2023',
        ];
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getDefaultStyle()
            ->getFont()
            ->setName('Arial')
            ->setSize('12');
        $activeWorksheet->getColumnDimension('A')->setWidth(5);
        $activeWorksheet->getColumnDimension('B')->setWidth(35);
        $activeWorksheet->getColumnDimension('C')->setWidth(35);
        $activeWorksheet->getColumnDimension('D')->setWidth(20);
        $activeWorksheet->getColumnDimension('E')->setWidth(20);

        $activeWorksheet->setCellValue('A1', 'Daftar Penilaian Kesehatan');
        $activeWorksheet->getStyle('A1')->getFont()->setSize('16')->setBold(true);
        $activeWorksheet->mergeCells('A1:E1');
        $activeWorksheet->getStyle('A1:E1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


        $activeWorksheet
            ->setCellValue('A2', 'ID')
            ->setCellValue('B2', 'Jadwal Penilaian Kesehatan')
            ->setCellValue('C2', 'Kategori Penilaian Kesehatan')
            ->setCellValue('D2', 'Nilai')
            ->setCellValue('E2', 'Pemain');
        $activeWorksheet->getStyle('A2:E2')->getFont()->setBold(true);
        $activeWorksheet->getStyle('A2:E2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];

        $cell = 3;
        foreach ($pnl as $pnln) {
            $activeWorksheet->getStyle('A' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('B' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('C' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('D' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('E' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet
                ->setCellValue('A' . $cell, $pnln['health_assessment_id'])
                ->setCellValue('B' . $cell, $monthname[$pnln->CallJadwalKe['month_period']]. ' ' . $yearnum[$pnln->CallJadwalKe['year_period']])
                ->setCellValue('C' . $cell, $pnln->CallKategoriKe['name_assessment'])
                ->setCellValue('D' . $cell, $pnln['mark_health'])
                ->setCellValue('E' . $cell, $pnln->CallPlayKe['player_name']);

            $activeWorksheet->getStyle('A2:E' . $cell)->applyFromArray($styleArray);
            $cell++;
        }
        $activeWorksheet->getStyle('A' . $cell . ':E' . $cell)->getFont()->setBold(true);

        $writer = new Xlsx($spreadsheet);
        $writer->save('Penilaian Kesehatan.xlsx');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Penilaian Kesehatan.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }


    public function delete($health_assessment_id)
    {
        $pnl = ['data_state' => 1];
        PenilaianKesehatan::where('health_assessment_id', $health_assessment_id)->update($pnl);
        $message = 'Penilaian Kesehatan Berhasil di Hapus';
        return redirect()->to('/penilaiankesehatan')->with('message', $message);
    }
}
