$(function () {
    $('.excluir').on('click', function (e) {
        e.preventDefault();

        $("#spinnerLoading").show();

        if(confirm("Deseja realmente excluir este registro?")) {
            $.ajax({
                url: "/api/assunto/delete",
                type: "DELETE",
                data: {CodAs:$(this).attr('cod')}
            }).done(function (resposta) {

            toastr.success('Registro Excluído com sucesso!', 'Excluir Assunto', { timeOut: 6000 });

            setTimeout(window.location.href = "/assunto/", 2000);

            $("#spinnerLoading").hide();
            }).fail(function (xhr, textStatus) {
                if(textStatus == 'error'){
                    toastr.error('Erro ao tentar Excluir', 'Excluir Assunto', { timeOut: 6000 });
                }
                $("#spinnerLoading").hide();
            });
        }
    });
});
