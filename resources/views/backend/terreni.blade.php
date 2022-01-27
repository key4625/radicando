@extends('backend.layouts.app')

@section('title', __('Terreni'))

@push('after-styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.Default.css" />
@endpush

@section('content')
    <livewire:backend.fields-livewire />
@endsection

@push('after-scripts')

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script src="https://leaflet.github.io/Leaflet.markercluster/dist/leaflet.markercluster-src.js"></script>
<script>
    var dynamicPointsList;
 

    function fillMap() {   
        var container = L.DomUtil.get('map'); 
        if(container != null){ container._leaflet_id = null; }
        var map = L.map('map').setView([43.520933, 13.225302], 10); 
        var OpenStreetMap_Mapnik = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {            
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
       
    }
    function markerOnClick(e)
    {
        map.setView(e.latlng);
       
    }
    
   
   window.addEventListener('map-updated', event => { 
        dynamicPointsList = event.detail.pointList;
        //console.log("mappa aggiornata");
        fillMap();      
    });

</script>

<script>
Livewire.on("deleteTriggered", (id, name) => {
    const proceed = confirm(`Sei sicuro che vuoi eliminare ${name} ?`);
    if (proceed) {
        Livewire.emit("delete", id);
    }
    window.addEventListener("field-deleted",(event)=>{
        alert(`${event.detail.field_name} è stato eliminato`)
    })
});

</script>
@endpush
