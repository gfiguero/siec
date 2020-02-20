$(document).ready(function() {
    $('#accidente_claseAccidente').selectpicker({liveSearch: true});
    $('#accidente_tipoAccidente').selectpicker({liveSearch: true});
    $('#accidente_funcionario').selectpicker({liveSearch: true});
    $('#accidente_funcionarioResponsable').selectpicker({liveSearch: true});
    $('#accidente_tribunal').selectpicker({liveSearch: true});

    $('#accidente_causaBasal').selectpicker({liveSearch: true});

    $('#accidente_estadoAtmosferico').selectpicker({liveSearch: true});
    $('#accidente_tipoLuminosidad').selectpicker({liveSearch: true});
    $('#accidente_estadoLuzArtificial').selectpicker({liveSearch: true});
    $('#accidente_tipoPavimentoCalzada').selectpicker({liveSearch: true});
    $('#accidente_condicionPavimentoCalzada').selectpicker({liveSearch: true});
    $('#accidente_estadoPavimentoCalzada').selectpicker({liveSearch: true});
    $('#accidente_tipoCalzada').selectpicker({liveSearch: true});
    $('#accidente_cantidadPistasIda').selectpicker({liveSearch: true});
    $('#accidente_cantidadPistasRegreso').selectpicker({liveSearch: true});
    $('#accidente_demarcacionLineaCalzada').selectpicker({liveSearch: true});
    $('#accidente_demarcacionPrioridadCalzada').selectpicker({liveSearch: true});

    $('#accidente_comuna').selectpicker({liveSearch: true});
    $('#accidente_cuadrante').selectpicker({liveSearch: true});
    $('#accidente_unidad').selectpicker({liveSearch: true});
    $('#accidente_tipoZonaAccidente').selectpicker({liveSearch: true});
    $('#accidente_tipoUbicacionRelativaAccidente').selectpicker({liveSearch: true});
    $('#accidente_tipoDireccion').selectpicker({liveSearch: true});

    $('#accidente_estadoAccidente').selectpicker({liveSearch: true});
    $('#accidente_causas').select2();
    $('#accidente_elementosCalzada').select2();
    $('#accidente_registroEtapas').select2();

    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
});
