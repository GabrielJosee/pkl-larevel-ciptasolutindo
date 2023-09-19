@inject('InvtItem', 'App\Http\Controllers\InvtItemController')

@extends('adminlte::page')

@section('title', 'Tanggapan')

@section('js')
<script>
	$(document).ready(function(){
        var seller_id               = {!! json_encode($seller_id) !!};
        var item_category_id        = {!! json_encode($item_category_id) !!};
        
        if(seller_id == null){
            $("#seller_id").select2("val", "0");
        }
        
        if(item_category_id == null){
            $("#item_category_id").select2("val", "0");
        }
    });
</script>
@stop

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Daftar Item</li>
    </ol>
</nav>

@stop

@section('content')

<h3 class="page-title">
    <b>Daftar Item</b> <small>Mengelola Item</small>
</h3>
<br/>
<div id="accordion">
    <form  method="post" action="{{route('filter-item')}}" enctype="multipart/form-data">
    @csrf
        <div class="card border border-dark">
        <div class="card-header bg-dark" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <h5 class="mb-0">
                Filter
            </h5>
        </div>
    
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <div class = "row">
                    <div class="col-md-6">
                        <a class="text-dark">Penjual</a>
                        <br/>
                        {!! Form::select('seller_id',  $seller, $seller_id, ['class' => 'selection-search-clear select-form', 'id' => 'seller_id']) !!}
                    </div>
                    <div class="col-md-6">
                        <a class="text-dark">Kategori</a>
                        <br/>
                        {!! Form::select('item_category_id',  $invtitemcategory, $item_category_id, ['class' => 'selection-search-clear select-form', 'id' => 'item_category_id']) !!}
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <div class="form-actions float-right">
                    <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i class="fa fa-times"></i> Batal</button>
                    <button type="submit" name="Find" class="btn btn-primary" title="Search Data"><i class="fa fa-search"></i> Cari</button>
                </div>
            </div>
        </div>
        </div>
    </form>
</div>
<br/>
@if(session('msg'))
<div class="alert alert-info" role="alert">
    {{session('msg')}}
</div>
@endif 
<div class="card border border-dark">
    <div class="card-header bg-dark clearfix">
        <h5 class="mb-0 float-left">
            Daftar
        </h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="example" style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                <thead>
                    <tr>
                        <th width="5%" style='text-align:center'>No</th>
                        <th width="15%" style='text-align:center'>Nama Seller</th>
                        <th width="20%" style='text-align:center'>Nama Kategori</th>
                        <th width="25%" style='text-align:center'>Nama Item</th>
                        <th width="15%" style='text-align:center'>Harga Item</th>
                        <th width="10%" style='text-align:center'>Favorit</th>
                        <th width="10%" style='text-align:center'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach($invtitem as $item)
                    <tr>
                        <td style='text-align:center'>{{$no}}</td>
                        <td>{{$item['seller_name']}}</td>
                        <td>{{$item['item_category_name']}}</td>
                        <td>{{$item['item_name']}}</td>
                        <?php if($item['item_variant'] == 0){ ?>
                            <td style='text-align:right'>{{number_format($item['item_price'])}}</td>
                        <?php }else{ ?>
                            <td style='text-align:right'>{{number_format($item['item_price_floor']).' - '.number_format($item['item_price_limit'])}}</td>
                        <?php } ?>
                        <td>{{number_format($item['item_favorite']).' User'}}</td>
                        <td class="">
                            <a type="button" class="btn btn-outline-warning btn-sm" href="{{ url('/item/detail/'.$item['item_id']) }}">Detail</a>
                            <?php if($item['item_status'] != 2){?>
                                <a type="button" class="btn btn-outline-danger btn-sm" href="{{ url('/item/blokir/'.$item['item_id']) }}">Blokir</a>
                            <?php }else{?>
                                <a type="button" class="btn btn-outline-success btn-sm" href="{{ url('/item/unblokir/'.$item['item_id']) }}">Buka Blokir</a>
                            <?php }?>
                        </td>
                    </tr>
                    <?php $no++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>

@stop

@section('footer')
    
@stop

@section('css')
    
@stop