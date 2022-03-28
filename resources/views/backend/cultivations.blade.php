@extends('backend.layouts.app')

@section('title', __('Coltivazioni'))

@push('after-styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
<link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.Default.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.2/dist/leaflet.draw.css" />

<style>
    #map, #map-index {
        height: 400px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
    }
   
</style>
@endpush

@section('content')
    <livewire:backend.cultivationslivewire />
@endsection

@push('after-scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script src="https://leaflet.github.io/Leaflet.markercluster/dist/leaflet.markercluster-src.js"></script>
<script src="https://unpkg.com/leaflet-draw@1.0.2/dist/leaflet.draw-src.js"></script>
<script>
    var dynamicPoligonList, indexPoligonList;
    var map, mapindex;
    var polygon;
    var editableLayers2;
    var editableLayersIndex;

    var LeafIcon = L.Icon.extend({
        options: {
            iconSize:     [40, 40],
            shadowSize:   [40, 40],
            iconAnchor:   [22, 32],
            shadowAnchor: [8, 32],
            popupAnchor:  [-3, -30]
        }
    });
    function createMap() {         
        var container = L.DomUtil.get('map'); 
        if(container != null){ container._leaflet_id = null; }
        map = L.map('map').setView([43.520933, 13.225302], 10); 
        /*var OpenStreetMap_Mapnik = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {            
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });
        var OpenTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
            maxZoom: 17,
            attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
        });*/
        var OpenSatMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            maxZoom: 17,
            attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
        }).addTo(map);

            
        editableLayers2 = new L.FeatureGroup();
        map.addLayer(editableLayers2);
  
        
    }
    function createIndexMap() {   
        var container_index = L.DomUtil.get('map-index'); 
        var pol_exist = false;
        if(container_index != null){ container_index._leaflet_id = null; }
        mapindex = L.map('map-index').setView([43.520933, 13.225302], 10); 
        var OpenSatMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
        }).addTo(mapindex);
        editableLayersIndex = new L.FeatureGroup();
        mapindex.addLayer(editableLayersIndex);
        indexPoligonList.forEach(polygon_single => {
            if(polygon_single[1]!= null){
                var single_pol = L.polygon([polygon_single[1]]);
                single_pol.setStyle({fillColor: polygon_single[4], color: polygon_single[3]});
                single_pol.addTo(mapindex);
                editableLayersIndex.addLayer(single_pol);              
                single_pol.on("click", function (e) {
                    Livewire.emit("setCultivation", polygon_single[0]);
                });
                if(polygon_single[2]!= null){
                    var cult_icon = new LeafIcon({iconUrl: polygon_single[2],   shadowUrl: '/img/piante/ombra marker.png'});
                    L.marker(single_pol.getBounds().getCenter(), {icon: cult_icon}).addTo(mapindex).bindPopup("I am a green leaf.");
                }
            }
            pol_exist = true;
        });
        if(pol_exist) mapindex.fitBounds(editableLayersIndex.getBounds());
    }

    function fillMap() { 
        editableLayers2.clearLayers();
        var pol_exist = false;
        dynamicPoligonList.forEach(polygon_single => {
            if(polygon_single[1]!= null){
                var single_pol = L.polygon([polygon_single[1]])
                single_pol.setStyle({fillColor: polygon_single[4], color: polygon_single[3]});
                single_pol.addTo(map);
                editableLayers2.addLayer(single_pol);
                
                if(polygon_single[2]!= null){
                    var cult_icon = new LeafIcon({
                        iconUrl: polygon_single[2],
                        shadowUrl: '/img/piante/ombra marker.png'
                    });
                    L.marker(single_pol.getBounds().getCenter(), {icon: cult_icon}).addTo(map).bindPopup("I am a green leaf.");
                }
            }
            pol_exist = true;
        });
        if(pol_exist) map.fitBounds(editableLayers2.getBounds());  
    }

    window.addEventListener('map-created', event => { 
        createMap();      
    });
    
    window.addEventListener('map-updated', event => { 
        dynamicPoligonList = event.detail.polList;  
        fillMap();      
    });
    window.addEventListener('map-index-created', event => { 
        indexPoligonList = event.detail.polList;
        createIndexMap();      
    });

</script>
<script>
    Livewire.on("deleteTriggered", (id, name) => {
        const proceed = confirm(`Sei sicuro che vuoi eliminare la coltivazione di ${name} ?`);
        if (proceed) {
            Livewire.emit("delete", id);
        }
        window.addEventListener("cultivation-deleted",(event)=>{
            alert(`La coltivazione è stata eliminata`)
        })
    });
</script>
@endpush