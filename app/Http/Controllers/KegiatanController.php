<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PDF;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        $kegiatan = Kegiatan::where('data_state', '=', 0)->get();
        return view('content/Kegiatan/ListKegiatan', compact('kegiatan'));
    }


    public function screenTambah()
    {
        $jadwal = Jadwal::where('data_state', '=', 0)->get();
        return view('content.Kegiatan.TambahKegiatan', compact('jadwal'));
    }
    public function tambah(Request $request)
    {
        $request->validate([
            'timetable_id' => 'required',
            'activity_name' => 'required',
            'activity_start' => 'required',
            'activity_end' => 'required',
            'description_act' => 'required'
        ]);

        $kegiatan = [
            'timetable_id' => $request->timetable_id,
            'activity_name' => $request->activity_name,
            'activity_start' => $request->activity_start,
            'activity_end' => $request->activity_end,
            'description_act' => $request->description_act,
        ];
        Kegiatan::create($kegiatan);
        $message = 'Kegiatan Berhasil Di Tambahkan';
        return redirect()->to('/kegiatan')->with('message', $message);
    }

    public function edit($activity_id)
    {
        $jadwal = Jadwal::where('data_state', '=', 0)->get();
        $kegiatan = Kegiatan::where('activity_id', $activity_id)->first();
        $TraName = $kegiatan->CallJadwalLat->name_training;
        return view('content/Kegiatan/EditKegiatan', compact('kegiatan', 'jadwal', 'TraName'));
    }
    public function update(Request $request, $activity_id)
    {
        $request->validate([
            'timetable_id' => 'required',
            'activity_name' => 'required',
            'activity_start' => 'required',
            'activity_end' => 'required',
            'description_act' => 'required'
        ]);

        $kegiatan = [
            'timetable_id' => $request->timetable_id,
            'activity_name' => $request->activity_name,
            'activity_start' => $request->activity_start,
            'activity_end' => $request->activity_end,
            'description_act' => $request->description_act,
        ];
        Kegiatan::where('activity_id', $activity_id)->update($kegiatan);
        $message = 'Kegiatan Berhasil Di Edit';
        return redirect()->to('/kegiatan')->with('message', $message);
    }

    public function CetakKegiatan()
    {
        $filename = 'kegiatan jadwal latihan.pdf';
        $activity_id = Kegiatan::where('data_state', '=', 0)->get();
        $html = view()->make('content/Kegiatan/CetakKegiatan', ['activity_id' => $activity_id])->render();
        $pdf = new PDF;
        $pdf::SetTitle('Kegiatan');
        $pdf::AddPage();
        $pdf::writeHTML($html);
        $pdf::Output(public_path($filename), 'F');
        return response()->download(public_path($filename));
    }

    public function CetakKegiatanExcel()
    {
        $kegiatan = Kegiatan::where('data_state', '=', 0)->get();
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

        $activeWorksheet->setCellValue('A1', 'Daftar Kegiatan Jadwal Latihan');
        $activeWorksheet->getStyle('A1')->getFont()->setSize('16')->setBold(true);
        $activeWorksheet->mergeCells('A1:F1');
        $activeWorksheet->getStyle('A1:F1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


        $activeWorksheet
            ->setCellValue('A2', 'ID')
            ->setCellValue('B2', 'Latihan')
            ->setCellValue('C2', 'Kegiatan')
            ->setCellValue('D2', 'Jam Mulai')
            ->setCellValue('E2', 'Jam Selesai')
            ->setCellValue('F2', 'Deskripsi');
        $activeWorksheet->getStyle('A2:F2')->getFont()->setBold(true);
        $activeWorksheet->getStyle('A2:F2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];

        $cell = 3;
        foreach ($kegiatan as $keg) {
            $activeWorksheet->getStyle('A' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('B' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            $activeWorksheet->getStyle('C' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('D' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('E' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('F' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet
                ->setCellValue('A' . $cell, $keg['activity_id'])
                ->setCellValue('B' . $cell, $keg->CallJadwalLat['name_training'])
                ->setCellValue('C' . $cell, $keg['activity_name'])
                ->setCellValue('D' . $cell, $keg['activity_start'])
                ->setCellValue('E' . $cell, $keg['activity_end'])
                ->setCellValue('F' . $cell, $keg['description_act']);

            $activeWorksheet->getStyle('A2:F' . $cell)->applyFromArray($styleArray);
            $cell++;
        }
        $activeWorksheet->getStyle('A' . $cell . ':F' . $cell)->getFont()->setBold(true);

        $writer = new Xlsx($spreadsheet);
        $writer->save('Kegiatan Jadwal Latihan.xlsx');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Kegiatan Jadwal Latihan.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    
    public function delete($activity_id)
    {
        $kegiatan = ['data_state' => 1];
        Kegiatan::where('activity_id', $activity_id)->update($kegiatan);
        $message = 'Kegiatan Berhasil di Hapus';
        return redirect()->to('/kegiatan')->with('message', $message);
    }
}
