$(function () {
    $('form').on('submit', function (e) {
        e.preventDefault();

        $(".validarErro").removeClass("is-invalid");
        $(".invalid-feedback").text("");
        $(".invalid-feedback").hide();

        $("#spinnerLoading").show();
        var manter = $("#manter").val();
        if (manter == 'Atualizar') {
            var url = "/api/post/update";
            var type = "PUT";
        } else {
            var url = "/api/post/create";
            var type = "POST";
        }

        $.ajax({
            url: url,
            type: type,
            data: $("form").serialize()
        }).done(function (resposta) {
            if (resposta.Titulo != "") {
                toastr.success('Registro efetuado com sucesso!', manter + ' Post', { timeOut: 6000 });
                if (manter != 'Atualizar') {
                    $("#titulo").val("");
                    $("#resumo").val("");
                    $("#conteudo").val("");
                }

                $(".validarErro").removeClass("is-invalid");
                $(".invalid-feedback").text("");
                $(".invalid-feedback").hide();
            }
            $("#spinnerLoading").hide();
        }).fail(function (xhr, textStatus) {
            if (textStatus == 'error') {
              var json = $.parseJSON(xhr.responseText);
              var result = json.error.message;
              var msg = [];
              $.each(result,function(index, value){
                  if (index == 'Codl') {
                      msg.push(value[0]);
                  } else {
                      $("#"+index).addClass("is-invalid");
                      $("#"+index+"-error").text(value[0]);
                      $("#"+index+"-error").show();
                      msg.push(value[0]);
                  }
              });

              toastr.error('Erro ao tentar ' + manter + ':<br>'+msg.join("<br>"), manter + ' Post', {
                timeOut: 6000
              });
            }
            $("#spinnerLoading").hide();
          });
    });
});
