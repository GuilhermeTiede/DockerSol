// public/js/clientes.js
$(document).ready(function () {
    $('#formCliente').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "{{ route('clientes.store') }}",
            data: $(this).serialize(),
            success: function (data) {
                $('#resultado').text(data.message);
            },
            error: function (xhr, status, error) {
                $('#resultado').text('Ocorreu um erro ao criar o cliente.');
            }
        });
    });
});
