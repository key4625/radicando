@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
 
    <h4 class="text-center text-uppercase">{{  Carbon\Carbon::now()->translatedFormat('d F Y') }}</h4>
    <div class="row">
        @if(App\Models\Setting::find('gest_coltivazioni')->value == "on")
            <div class="col-12 col-xl-6">   
                <div class="card">   
                    <div class="card-body row text-center">
                        <div class="col-12 my-4"><h3>Semine e trapianti consigliati {{  Carbon\Carbon::now()->translatedFormat('F') }}</h3></div>
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
                </div>

                
            </div>
        @endif
        @if(App\Models\Setting::find('gest_coltivazioni')->value == "on")
            <div class="col-12 col-xl-6 text-center">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12 my-4 "><h3>Andamento coltivazioni</h3></div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-12 col-xl-6">
            <livewire:ordinisintesi />
        </div>
        <div class="col-12 col-xl-6">
            <livewire:ordinisintesi2 />
        </div> 
        <div class="col-12 col-xl-12">
            <livewire:statistica1 />
        </div>        
    </div>   
    
@endsection

@push('before-scripts')
@livewireChartsScripts

@endpush
@push('after-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.4/apexcharts.min.js" integrity="sha512-oUoSexkALUPd0BQaO/0m029XijXQ7XlFbPIhDNvzD8r2XhUjidiRo/8YhJGpoevLZVRwRFBvygSc9jV2TagjfQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush