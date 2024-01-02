$(function () {
    $('.excluir').on('click', function (e) {
        e.preventDefault();

        $("#spinnerLoading").show();

        if(confirm("Deseja realmente excluir este registro?")) {
            $.ajax({
                url: "/api/autor/delete",
                type: "DELETE",
                data: {CodAu:$(this).attr('cod')}
            }).done(function (resposta) {

            toastr.success('Registro Excluído com sucesso!', 'Excluir Autor', { timeOut: 6000 });

            setTimeout(window.location.href = "/autor/", 2000);

            $("#spinnerLoading").hide();
            }).fail(function (xhr, textStatus) {
                if(textStatus == 'error'){
                    toastr.error('Erro ao tentar Excluir', 'Excluir Autor', { timeOut: 6000 });
                }
                $("#spinnerLoading").hide();
            });
        }
    });
});
