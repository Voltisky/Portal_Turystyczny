function Map() {
    var base = this;
    base.mapObject = null;
    base.options = {
        onMapClick: function () {
        },
        onDrawEnd: function (features) {
        },
        drawning: false,
        scrollable: true
    };
    base.styles = {
        'icon': new ol.style.Style({
            image: new ol.style.Icon({
                anchor: [0.5, 1],
                src: 'https://openlayers.org/en/v4.1.0/examples/data/icon.png'
            })
        })
    };

    base.features = new ol.Collection();
    base.featuresOverlay = new ol.Collection();

    base.layers = {
        featureLayer: new ol.layer.Vector({
            source: new ol.source.Vector({
                features: base.features
            }),
            style: function (feature) {
                return base.styles[feature.get('type')];
            }
        }),
        featureOverlay: new ol.layer.Vector({
            source: new ol.source.Vector({features: base.featuresOverlay}),
            style: new ol.style.Style({
                fill: new ol.style.Fill({
                    color: 'rgba(255, 255, 255, 0.2)'
                }),
                stroke: new ol.style.Stroke({
                    color: 'red',
                    width: 4
                }),
                image: new ol.style.Circle({
                    radius: 7,
                    fill: new ol.style.Fill({
                        color: 'red'
                    })
                })
            })
        })
    };

    base.initialize = function (target, options) {
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
                base.layers.featureLayer,
                base.layers.featureOverlay
            ],
            target: target,
            view: new ol.View({
                center: [0, 0],
                zoom: 6
            })
        });

        base.centerMap([21.017532, 52.237049]);
        base.initializeEvents();

        if (base.options.drawning === true) {
            base.initializeDrawning();
        }

        if (base.options.drawningWKT) {
            var format = new ol.format.WKT();
            var featuresFromWKT = format.readFeatures(base.options.drawningWKT,
                {
                    dataProjection: 'EPSG:4326',
                    featureProjection: 'EPSG:3857'
                });
            for (var i = 0; i < featuresFromWKT.length; i++) {
                base.layers.featureOverlay.getSource().addFeature(featuresFromWKT[i]);
            }

            base.mapObject.getView().fit(base.layers.featureOverlay.getSource().getExtent(), base.mapObject.getSize());
        }

        if (base.options.scrollable == false) {
            // Mouse scroll off
            base.mapObject.getInteractions().forEach(function (interaction) {
                if (interaction instanceof ol.interaction.MouseWheelZoom) {
                    interaction.setActive(false);
                }
            }, this);
        }
    };

    base.fitToExtent = function (extent) {
        base.mapObject.getView().fit(extent, base.mapObject.getSize());
    };

    base.initializeDrawning = function () {
        var modify = new ol.interaction.Modify({
            features: base.featuresOverlay,
            // the SHIFT key must be pressed to delete vertices, so
            // that new vertices can be drawn at the same position
            // of existing vertices
            deleteCondition: function (event) {
                return ol.events.condition.shiftKeyOnly(event) &&
                    ol.events.condition.singleClick(event);
            }
        });

        modify.on("modifyend", function () {
            base.options.onDrawEnd && base.options.onDrawEnd(base.featuresOverlay);
        });

        base.mapObject.addInteraction(modify);

        var draw = new ol.interaction.Draw({
            features: base.featuresOverlay,
            type: "LineString"
        });
        base.mapObject.addInteraction(draw);
        base.featuresOverlay.on("add", function (type) {
            base.options.onDrawEnd && base.options.onDrawEnd(base.featuresOverlay);
        });

    };

    base.initializeEvents = function () {
        base.mapObject.on("click", function (e) {
            base.options.onMapClick && base.options.onMapClick(e.coordinate, base.getWgsCoordinate(e.coordinate));
        });
    };

    base.getMapCoordinate = function (coordinate) {
        return ol.proj.transform(coordinate, 'EPSG:4326', 'EPSG:3857');
    };

    base.getWgsCoordinate = function (coordinate) {
        return ol.proj.transform(coordinate, 'EPSG:3857', 'EPSG:4326');
    };

    base.centerMap = function (coordinate) {
        base.mapObject.getView().setCenter(base.getMapCoordinate(coordinate));
    };

    base.drawFeature = function (coordinate, clearLayer) {
        if (clearLayer && clearLayer === true) {
            base.layers.featureLayer.getSource().clear();
        }

        base.layers.featureLayer.getSource().addFeature(new ol.Feature({
            type: 'icon',
            geometry: new ol.geom.Point(coordinate)
        }));
    };
}