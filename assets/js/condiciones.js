$(document).ready(function() {
    $(window).keydown(function(event){if(event.keyCode == 13){event.preventDefault();return false;}});

// Condiciones
    $('#accidente_estadoAtmosferico').selectpicker({liveSearch: true});
    $('#accidente_tipoLuminosidad').selectpicker({liveSearch: true});
    $('#accidente_estadoLuzArtificial').selectpicker({liveSearch: true});
    $('#accidente_tipoPavimentoCalzada').selectpicker({liveSearch: true});
    $('#accidente_condicionPavimentoCalzada').selectpicker({liveSearch: true});
    $('#accidente_estadoPavimentoCalzada').selectpicker({liveSearch: true});

// Pistas
    $('#accidente_tipoCalzada').selectpicker({liveSearch: true});
    $('#accidente_cantidadPistasIda').selectpicker({liveSearch: true});
    $('#accidente_cantidadPistasRegreso').selectpicker({liveSearch: true});

// Demarcaciones
    $('#accidente_demarcacionLineaCalzada').selectpicker({liveSearch: true});
    $('#accidente_demarcacionPrioridadCalzada').selectpicker({liveSearch: true});

});
