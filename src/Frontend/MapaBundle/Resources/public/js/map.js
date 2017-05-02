function Map()
{
    var base = this;
    base.mapObject = null;
    base.options = {
        onMapClick: function ()
        {},
        onDrawEnd: function (features) {},
        drawning: false
    };
    base.styles = {
        'icon': new ol.style.Style({
            image: new ol.style.Icon({
                anchor: [0.5, 1],
                src: 'https://openlayers.org/en/v4.1.0/examples/data/icon.png'
            })
        })
    };

    base.features = new Array();

    base.layers = {
        featureLayer: new ol.layer.Vector({
            source: new ol.source.Vector({
                features: base.features
            }),
            style: function (feature)
            {
                return base.styles[feature.get('type')];
            }
        })
    };
    base.initialize = function (target, options)
    {
        base.options = $.extend({}, base.options, options);
        base.mapObject = new ol.Map({
//            controls: ol.control.defaults({
//                attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
//                    collapsible: false
//                })
//            }),
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM()
                }),
                base.layers.featureLayer
            ],
            target: target,
            view: new ol.View({
                center: [0, 0],
                zoom: 6
            })
        });

        base.centerMap([21.017532, 52.237049]);
        base.initializeEvents();

        if (base.options.drawning === true)
        {
            base.initializeDrawning();
        }
    };

    base.initializeDrawning = function () {

        var features = new ol.Collection();
        var featureOverlay = new ol.layer.Vector({
            source: new ol.source.Vector({features: features}),
            style: new ol.style.Style({
                fill: new ol.style.Fill({
                    color: 'rgba(255, 255, 255, 0.2)'
                }),
                stroke: new ol.style.Stroke({
                    color: '#ffcc33',
                    width: 2
                }),
                image: new ol.style.Circle({
                    radius: 7,
                    fill: new ol.style.Fill({
                        color: '#ffcc33'
                    })
                })
            })
        });
        featureOverlay.setMap(base.mapObject);
        var modify = new ol.interaction.Modify({
            features: features,
            // the SHIFT key must be pressed to delete vertices, so
            // that new vertices can be drawn at the same position
            // of existing vertices
            deleteCondition: function (event) {
                return ol.events.condition.shiftKeyOnly(event) &&
                        ol.events.condition.singleClick(event);
            }
        });

        base.mapObject.addInteraction(modify);

        var draw = new ol.interaction.Draw({
            features: features,
            type: "LineString"
        });
        base.mapObject.addInteraction(draw);
        features.on("add", function (type) {
            base.options.onDrawEnd && base.options.onDrawEnd(features);
        });

        if (base.options.drawningWKT)
        {
            var format = new ol.format.WKT();
            var featuresFromWKT = format.readFeatures(base.options.drawningWKT,
                    {
                        dataProjection: 'EPSG:4326',
                        featureProjection: 'EPSG:3857'
                    });
            for (var i = 0; i < featuresFromWKT.length; i++) {
                featureOverlay.getSource().addFeature(featuresFromWKT[i]);
            }
            
            base.mapObject.getView().fit(featureOverlay.getSource().getExtent(), base.mapObject.getSize());
        }
    };

    base.initializeEvents = function ()
    {
        base.mapObject.on("click", function (e)
        {
            base.options.onMapClick && base.options.onMapClick(e.coordinate, base.getWgsCoordinate(e.coordinate));
        });
    };

    base.getMapCoordinate = function (coordinate)
    {
        return ol.proj.transform(coordinate, 'EPSG:4326', 'EPSG:3857');
    };

    base.getWgsCoordinate = function (coordinate)
    {
        return ol.proj.transform(coordinate, 'EPSG:3857', 'EPSG:4326');
    };

    base.centerMap = function (coordinate)
    {
        base.mapObject.getView().setCenter(base.getMapCoordinate(coordinate));
    };
}
;