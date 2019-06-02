<link rel="stylesheet" href="{{ asset('/vendor/openlayers/ol.css') }}" type="text/css">
<script src="{{ asset('/vendor/openlayers/ol.js') }}"></script>
<link href="{{ asset('/vendor/ol3-contextmenu/ol3-contextmenu.min.css') }}" rel="stylesheet">
<script src="{{ asset('/vendor/ol3-contextmenu/ol3-contextmenu.js') }}"></script>

<div id="map" class="map" style="border:solid 1px #CCCCCC; background-color:#DDDDDD; box-shadow: inset 2px 2px 0px rgba(0,0,0,0.2);"></div>
<div id="popupWindow" class="ol-popup">
    <a href="#" id="popupWindowCloseButton" class="ol-popup-closer"></a>
    <div id="popupWindowContent"></div>
</div>
<style>
    .ol-popup {
        position: absolute;
        background-color: white;
        -webkit-filter: drop-shadow(0 1px 4px rgba(0,0,0,0.2));
        filter: drop-shadow(0 1px 4px rgba(0,0,0,0.2));
        padding: 15px;
        border-radius: 10px;
        border: 1px solid #cccccc;
        bottom: 22px;
        left: -50px;
        min-width:250px;
    }
    .ol-popup:after, .ol-popup:before {
        top: 100%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
    }
    .ol-popup:after {
        border-top-color: white;
        border-width: 10px;
        left: 48px;
        margin-left: -10px;
    }
    .ol-popup:before {
        border-top-color: #cccccc;
        border-width: 11px;
        left: 48px;
        margin-left: -11px;
    }
    .ol-popup-closer {
        text-decoration: none;
        position: absolute;
        top: 2px;
        right: 8px;
    }
    .ol-popup-closer:after {
        content: "✖";
    }
</style>
<script>
    var urlBaseItem = '{{ url('/manage/map/'.$map->id.'/view/marker') }}';
    var urlCreateItem = '{{ url('/manage/map/'.$map->id.'/view/marker/create') }}';
    var urlDeleteItem = '{{ url('/manage/map/'.$map->id.'/view/marker/delete') }}';

    var contextMenuCenterIcon = '{{ url('/img/map/center.png') }}';
    var contextMenuPinIcon = '{{ url('/img/map/pin_drop.png') }}';

    // Map views require a projection. Pass and use extent in pixels
    var mapBoundsExtent = [0, 0, {{ $map->image_width }}, {{ $map->image_height }}];
    var mapProjection = new ol.proj.Projection({
        code: 'map-image',
        units: 'pixels',
        extent: mapBoundsExtent
    });
    var mapView = new ol.View({
        projection: mapProjection,
        center: ol.extent.getCenter(mapBoundsExtent),
        zoom: 2
    });

    // Markers
    var mapMarkers = [];
    var mapMarker;
    var mapMarkerStyle;
    @foreach($map->markers as $marker)
        mapMarker = new ol.Feature({
            modelId: "{{ $marker->id }}",
            modelName: "{{ $marker->name }}",
            modelType: "{{ $marker->type }}",
            modelIcon: "{{ $marker->icon }}",
            modelColor: "{{ $marker->color }}",
            modelDetails: "{{ $marker->details }}",
            type: 'icon',
            geometry: new ol.geom.Point([{{$marker->x}}, {{ $marker->y }}])
        });
        mapMarkerStyle = new ol.style.Style({
            image: new ol.style.Icon(({
                anchor: [0.5, 1],
                src: '{{ url($marker->getMarkerImageURL()) }}',
                color: {!! json_encode($marker->getMarkerRGB()) !!}
            })),
            stroke: new ol.style.Stroke({
                color: '#ffcc33',
                width: 2
            })
        });
        mapMarker.setStyle(mapMarkerStyle);
        mapMarkers[mapMarkers.length] = mapMarker;
    @endforeach

    var mapMarkerVectorLayer = new ol.layer.Vector({
            source: new ol.source.Vector({
                features: mapMarkers
            })
        });

    //POPUP

    var popupWindow = document.getElementById('popupWindow');
    var popupWindowContent = document.getElementById('popupWindowContent');
    var popupWindowCloseButton = document.getElementById('popupWindowCloseButton');

    var popupWindowOverlay = new ol.Overlay({
        element: popupWindow,
        autoPan: true,
        autoPanAnimation: {
            duration: 250
        }
    });

    popupWindowCloseButton.onclick = function() {
        popupWindowOverlay.setPosition(undefined);
        popupWindowCloseButton.blur();
        return false;
    };

    // CONTEXT
    var mapContextMenuItems = [
        {
            text: 'Center map here',
            classname: 'bold',
            icon: contextMenuCenterIcon,
            callback: contextMenuAnimateToCoordinates
        },
        {
            text: 'Add Marker Here',
            classname: 'bold',
            icon: contextMenuPinIcon,
            items: [
                {
                    text: 'Person',
                    callback: contextMenuAddPersonMarkerAtCoordinates
                },
                {
                    text: 'Asset',
                    callback: contextMenuAddAssetMarkerAtCoordinates
                },
                {
                    text: 'Attachment',
                    callback: contextMenuAddAttachmentMarkerAtCoordinates
                }
            ]
        },
        '-'
    ];

    var mapContextMenu = new ContextMenu({
        width: 180,
        items: mapContextMenuItems
    });

    var mapContextMenuEditMarkerItem = {
        text: 'Edit this Marker',
        classname: 'marker',
        callback: contextMenuEditMarker
    };

    //BUILD MAP

    var map = new ol.Map({
        logo: false,
        layers: [
            new ol.layer.Image({
                source: new ol.source.ImageStatic({
                    url: '{{ $map->image->fileUrl() }}',
                    projection: mapProjection,
                    imageExtent: mapBoundsExtent
                })
            }),
            mapMarkerVectorLayer
        ],
        overlays: [popupWindowOverlay],
        target: 'map',
        view: mapView
    });

    map.addControl(mapContextMenu);

    // EVENT LISTENERS

    // -- SHOW POPUP ON MARKER CLICK
    map.on('singleclick', function(evt) {
        var coordinate = evt.coordinate;
        var feature = map.forEachFeatureAtPixel(evt.pixel, ft => ft);
        if (feature && feature.get('type') === 'icon') {
            openPopupWindow(feature);
        } else {
            console.log('clear window');
        }
        //overlay.setPosition(coordinate);
    });

    // -- OPEN CONTEXT MENU
    mapContextMenu.on('open', function (evt) {
        var feature = map.forEachFeatureAtPixel(evt.pixel, ft => ft);
        if (feature && feature.get('type') === 'icon') {
            mapContextMenu.clear();
            mapContextMenuEditMarkerItem.data = { marker: feature };
            mapContextMenu.push(mapContextMenuEditMarkerItem);
        } else {
            mapContextMenu.clear();
            mapContextMenu.extend(mapContextMenuItems);
            mapContextMenu.extend(mapContextMenu.getDefaultItems());
        }
    });

    // HELPER METHODS

    function getCoordinatesFromMapMarker(mapMarker){
        return mapMarker.getGeometry().getCoordinates();
    }

    function openPopupWindow(feature){
        var coordinates = getCoordinatesFromMapMarker(feature);
        coordinates[1] = coordinates[1] + 25;
        var modelId = feature.get('modelId');
        var modelName = feature.get('modelName');
        var modelType = feature.get('modelType');
        var modelIcon = feature.get('modelIcon');
        var modelColor = feature.get('modelColor');
        var modelDetails = feature.get('modelDetails');
        popupWindowContent.innerHTML = '<p><strong><span class="'+modelIcon+'"></span> '+modelName+'</strong></p><p>' + modelDetails +
            '</p>';
        popupWindowOverlay.setPosition(coordinates);
    }

    function contextMenuAnimateToCoordinates(obj) {
        mapView.animate({
            duration: 700,
            easing: elasticEasing,
            center: obj.coordinate
        });
    }

    function contextMenuAddMarkerAtCoordinates(obj,itemType){
        console.log(obj.coordinate);
        var x = obj.coordinate[0];
        var y = obj.coordinate[1];
        var href = urlCreateItem+"?x="+x+"&y="+y+"&type="+itemType;
        if(itemType == 'person'){
            href += "&icon=user";
        }
        if(itemType == 'attachment'){
            href += "&icon=download";
        }
        window.location.href = href;
    }

    function contextMenuAddPersonMarkerAtCoordinates(obj){
        contextMenuAddMarkerAtCoordinates(obj,'person');
    }

    function contextMenuAddAssetMarkerAtCoordinates(obj){
        contextMenuAddMarkerAtCoordinates(obj,'asset');
    }

    function contextMenuAddAttachmentMarkerAtCoordinates(obj){
        contextMenuAddMarkerAtCoordinates(obj,'attachment');
    }

    function contextMenuDeleteMarker(obj){
        var markerData = obj.data.marker.O;
        window.location.href = urlDeleteItem+"/"+markerData.modelId;
    }

    function contextMenuEditMarker(obj){
        var markerData = obj.data.marker.O;
        window.location.href = urlBaseItem+"/"+markerData.modelId+'/edit';
    }

    function elasticEasing(t) {
        var amount = -30;
        return Math.pow(2, amount * t) * Math.sin((t - 0.075) * (2 * Math.PI) / 0.3) + 1;
    }

    function findMapMarkerByModelId(modelId){
        for(var i=0; i<mapMarkers.length; i++){
            var mapMarker = mapMarkers[i];
            if(mapMarker.get('modelId') == modelId){
                return mapMarker;
            }
        }
        return null;
    }

    function zoomToMapItem(modelId,openInfoWindow){
        if(typeof(openInfoWindow) == "undefined"){
            openInfoWindow = false;
        }
        var mapMarker = findMapMarkerByModelId(modelId);
        var mapMarkerCoordinates = getCoordinatesFromMapMarker(mapMarker);
        mapView.animate({
            duration: 700,
            easing: elasticEasing,
            center: mapMarkerCoordinates,
            zoom: 3
        });
        console.log(openInfoWindow);
        if(openInfoWindow){
            openPopupWindow(mapMarker);
        }
    }

</script>