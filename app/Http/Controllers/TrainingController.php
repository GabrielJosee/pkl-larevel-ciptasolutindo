<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingGround;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class TrainingController extends Controller
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
        $training = TrainingGround::where('data_state','=',0)->get();
        return view('content/Training/ListTraining', compact('training'));
    }

    public function screenTambah()
    {
        return view('content/Training/TambahTraining');
    }
    public function tambah(Request $request)
    {
        $request->validate([
            'training_ground_name' => 'required',
            'training_ground_address' => 'required',
            'contact_person' => 'required',
            'number_phone' => 'required',
            'open_hours' => 'required',
            'close_hours' => 'required'
        ]);
    
        $training = [
            'training_ground_name' => $request->training_ground_name,
            'training_ground_address' => $request->training_ground_address,
            'contact_person' => $request->contact_person,
            'number_phone' => $request->number_phone,
            'open_hours' => $request->open_hours,
            'close_hours' => $request->close_hours,
        ];
        TrainingGround::create($training);
        $message = 'Latihan Berhasil di Tambah';
        return redirect()->to('/training')->with('message',$message);
    }
   
    public function edit($training_ground_id)
    {
        $training = TrainingGround::where('training_ground_id', $training_ground_id)->first();
        return view('content/Training/EditTraining', ['training' => $training]);
    }    
    public function update(Request $request, $training_ground_id)
    {
        $request->validate([
            'training_ground_name' => 'required',
            'training_ground_address' => 'required',
            'contact_person' => 'required',
            'number_phone' => 'required',
            'open_hours' => 'required',
            'close_hours' => 'required '
        ]);
        
        $training = [
            'training_ground_name' => $request->training_ground_name,
            'training_ground_address' => $request->training_ground_address,
            'contact_person' => $request->contact_person,
            'number_phone' => $request->number_phone,
            'open_hours' => $request->open_hours,
            'close_hours' => $request->close_hours,
        ];
        TrainingGround::where('training_ground_id', $training_ground_id)->update($training);
        $message = 'Jadwal berhasil di Edit';
        return redirect()->to('/training')->with('message',$message);
    }

    public function delete($training_ground_id)
    {
        $training = ['data_state' => 1];
        TrainingGround::where('training_ground_id', $training_ground_id)->update($training);
        $message = 'Jadwal Berhasil di Hapus';
        return redirect()->to('/training')->with('message',$message);
    }
    public function detail($training_ground_id)
    {
        $training = TrainingGround::where('training_ground_id',$training_ground_id)->first();
        return view('content/Training/DetailTraining', compact('training'));
    }
}
