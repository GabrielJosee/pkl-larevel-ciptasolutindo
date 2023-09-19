<?php

namespace App\Http\Controllers;

use App\Models\KategoriKesehatan;
use Illuminate\Http\Request;

class KategoriKesehatanController extends Controller
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
        $kt = KategoriKesehatan::where('data_state','=',0)->get();
        return view('content/KategoriKesehatan/ListKategori', compact('kt'));
    }

    public function screenTambah()
    {
        $kt    = KategoriKesehatan::where('data_state','=',0)->get();
        return view('content/KategoriKesehatan/TambahKategori', compact('kt'));
    }
    public function tambah(Request $request)
    {
        $request->validate([
            'kode_assessment' => 'required',
            'name_assessment' => 'required',
            'information_assessment' => 'required',
        ]);

        $kt = [
            'kode_assessment' => $request->kode_assessment,
            'name_assessment' => $request->name_assessment,
            'information_assessment' => $request->information_assessment,
        ];
    
         KategoriKesehatan::create($kt);
        
        
        $msge = 'Kategori Penilaian Kesehatan Berhasil di Tambahkan';
        return redirect()->to('/kategorikesehatan')->with('msge',$msge);
    }

    public function edit($health_assessment_categories_id)
    {
        $kt = KategoriKesehatan::where('health_assessment_categories_id', $health_assessment_categories_id)->first();
        return view('content/KategoriKesehatan/EditKategori', compact('kt'));
    }    
    
    public function update(Request $request, $health_assessment_categories_id)
    {
        $request->validate([
            'kode_assessment' => 'required',
            'name_assessment' => 'required',
            'information_assessment' => 'required',
        ]);

        $kt = [
            'kode_assessment' => $request->kode_assessment,
            'name_assessment' => $request->name_assessment,
            'information_assessment' => $request->information_assessment,
        ];

        KategoriKesehatan::where('health_assessment_categories_id', $health_assessment_categories_id)->update($kt);

        $msge = 'Kategori Penilaian Kesehatan Berhasil di Diubah';
        return redirect()->to('/kategorikesehatan')->with('msge',$msge);
    }

    public function delete($health_assessment_categories_id)
    {
        $kt = ['data_state' => 1];
        KategoriKesehatan::where('health_assessment_categories_id', $health_assessment_categories_id)->update($kt);
        $msge = 'Kategori Penilaian Kesehatan  Berhasil di Hapus';
        return redirect()->to('/kategorikesehatan')->with('msge',$msge);
    }

}
