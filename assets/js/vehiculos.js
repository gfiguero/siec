$(document).ready(function() {
    $(window).keydown(function(event){if(event.keyCode == 13) {event.preventDefault();return false;}});

    $('.simple-select').selectpicker({liveSearch: true, size: 10});
    $('.placa-patente').keyup(function(){ $(this).val( $(this).val().toUpperCase()); });
    $('.nombre-propio').keyup(function(){ $(this).val(capitalize( $(this).val())); });
    $('.rut').rut({formatOn: 'keyup', ignoreControlKeys: false}).on('rutInvalido', function(e) { $(this).addClass('is-invalid'); }).on('rutValido', function(e) { $(this).removeClass('is-invalid'); });

    $('.vehiculo-collection').collection({
        min: 1,
        drag_drop: false,
        allow_duplicate:false,
        position_field_selector: '.vehiculo-position',
        add:'<a href="#" class="btn btn-primary btn-block"><span class="fa fa-plus"></span> Agregar Vehículo</a>',
        add_at_the_end: true,
        after_add: function(collection, element) {
            $('.simple-select').selectpicker({liveSearch: true, size: 10});
            $('.placa-patente').keyup(function(){ $(this).val($(this).val().toUpperCase()); });
            $('input[type=checkbox]').bootstrapToggle({on: 'Si', off: 'No', height: 38, width: 70, style: 'mr-1'});
        },
        children: [{
            drag_drop: false,
            selector: '.conductor-vehiculo-collection',
            allow_duplicate: false,
            min: 1,
            max: 1,
            after_add: function(collection, element) {
                $('.simple-select').selectpicker({liveSearch: true, size: 10});
                $('input[type=checkbox]').bootstrapToggle({on: 'Si', off: 'No', height: 38, width: 70, style: 'mr-1'});
                $('.rut').rut({formatOn: 'keyup', ignoreControlKeys: false}).on('rutInvalido', function(e) { $(this).addClass('is-invalid'); }).on('rutValido', function(e) { $(this).removeClass('is-invalid'); });
            }
        },{
            drag_drop: false,
            selector: '.pasajero-vehiculo-collection',
            allow_duplicate:false,
            add_at_the_end: true,
            add:'<a href="#" class="btn btn-primary btn-block"><span class="fa fa-plus"></span> Agregar Pasajero</a>',
            after_add: function(collection, element) {
                $('.simple-select').selectpicker({liveSearch: true, size: 10});
                $('input[type=checkbox]').bootstrapToggle({on: 'Si', off: 'No', height: 38, width: 70, style: 'mr-1'});
                $('.rut').rut({formatOn: 'keyup', ignoreControlKeys: false}).on('rutInvalido', function(e) { $(this).addClass('is-invalid'); }).on('rutValido', function(e) { $(this).removeClass('is-invalid'); });
            }
        }]
    });
});

function capitalize(str){str.toLowerCase(); return str.replace(/(\b)([a-zA-Z])/g, function(firstLetter){ return firstLetter.toUpperCase(); });}