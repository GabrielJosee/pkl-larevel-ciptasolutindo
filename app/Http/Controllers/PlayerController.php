<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Exports\PlayerExport;
use App\Models\Player;
use App\Models\User;
use App\Models\SystemUserGroup;
// use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
Use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use DB;
use Symfony\Component\Routing\Route;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Facades\Session;

class PlayerController extends Controller
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
        $player = Player::where('data_state','=',0)->get();
        $systemusergroup    = SystemUserGroup::where('data_state','=',0)->get()->pluck('user_group_name','user_group_id');
     
        $user         = User::select('system_user.*', 'system_user_group.user_group_level')
        ->join('system_user_group', 'system_user.user_group_id', 'system_user_group.user_group_id')
        ->where('system_user.data_state', 0);
     
        if(!Session::get('user_group_id')){
            $user_group_id  = null;
            $user     = $user->get();
        }else{
            $user_group_id  = Session::get('user_group_id');
            $user     = $user->where('system_user.user_group_id', $user_group_id)->get();
        }
        return view('content/Player/ListPlayer', compact('player','user','systemusergroup','user_group_id'));
    }

    public function screenTambah()
    {
        $systemusergroup    = SystemUserGroup::where('data_state','=',0)->get();
        return view('content/Player/TambahPlayer', compact('systemusergroup'));
    }
    public function tambah(Request $request)
    {
        $request->validate([
            'player_name' => 'required',
            'birth_place' => 'required',
            'date_birth' => 'required',
            'player_address' => 'required',
            'player_image' => '',
            'player_gender' => 'required',
            'player_position' => 'required',
        ]);

        $player = [
            'player_name' => $request->player_name,
            'birth_place' => $request->birth_place,
            'date_birth' => $request->date_birth,
            'player_address' => $request->player_address,
            'player_image' => '', 
            'player_gender' => $request->player_gender,
            'player_position' => $request->player_position,
        ];
        $imageName = ''; 

        if ($request->hasFile('player_image')) {
            $image = $request->file('player_image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $player['player_image'] = $imageName; 
        }
        $newPlayer = Player::create($player);

        
        $user = User::create([
            'name' => $newPlayer['player_name'],
            'full_name' => $newPlayer['player_name'],
            'password' => Hash::make('123456'),
            'user_group_id' => 4,
        ]);
    
        
        $user->id_player = $newPlayer->id_player;
        $user->save();
        
        $msge = 'Pemain Berhasil di Tambahkan';
        return redirect()->to('/player')->with('msge',$msge);
    }

    public function edit($id_player)
    {
        $systemusergroup    = SystemUserGroup::where('data_state','=',0)->get()->pluck('user_group_name','user_group_id');
        $user    = SystemUserGroup::where('data_state','=',0)->get()->pluck('name','user_id','full_name');
        $player = Player::where('id_player', $id_player)->first();
        return view('content/Player/EditPlayer', compact('systemusergroup', 'user', 'player'));
    }    
    
    public function update(Request $request, $id_player)
    {
        $request->validate([
            'player_name' => 'required',
            'birth_place' => 'required',
            'date_birth' => 'required',
            'player_address' => 'required',
            'player_gender' => 'required',
            'player_position' => 'required',
        ]);
        
        $player = [
            'player_name' => $request->player_name,
            'birth_place' => $request->birth_place,
            'date_birth' => $request->date_birth,
            'player_address' => $request->player_address,
            'player_image' => '', 
            'player_gender' => $request->player_gender,
            'player_position' => $request->player_position,
        ];
        $imageName = ''; 

        if ($request->hasFile('player_image')) {
            $image = $request->file('player_image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $player['player_image'] = $imageName; 
        }    
        Player::where('id_player', $id_player)->update($player);

        $user = User::where('name', $player['player_name'])->first();
        if ($user) {
            $user->name = $request->player_name;
            $user->full_name = $request->player_name;
            $user->save();
        }
        $msge = 'Pemain Berhasil di Diubah';
        return redirect()->to('/player')->with('msge',$msge);
    }

    public function delete($id_player)
    {
        $player = ['data_state' => 1];
        Player::where('id_player', $id_player)->update($player);
        $msge = 'Produk Berhasil di Hapus';
        return redirect()->to('/player')->with('msge',$msge);
    }
    public function detail($id_player)
    {
        $player = Player::where('id_player', $id_player)->first();
        return view('content/Player/DetailPlayer', ['player' => $player]);
    }

    public function CetakPlayer()
    {
        $filename = 'player.pdf';
        $id_player = Player::where('data_state', '=', 0)->get();
        $html = view()->make('content/player/CetakPlayer', ['id_player' => $id_player])->render();
        $pdf = new PDF;
        $pdf::SetTitle('Player');
        $pdf::AddPage();
        $pdf::writeHTML($html);
        $pdf::Output(public_path($filename), 'F');
        return response()->download(public_path($filename));
    }

    public function CetakPlayerExcel()
    {
        $player = Player::where('data_state', '=', 0)->get();
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
        
        $activeWorksheet->setCellValue('A1', 'Daftar Pemain');
        $activeWorksheet->getStyle('A1')->getFont()->setSize('16')->setBold(true);
        $activeWorksheet->mergeCells('A1:H1');
        $activeWorksheet->getStyle('A1:H1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


        $activeWorksheet
            ->setCellValue('A2', 'ID')
            ->setCellValue('B2', 'Nama Pemain')
            ->setCellValue('C2', 'Tempat Lahir')
            ->setCellValue('D2', 'Tanggal Lahir')
            ->setCellValue('E2', 'Alamat')
            ->setCellValue('F2', 'Foto')
            ->setCellValue('G2', 'Gender')
            ->setCellValue('H2', 'Posisi');
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
        foreach ($player as $ply) {
            $activeWorksheet->getStyle('A' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('B' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            $activeWorksheet->getStyle('C' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('D' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('E' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('F' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('G' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet->getStyle('H' . $cell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $activeWorksheet
                ->setCellValue('A' . $cell, $ply['id_player'])
                ->setCellValue('B' . $cell, $ply['player_name'])
                ->setCellValue('C' . $cell, $ply['birth_place'])
                ->setCellValue('D' . $cell, $ply['date_birth'])
                ->setCellValue('E' . $cell, $ply['player_address'])
                ->setCellValue('F' . $cell, $ply['player_image']);
                if ($ply['player_gender'] == 1) {
                    $activeWorksheet->setCellValue('G' . $cell, 'Laki - Laki');
                } else if ($ply['player_gender'] == 2) {
                    $activeWorksheet->setCellValue('G' . $cell, 'Perempuan');
                };

                if ($ply['player_position'] == 1) {
                    $activeWorksheet->setCellValue('H' . $cell, 'Point Guard');
                } else if ($ply['player_position'] == 2) {
                    $activeWorksheet->setCellValue('H' . $cell, 'Shooting Guard');
                } else if ($ply['player_position'] == 3) {
                    $activeWorksheet->setCellValue('H' . $cell, 'Small Forward');
                } else if ($ply['player_position'] == 4) {
                    $activeWorksheet->setCellValue('H' . $cell, 'Power Forward');
                } else if ($ply['player_position'] == 5) {
                    $activeWorksheet->setCellValue('H' . $cell, 'Center');
                };  
                
                $activeWorksheet->getStyle('A2:H' . $cell)->applyFromArray($styleArray);
                $cell++;
            }
            $activeWorksheet->getStyle('A' . $cell . ':H' . $cell)->getFont()->setBold(true); 
            
        $writer = new Xlsx($spreadsheet);
        $writer->save('Player.xlsx');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Player.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
