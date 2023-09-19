<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\timbasket;
use App\Models\TrainingGround;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PDF;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class JadwalController extends Controller
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
        $jadwal = Jadwal::where('data_state', '=', 0)->get();
        return view('content/Jadwal/ListJadwal', compact('jadwal'));
    }
    public function screenTambah()
    {
        $timbasket = Timbasket::where('data_state', '=', 0)->get();
        $TrainingGround = TrainingGround::where('data_state', '=', 0)->get();

        // Misalnya, ambil data terakhir yang dipilih oleh pengguna dari session
        $selectedTrainingGroundId = session('last_selected_training_ground_id');

        // Set session value when user selects a training ground
        session(['last_selected_training_ground_id' => $selectedTrainingGroundId]);

        return view('content.Jadwal.TambahJadwal', compact('timbasket', 'TrainingGround', 'selectedTrainingGroundId'));
    }


    public function tambah(Request $request)
    {
        $request->validate([
            'name_training' => 'required',
            'training_ground_id' => 'required',
            'training_day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'description' => 'required',
            'id_team' => 'required'
        ]);

        $jadwal = [
            'name_training' => $request->name_training,
            'training_ground_id' => $request->training_ground_id,
            'training_day' => $request->training_day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'description' => $request->description,
            'id_team' => $request->id_team,
        ];
        Jadwal::create($jadwal);
        $message = 'Jadwal Berhasil Di Tambahkan';
        return redirect()->to('/jadwal')->with('message', $message);
    }


    public function edit($timetable_id)
    {
        $timbasket = timbasket::where('data_state', '=', 0)->get();
        $TrainingGround = TrainingGround::where('data_state', '=', 0)->get();
        $jadwal = Jadwal::where('timetable_id', $timetable_id)->first();
        $tm = $jadwal->CallTim->team_name;
        $trn = $jadwal->CallTraining->training_ground_name;
        return view('content/Jadwal/EditJadwal', compact('timbasket', 'jadwal', 'TrainingGround', 'tm','trn'));
    }
    public function update(Request $request, $timetable_id)
    {
        $request->validate([
            'name_training' => 'required',
            'training_ground_id' => 'required',
            'training_day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'description' => 'required',
            'id_team' => 'required'
        ]);

        $jadwal = [
            'name_training' => $request->name_training,
            'training_ground_id' => $request->training_ground_id,
            'training_day' => $request->training_day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'description' => $request->description,
            'id_team' => $request->id_team,
        ];
        Jadwal::where('timetable_id', $timetable_id)->update($jadwal);
        $message = 'Jadwal Berhasil Di Edit';
        return redirect()->to('/jadwal')->with('message', $message);
    }
    public function delete($timetable_id)
    {
        $jadwal = ['data_state' => 1];
        Jadwal::where('timetable_id', $timetable_id)->update($jadwal);
        $message = 'Jadwal Berhasil di Hapus';
        return redirect()->to('/jadwal')->with('message', $message);
    }
    public function detail($timetable_id)
    {
        $jadwal = Jadwal::where('timetable_id', $timetable_id)->first();
        return view('content/Jadwal/DetailJadwal', ['jadwal' => $jadwal]);
    }
    public function CetakJadwal()
    {
        $filename = 'jadwal.pdf';
        $timetable_id = Jadwal::where('data_state', '=', 0)->get();
        $html = view()->make('content/Jadwal/CetakJadwal', ['timetable_id' => $timetable_id])->render();
        $pdf = new PDF;
        $pdf::SetTitle('Jadwal');
        $pdf::AddPage();
        $pdf::writeHTML($html);
        $pdf::Output(public_path($filename), 'F');
        return response()->download(public_path($filename));
    }

    public function CetakJadwalExcel()
    {
        $jadwal = Jadwal::where('data_state', '=', 0)->get();
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
        $activeWorksheet->getColumnDimension('F')->setWidth(20);
        $activeWorksheet->getColumnDimension('G')->setWidth(20);
        $activeWorksheet->getColumnDimension('H')->setWidth(20);

        $activeWorksheet->setCellValue('A1', 'Daftar Jadwal Latihan');
        $activeWorksheet->getStyle('A1')->getFont()->setSize('16')->setBold(true);
        $activeWorksheet->mergeCells('A1:H1');
        $activeWorksheet->getStyle('A1:H1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


        $activeWorksheet
            ->setCellValue('A2', 'ID')
            ->setCellValue('B2', 'Nama Latihan')
            ->setCellValue('C2', 'Tempat Latihan')
            ->setCellValue('D2', 'Hari Latihan')
            ->setCellValue('E2', 'Jam Mulai')
            ->setCellValue('F2', 'Jam Selesai')
            ->setCellValue('G2', 'Deskripsi')
            ->setCellValue('H2', 'Nama Tim');
        $activeWorksheet->getStyle('A2:H2')->getFont()->setBold(true);
        $activeWorksheet->getStyle('A2:H2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];

        $cell = 3;
        foreach ($jadwal as $jwl) {
            $activeWorksheet->getStyle('A' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('B' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            $activeWorksheet->getStyle('C' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('D' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('E' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('F' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('G' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('H' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet
                ->setCellValue('A' . $cell, $jwl['timetable_id'])
                ->setCellValue('B' . $cell, $jwl['name_training'])
                ->setCellValue('C' . $cell, $jwl->CallTraining['training_ground_name'])
                ->setCellValue('D' . $cell, $jwl['training_day'])
                ->setCellValue('E' . $cell, $jwl['start_time'])
                ->setCellValue('F' . $cell, $jwl['end_time'])
                ->setCellValue('G' . $cell, $jwl['description'])
                ->setCellValue('H' . $cell, $jwl->CallTim['team_name']);

            $activeWorksheet->getStyle('A2:G' . $cell)->applyFromArray($styleArray);
            $cell++;
        }
        $activeWorksheet->getStyle('A' . $cell . ':G' . $cell)->getFont()->setBold(true);

        $writer = new Xlsx($spreadsheet);
        $writer->save('Jadwal.xlsx');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Jadwal.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
