@extends('backend.layouts.app')

@section('title', __('Terreni'))

@push('after-styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.Default.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.2/dist/leaflet.draw.css" />
@endpush

@section('content')
    <livewire:backend.field-sat-livewire />
@endsection

@push('after-scripts')

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script src="https://leaflet.github.io/Leaflet.markercluster/dist/leaflet.markercluster-src.js"></script>
<script src="https://unpkg.com/leaflet-draw@1.0.2/dist/leaflet.draw-src.js"></script>
<script>
    var dynamicPoligonList, layer_sel, gain_pam, gamma_pam, date_pam;
    var map, mapindex;
    var polygon;
   
    function createIndexMap() {   
        var container_index = L.DomUtil.get('mapindex'); 
        if(container_index != null){ container_index._leaflet_id = null; }
       
        // OpenStreetMap
        let osm = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        });
         // Sentinel Hub WMS service
        // tiles generated using EPSG:3857 projection - Leaflet takes care of that
        let baseUrl = "https://services.sentinel-hub.com/ogc/wms/3e323bf1-6f05-41cc-880c-0949b453d527";
        
        var strPolygon ="POLYGON((";
        dynamicPoligonList.forEach(polygon_single => {
            polygon_single[1].forEach(point_single => {
                strPolygon+= point_single[1] + " " + point_single[0]+", ";
            });
            strPolygon+= polygon_single[1][0][1] + " " + polygon_single[1][0][0]+"))";
        });
       
       
        let sentinelHub = L.tileLayer.wms(baseUrl, {
            tileSize: 512,
            attribution: '&copy; <a href="http://www.sentinel-hub.com/" target="_blank">Sentinel Hub</a>',	 	 	
            maxcc:"20", 
            minZoom:6, 
            maxZoom:20, 
            layers:layer_sel, 
            gain: gain_pam,
            gamma: gamma_pam,
            time:date_pam, 
            format: 'image/png',
            transparent:true,
            crs: L.CRS.EPSG4326,
            geometry: strPolygon, 
        });

        let baseMaps = {'OpenStreetMap': osm };
        let overlayMaps = {'Sentinel Hub WMS': sentinelHub }

        mapindex = L.map('mapindex', {
            center: [43.520933, 13.225302], // lat/lng in EPSG:4326
            zoom: 10,
            layers: [osm, sentinelHub]
        }); 
        
        L.control.layers(baseMaps, overlayMaps).addTo(mapindex);

       
        var editableLayers2 = new L.FeatureGroup();
        mapindex.addLayer(editableLayers2);
        dynamicPoligonList.forEach(polygon_single => {
            var single_pol = L.polygon([polygon_single[1]]).addTo(mapindex);
            editableLayers2.addLayer(single_pol);
        });
        mapindex.fitBounds(editableLayers2.getBounds());
    }

    window.addEventListener('map-index-created', event => { 
        dynamicPoligonList = event.detail.polList;
        layer_sel = event.detail.layerSel;
        gain_pam = event.detail.gain_pam;
        gamma_pam = event.detail.gamma_pam;
        date_pam = event.detail.date_pam;
        createIndexMap();      
    });


  

</script>


@endpush

