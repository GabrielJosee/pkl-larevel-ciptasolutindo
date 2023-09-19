@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('product') }}">Daftar Slide</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Slide</li>
    </ol>
  </nav>

@stop

@section('content')

<h3 class="page-title">
    Form Edit Slide 
</h3>
<br/>
@if(session('msg'))
<div class="alert alert-info" role="alert">
    {{session('msg')}}
</div>
@endif
    <div class="card border border-dark">
    <div class="card-header border-dark bg-dark">
        <h5 class="mb-0 float-left">
            Form Edit
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('slideshow') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>Kembali</button>
        </div>
    </div>

    <form method="POST" action="{{ url('/slide/edit/process/' . $slide['slide_id']) }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="text-dark">Foto/Video<span class='red'> *</span></label>
                        <input class="form-control" type="file" accept="image/*, video/*" name="pitcure" id="pitcure" autocomplete="off"/>
                        
                        @php
                            $fileExtension = pathinfo($slide['pitcure'], PATHINFO_EXTENSION);
                        @endphp
                        
                        @if ($fileExtension === 'jpg' || $fileExtension === 'png')
                            <img src="{{ asset('images/'.$slide['pitcure']) }}" alt="Foto/Video" class="img-fluid">
                        @elseif ($fileExtension === 'mp4')
                            <video width="100%" controls>
                                <source src="{{ asset('videos/'.$slide['pitcure']) }}" type="video/mp4">
                                Maaf, browser Anda tidak mendukung pemutaran video.
                            </video>
                        @elseif ($fileExtension === '')
                            Tidak ada gambar atau video yang dipilih.
                        @else
                            Tipe konten tidak dikenali.
                        @endif
                
                        <small class="form-text text-muted">Upload gambar (jpg/png) atau video (mp4).</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <a class="text-dark">Keterangan<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="description" id="description" value="{{ $slide['description'] }}"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group form-md-line-input">
                        <section class="control-label">Tanggal Tayang
                            <span class="required text-danger">
                                *
                            </span>
                        </section>
                        <input type="date"
                            class="form-control form-control-inline input-medium date-picker input-date"
                            type="text" name="start_date" id="start_date" value="{{ $slide['start_date'] }}"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group form-md-line-input">
                        <section class="control-label">Tanggal Berakhir
                            <span class="required text-danger">
                                *
                            </span>
                        </section>
                        <input type="date"
                            class="form-control form-control-inline input-medium date-picker input-date"
                            type="text" name="end_date" id="end_date" value="{{ $slide['end_date'] }}"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <div class="form-actions float-right">
                <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i class="fa fa-times"></i> Batal</button>
                <button type="submit" name="Save" class="btn btn-primary" title="Save"><i class="fa fa-check"></i> Simpan</button>
            </div>
        </div>
    </div>
    </div>
</form>


@stop

@section('footer')
    
@stop

@section('css')
    
@stop

@section('js')
    
@stop