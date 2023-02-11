/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// start the Stimulus application
import './bootstrap';

// const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything

// Message de test
// console.log('Hello Webpack Encore !')

require('bootstrap');

// Import of Bootstrap-icons
import 'bootstrap-icons/font/bootstrap-icons.css';

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// // or you can include specific pieces
// // require('bootstrap/js/dist/tooltip');
// // require('bootstrap/js/dist/popover');

// $(document).ready(function () {
//     $('[data-toggle="popover"]').popover();
// });
