'use strict';
$(function () {
    $('#imei').mask('000000000000000');
    $('.imei').mask('000000000000000');
    $('#iccid').mask('0000000000000000000');
    $('.iccid').mask('0000000000000000000');
    $('#msisdn').mask('0000000000');
    $('#msisdn_temp').mask('0000000000');
    $('.msisdn').mask('0000000000');
    $('.msisdn_temp').mask('0000000000');
    $('#telephone').mask('0000000000');
    $('.telephone').mask('0000000000');
    $('.cel').mask('0000000000');
    $('#nip').mask('0000');
    $('.nip').mask('0000');
    $('#postcode').mask('00000');
    $('.postcode').mask('00000');
    $('.cp').mask('00000');
    $('.exp').mask('00');
    $('.card_cvv').mask('000');
    $('.card_number').mask('0000000000000000');

    $(document).ajaxSend(function () {
        $('#overlay').fadeIn(300);
    });

    $(document).ajaxComplete(function () {
        $('#overlay').fadeOut(300);
    });
});

jQuery.extend(jQuery.validator.messages, {
    required: 'Este campo es obligatorio.',
    remote: 'Por favor, rellena este campo.',
    email: 'Por favor, escribe una dirección de correo válida',
    url: 'Por favor, escribe una URL válida.',
    date: 'Por favor, escribe una fecha válida.',
    dateISO: 'Por favor, escribe una fecha (ISO) válida.',
    number: 'Por favor, escribe un número entero válido.',
    digits: 'Por favor, escribe sólo dígitos.',
    creditcard: 'Por favor, escribe un número de tarjeta válido.',
    equalTo: 'Por favor, escribe el mismo valor de nuevo.',
    accept: 'Por favor, escribe un valor con una extensión aceptada.',
    maxlength: jQuery.validator.format(
        'Por favor, no escribas más de {0} caracteres.'
    ),
    minlength: jQuery.validator.format(
        'Por favor, no escribas menos de {0} caracteres.'
    ),
    rangelength: jQuery.validator.format(
        'Por favor, escribe un valor entre {0} y {1} caracteres.'
    ),
    range: jQuery.validator.format(
        'Por favor, escribe un valor entre {0} y {1}.'
    ),
    max: jQuery.validator.format(
        'Por favor, escribe un valor menor o igual a {0}.'
    ),
    min: jQuery.validator.format(
        'Por favor, escribe un valor mayor o igual a {0}.'
    ),
});
