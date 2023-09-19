<?php

namespace App\Http\Controllers;

use App\Models\JadwalKesehatan;
use App\Models\KategoriKesehatan;
use Illuminate\Http\Request;

class JadwalKesehatanController extends Controller
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
        $jk = JadwalKesehatan::where('data_state','=',0)->get();
        return view('content/JadwalKesehatan/ListJadwal', compact('jk'));
    }

    public function screenTambah()
    {
        $jk    = JadwalKesehatan::where('data_state','=',0)->get();
        return view('content/JadwalKesehatan/TambahJadwal', compact('jk'));
    }
    public function tambah(Request $request)
    {
        $request->validate([
            'month_period' => 'required',
            'year_period' => 'required',        
        ]);

        $jk = [
            'month_period' => $request->month_period,
            'year_period' => $request->year_period,
        ];
    
         JadwalKesehatan::create($jk);
        
        
        $msge = 'Jadwal Penilaian Kesehatan Berhasil di Tambahkan';
        return redirect()->to('/jadwalkesehatan')->with('msge',$msge);
    }

    public function edit($health_assessment_schedule_id)
    {
        $jk = JadwalKesehatan::where('health_assessment_schedule_id', $health_assessment_schedule_id)->first();
        return view('content/JadwalKesehatan/EditJadwal', compact('jk'));
    }    
    
    public function update(Request $request, $health_assessment_schedule_id)
    {
        $request->validate([
            'month_period' => 'required',
            'year_period' => 'required',        
        ]);

        $jk = [
            'month_period' => $request->month_period,
            'year_period' => $request->year_period,
        ];

        JadwalKesehatan::where('health_assessment_schedule_id', $health_assessment_schedule_id)->update($jk);

        $msge = 'Jadwal Penilaian Kesehatan Berhasil di Diubah';
        return redirect()->to('/jadwalkesehatan')->with('msge',$msge);
    }

    public function delete($health_assessment_schedule_id)
    {
        $jk = ['data_state' => 1];
        JadwalKesehatan::where('health_assessment_schedule_id', $health_assessment_schedule_id)->update($jk);
        $msge = 'Jadwal Penilaian Kesehatan  Berhasil di Hapus';
        return redirect()->to('/jadwalkesehatan')->with('msge',$msge);
    }

}
