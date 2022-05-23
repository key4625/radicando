@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <h4 class="text-center text-uppercase">{{  Carbon\Carbon::now()->translatedFormat('d F Y') }}</h4>
    <div class="row">
        @if(App\Models\Setting::find('gest_coltivazioni')->value == "on")
            <div class="col-12 col-xl-6 row">        
                <div class="col-12 my-4"><h3>Semine e trapianti consigliati ad {{  Carbon\Carbon::now()->translatedFormat('F') }}</h3></div>
                <div class="col-12 col-sm-4">
                    <div class="card">
                        <div class="card-header">Semina in pieno campo</div>
                        <ul class="list-group list-group-flush">
                            @foreach($piante_semina_mese as $p_s_m)
                                <li class="list-group-item">{{ $p_s_m->nome }} </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card">
                        <div class="card-header">Semina al coperto</div>
                        <ul class="list-group list-group-flush">
                            @foreach($piante_semina_out_mese as $p_s_m)
                                <li class="list-group-item">{{ $p_s_m->nome }} </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card">
                        <div class="card-header">Trapianti</div>
                        <ul class="list-group list-group-flush">
                            @foreach($piante_trapianto_mese as $p_s_m)
                                <li class="list-group-item">{{ $p_s_m->nome }} </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                
            </div>
        @endif
        @if(App\Models\Setting::find('gest_coltivazioni')->value == "on")
            <div class="col-12 col-xl-6">
                <div class="col-12 my-4"><h3>Andamento coltivazioni</h3></div>
            </div>
        @endif
        <div class="col-12 col-xl-6">
            <div class="col-12 my-4"><h3>Ultimi ordini</h3></div>
        </div>
        
    </div>   
@endsection
