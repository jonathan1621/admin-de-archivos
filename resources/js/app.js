import './bootstrap';

import $ from 'jquery';
import 'select2';
import 'select2/dist/css/select2.min.css';


// Inicializa Select2
$(document).ready(() => {
    $('.select2').select2(); // Asegúrate de tener un elemento con la clase "select2" en tu HTML
});
