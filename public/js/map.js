function initMap(latitude, longitude){
    var map = new ol.Map({
        target: 'map',
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM()
            }),
            new ol.layer.Tile({
                source: new ol.source.TileWMS({
                    url: 'http://localhost:8181/geoserver/ows',
                    serverType: 'geoserver',
                })
            })
        ],
        view: new ol.View({
            center: ol.proj.fromLonLat([latitude,
                longitude
            ]),
            zoom: 16
        }),
    });

    var marker = new ol.Feature({
        geometry: new ol.geom.Point(
            ol.proj.fromLonLat([latitude,
                longitude])
        )
    });

    marker.setStyle(new ol.style.Style({
        image: new ol.style.Circle({
            radius: 10,
            fill: new ol.style.Fill({
                color: 'rgba(94, 105, 255)'
            }),
            stroke: new ol.style.Stroke({
                color: 'rgba(94, 105, 255)',
                width: 2
            })
        })
    }));

    var vectorLayer = new ol.layer.Vector({
        source: new ol.source.Vector({
            features: [marker]
        })
    });

    map.getControls().forEach(function(control) {
        if (control instanceof ol.control.Zoom) {
            map.removeControl(control);
        }
    }, this);

    map.addLayer(vectorLayer);
}
