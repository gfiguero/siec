$(document).ready(function() {
    $(window).keydown(function(event){if(event.keyCode == 13){event.preventDefault();return false;}});

    $('#accidente_claseAccidente').selectpicker({liveSearch: true, size: 10 });

    $('#accidente_tipoAccidente').selectpicker({liveSearch: true, size: 10 });

    $('#accidente_claseAccidente').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        $("#accidente_tipoAccidente").empty().append('<option value="" selected="selected">Seleccione</option>');
        $.ajax({
            url: Routing.generate('buscar_claseAccidente_tiposAccidente', { claseAccidente: $(e.currentTarget).val() }),
            type: 'GET',
            success: function(data) {
                var jsonData = JSON.stringify(data);
                $.each(JSON.parse(jsonData), function (idx, obj) {
                    $("#accidente_tipoAccidente").append('<option value="' + obj.id + '">' + obj.codigoNombre + '</option>');
                });
                $("#accidente_tipoAccidente").selectpicker('refresh');
            }
        });
    });
});
