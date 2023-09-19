<?php

namespace App\Http\Controllers;

use App\Exports\CustomerExport;
use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\timbasketplay;
use App\Models\timbasket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TimBasketController extends Controller
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
        $timplay = timbasketplay::where('data_state', '=', 0)->get();
        return view('content/TimBasket/ListTim', ['timplay' => $timplay]);
    }
    public function screenTambah()
    {
        $Player = Player::where('data_state', 0)->get();
        $timbasket = timbasket::where('data_state', 0)->get();
        $list = Session::get('listTimBasket', []);
        $flash = Session::get('flash', []);
        $id_player = isset($flash['id_player']) ? $flash['id_player'] : null;
    
        return view('content/TimBasket/TambahTim', compact('Player', 'id_player', 'timbasket', 'flash', 'list'));
    }
    public function listSession(Request $request)
    {
        if ($request->id == 0) {
            $flash = [
                'team_name' => $request->team_name,
                'id_player' => $request->id_player
            ];
            Session::put('flash', $flash);
    
            return redirect('/timbasket/tambah');
        } else {
            $player = Player::where('data_state', 0)->where('id_player', $request->id_player)->first();
            $request->validate([
                'team_name' => 'required',
                'id_player' => 'required'   
            ]);
    
            $data_tim = array(
                'team_name' => $request->team_name,
                'id_player' => $request->id_player,
                'player_name' => $player->player_name,
            );
    
            $lastdatatim = Session::get('listTimBasket', []);
            if ($lastdatatim !== null) {
                array_push($lastdatatim, $data_tim);
                Session::put('listTimBasket', $lastdatatim);
            } else {
                $lastdatatim = [];
                array_push($lastdatatim, $data_tim);
                Session::push('listTimBasket', $data_tim);
            }
    
            Session::forget('flash');

            // Setelah mengubah atau menambahkan data, simpan kembali ke session 'listTimBasket'
            Session::put('listTimBasket', $lastdatatim);
    
            return redirect('/timbasket/tambah');
        }
    }
    
    public function deleteList($index)
    {
        $list = Session::get('listTimBasket', []);
    
        if (isset($list[$index])) {
            unset($list[$index]);
            Session::put('listTimBasket', $list);
        }
    
        return redirect('/timbasket/tambah');
    }
    
    public function tambah(Request $request)
    {
        $list = Session::get('listTimBasket', []);

        if (count($list) > 0) {
            foreach ($list as $index => $value) {
                if (!is_null($value)) {
                    $count = $index + 1;
                }
            }
            for ($i = 0; $i < $count; $i++) {
                if (isset($list[$i]) && $list[$i]) {
                    $teamData = [
                        'team_name' => $list[$i]['team_name'],
                        'id_player' => $list[$i]['id_player'],
                    ];
    
                    
                    $existingTeam = timbasket::where('data_state', 0)
                        ->where('team_name', $teamData['team_name'])
                        ->first();
    
                    if (!$existingTeam) {
                        
                        $newTeam = timbasket::create(['team_name' => $teamData['team_name']]);
                        
                       
                        timbasketplay::create([
                            'id_team' => $newTeam->id_team,
                            'id_player' => $teamData['id_player'],
                        ]);
                    } else {
                       
                        timbasketplay::create([
                            'id_team' => $existingTeam->id_team,
                            'id_player' => $teamData['id_player'],
                        ]);
                    }
                } else {
                    return redirect('/timbasket/tambah')->with('error', 'Data tim tidak valid.');
                }
            }
        } else {
            return redirect('/timbasket/tambah');
        }
    
        Session::forget('listTimBasket');
        Session::forget('flash');
    
        $message = 'Tim berhasil ditambahkan';
    
        return redirect('/timbasket')->with('message', $message);
    }
    public function edit($id_team_play)
    {
        $player = Player::get();
        $timbasket = timbasket::get();
        $timplay = timbasketplay::where('id_team_play', $id_team_play)->first();
        $relatedTeamName = $timplay->CallTeam->team_name;
        $relatedPlayerName = $timplay->CallPlayer->player_name;
        return view('content/TimBasket/EditTim', compact('timbasket', 'player', 'timplay', 'id_team_play', 'relatedPlayerName', 'relatedTeamName'));
    }
    
    public function update(Request $request, $id_team_play)
    {
        $request->validate([
            'id_team' => 'required',
            'id_player' => 'required',
            'team_name' => '',
        ]);
    
        $Bolabasket = [
            'id_team' => $request->id_team,
            'id_player' => $request->id_player,
        ];
        
        timbasketplay::where('id_team_play', $id_team_play)->update($Bolabasket);
    
        $upteam = [
            'team_name' => $request->team_name
        ];
    
        $timplay = timbasketplay::where('id_team_play', $id_team_play)->first();
        timbasket::where('id_team', $timplay->CallTeam['id_team'])->update($upteam);
    
        return redirect()->to('/timbasket');
    }
    public function CetakTim()
    {
        $filename = 'Tim Basket.pdf';
        $timbasket = timbasket::where('data_state', '=', 0)->get();
        $html = view()->make('content/TimBasket/CetakTim', ['timbasket' => $timbasket])->render();
        $pdf = new PDF;
        $pdf::SetTitle('Tim Basket');
        $pdf::AddPage();
        $pdf::writeHTML($html);
        $pdf::Output(public_path($filename), 'F');
        return response()->download(public_path($filename));
    }

    public function CetakTimExcel()
    {
        $timbasket = timbasket::where('data_state', '=', 0)->get();
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getDefaultStyle()
            ->getFont()
            ->setName('Arial')
            ->setSize('12');
        $activeWorksheet->getColumnDimension('A')->setWidth(5);
        $activeWorksheet->getColumnDimension('B')->setWidth(20);
        $activeWorksheet->getColumnDimension('C')->setWidth(20);
        
        $activeWorksheet->setCellValue('A1', 'Daftar Tim Basket');
        $activeWorksheet->getStyle('A1')->getFont()->setSize('16')->setBold(true);
        $activeWorksheet->mergeCells('A1:C1');
        $activeWorksheet->getStyle('A1:C1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


        $activeWorksheet
            ->setCellValue('A2', 'ID')
            ->setCellValue('B2', 'Nama Tim')
            ->setCellValue('C2', 'Nama Pemain');
        $activeWorksheet->getStyle('A2:C2')->getFont()->setBold(true);
        $activeWorksheet->getStyle('A2:C2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];

        $cell = 3;
        foreach ($timbasket as $tim) {
            $activeWorksheet->getStyle('A' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('B' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            $activeWorksheet->getStyle('C' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet
            ->setCellValue('A' . $cell, $tim['id_team']) 
            ->setCellValue('B' . $cell, $tim->CallTeam['team_name'])
            ->setCellValue('C' . $cell, $tim->CallPlayer['player_name']);
                
                $activeWorksheet->getStyle('A2:C' . $cell)->applyFromArray($styleArray);
                $cell++;
            }
            $activeWorksheet->getStyle('A' . $cell . ':C' . $cell)->getFont()->setBold(true); 
            
        $writer = new Xlsx($spreadsheet);
        $writer->save('Tim Basket.xlsx');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Tim Basket.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }

    public function detail($id_team_play)
    {
        $timplay = timbasketplay::where('id_team_play', $id_team_play)->first();
        return view('content/TimBasket/DetailTim', ['timplay' => $timplay]);
    }

    public function delete($id_team_play)
    {
        $timplay = ['data_state' => 1];
        timbasketplay::where('id_team_play', $id_team_play)->update($timplay);
        return redirect()->to('/timbasket');
    }

}