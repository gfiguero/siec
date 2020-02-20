/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

require('webpack-jquery-ui');
require('webpack-jquery-ui/autocomplete');
//require('jquery-ui-bundle');
//require('jquery-ui/ui/widgets/sortable');
require('../js/jquery.collection.js');
require('bootstrap');
require('bootstrap-select');
require('select2');
require('chart.js');
require('popper.js');
require('animate.css');

import Notify from 'bootstrap4-notify';
window.Notify = Notify;

import rut from './rut.js';
window.rut = rut;

import 'bootstrap4-toggle/js/bootstrap4-toggle.min';

import '@fortawesome/fontawesome-free/js/all';

const routes = require('../../public/js/fos_js_routes.json');
import Routing from '../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.min.js';
window.Routing = Routing;
Routing.setRoutingData(routes);

global.$ = global.jQuery = $;

$(document).ready(function() {
    $('input[type=checkbox]').bootstrapToggle({on: 'Si', off: 'No', height: 38, width: 70, style: 'mr-1'});
    $('[data-toggle="tooltip"]').tooltip();
});
