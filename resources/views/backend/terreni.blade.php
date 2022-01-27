@extends('backend.layouts.app')

@section('title', __('Terreni'))

@push('after-styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.Default.css" />
    {{--<link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.2/dist/leaflet.draw.css" />--}}
@endpush

@section('content')
    <livewire:backend.fields-livewire />
@endsection

@push('after-scripts')

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script src="https://leaflet.github.io/Leaflet.markercluster/dist/leaflet.markercluster-src.js"></script>
{{--<script src="https://unpkg.com/leaflet-draw@1.0.2/dist/leaflet.draw-src.js"></script>--}}
<script>
    var dynamicPointsList;
    var map;
    var polygon;
    function createMap() {         
        var container = L.DomUtil.get('map'); 
        if(container != null){ container._leaflet_id = null; }
        map = L.map('map').setView([43.520933, 13.225302], 10); 
        var OpenStreetMap_Mapnik = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {            
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        var OpenTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
            maxZoom: 17,
            attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
        });

        /*var editableLayers = L.featureGroup().addTo(map);
        var drawControl = new L.Control.Draw({
        edit: {
            featureGroup: editableLayers
        },
        draw: false
        }).addTo(map);

        // Add a new editable rectangle when clicking on the button.
        button.addEventListener('click', function(event) {
        event.preventDefault();

        L.rectangle([
                getRandomLatLng(),
                getRandomLatLng()
            ]).addTo(editableLayers); // Add to editableLayers instead of directly to map.
        });
        */
        map.on('click', onMapClick); 
        polygon = L.polygon([dynamicPointsList]).addTo(map);
    }

    /*function getRandomLatLng() {
        return [
            48.8 + 0.1 * Math.random(),
            2.25 + 0.2 * Math.random()
        ];
    }*/
    function fillMap() {   
        map.removeLayer(polygon);
        polygon = L.polygon([dynamicPointsList]).addTo(map);
        //map.fitBounds(polygon.getBounds());
    }
    function onMapClick(e) {
        Livewire.emit("addPointFromMap", e.latlng);
        //alert("You clicked the map at " + e.latlng);
    }

    window.addEventListener('map-created', event => { 
        dynamicPointsList = event.detail.pointList;
        createMap();      
    });
   window.addEventListener('map-updated', event => { 
        dynamicPointsList = event.detail.pointList;
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
