$(document).ready(function() {
    $('#accidente_busqueda_causaBasal').select2();
    $('#accidente_busqueda_claseAccidente').select2();
    $('#accidente_busqueda_tipoAccidente').select2();
    $('#accidente_busqueda_funcionario').select2();
    $('#accidente_busqueda_funcionarioResponsable').select2();

    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
});
