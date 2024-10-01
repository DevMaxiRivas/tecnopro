
    document.addEventListener('DOMContentLoaded', function () {
        var inputs = document.querySelectorAll('input[type=number]');

        inputs.forEach(function (input) {
            input.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    this.closest('form').submit();
                }
            });
        });
    });

    