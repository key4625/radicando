@extends('backend.layouts.app')

@section('title', __('Prodotti'))

@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <div>@if(isset($product)) Modifica prodotto @else Crea nuovo prodotto @endif </div>
            <a href="{{route('admin.prodotti.index')}}" class="btn btn-primary"><i class="fas fa-home"></i> Indice</a> 
        </div>

        <div class="card-body">
           
            @if(isset($product))
                <form action="{{ route('admin.prodotti.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            @else
                <form action="{{ route('admin.prodotti.store') }}" method="POST" enctype="multipart/form-data" >
                    @csrf
            @endif
                
              
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="name" @if(isset($product)) value="{{$product->name}}" @endif class="form-control" placeholder="Nome">
                            @error('name')<div class="text-danger">Inserire un nome</div>@enderror
                        </div>
                    </div>
                  
                
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label>Ordinamento (1-10)</label>
                            <input type="number"class="form-control" name="priority" @if(isset($plant)) value="{{$plant->priority}}" @else value="5" @endif>
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label>Fragilità</label>
                           <select class="form-control" name="fragile">
                               <option value="0" @if(isset($plant)&&($plant->fragile==0)) selected="selected" @endif>0</option>
                               <option value="1" @if(isset($plant)&&($plant->fragile==1)) selected="selected" @endif>1</option>
                               <option value="2" @if(isset($plant)&&($plant->fragile==2)) selected="selected" @endif>2</option>
                               <option value="3" @if(isset($plant)&&($plant->fragile==3)) selected="selected" @endif>3</option>
                               <option value="4" @if(isset($plant)&&($plant->fragile==4)) selected="selected" @endif>4</option>
                               <option value="5" @if(isset($plant)&&($plant->fragile==5)) selected="selected" @endif>5</option>
                           </select>
                        </div>
                    </div>
                    <div class="col-4 col-md-2">
                        <div class="form-group">
                            <label>Prezzo</label>
                            <input type="text" name="price" @if(isset($product)) value="{{$product->price}}" @else value=0 @endif class="form-control" placeholder="0.0">
                            @error('price')<div class="text-danger">Inserire un prezzo</div>@enderror
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
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Tipologia prodotto</label>
                            <select name="productcategories_id" class="form-control">
                                <option value="0">Seleziona una tipologia</option>
                                @foreach($productcategories as $single_cat)
                                    <option value="{{$single_cat->id}}" @if(isset($product)&&($product->productcategories_id == $single_cat->id)) selected="selected" @endif>{{$single_cat->name}}</option>
                                @endforeach
                            </select>
                            @error('productcategories_id')<div class="text-danger">Selezionare una tipologia</div>@enderror
                        </div>
                    </div>
                   
                    <div class="col-4 col-md-2">
                        <div class="form-group">
                            <label>Quantità mag</label>
                            <input type="number" name="quantity_mag" @if(isset($product)) value="{{$product->quantity_mag}}" @else value=0 @endif class="form-control" placeholder="0">
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div class="form-group">
                            <label>N° Lotto</label>
                            <input type="text" name="lot" @if(isset($product)) value="{{$product->lot}}" @endif class="form-control" placeholder="lotto n°">
                        </div>
                    </div>
                    <div class="col-4 col-md-2">
                        <div class="form-group">
                            <label>Dimensioni (kg o litri)</label>
                            <input type="number" name="dimension" @if(isset($product)) value="{{$product->dimension}}" @else value=0 @endif class="form-control" placeholder="0.0">
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
                 
                   
                    @if(App\Models\Setting::find('gest_coltivazioni')->value == "on")
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Coltivazione associata</label>
                                <select name="cultivation_id" class="form-control">
                                    <option value="0">Seleziona una coltivazione</option>
                                    @foreach($cultivations as $single_cult)
                                        <option value="{{$single_cult->id}}" @if(isset($product)&&($product->cultivation_id == $single_cult->id)) selected="selected" @endif>{{$single_cult->cultivable->name}} - {{$single_cult->data_inizio}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    

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