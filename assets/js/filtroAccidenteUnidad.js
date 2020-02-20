$(document).ready(function() {
    $('#inspeccion_region').select2();
    $('#inspeccion_provincia').select2();
    $('#inspeccion_comuna').select2();
    $('#inspeccion_cuadrante').select2();

    $('#inspeccion_funcionario').select2();
    $('#inspeccion_tribunal').select2();
    $('#inspeccion_unidad').select2();

    $('#inspeccion_estadoAccidente').select2();

    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
});
