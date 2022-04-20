@extends('backend.layouts.app')

@section('title', __('Terreni'))

@push('after-styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.Default.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.2/dist/leaflet.draw.css" />
@endpush

@section('content')
    <livewire:backend.fields-livewire />
@endsection

@push('after-scripts')

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script src="https://leaflet.github.io/Leaflet.markercluster/dist/leaflet.markercluster-src.js"></script>
<script src="https://unpkg.com/leaflet-draw@1.0.2/dist/leaflet.draw-src.js"></script>
<script>
    var dynamicPointsList, dynamicPoligonList;
    var map, mapindex;
    var polygon;
    function createMap() {         
        var container = L.DomUtil.get('map'); 
        if(container != null){ container._leaflet_id = null; }
        map = L.map('map').setView([43.520933, 13.225302], 10); 
        var OpenSatMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
        }).addTo(map);
        //  geometry: "POLYGON ((43.61446166192095 13.315908046701132, 43.612861504022575 13.315650634393423, 43.612426502282005 13.320605821317045, 43.612628467767145 13.320627272342682, 43.61283043257404 13.318632326957877, 43.61307900371295 13.318675229009147, 43.61301686102455 13.319297308752823, 43.6132654313929 13.319361661829731, 43.61317221762516 13.32002664362468, 43.613636343079065 13.319963980651591, 43.498332083879276 13.214171959175536, 43.49655761641179 13.213099407893349, 43.49567036312313 13.215694981996197, 43.49756938056825 13.216295610714237, 43.497942950740665 13.215180157380779, 43.49844104070869 13.215630628919289, 43.498612258186235 13.214965647124341))",
  
        /* inizio polygon */
        var editableLayers = new L.FeatureGroup();
        map.addLayer(editableLayers);

        var drawPluginOptions = {
            position: 'topright',
            draw: {
                polygon: {
                    allowIntersection: false, // Restricts shapes to simple polygons
                    drawError: {
                        color: '#e1e100', // Color the shape will turn when intersects
                        message: '<strong>Oh snap!<strong> you can\'t draw that!' // Message that will show when intersect
                    },
                    shapeOptions: {
                        color: '#97009c'
                    }
                },
                // disable toolbar item by setting it to false
                polyline: false,
                circle: false, // Turns off this drawing tool
                rectangle: false,
                marker: false,
                circlemarker: false,
            },
            edit: {
                featureGroup: editableLayers, //REQUIRED!!
                remove: false
            }
        };

        // Initialise the draw control and pass it the FeatureGroup of editable layers
        var drawControl = new L.Control.Draw(drawPluginOptions);
        map.addControl(drawControl);
        
        var editableLayers = new L.FeatureGroup();
        map.addLayer(editableLayers);

        map.on('draw:created', function(e) {
            map.removeLayer(polygon);
            var type = e.layerType, layer = e.layer;
            if (type === 'polygon') {
                editableLayers.addLayer(layer);
                var seeArea = L.GeometryUtil.geodesicArea(layer.getLatLngs()[0]);
                //console.log(seeArea);
                Livewire.emit("addPolygonFromMap", layer._latlngs);
                Livewire.emit("setAreaMq", seeArea);
            }
        });
        /* fine polygon */

        //map.on('click', onMapClick); 
        polygon = L.polygon([dynamicPointsList]).addTo(map);
        editableLayers.addLayer(polygon);

        map.fitBounds(editableLayers.getBounds());
    }
    function createIndexMap() {   
        var container_index = L.DomUtil.get('mapindex'); 
        if(container_index != null){ container_index._leaflet_id = null; }
        mapindex = L.map('mapindex').setView([43.520933, 13.225302], 10); 

        
        /*var OpenStreetMap_Mapnik = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {            
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });
        var OpenTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
            maxZoom: 17,
            attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
        });*/
        var OpenSatMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
        }).addTo(mapindex);
        var editableLayers2 = new L.FeatureGroup();
        mapindex.addLayer(editableLayers2);
        dynamicPoligonList.forEach(polygon_single => {
            var single_pol = L.polygon([polygon_single[1]]).addTo(mapindex);
            editableLayers2.addLayer(single_pol);
            single_pol.on("click", function (e) {
                //console.log('hai cliccato'+ polygon_single[0]);
                Livewire.emit("toggleUpdate", polygon_single[0]);
            });
        });
        mapindex.fitBounds(editableLayers2.getBounds());
    }


    function fillMap() {   
        map.removeLayer(polygon);
        polygon = L.polygon([dynamicPointsList]).addTo(map);
        //map.fitBounds(polygon.getBounds());
    }
    /*function onMapClick(e) {
        Livewire.emit("addPointFromMap", e.latlng);
    }*/

    window.addEventListener('map-created', event => { 
        dynamicPointsList = event.detail.pointList;
        createMap();      
    });
    window.addEventListener('map-index-created', event => { 
        dynamicPoligonList = event.detail.polList;
        createIndexMap();      
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
