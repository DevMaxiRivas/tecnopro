$(document).ready(function () {
    // Agrega el evento change para el campo tipo_modif
    $('#tipo_modif').on('change', function () {
        validateTipoModif();
        validateCantidadModif();
        updateSubmitButton();
    });

    // Agrega el evento input para los campos relacionados
    $('#cantidad_modif, #motivo_modif, #stock_disponible').on('input', function () {
        validateCantidadModif();
        updateSubmitButton();
    });

    function validateCantidadModif() {
        var tipoModif = $('#tipo_modif').val();
        var cantidadModif = parseFloat($('#cantidad_modif').val()) || 0;
        var stockDisponible = parseFloat($('#stock_disponible').val()) || 0;
        var errorMessage = '';

        // Validación: cantidad_modif no debe ser negativo
        if (cantidadModif < 0) {
            errorMessage = 'La cantidad no puede ser negativa.';
        }

        // Validación: Si es egreso o devolución, cantidad_modif no debe ser mayor a stock_disponible
        if ((tipoModif === 'egreso' || tipoModif === 'devolucion') && cantidadModif > stockDisponible) {
            errorMessage = 'La cantidad no puede ser mayor al stock disponible.';
        }

        // Validación: cantidad_modif debe ser mayor o igual a 1
        if (cantidadModif < 1) {
            errorMessage = 'La cantidad debe ser mayor o igual a 1.';
        }

        // Muestra el mensaje de error o limpia el mensaje si no hay error
        $('#cantidad_modif').toggleClass('is-invalid', errorMessage !== '');
        $('#cantidad_modif-error').text(errorMessage);
    }

    function validateTipoModif() {
        var tipoModif = $('#tipo_modif').val();

        // Cambia el atributo readonly de los campos cantidad_modif y motivo_modif según la selección
        $('#cantidad_modif, #motivo_modif').prop('readonly', tipoModif === '');

        // Si el tipoModif es '', también limpia el valor de cantidad_modif
        if (tipoModif === '') {
            $('#cantidad_modif').val('');
        }

        // Agrega o quita el atributo "required" según la selección
        $('#cantidad_modif, #motivo_modif').prop('required', tipoModif !== '');
    }

    function updateSubmitButton() {
        // Habilita o deshabilita el botón de enviar según si hay errores o no
        $('button[type="submit"]').prop('disabled', $('#cantidad_modif').hasClass('is-invalid'));
    }
});
