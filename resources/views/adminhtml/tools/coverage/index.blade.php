<x-app-layout>
    <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
    <style>
        #map {
            width: 100%;
            height: 700px;
            position: relative !important;
        }
    </style>
    <div class="card">
        <div class="card-header top-card">
            <h5>Cobertura</h5>
        </div>
    </div>

    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-12">
                    <div class="card p-25">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 justify-content-center">
                                    <div id="map" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <script>
        var mapLayers = {};
        var map = L.map('map').
        setView([24.325179, -104.6532400],5);

        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'IGOU TELECOM S.A.P.I. de C.V.',
            maxZoom: 18
        }).addTo(map);

        L.control.scale().addTo(map);
        //L.marker([19.2878600, -99.6532400], {draggable: true}).addTo(map);


        mapLayers['Cobertura Actual'] = L.tileLayer.wms('https://geomap.altanredes.com/geoserver/web_altanredes_geoaltan/ows?SERVICE=WMS?&authkey=0768cc4d', {
            layers: 'Cobertura_Actual',
            format: 'image/png',
            transparent: true,
            tiled: true,
            opacity : 1

        }).addTo(map);

        mapLayers['Cobertura Garantizada'] = L.tileLayer.wms('https://geomap.altanredes.com/geoserver/web_altanredes_geoaltan/ows?SERVICE=WMS?&authkey=0768cc4d', {
            layers: 'Cobertura_Garantizada',
            format: 'image/png',
            transparent: true,
            tiled: true,
            opacity : 0.9

        }).addTo(map);

        mapLayers['Red 4G'] = L.tileLayer.wms('https://geomap.altanredes.com/geoserver/web_altanredes_geoaltan/ows?SERVICE=WMS?&authkey=0768cc4d', {
            layers: 'Telcel_Lte_Roaming',
            format: 'image/png',
            transparent: true,
            tiled: true,
            opacity : 0.7
        }).addTo(map);

        mapLayers['Red 3G'] = L.tileLayer.wms('https://geomap.altanredes.com/geoserver/web_altanredes_geoaltan/ows?SERVICE=WMS?&authkey=0768cc4d', {
            layers: 'Telcel_3G_Roaming',
            format: 'image/png',
            transparent: true,
            tiled: true,
            opacity : 0.5
        }).addTo(map);

        L.control.layers(null, mapLayers).addTo(map);
    </script>
</x-app-layout>
