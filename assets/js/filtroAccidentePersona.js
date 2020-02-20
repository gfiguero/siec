$(document).ready(function() {
    $('#inspeccion_region').select2();
    $('#inspeccion_provincia').select2();
    $('#inspeccion_comuna').select2();
    $('#inspeccion_cuadrante').select2();

    $('#inspeccion_funcionario').selectpicker({liveSearch: true, size: 10});
    $('#inspeccion_tribunal').selectpicker({liveSearch: true, size: 10});
    $('#inspeccion_unidad').selectpicker({liveSearch: true, size: 10});

    $('#inspeccion_tipoCausa').select2();
    $('#inspeccion_tipoUbicacionRelativaAccidente').select2();
    $('#inspeccion_tipoUnidad').select2();
    $('#inspeccion_tipoCalzada').select2();
    $('#inspeccion_demarcacionLineaCalzada').select2();
    $('#inspeccion_demarcacionPrioridadCalzada').select2();
    $('#inspeccion_elementoCalzada').select2();
    $('#inspeccion_estadoAtmosferico').select2();
    $('#inspeccion_estadoPavimentoCalzada').select2();
    $('#inspeccion_tipoDireccion').select2();
    $('#inspeccion_tipoPavimentoCalzada').select2();
    $('#inspeccion_tipoZonaAccidente').select2();
    $('#inspeccion_causaBasal').select2();
    $('#inspeccion_causas').select2();
    $('#inspeccion_claseAccidente').select2();
    $('#inspeccion_condicionPavimentoCalzada').select2();
    $('#inspeccion_estadoLuzArtificial').select2();
    $('#inspeccion_tipoAccidente').select2();
    $('#inspeccion_tipoLuminosidad').select2();
    $('#inspeccion_estadoAccidente').select2();

    $('#inspeccion_tipoVehiculo').select2();
    $('#inspeccion_servicioVehiculo').select2();
    $('#inspeccion_maniobraVehiculo').select2();
    $('#inspeccion_direccionVehiculo').select2();
    $('#inspeccion_consecuenciaVehiculo').select2();

    $('#inspeccion_claseLicencia').select2();
    $('#inspeccion_comunaLicencia').select2();
    $('#inspeccion_condicionFisica').select2();
    $('#inspeccion_consecuenciaPersona').select2();
    $('#inspeccion_cualidadEspecial').select2();
    $('#inspeccion_tipoTrayecto').select2();
    $('#inspeccion_seguridad').select2();


    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
});
