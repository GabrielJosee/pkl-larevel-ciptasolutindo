<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SlideShow;


class SlideShowController extends Controller
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
        $slide = SlideShow::where('data_state','=',0)->get();
        return view('content/SlideShow/ListSlide', compact('slide'));
    }

    public function screenTambah()
    {
        $slide    = SlideShow::where('data_state','=',0)->get();
        return view('content/SlideShow/TambahSlide', compact('slide'));
    }
    public function tambah(Request $request)
    {
        $request->validate([
            'pitcure' => '',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $slide = [
            'pitcure' => '',
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];
        $mediaName = '';
        
        if ($request->hasFile('pitcure')) {
            $media = $request->file('pitcure');
            $mediaExtension = $media->getClientOriginalExtension();
            $mediaName = time() . '.' . $mediaExtension;
            
            if ($mediaExtension === 'jpg' || $mediaExtension === 'png' || $mediaExtension === 'jpeg') {
                $media->move(public_path('images'), $mediaName);
            } elseif ($mediaExtension === 'mp4') {
                $media->move(public_path('videos'), $mediaName);
            }
            
            $slide['pitcure'] = $mediaName;
        }
        
        SlideShow::create($slide);
        
        
        $msge = 'slide Berhasil di Tambahkan';
        return redirect()->to('/slideshow')->with('msge',$msge);
    }

    public function edit($slide_id)
    {
        $slide = SlideShow::where('slide_id', $slide_id)->first();
        return view('content/SlideShow/EditSlide', compact('slide'));
    }    
    
    public function update(Request $request, $slide_id)
    {
        $request->validate([
            'pitcure' => '',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        
        $slide = [
            'pitcure' => '',
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];
        $mediaName = '';
        
        if ($request->hasFile('pitcure')) {
            $media = $request->file('pitcure');
            $mediaExtension = $media->getClientOriginalExtension();
            $mediaName = time() . '.' . $mediaExtension;
            
            if ($mediaExtension === 'jpg' || $mediaExtension === 'png' || $mediaExtension === 'jpeg') {
                $media->move(public_path('images'), $mediaName);
            } elseif ($mediaExtension === 'mp4') {
                $media->move(public_path('videos'), $mediaName);
            }
            
            $slide['pitcure'] = $mediaName;
        }
            
        SlideShow::where('slide_id', $slide_id)->update($slide);

        $msge = 'Slide Berhasil di Diubah';
        return redirect()->to('/slideshow')->with('msge',$msge);
    }

    public function delete($slide_id)
    {
        $slide = ['data_state' => 1];
        SlideShow::where('slide_id', $slide_id)->update($slide);
        $msge = 'Slide Berhasil di Hapus';
        return redirect()->to('/slideshow')->with('msge',$msge);
    }

    public function detail($slide_id)
    {
        $slide = SlideShow::where('slide_id', $slide_id)->first();
        return view('content/SlideShow/DetailSlide', ['slide' => $slide]);
    }
}
