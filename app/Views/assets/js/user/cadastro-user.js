// cadastro user 
document.addEventListener('DOMContentLoaded', function () {

// mostrar/ocultar senha 
    function toggleSenha(id, icone) {

        const input = document.getElementById(id);

        if (!input) return;

        if (input.type === 'password') {

            input.type = 'text';
            icone.textContent = 'visibility_off';

        } else {

            input.type = 'password';
            icone.textContent = 'visibility';

        }

    }

    // Disponibiliza a função para os ícones
    document.querySelectorAll('.olho').forEach(function (icone) {

        icone.addEventListener('click', function () {

            const input = icone.parentElement.querySelector('input');

            if (input) {
                toggleSenha(input.id, icone);
            }

        });

    });


// mascara cpf 
    const cpf = document.getElementById('cpf');

    if (cpf) {

        cpf.addEventListener('input', function () {

            let valor = this.value.replace(/\D/g, '');

            valor = valor.substring(0, 11);

            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
            valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

            this.value = valor;

        });

    }


// permitir somente letras no nome 
    const nome = document.getElementById('nome');

    if (nome) {

        nome.addEventListener('input', function () {

            this.value = this.value.replace(/[^a-zA-ZÀ-ÿ\s]/g, '');

        });

    }


// mascara tel 
    const telefone = document.getElementById('telefone');

    if (telefone) {

        telefone.addEventListener('input', function () {

            let valor = this.value.replace(/\D/g, '');

            valor = valor.substring(0, 11);

            if (valor.length > 10) {

                valor = valor.replace(
                    /^(\d{2})(\d{5})(\d{4})$/,
                    '($1) $2-$3'
                );

            } else if (valor.length > 6) {

                valor = valor.replace(
                    /^(\d{2})(\d{4})(\d{0,4})$/,
                    '($1) $2-$3'
                );

            } else if (valor.length > 2) {

                valor = valor.replace(
                    /^(\d{2})(\d+)/,
                    '($1) $2'
                );

            } else if (valor.length > 0) {

                valor = valor.replace(
                    /^(\d+)/,
                    '($1'
                );

            }

            this.value = valor;

        });

    }

});