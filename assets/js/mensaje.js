$(document).ready(function() {

    $('#accidente_claseAccidente').selectpicker({liveSearch: true, size: 10});
    $('#accidente_tipoAccidente').selectpicker({liveSearch: true, size: 10});
    $('#accidente_causaBasal').selectpicker({liveSearch: true, size: 10});

    $('#accidente_comuna').selectpicker({liveSearch: true, size: 10});
    $('#accidente_unidad').selectpicker({liveSearch: true, size: 10});
    $('#accidente_tipoZonaAccidente').selectpicker({liveSearch: true, size: 10});
    $('#accidente_tipoDireccion').selectpicker({liveSearch: true, size: 10});

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

    $('#accidente_comuna').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        $("#accidente_unidad").empty().append('<option value="" selected="selected">Seleccione</option>');
        $.ajax({
            url: Routing.generate('buscar_comuna_unidades', { comuna: $(e.currentTarget).val() }),
            type: 'GET',
            success: function(data) {
                var jsonData = JSON.stringify(data);
                $.each(JSON.parse(jsonData), function (idx, obj) {
                    $("#accidente_unidad").append('<option value="' + obj.id + '">' + obj.codigoNombre + '</option>');
                });
                $("#accidente_unidad").selectpicker('refresh');
            }
        });
    });

});
