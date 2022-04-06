@extends('backend.layouts.app')

@push('after-styles')
@endpush
@section('title', __('Prodotti'))

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <div>@if(isset($product)) Modifica prodotto @else Crea nuovo prodotto @endif </div>
            <a href="{{route('admin.prodotti.index')}}" class="btn btn-primary"><i class="fas fa-home"></i> Indice</a> 
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Error!</strong> 
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li></li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(isset($product))
                <form action="{{ route('admin.prodotti.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            @else
                <form action="{{ route('admin.prodotti.store') }}" method="POST" enctype="multipart/form-data" >
                    @csrf
            @endif
                
              
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="name" @if(isset($product)) value="{{$product->name}}" @endif class="form-control" placeholder="Nome">
                        </div>
                    </div>
                    <div class="col-4 col-md-2">
                        <div class="form-group">
                            <label>Dimensioni (kg o litri)</label>
                            <input type="number" name="dimension" @if(isset($product)) value="{{$product->dimension}}" @else value=0 @endif class="form-control" placeholder="0.0">
                        </div>
                    </div> 
                    <div class="col-4 col-md-2">
                        <div class="form-group">
                            <label>Quantità mag</label>
                            <input type="number" name="quantity_mag" @if(isset($product)) value="{{$product->quantity_mag}}" @else value=0 @endif class="form-control" placeholder="0">
                        </div>
                    </div>
                    <div class="col-4 col-md-2">
                        <div class="form-group">
                            <label>Prezzo</label>
                            <input type="text" name="price" @if(isset($product)) value="{{$product->price}}" @else value=0 @endif class="form-control" placeholder="0.0">
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="form-group">
                            <label>Coltivazione associata</label>
                            <select name="cultivation_id" class="form-control">
                                <option value="0">Seleziona una coltivazione</option>
                                @foreach($cultivations as $single_cult)
                                    <option value="{{$single_cult->id}}" @if(isset($product)&&($product->cultivation_id == $single_cult->id)) selected="selected" @endif>{{$single_cult->plant->name}} - {{$single_cult->data_inizio}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div class="form-group">
                            <label>N° Lotto</label>
                            <input type="text" name="lot" @if(isset($product)) value="{{$product->lot}}" @endif class="form-control" placeholder="lotto n°">
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div class="form-group">
                            <label>In vendita</label>
                           <select class="form-control" name="vendibile">
                               <option value="1" @if(isset($product)&&($product->vendibile == 1)) selected="selected" @endif>Si</option>
                               <option value="0" @if(isset($product)&&($product->vendibile == 0)) selected="selected" @endif>No</option>
                           </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Descrizione</label>
                            <textarea name="description"  class="form-control" rows="3">@if(isset($product)) {{$product->description}} @endif</textarea>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Immagine</label>
                            <input type="file" class="form-control-file" name="file_upload">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            @if(isset($product)&&($product->image!=null)) 
                            <img class="img-fluid" style="max-height:400px;" src="{{ Storage::url($product->image) }}">
                            @endif
                        </div>
                    </div>
                 
                   
                   
                    

                    <div class="col-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">@if(isset($product)) <i class="fas fa-save"></i> Salva @else <i class="fas fa-plus"></i> Crea @endif</button>
                    </div>
                </div>
        
            </form>

        </div>
    </div>

@endsection

@push('after-scripts')
@endpush