@extends('adminlte::page')

@section('title', 'Tanggapan')    
@section('js')
@stop

@section('content_header')
    
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="{{ url('item') }}">Daftar Item</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Item</li>
    </ol>
</nav>

@stop

@section('content')

<h3 class="page-title">
    Form Detail Item
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
            Detail Item
        </h5>
        <div class="float-right">
            <button onclick="location.href='{{ url('item') }}'" name="Find" class="btn btn-sm btn-info" title="Back"><i class="fa fa-angle-left"></i>  Kembali</button>
        </div>
    </div>

    <form>
        @csrf
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Nama Item</a>
                        <input class="form-control input-bb" type="text" name="item_name" id="item_name" value="{{$invtitem['item_name']}}" autocomplete="off" readonly/>

                        <input class="form-control input-bb" type="hidden" name="item_id" id="item_id" value="{{$invtitem['item_id']}}"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Seller</a>
                        <input class="form-control input-bb" type="text" name="item_name" id="item_name" value="{{$invtitem['seller_name']}}" autocomplete="off" readonly/>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                    <div class="form-group">
                        <a class="text-dark">Deskripsi</a>
                        <textarea class="form-control input-bb" type="text" name="item_description" id="item_description" autocomplete="off" readonly>{{$invtitem['item_description']}}</textarea>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Kategori</a>
                        <input class="form-control input-bb" type="text" name="item_category_name" id="item_category_name" value="{{$invtitem['item_category_name']}}" autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Tipe</a>
                        <?php if($invtitem['item_type'] == 0){?>
                            <input class="form-control input-bb" type="text" name="type_name" id="type_name" value="Barang" autocomplete="off" readonly/>
                        <?php }else{?>
                            <input class="form-control input-bb" type="text" name="type_name" id="type_name" value="Jasa" autocomplete="off" readonly/>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php if($invtitem['item_variant'] == 0){?>
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Harga Satuan</a>
                        <input class="form-control input-bb" type="text" name="item_price" id="item_price" value="{{number_format($invtitem['item_price'])}}" autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php if($invtitem['item_type'] == 0){?>
                            <a class="text-dark">Stock Item</a>
                            <input class="form-control input-bb" type="text" name="item_stock" id="item_stock" value="{{number_format($invtitem['item_stock'])}}" autocomplete="off" readonly/>
                        <?php }else{?>
                            <a class="text-dark">Lama Waktu</a>
                            <input class="form-control input-bb" type="text" name="item_length" id="item_length" value="{{$invtitem['item_length'].' menit'}}" autocomplete="off" readonly/>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <a class="text-dark">Favorit</a>
                        <input class="form-control input-bb" type="text" name="item_favorite" id="item_favorite" value="{{number_format($invtitem['item_favorite']).' User'}}" autocomplete="off" readonly/>
                    </div>
                </div>
            </div>
            <?php }else{?>
            <div class="row form-group">
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Range Harga</a>
                        <input class="form-control input-bb" type="text" name="item_price_range" id="item_price_range" value="{{number_format($invtitem['item_price_floor']).' - '.number_format($invtitem['item_price_limit'])}}" autocomplete="off" readonly/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <a class="text-dark">Favorit</a>
                        <input class="form-control input-bb" type="text" name="item_favorite" id="item_favorite" value="{{number_format($invtitem['item_favorite']).' User'}}" autocomplete="off" readonly/>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    </div>
</form>

<?php if($invtitem['item_variant'] == 1 && $invtitem['item_type'] == 0){?>
    <form>
    @csrf
        <div class="card border border-dark">
            <div class="card-header border-dark bg-dark">
                <h5 class="mb-0 float-left">
                    List Variant
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                        <thead>
                            <tr>
                                <th width="5%" style='text-align:center'>No</th>
                                <th width="15%" style='text-align:center'>Nama Variant</th>
                                <th width="20%" style='text-align:center'>Stock</th>
                                <th width="25%" style='text-align:center'>Harga</th>
                                <th width="25%" style='text-align:center'>Deskripsi</th>
                                <th width="10%" style='text-align:center'>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(count($invtitemvariant)!=0){
                            $no = 1; 
                            ?>
                            @foreach($invtitemvariant as $item)
                            <tr>
                                <td align="center">{{$no}}</td>
                                <td align="left">{{$item['item_variant_name']}}</td>
                                <td align="right">{{number_format($item['item_variant_stock'])}}</td>
                                <td align="right">{{number_format($item['item_variant_price'])}}</td>
                                <td align="left">{{$item['item_variant_description']}}</td>
                                <td align="left">
                                    <?php if($item['item_variant_status'] != 2){?>
                                        <a type="button" class="btn btn-outline-danger btn-sm" href="{{ url('/item/blokir-variant/'.$item['item_variant_id']) }}">Blokir</a>
                                    <?php }else{?>
                                        <a type="button" class="btn btn-outline-success btn-sm" href="{{ url('/item/unblokir-variant/'.$item['item_variant_id']) }}">Buka Blokir</a>
                                    <?php }?>
                                </td>
                            </tr>
                            <?php $no++ ?>
                            @endforeach
                            <?php }else{?>
                            <tr>
                                <td align="center" colspan="6">Data Kosong</td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
<?php } ?>

<?php if($invtitem['item_variant'] == 1 && $invtitem['item_type'] == 1){?>
    <form>
    @csrf
        <div class="card border border-dark">
            <div class="card-header border-dark bg-dark">
                <h5 class="mb-0 float-left">
                    List Variant
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table style="width:100%" class="table table-striped table-bordered table-hover table-full-width">
                        <thead>
                            <tr>
                                <th width="5%" style='text-align:center'>No</th>
                                <th width="15%" style='text-align:center'>Nama Variant</th>
                                <th width="20%" style='text-align:center'>Lama Waktu</th>
                                <th width="25%" style='text-align:center'>Harga</th>
                                <th width="25%" style='text-align:center'>Deskripsi</th>
                                <th width="10%" style='text-align:center'>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(count($invtitemvariant)!=0){
                            $no = 1; 
                            ?>
                            @foreach($invtitemvariant as $item)
                            <tr>
                                <td align="center">{{$no}}</td>
                                <td align="left">{{$item['item_variant_name']}}</td>
                                <td align="left">{{$item['item_variant_length'].' menit'}}</td>
                                <td align="right">{{number_format($item['item_variant_price'])}}</td>
                                <td align="left">{{$item['item_variant_description']}}</td>
                                <td align="left">
                                    <?php if($item['item_variant_status'] != 2){?>
                                        <a type="button" class="btn btn-outline-danger btn-sm" href="{{ url('/item/blokir-variant/'.$item['item_variant_id']) }}">Blokir</a>
                                    <?php }else{?>
                                        <a type="button" class="btn btn-outline-success btn-sm" href="{{ url('/item/unblokir-variant/'.$item['item_variant_id']) }}">Buka Blokir</a>
                                    <?php }?>
                                </td>
                            </tr>
                            <?php $no++ ?>
                            @endforeach
                            <?php }else{?>
                            <tr>
                                <td align="center" colspan="6">Data Kosong</td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
<?php } ?>

@stop

@section('footer')
    
@stop

@section('css')
    
@stop