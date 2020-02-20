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
    $(window).keydown(function(event){if(event.keyCode == 13){event.preventDefault();return false;}});

    const markerSource = new SourceVector();
    var markerStyle = new Style({image: new Icon({anchor: [256, 512],anchorXUnits: 'pixels',anchorYUnits: 'pixels',opacity: 1,scale: 0.1,src: Routing.generate('buscar_marker')})});
    var tile = new Tile({source: new OSM()});
    var vector = new LayerVector({source: markerSource,style: markerStyle});
    var view = new View({center: proj.fromLonLat([-70.6506, -33.4372]),zoom: 12});
    var map = new Map({target: 'map',layers: [tile,vector],view: view});

    function addMarker(lon,lat) {
        markerSource.clear();
        var iconFeature = new Feature({geometry: new Point(proj.transform([lon, lat], 'EPSG:4326', 'EPSG:3857'))});
        markerSource.addFeature(iconFeature);
    }

    map.on('singleclick',function(event){
        var lonLat = proj.toLonLat(event.coordinate);
        var lon = lonLat[0];
        var lat = lonLat[1];
        $("#accidente_ubicacion_longitud").val(lon);
        $("#accidente_ubicacion_latitud").val(lat);
        addMarker(lon,lat);
    });

    map.once('postrender',function(event){
        var lon = parseFloat($("#accidente_ubicacion_longitud").val());
        var lat = parseFloat($("#accidente_ubicacion_latitud").val());
        if(!isNaN(lon) && !isNaN(lat)){
            addMarker(lon,lat);
            var feature = markerSource.getFeatures()[0];
            var point = feature.getGeometry();
            var size = map.getSize();
            view.centerOn(point.getCoordinates(), size, [size[0]/2, size[1]/2]);
            view.setZoom(16);
        }
    });

    window.onresize = function() { setTimeout( function() { map.updateSize();}, 2000); }

    $(window).trigger('resize');

    $('#accidente_ubicacion_glosa').autocomplete({
        delay: 500,
        minLength: 3,
        source: function (request, response) {
            $.ajax({
                dataType: "json",
                type : 'Get',
                url: Routing.generate('buscar_maestro_calles', { textoLibre: $('#accidente_ubicacion_glosa').val() }),
                success: function(data) {
                    response( $.map( data, function(item) {
                        console.log(item);
                        return {
                            value: item.ID,
                            label: item.DireccionOrPOI,
                            latitud: item.Latitud,
                            longitud: item.Longitud,
                            id: item.ID,
                            calle: item.Calle,
                            numero: item.Numero,
                            comuna: item.Comuna,
                            pais: item.Pais,
                            tipoId: item.IdTipo,
                            tipo: item.Tipo,
                            direccion: item.DireccionOrPOI
                        };
                    }));
                }
            });
        },
        select: function(event, ui) {

            var id = (ui.item.id) ? ui.item.id.trim() : '';
            var calle = (ui.item.calle) ? ui.item.calle.trim() : '';
            var numero = (ui.item.numero) ? ui.item.numero.trim() : '';
            var comuna = (ui.item.comuna) ? ui.item.comuna.trim() : '';
            var pais = (ui.item.pais) ? ui.item.pais.trim() : '';
            var tipo = (ui.item.tipo) ? ui.item.tipo.trim() : '';
            var direccion = (ui.item.direccion) ? ui.item.direccion.trim() : '';
            var tipoId = (ui.item.tipoId) ? ui.item.tipoId : '';
            var longitud = (ui.item.longitud) ? parseFloat(ui.item.longitud.replace(",", ".")) : 0.0;
            var latitud = (ui.item.latitud) ? parseFloat(ui.item.latitud.replace(",", ".")) : 0.0;

            $('#accidente_ubicacion_maestroId').val(id);
            $('#accidente_ubicacion_calle').val(calle);
            $('#accidente_ubicacion_numero').val(numero);
            $('#accidente_ubicacion_comuna').val(comuna);
            $('#accidente_ubicacion_pais').val(pais);
            $('#accidente_ubicacion_tipo').val(tipo);
            $('#accidente_ubicacion_direccion').val(direccion);
            $('#accidente_ubicacion_tipoId').val(tipoId);
            $('#accidente_ubicacion_latitud').val(latitud);
            $('#accidente_ubicacion_longitud').val(longitud);

            addMarker(longitud,latitud);
            var feature = markerSource.getFeatures()[0];
            var point = feature.getGeometry();
            var size = map.getSize();
            view.centerOn(point.getCoordinates(), size, [size[0]/2, size[1]/2]);
            view.setZoom(16);
            return false;
        }
    });

    $('#accidente_ubicacion_limpiar').click(function(){
        $('#accidente_ubicacion_maestroId').val('');
        $('#accidente_ubicacion_calle').val('');
        $('#accidente_ubicacion_numero').val('');
        $('#accidente_ubicacion_comuna').val('');
        $('#accidente_ubicacion_pais').val('');
        $('#accidente_ubicacion_tipoId').val('');
        $('#accidente_ubicacion_tipo').val('');
        $('#accidente_ubicacion_direccion').val('');
        $('#accidente_ubicacion_latitud').val('');
        $('#accidente_ubicacion_longitud').val('');
    });
});
