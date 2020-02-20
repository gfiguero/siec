$(document).ready(function() {
    $(window).keydown(function(event){if(event.keyCode == 13){event.preventDefault();return false;}});

    $('#accidente_comuna').selectpicker({liveSearch: true});

    $('#accidente_cuadrante').selectpicker({liveSearch: true});

    $('#accidente_tipoZonaAccidente').selectpicker({liveSearch: true});

    $('#accidente_tipoUbicacionRelativaAccidente').selectpicker({liveSearch: true});

    $('#accidente_tipoDireccion').selectpicker({liveSearch: true});

    $('#accidente_comuna').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        $("#accidente_cuadrante").empty().append('<option value="" selected="selected">Desconocido</option>');
        $.ajax({
            url: Routing.generate('buscar_comuna_cuadrantes', { comuna: $(e.currentTarget).val() }),
            type: 'GET',
            success: function(data) {
                var jsonData = JSON.stringify(data);
                $.each(JSON.parse(jsonData), function (idx, obj) {
                    $("#accidente_cuadrante").append('<option value="' + obj.id + '">' + obj.codigoNombre + '</option>');
                });
                $("#accidente_cuadrante").selectpicker('refresh');
            }
        });
    });

    $("#accidente_ubicacion_latitud").keydown(function(e){e.preventDefault();});

    $("#accidente_ubicacion_longitud").keydown(function(e){e.preventDefault();});

});
