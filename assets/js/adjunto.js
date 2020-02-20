import Map from 'ol/Map';
window.Map = Map;

import View from 'ol/View';
window.View = View;

window.proj = require('ol/proj');

import Group from 'ol/layer/Group';
window.Group = Group;

import Tile from 'ol/layer/Tile';
window.Tile = Tile;

import XYZ from 'ol/source/XYZ';
window.XYZ = XYZ;

import SourceVector from 'ol/source/Vector';
window.SourceVector = SourceVector;

import LayerVector from 'ol/layer/Vector';
window.LayerVector = LayerVector;

import Style from 'ol/style/Style';
window.Style = Style;

import Icon from 'ol/style/Icon';
window.Icon = Icon;

import Feature from 'ol/Feature';
window.Feature = Feature;

import Point from 'ol/geom/Point';
window.Point = Point;

import OSM from 'ol/source/OSM';
window.OSM = OSM;

$(document).ready(function() {
    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    $('.simple-select').selectpicker({
        liveSearch: true,
        width: false,
        virtualScroll: 10,
        noneSelectedText: 'Seleccionar',
        noneResultsText: 'Seleccionar',
        selectedTextFormat: 'count'
    });

    const markerSource = new SourceVector();

    var markerStyle = new Style({
        image: new Icon({
            anchor: [256, 512],
            anchorXUnits: 'pixels',
            anchorYUnits: 'pixels',
            opacity: 1,
            scale: 0.1,
            src: '../../../img/marker.png'
        })
    });

    var tile = new Tile({
        source: new OSM()
    });

    var vector = new LayerVector({
        source: markerSource,
        style: markerStyle
    });

    var view = new View({
        center: proj.fromLonLat([-70.6506, -33.4372]),
        zoom: 10
    });

    var map = new Map({
        target: 'map',
        layers: [tile,vector],
        view: view
    });

    function addMarker(lon,lat) {
        markerSource.clear();
        var iconFeature = new Feature({
            geometry: new Point(proj.transform([lon, lat], 'EPSG:4326', 'EPSG:3857'))
        });

        markerSource.addFeature(iconFeature);
    }

    map.on('singleclick',function(event){
        var lonLat = proj.toLonLat(event.coordinate);
        var lon = lonLat[0];
        var lat = lonLat[1];
        $("#mensaje_longitud").val(lon);
        $("#mensaje_latitud").val(lat);
        addMarker(lon,lat);
    });

    map.once('postrender',function(event){
        var lon = parseFloat($("#mensaje_longitud").val());
        var lat = parseFloat($("#mensaje_latitud").val());
        if(isNaN(lon) || isNaN(lat)){
            console.log('nan');
        } else {
            addMarker(lon,lat);
            var feature = markerSource.getFeatures()[0];
            var point = feature.getGeometry();
            var size = map.getSize();
            view.centerOn(point.getCoordinates(), size, [size[0]/2, size[1]/2]);
            view.setZoom(16);
        }
    });

    window.onresize = function() {
        setTimeout( function() { map.updateSize();}, 2000);
    }

    $(window).trigger('resize');

    $('#mensaje_claseAccidente').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        $("#mensaje_tipoAccidente").empty().append('<option value="" selected="selected">Seleccione</option>');
        $.ajax({
            url: Routing.generate('buscar_claseAccidente_tiposAccidente', { claseAccidente: $(e.currentTarget).val() }),
            type: 'GET',
            success: function(data) {
                var jsonData = JSON.stringify(data);
                $.each(JSON.parse(jsonData), function (idx, obj) {
                    $("#mensaje_tipoAccidente").append('<option value="' + obj.id + '">' + obj.codigoNombre + '</option>');
                });
                $("#mensaje_tipoAccidente").selectpicker('refresh');
            }
        });
    });

    $('#mensaje_comuna').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        $("#mensaje_unidad").empty().append('<option value="" selected="selected">Seleccione</option>');
        $.ajax({
            url: Routing.generate('buscar_comuna_unidades', { comuna: $(e.currentTarget).val() }),
            type: 'GET',
            success: function(data) {
                var jsonData = JSON.stringify(data);
                $.each(JSON.parse(jsonData), function (idx, obj) {
                    $("#mensaje_unidad").append('<option value="' + obj.id + '">' + obj.codigoNombre + '</option>');
                });
                $("#mensaje_unidad").selectpicker('refresh');
            }
        });
    });

    $('#mensaje_glosaUbicacion').autocomplete({
        delay: 500,
        minLength: 3,
        source: function (request, response) {
            $.ajax({
                dataType: "json",
                type : 'Get',
                url: Routing.generate('buscar_maestro_calles', { textoLibre: $('#mensaje_glosaUbicacion').val() }),
                success: function(data) {
                    response( $.map( data, function(item) {
                        return {
                            value: item.id,
                            label: item.DireccionOrPOI,
                            latitud: item.Latitud,
                            longitud: item.Longitud
                        };
                    }));
                }
            });
        },
        select: function(event, ui) {
            $('#mensaje_glosaUbicacion').val(ui.item.label.trim());
            $('#mensaje_idUbicacion').val(ui.item.value.trim());
            var longitud = parseFloat(ui.item.longitud.replace(",", "."));
            var latitud = parseFloat(ui.item.latitud.replace(",", "."));
            $('#mensaje_latitud').val(latitud);
            $('#mensaje_longitud').val(longitud);
            addMarker(longitud,latitud);
            var feature = markerSource.getFeatures()[0];
            var point = feature.getGeometry();
            var size = map.getSize();
            view.centerOn(point.getCoordinates(), size, [size[0]/2, size[1]/2]);
            view.setZoom(16);
            return false;
        }
    });

});
