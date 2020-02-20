$(document).ready(function() {
    $(window).keydown(function(event){if(event.keyCode == 13){event.preventDefault();return false;}});

    $('#accidente_unidad').selectpicker({liveSearch: true, size: 10 });

    $('#accidente_funcionario').selectpicker({liveSearch: true, size: 10 });

    $('#accidente_funcionarioResponsable').selectpicker({liveSearch: true, size: 10 });

    $('#accidente_tribunal').selectpicker({liveSearch: true, size: 10 });

    $('#accidente_unidad').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        $("#accidente_funcionario").empty().append('<option value="" selected="selected">Seleccione</option>');
        $("#accidente_funcionarioResponsable").empty().append('<option value="" selected="selected">Seleccione</option>');
        $.ajax({
            url: Routing.generate('buscar_unidad_funcionarios', { unidad: $(e.currentTarget).val() }),
            type: 'GET',
            success: function(data) {
                var jsonData = JSON.stringify(data);
                $.each(JSON.parse(jsonData), function (idx, obj) {
                    $("#accidente_funcionario").append('<option value="' + obj.id + '">' + obj.codigoNombre + '</option>');
                    $("#accidente_funcionarioResponsable").append('<option value="' + obj.id + '">' + obj.codigoNombre + '</option>');
                });
                $("#accidente_funcionario").selectpicker('refresh');
                $("#accidente_funcionarioResponsable").selectpicker('refresh');
            }
        });
    });
});
