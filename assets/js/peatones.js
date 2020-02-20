$(document).ready(function() {
    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    $('.peatones-collection').collection({
        drag_drop: false,
        allow_duplicate:false,
        position_field_selector: '.peaton-position',
        add:'<a href="#" class="btn btn-primary btn-block"><span class="fa fa-plus"></span> Agregar Peatón</a>',
        add_at_the_end: true,
        after_add: function(collection, element) {
            $('.simple-select').selectpicker({liveSearch: true, size: 10});
            $('input[type=checkbox]').bootstrapToggle({on: 'Si', off: 'No', height: 38, width: 70, style: 'mr-1'});
            $('.rut').rut({formatOn: 'keyup', ignoreControlKeys: false}).on('rutInvalido', function(e) { $(this).addClass('is-invalid'); }).on('rutValido', function(e) { $(this).removeClass('is-invalid'); });
        }
    });

    $('.simple-select').selectpicker({
        liveSearch: true,
        width: false,
        virtualScroll: 10,
        noneSelectedText: 'Seleccionar',
        noneResultsText: 'Seleccionar',
        selectedTextFormat: 'count'
    });

    $('.multiple-select').selectpicker({
        liveSearch: true,
        actionsBox: true,
        selectAllText: 'Seleccionar Todo',
        deselectAllText: 'Limpiar selección',
        noneSelectedText: 'Seleccionar',
        noneResultsText: 'Seleccionar',
        selectedTextFormat: 'count',
        countSelectedText: function (numSelected, numTotal) {
            return (numSelected == 1) ? '{0} seleccionadas' : '{0} seleccionadas';
        }
    });

    $('.nombre-propio').keyup(function(){
        $(this).val(capitalize($(this).val()));
    });

    $('.rut').rut({formatOn: 'keyup', ignoreControlKeys: false}).on('rutInvalido', function(e) { $(this).addClass('is-invalid'); }).on('rutValido', function(e) { $(this).removeClass('is-invalid'); });

});

function capitalize(str){
    str.toLowerCase();  
    return str.replace(/(\b)([a-zA-Z])/g, function(firstLetter){ return firstLetter.toUpperCase(); });
}