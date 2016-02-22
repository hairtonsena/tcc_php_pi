
jQuery(function ($) {



    var url_base = 'http://localhost/';


    $(".pagination").hide();
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 200) {
                $('.pagination').fadeIn();
            } else {
                $('.pagination').fadeOut();
            }
        });
    });



//                uploda imagem via Jquery
    $("#btn_enviar_imagem").on('click', function (event) {

        var mensagem = $("#mensagemImagem");
        var div_porcentagem = $("#porcentagemImagem");
        var barra = $("#barraImagem");
        var campoImgame = $("#arquivo_imagem");
//                    var textoCampoUp = $("#textoCampoUpImagem");



        barra.width('0%');
        barra.html('0%');
        event.preventDefault();
        if (campoImgame.val() == "") {
            mensagem.html("<div class='alert alert-danger'>Por favor, selecione uma imagem!<div>");
        } else {
            $("#form_upload_imagem").ajaxForm({
                url: url_base + 'palavras_indigenas/upImagem.php?acao=salvar_imagem_palavra',
                uploadProgress: function (event, position, total, percentComplete) {
                    div_porcentagem.css('display', 'block');
                    barra.width(percentComplete + '%');
                    barra.html(percentComplete + '%');
                },
                success: function (data) {

                    if (data == "sucesso") {
                        barra.width('100%');
                        console.log(data);
                        mensagem.html("<div class='alert alert-success'>Imagem enviada com sucesso!");
                        campoImgame.val("");

                        alert("Imagem enviada com sucesso!");
                        Tela.fecharModal();

                    } else {

                        barra.width('100%');
                        console.log(data);
                        mensagem.html(data);
                        campoImgame.val("");
//                                    textoCampoUp.html('<i class="glyphicon glyphicon-camera"></i> Selecione uma imagem </span>');
                    }
                },
                error: function () {
                    mensagem.html('Erro ao tentar acessar o arquivo!');
                },
                //  datatype: 'post',
                //  data: 'id_mural=agora',
                resetFrom: true
            }).submit();
        }
    });


    $("#arquivo_imagem").change(function () {
        $(this).prev().html($(this).val());
    });


//                Upload de som via Jquery
    $("#btn_enviar_som").on('click', function (event) {

        var mensagem = $("#mensagemSom");
        var div_porcentagem = $("#porcentagemSom");
        var barra = $("#barraSom");
        var campoImgame = $("#arquivo_som");
//                    var textoCampoUp = $("#textoCampoUpSom");



        barra.width('0%');
        barra.html('0%');
        event.preventDefault();
        if (campoImgame.val() == "") {
            mensagem.html("<div class='alert alert-danger'>Por favor, selecione uma imagem!<div>");
        } else {
            $("#form_upload_som").ajaxForm({
                url: url_base + 'palavras_indigenas/upSom.php?acao=salvar_som_palavra',
                uploadProgress: function (event, position, total, percentComplete) {
                    div_porcentagem.css('display', 'block');
                    barra.width(percentComplete + '%');
                    barra.html(percentComplete + '%');
                },
                success: function (data) {

                    if (data == "sucesso") {
                        barra.width('100%');
                        console.log(data);
                        mensagem.html("<div class='alert alert-success'>Imagem enviada com sucesso!");
                        campoImgame.val("");

                        alert("Imagem enviada com sucesso!");


                    } else {

                        barra.width('100%');
                        console.log(data);
                        mensagem.html(data);
                        campoImgame.val("");
//                                    textoCampoUp.html('<i class="glyphicon glyphicon-camera"></i> Selecione uma imagem </span>');
                    }
                },
                error: function () {
                    mensagem.html('Erro ao tentar acessar o arquivo!');
                },
                //  datatype: 'post',
                //  data: 'id_mural=agora',
                resetFrom: true
            }).submit();
        }
    });

    $("#arquivo_som").change(function () {
        $(this).prev().html($(this).val());
    });

});







function fuc_sobreAutor(palavra) {
    $('#myModal').modal('show');

    var parametro = "palavra=" + palavra;
    var url = "http://localhost/pi_ci/palavras/autor_palavra";

    carregar(parametro, url);

}


function informacoesUsuario(usuario) {
    $('#myModal').modal('show');
    var parametro = "usuario=" + usuario;
    var url = "./apresentacao/admin/informacaoUsuario.php";
    carregar(parametro, url);
}

function carregar(parametro, url) {
    $.ajax({
        type: "post",
        url: url,
        data: parametro,
        success: function (retorno) {
            $("#conteudodiv").html(retorno);
        }
    });
}

function exibirObservacao(texto) {

    var t = texto;
    $('#myModalLabel').html('Observação');
    $('#conteudodiv').html(t);
    
    $('#myModal').modal('show');
}

