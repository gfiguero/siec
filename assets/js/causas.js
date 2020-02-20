$(document).ready(function() {
    $(window).keydown(function(event){if(event.keyCode == 13){event.preventDefault();return false;}});

    $('#accidente_causaBasal').selectpicker({liveSearch: true, size: 10});
    $('#accidente_causas').select2();

    $('#accidente_causaBasal').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
        $("#accidente_causas").empty();
        $.ajax({
            url: Routing.generate('buscar_causaBasal_causasConcurrentes', { causa: $(e.currentTarget).val() }),
            type: 'GET',
            success: function(data) {
                var jsonData = JSON.stringify(data);
                $.each(JSON.parse(jsonData), function (idx, obj) {
                    $("#accidente_causas").append('<option value="' + obj.id + '">' + obj.codigoNombre + '</option>');
                });
                $("#accidente_causas").select2();
            }
        });
    });
});
