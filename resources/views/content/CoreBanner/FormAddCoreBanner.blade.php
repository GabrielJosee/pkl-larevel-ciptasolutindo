@extends('adminlte::page')

@section('title', 'Tanggapan')
@section('js')
<script>
    function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "{{route('add-banner-elements')}}",
				data : {
                    'name'      : name, 
                    'value'     : value,
                    '_token'    : '{{csrf_token()}}'
                },
				success: function(msg){
			}
		});
	}

    function reset_add(){
		$.ajax({
				type: "GET",
				url : "{{route('add-reset-banner')}}",
				success: function(msg){
                    location.reload();
			}

		});
	}
</script>
@stop
@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('banner') }}">Daftar Banner</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Banner</li>
    </ol>
  </nav>

@stop

@section('content')

<h3 class="page-title">
    Form Tambah Banner
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
            Form Tambah
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('banner') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</button>
        </div>
    </div>

    <?php 
            if (empty($corebanner)){
                $corebanner['banner_name']          = '';
                $corebanner['banner_redirect_link'] = '';
            }
        ?>

    <form method="post" action="{{route('process-add-banner')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Nama Banner<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="banner_name" id="banner_name" value="<?php echo $corebanner['banner_name']?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>

                        <input class="form-control input-bb" type="hidden" name="banner_token" id="banner_token" value="<?php echo $banner_token ?>"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Redirect Link<a class='red'> *</a></a>
                        <input class="form-control input-bb" type="text" name="banner_redirect_link" id="banner_redirect_link" value="<?php echo $corebanner['banner_redirect_link']?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <a class="text-dark">File Gambar Banner<a class='red'> *</a></a>
                    <br>
                    <input type="file" name="banner_image" id="banner_image" value="" accept="image/*"/>
                </div>
            </div>  
        </div>
        <div class="card-footer text-muted">
            <div class="form-actions float-right">
                <button type="reset" name="Reset" class="btn btn-danger" onClick="reset_add();"><i class="fa fa-times"></i> Batal</button>
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