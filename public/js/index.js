$(function () {
    $('[name="fone"]').mask('(00) 0000-00009');

    $(document).on('click', '[js-deletar]', function (e) {
        e.preventDefault();

        if (confirm("Tem certeza que deseja deletar o cadastro?")) {
            let elemento = $(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/pessoa-deletar/' + elemento.attr('js-deletar'),
                type: 'DELETE',
                contentType: 'application/json',
                async: true,
                success: function (retorno) {
                    window.location.href = '/';
                },
                error: function () {
                    alert('Algo de errado aconteceu, por favor, tente novamente!');
                }
            });

        } else {
            return false;
        }
    });

    $(document).on('blur', '[name="cpf"]', function (e) {
        e.preventDefault();

        let elemento = $(this);

        let cpf = maskCPF(elemento.val());
        let valido = validaCpf(elemento.val());

        elemento.val(cpf);

        if (!valido) {
            elemento.val('');
            return alert('CPF inválido, digite novamente!');
        }
    });

    $(document).on('blur', '[name="fone"]', function (e) {
        e.preventDefault();

        let elemento = $(this);

        if (elemento.val().length == 15) {
            $(this).mask('(00) 00000-0009');
        } else {
            $(this).mask('(00) 0000-00009');
        }
    });
});

function maskCPF(cpf) {
    return cpf.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
}

function validaCpf(cpf) {
    var result = true;

    cpf = cpf.replace(/\D/g, '');

    if (cpf.toString().length != 11 || /^(\d)\1{10}$/.test(cpf)) {
        return false;
    }

    [9, 10].forEach(function (j) {
        var soma = 0, r;

        cpf.split(/(?=)/).splice(0, j).forEach(function (e, i) {
            soma += parseInt(e) * ((j + 2) - (i + 1));
        });

        r = soma % 11;
        r = (r < 2) ? 0 : 11 - r;

        if (r != cpf.substring(j, j + 1)) {
            result = false;
        }
    });
    
    return result;
}