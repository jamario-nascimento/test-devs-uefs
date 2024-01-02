$(function () {
    $('.excluir').on('click', function (e) {
        e.preventDefault();

        $("#spinnerLoading").show();

        if(confirm("Deseja realmente excluir este registro?")) {
            $.ajax({
                url: "/api/livro/delete",
                type: "DELETE",
                data: {Codl:$(this).attr('cod')}
            }).done(function (resposta) {

            toastr.success('Registro Excluído com sucesso!', 'Excluir Livro', { timeOut: 6000 });

            setTimeout(window.location.href = "/livro/", 2000);

            $("#spinnerLoading").hide();
            }).fail(function (xhr, textStatus) {
                if(textStatus == 'error'){
                    toastr.error('Erro ao tentar Excluir', 'Excluir Livro', { timeOut: 6000 });
                }
                $("#spinnerLoading").hide();
            });
        }
    });
});
