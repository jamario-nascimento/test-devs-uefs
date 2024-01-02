
/**
*                   .///.
*                   (0 o)
*-------------0000--(_)--0000-------------------------
* 
*  Olha eu aqui de novo gente, deixa eu explicar.
* 
*  Esta função ficará responsável por limpar todos
*  os alertas de validações do campo em destaque,
*  de tal forma que ao digitar algo novamente no
*  no campo, eu me encarregarei de remover as 
*  validações ali presentes.
*  
*  Espero ter ajudado e sempre conte comigo.
* 
*             oooO      Oooo 
*------------(   )-----(   )--------------------------
*             \ (       ) /
*              \_)     (_/
*/
$(document).ready(function () {
    $('.rg').mask('0000000000000');
    $('.numero').mask('00000');
    $('.data').mask('00/00/0000');
    $('.cep').mask('00.000-000');
    $('.telefone').mask('(00) 0000-0000');
    $('.celular').mask('(00) 00000-0000');
    $('.cpf').mask('000.000.000-00', {
        reverse: true
    });
    $('.cnpj').mask('00.000.000/0000-00', {
        reverse: true
    });

    // Validar Erro.
    $('.validarErro').keypress(function () {
        var nameCampo = $(this).attr('name');
        $($(this)).removeClass(".form-control is-invalid");
        $('#' + nameCampo + '-error').html('');
    });

    $('.validarErro').change(function () {
        var nameCampo = $(this).attr('name');
        $($(this)).removeClass(".form-control is-invalid");
        $('#' + nameCampo + '-error').html('');
    });

    // Máscara para telefone.
    var MaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
        spOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(MaskBehavior.apply({}, arguments), options);
            }
        };

    $('.celphones').mask(MaskBehavior, spOptions);

    // Máscara para CPF/CNPJ.
    var CpfCnpjMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length <= 11 ? '000.000.000-009' : '00.000.000/0000-00';
    },
        cpfCnpjpOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(CpfCnpjMaskBehavior.apply({}, arguments), options);
            }
        };
    $('.cpfCnpj').mask(CpfCnpjMaskBehavior, cpfCnpjpOptions);

    // Inicializa o select2 na classe select2.
    $('.select2').select2({
        language: {
            searching: function () {
                return 'Pesquisando...';
            },
            noResults: function () {
                return 'Nenhum resultado encontrado';
            }
        }
    });

    $('.custom-file-input').on('change', function () {
        //get the file name
        var fileName = $(this).val().replace('C:\\fakepath\\', " ");
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });

    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: "/reload-captcha",
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });

    $('#modalEnable').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);

        var cat_id = button.data('catid');
        var cat_name = button.data('cattext');
        var modal = $(this);

        modal.find('#modalForm').attr('action', cat_id);
        modal.find('.modal-body #Modal-text').html(cat_name);
    });
});
