<?php

// Startando a sessão do php
session_start();
// Variaveis Globais 
$tituloSistema = "Palavras Indigenas";
// Menu do sistema default
$menuSistema = "./apresentacao/visitante/menuTop.php";
// Conteudo do sistema default
$conteudoSistema = "./apresentacao/visitante/homeVisitante.php";
$usuarioLogado = FALSE;
$codigoUsuarioLog = NULL;
$tipoUsuarioSistema = -1;
// Numero de registro de paginação.
$numeroRegistroPorPagina = 20;

// incluido classe 
include './persistencia/conexao/DB.class.php';
include './persistencia/usuario/Login.class.php';
include './persistencia/palavra/Palavra.class.php';
include './persistencia/lingua/Lingua.class.php';
include './persistencia/usuario/Usuario.class.php';
include './persistencia/povo/Povo.class.php';


// instanciando a classe de conexão com o banco de dados
$conexao = new DB();
// acessando o metodo de conexao na classe
$conexao->conexao();






// Metodo para verificar Usuario logado e verificar o nivel de previlegil
if (isset($_SESSION['user_nome']) && isset($_SESSION['user_apelido']) && isset($_SESSION['user_senha']) && isset($_SESSION['user_email']) && isset($_SESSION['user_tipo'])) {
    $usuarioLogado = TRUE;
    $codigoUsuarioLog = $_SESSION['user_id'];
    $tipoUsuarioSistema = $_SESSION['user_tipo'];
    if (($tipoUsuarioSistema == 0) or ( $tipoUsuarioSistema == 1)) {
        $menuSistema = "./apresentacao/admin/menuTop.php";
        $conteudoSistema = "./apresentacao/admin/homeColaborador.php";
    } else if ($tipoUsuarioSistema == 2) {
        $menuSistema = "./apresentacao/colaborador/menuTop.php";
        $conteudoSistema = "./apresentacao/colaborador/homeColaborador.php";
    }
}



//include './controle/usuario/validar_user_logado.php';
// Verificando se o request ação foi chamado
if (isset($_GET["acao"])) {
// recebendo informações do request ação 
    $acao = $_GET["acao"];
    switch ($acao) {


///////////////////////////////////////////////////////////////////////////
//---------Trabalhando com autenticação e solicitação de colaborador ----//
///////////////////////////////////////////////////////////////////////////        
        case "login":
            $conteudoSistema = "./apresentacao/seguranca/loguin_usuario.php";
            break;

        case "logar":
            if ((!isset($_POST['apelido'])) or (!isset($_POST['senha'])))
                redirecionar('./?acao=login');

            $apelidoLogin = mysql_escape_string(trim(strip_tags($_POST['apelido'])));
            $senhaLogin = mysql_escape_string(trim(strip_tags($_POST['senha'])));

// instanciando classe de login
            $logarSistema = New Login();
            $logar = $logarSistema->logar($apelidoLogin, $senhaLogin);
            if ($logar['verificarError'] == 0) {
// salvando logs.
                $mensagemLog = "Usuário entrou no sistema.";
                $idUsuarioLog = $_SESSION['user_id'];
                salvaLog($mensagemLog, $idUsuarioLog);
                redirecionar("./");
            } else {
                $flesh = $logar['flesh'];
                $conteudoSistema = "./apresentacao/seguranca/loguin_usuario.php";
            }
            break;

        case "logout" :
// salvando logs.
            $mensagemLog = "Usuário saiu do sistema.";
            $idUsuarioLog = $codigoUsuarioLog;
            $logoutSistema = new Login();
            $logoutSistema->logout();
            salvaLog($mensagemLog, $idUsuarioLog);
            redirecionar("./");
            break;

        case "gerar_nova_senha":
            $conteudoSistema = "./apresentacao/seguranca/esquece_senha_usuario.php";
            break;

        case "gerar":

            $verificarErro = 0;
            $flesh = '';

            if (!isset($_POST['apelido_email'])) {
                redirecionar("./?acao=gerar_nova_senha");
            }

            $apelido_email = trim(strip_tags($_POST['apelido_email']));

            $geraSenha = new Login();
            $query = $geraSenha->gerar_nova_senha_usuario($apelido_email);
            if ($query['verificarErro'] == 0) {
                $verificarErro = 0;
            } else {
                $flesh = $query['flesh'];
                $verificarErro = 1;
            }

            if ($verificarErro == 0) {
                $flesh = "A senha foi enviada para o email cadastrado no sistema!";
                $conteudoSistema = "./apresentacao/seguranca/esquece_senha_usuario.php";
            } else {
                $conteudoSistema = "./apresentacao/seguranca/esquece_senha_usuario.php";
            }

            break;

        case "novo_colaborador":
            $inputValue = array(
                "nomeUsuario" => "",
                "apelidoUsuario" => "",
                "emailUsuario" => "",
                "cpfUsuario" => "",
                "telefoneUsuario" => "",
                "linkUsuario" => "",
                "descricaoUsuario" => ""
            );
            $conteudoSistema = "./apresentacao/seguranca/cadastra_usuario.php";
            break;

        case "enviar_solicitacao":

            $verificarErro = 0;
            $flesh = '';

            if ((!isset($_POST['nome'])) or (!isset($_POST['apelido'])) or (!isset($_POST['email'])) or (!isset($_POST['cpf'])) or (!isset($_POST['telefone']))) {
                redirecionar("./?acao=novo_colaborador");
            }

            $nomeUsuario = trim(strip_tags($_POST['nome']));
            $apelidoUsuario = trim(strip_tags($_POST['apelido']));
            $emailUsuario = trim(strip_tags($_POST['email']));
            $cpfUsuario = trim(strip_tags($_POST['cpf']));
            $telefoneUsuario = trim(strip_tags($_POST['telefone']));
            $linkUsuario = trim(strip_tags($_POST['link']));
            $descricaofoneUsuario = trim(strip_tags($_POST['descricao']));
            $idTipoUsuario = 2;
            $statusUsuario = 0;

            $inputValue = array(
                "nomeUsuario" => $nomeUsuario,
                "apelidoUsuario" => $apelidoUsuario,
                "emailUsuario" => $emailUsuario,
                "cpfUsuario" => $cpfUsuario,
                "telefoneUsuario" => $telefoneUsuario,
                "linkUsuario" => $linkUsuario,
                "descricaoUsuario" => $descricaofoneUsuario
            );

            // Validação nome //
            if (strlen($nomeUsuario) < 3) {
                $verificarErro = 1;
                $flesh = "O nome está curto!";
            } else if (strlen($nomeUsuario) >= 50) {
                $verificarErro = 1;
                $flesh = "O nome pode ter no máximo 50 letras incluindo os espaços!";
            }
            // Fim validação nome //
            // Validação de apelido //
            if ($verificarErro == 0) {
                if (strripos($apelidoUsuario, " ") == TRUE) {
                    $verificarErro = 1;
                    $flesh = "O apelido não pode ter espaços!";
                } else if (strlen($apelidoUsuario) < 2) {
                    $verificarErro = 1;
                    $flesh = "O apelido está curto!";
                } else if (strlen($apelidoUsuario) >= 50) {
                    $verificarErro = 1;
                    $flesh = "O apelido pode ter no máximo 50 letras!";
                } else {
                    $apelidoUsuario = strtolower($apelidoUsuario);
                }
            }
            // Fim validação apelido //
            if ($verificarErro == 0) {
                if (strlen($emailUsuario) < 5) {
                    $verificarErro = 1;
                    $flesh = "O email está curto!";
                }if (validaEmail($emailUsuario) == FALSE) {
                    $verificarErro = 1;
                    $flesh = "O Email inserido é invalido!";
                } else if (strlen($emailUsuario) >= 70) {
                    $verificarErro = 1;
                    $flesh = "O email só pode ter no máximo 70 letras!";
                } else {
                    $emailUsuario = strtolower($emailUsuario);
                }
            }
            // Validação email //
            // Validação CPF //
            if ($verificarErro == 0) {
                if (validaCPF($cpfUsuario) == FALSE) {
                    $verificarErro = 1;
                    $flesh = 'CPF inválido!';
                } else {
                    $retira = array(".", "-");
                    $cpfUsuario = str_replace($retira, "", $cpfUsuario);
                }
            }
            // Fim da vailidação CPF // 



            if ($verificarErro == 0) {
                $colaborador = new Login();

                $query = $colaborador->enviarSolicitacaoColaborador($nomeUsuario, $apelidoUsuario, $emailUsuario, $cpfUsuario, $telefoneUsuario, $linkUsuario, $descricaofoneUsuario, $idTipoUsuario, $statusUsuario);

                if ($query['verificarErro'] != 0) {
                    $flesh = $query['flesh'];
                    $verificarErro = 1;
                }
            }

//            $verificarErro = 1;
            if ($verificarErro == 0) {
                $flesh = "Sua solicitação de colaborador foi realizada com sucesso! Aguarde avaliação dos seus dados. O resultado será encaminhado para o seu email juntamente com sua senha. Obrigado " . $nomeUsuario;
                $conteudoSistema = "./apresentacao/seguranca/cadastra_usuario.php";
            } else {
                $conteudoSistema = "./apresentacao/seguranca/cadastra_usuario.php";
            }

            break;

        case "alterar_senha" :

            if ($usuarioLogado == TRUE) {
                $conteudoSistema = "./apresentacao/seguranca/form_alterar_senha.php";
            }
            break;

        case "salvar_nova_senha" :
            if ($usuarioLogado == TRUE) {
                if ((!isset($_POST['senha_atual'])) or (!isset($_POST['nova_senha'])) or (!isset($_POST['confirmar_senha']))) {
                    redirecionar("./?acao=alterar_senha");
                }

                $verificarErro = 0;
                $flesh = '';

                $senhaAtual = trim(strip_tags($_POST['senha_atual']));
                $novaSenha = trim(strip_tags($_POST['nova_senha']));
                $confirmar_senha = trim(strip_tags($_POST['confirmar_senha']));
                $idUsuario = $_SESSION['user_id'];

                if (strlen($novaSenha) < 6) {
                    $verificarErro = 1;
                    $flesh = "Senha curta, mínimo de 6 caracteres!";
                } else if (strlen($novaSenha) > 12) {
                    $verificarErro = 1;
                    $flesh = "Senha longua, máximo de 12 caracteres!";
                } else if ($novaSenha != $confirmar_senha) {
                    $verificarErro = 1;
                    $flesh = "A confirmação da senha está incorreta!";
                }


                if ($verificarErro == 0) {
                    $usuario = new Login();
                    $query = $usuario->salvarNovaSenhaUsuario($senhaAtual, $novaSenha, $idUsuario);

                    if ($query['verificarErro'] == 1) {
                        $flesh = $query['flesh'];
                        $verificarErro = 1;
                    } else {
                        // salvando logs.
                        $mensagemLog = "Usuário alterou a senha.";
                        $idUsuarioLog = $_SESSION['user_id'];
                        salvaLog($mensagemLog, $idUsuarioLog);
                    }
                }
                if ($verificarErro == 0) {
                    $flesh = "Senha alterada com sucesso!";
                    $conteudoSistema = "./apresentacao/seguranca/form_alterar_senha.php";
                } else {
                    $conteudoSistema = "./apresentacao/seguranca/form_alterar_senha.php";
                }
            }
            break;

        case "alterar_dados":
            if ($usuarioLogado == TRUE) {
                $conteudoSistema = "./apresentacao/seguranca/form_alterar_dados_usuario.php";
            }
            break;

        case "salvar_dados_usuario":
            if ($usuarioLogado == TRUE) {
                if ((!isset($_POST['nome'])) or (!isset($_POST['apelido'])) or (!isset($_POST['email'])) or (!isset($_POST['cpf'])) or (!isset($_POST['telefone'])) or (!isset($_POST['senha_atual']))) {
                    redirecionar("./?acao=alterar_dados");
                }

                $verificarErro = 0;
                $flesh = '';

                $nomeUsuario = trim(strip_tags($_POST['nome']));
                $apelidoUsuario = trim(strip_tags($_POST['apelido']));
                $emailUsuario = trim(strip_tags($_POST['email']));
                $cpfUsuario = trim(strip_tags($_POST['cpf']));
                $telefoneUsuario = trim(strip_tags($_POST['telefone']));
                $linkUsuario = trim(strip_tags($_POST['link']));
                $descricaofoneUsuario = trim(strip_tags($_POST['descricao']));

                $senhaAtual = trim(strip_tags($_POST['senha_atual']));
                $idUsuario = $_SESSION['user_id'];



                // Validação nome //
                if (strlen($nomeUsuario) < 3) {
                    $verificarErro = 1;
                    $flesh = "O nome está curto!";
                } else if (strlen($nomeUsuario) >= 50) {
                    $verificarErro = 1;
                    $flesh = "O nome pode ter no máximo 50 letras incluindo os espaços!";
                }
                // Fim validação nome //
                // Validação de apelido //
                if ($verificarErro == 0) {
                    if (strripos($apelidoUsuario, " ") == TRUE) {
                        $verificarErro = 1;
                        $flesh = "O apelido não pode ter espaços!";
                    } else if (strlen($apelidoUsuario) < 2) {
                        $verificarErro = 1;
                        $flesh = "O apelido está curto!";
                    } else if (strlen($apelidoUsuario) >= 50) {
                        $verificarErro = 1;
                        $flesh = "O apelido pode ter no máximo 50 letras!";
                    } else {
                        $apelidoUsuario = strtolower($apelidoUsuario);
                    }
                }
                // Fim validação apelido //
                if ($verificarErro == 0) {
                    if (strlen($emailUsuario) < 5) {
                        $verificarErro = 1;
                        $flesh = "O email está curto!";
                    }if (validaEmail($emailUsuario) == FALSE) {
                        $verificarErro = 1;
                        $flesh = "O email inserido é invalido!";
                    } else if (strlen($emailUsuario) >= 70) {
                        $verificarErro = 1;
                        $flesh = "O email só pode ter no máximo 70 letras!";
                    } else {
                        $emailUsuario = strtolower($emailUsuario);
                    }
                }
                // Validação email //
                // Validação CPF //
                if ($verificarErro == 0) {
                    if (validaCPF($cpfUsuario) == FALSE) {
                        $verificarErro = 1;
                        $flesh = 'CPF inválido!';
                    } else {
                        $retira = array(".", "-");
                        $cpfUsuario = str_replace($retira, "", $cpfUsuario);
                    }
                }
                // Fim da vailidação CPF // 


                if ($verificarErro == 0) {
                    $usuario = new Login();
                    $query = $usuario->salvarDadosUsuario($nomeUsuario, $apelidoUsuario, $emailUsuario, $cpfUsuario, $telefoneUsuario, $linkUsuario, $descricaofoneUsuario, $senhaAtual, $idUsuario);

                    if ($query['verificarErro'] == 0) {
                        // salvando logs.
                        $mensagemLog = "Usuário alterou os dados.";
                        $idUsuarioLog = $_SESSION['user_id'];
                        salvaLog($mensagemLog, $idUsuarioLog);
                    } else {
                        $flesh = $query['flesh'];
                        $verificarErro = 1;
                    }
                }

                if ($verificarErro == 0) {
                    $flesh = "Os dados foram alterados como sucesso!";
                    $conteudoSistema = "./apresentacao/seguranca/form_alterar_dados_usuario.php";
                } else {
                    $conteudoSistema = "./apresentacao/seguranca/form_alterar_dados_usuario.php";
                }
            }
            break;

/////////////////////////////////////////////
//---------Trabalhando com as palavras ----//
/////////////////////////////////////////////
        case "nova_palavra":
            if ($usuarioLogado == TRUE) {

                $inputValue = array(
                    "palavraPortugues" => "",
                    "palavraIndigena" => "",
                    "observacaoPalavra" => "",
                    "tipoLingua" => -1,
                    "povo" => -1,
                );

                if (($tipoUsuarioSistema == 0) or ( $tipoUsuarioSistema == 1)) {
                    $conteudoSistema = "./apresentacao/admin/palavra/formPalavra.php";
                } else if ($tipoUsuarioSistema == 2) {
                    $conteudoSistema = "./apresentacao/colaborador/palavra/formPalavra.php";
                }
            }
            break;


        case "cadastrar_palavra":

            if ($usuarioLogado == TRUE) {
                if ((!isset($_POST['palavraPortugues'])) or (!isset($_POST['palavraIndigena'])) or (!isset($_POST['tipoLingua'])) or (!isset($_POST['povo']))) {
                    redirecionar("./?acao=nova_palavra");
                }
                $verificarErro = 0;
                $flesh = '';

                $palavraPortugues = trim(strip_tags($_POST['palavraPortugues']));
                $palavraIndigena = trim(strip_tags($_POST['palavraIndigena']));
                $observacaoPalavra = trim(strip_tags($_POST['observacaoPalavra']));
                $id_lingua = trim(strip_tags($_POST['tipoLingua']));
                $id_povo = trim(strip_tags($_POST['povo']));
                $id_usuario = $_SESSION['user_id'];

                $inputValue = array(
                    "palavraPortugues" => $palavraPortugues,
                    "palavraIndigena" => $palavraIndigena,
                    "observacaoPalavra" => $observacaoPalavra,
                    "tipoLingua" => $id_lingua,
                    "povo" => $id_povo,
                );

                // Validação de palavra português //
                if (strlen($palavraPortugues) < 1) {
                    $verificarErro = 1;
                    $flesh = 'Por favor informe o campo palavra português!';
                } else if (strlen($palavraPortugues) > 50) {
                    $verificarErro = 1;
                    $flesh = 'A Palavra em português é muito grande, o máximo é de 50 letras!';
                }
                // Fim da validação de palavra português //
                // Validação de palavra indigena //
                if ($verificarErro == 0) {
                    if (strlen($palavraIndigena) < 1) {
                        $verificarErro = 1;
                        $flesh = 'Por favor informe o campo Palavra Indigena!';
                    } else if (strlen($palavraIndigena) > 50) {
                        $verificarErro = 1;
                        $flesh = 'A Palavra Indigena está muito grande, o máximo é de 50 letras!';
                    }
                }
                // Fim da validação de palavra indigena //
                // Validação de Povo //
                if ($verificarErro == 0) {
                    if ($id_povo == "") {
                        $verificarErro = 1;
                        $flesh = 'Por favor selecione o "Povo" !';
                    }
                }
                // Fim de validação de povo //
                // Validação de lingua //
                if ($verificarErro == 0) {
                    if ($id_lingua == "") {
                        $verificarErro = 1;
                        $flesh = 'Por favor selecione o "Lingua" !';
                    }
                }
                // Fim de validação de lingua //
//                $verificarErro = 1;
                $idUltimaPalavraInserida;
                if ($verificarErro == 0) {
                    $casdastrar = New Palavra();
                    $query = $casdastrar->inserirPalavra($palavraPortugues, $palavraIndigena, $observacaoPalavra, $id_lingua, $id_povo, $id_usuario);
                    if ($query['verificarErro'] == 0) {
                        // salvando logs.
                        $mensagemLog = "Uma nova palavra foi inserida no sistema.";
                        $idUsuarioLog = $_SESSION['user_id'];
                        salvaLog($mensagemLog, $idUsuarioLog);
                        $idUltimaPalavraInserida = $query['idUltimaPalavraInserida'];
                    } else {
                        $flesh = $query['flash'];
                        $verificarErro = 1;
                    }
                }

                if ($verificarErro == 0) {
                    $flesh = "Palavra inserida com sucesso";
                    redirecionar("./?acao=inserir_imagem_palavra&palavra=" . base64_encode($idUltimaPalavraInserida));
//                  $conteudoSistema = "./apresentacao/colaborador/palavra/formPalavra.php";
                } else {
                    if ($usuarioLogado == TRUE) {
                        if (($tipoUsuarioSistema == 0) or ( $tipoUsuarioSistema == 1)) {
                            $conteudoSistema = "./apresentacao/admin/palavra/formPalavra.php";
                        } else if ($tipoUsuarioSistema == 2) {
                            $conteudoSistema = "./apresentacao/colaborador/palavra/formPalavra.php";
                        }
                    }
                }
            }
            break;

        case "alterar_palavra":
            if ($usuarioLogado == TRUE) {
                if ((!isset($_GET['palavra_alterar'])) or (!is_numeric(base64_decode($_GET['palavra_alterar'])))) {
                    redirecionar("./?acao=minhas_palavras");
                }
                $id_palavra = base64_decode($_GET['palavra_alterar']);
                if ($tipoUsuarioSistema <= 1) {
                    $conteudoSistema = "./apresentacao/admin/palavra/formAlterarPalavra.php";
                } if ($tipoUsuarioSistema == 2) {
                    $conteudoSistema = "./apresentacao/colaborador/palavra/formAlterarPalavra.php";
                }
            }
            break;
        case "alterar_palavra_super":
            if ($usuarioLogado == TRUE) {
                if ((!isset($_GET['palavra_alterar'])) or (!is_numeric(base64_decode($_GET['palavra_alterar'])))) {
                    redirecionar("./?acao=minhas_palavras");
                }
                $id_palavra = base64_decode($_GET['palavra_alterar']);
                if ($tipoUsuarioSistema == 0) {
                    $conteudoSistema = "./apresentacao/admin/palavra/formAlterarPalavraSuper.php";
                }
            }
            break;

        case "salvar_palavra_alterada":
            if ($usuarioLogado == TRUE) {
                if ((!isset($_POST['palavraPortugues'])) or (!isset($_POST['palavraIndigena'])) or (!isset($_POST['tipoLingua'])) or (!isset($_POST['povo']))) {
                    redirecionar("./");
                }
                $verificarErro = 0;
                $flesh = '';

                // Recebendo dados do formulário de alteração de palavras

                $id_palavra = $_POST['idPalavra'];
                $palavraPortugues = trim(strip_tags($_POST['palavraPortugues']));
                $palavraIndigena = trim(strip_tags($_POST['palavraIndigena']));
                $observacaoPalavra = trim(strip_tags($_POST['observacaoPalavra']));
                $id_lingua = trim(strip_tags($_POST['tipoLingua']));
                $id_povo = trim(strip_tags($_POST['povo']));




                // Validação de palavra português //
                if (strlen($palavraPortugues) < 1) {
                    $verificarErro = 1;
                    $flesh = 'Por favor informe o campo Palavra Português!';
                } else if (strlen($palavraPortugues) > 50) {
                    $verificarErro = 1;
                    $flesh = 'A Palavra em português está muito grande, o máximo é de 50 letras!';
                }
                // Fim da validação de palavra português //
                // Validação de palavra indigena //
                if ($verificarErro == 0) {
                    if (strlen($palavraIndigena) < 1) {
                        $verificarErro = 1;
                        $flesh = 'Por favor informe o campo Palavra Indigena!';
                    } else if (strlen($palavraIndigena) > 50) {
                        $verificarErro = 1;
                        $flesh = 'A Palavra Indigena está muito grande, o máximo é de 50 letras!';
                    }
                }
                // Fim da validação de palavra indigena //
                // Validação de Povo //
                if ($verificarErro == 0) {
                    if ($id_povo == "") {
                        $verificarErro = 1;
                        $flesh = 'Por favor selecione o "Povo" !';
                    }
                }
                // Fim de validação de povo //
                // Validação de lingua //
                if ($verificarErro == 0) {
                    if ($id_lingua == "") {
                        $verificarErro = 1;
                        $flesh = 'Por favor selecione o "Lingua" !';
                    }
                }
                // Fim de validação de lingua //
//                $verificarErro = 1;
//                
//                
// Instanciando a classe Palavra para fazer a persistência
                if ($verificarErro == 0) {
                    $palavra = new Palavra();

                    $query = $palavra->alterarPalavra($palavraPortugues, $palavraIndigena, $observacaoPalavra, $id_lingua, $id_povo, $id_palavra);
                    if ($query['verificarErro'] == 0) {

                        // salvando logs.
                        $mensagemLog = "A palavra " . $id_palavra . " foi alterada.";
                        $idUsuarioLog = $_SESSION['user_id'];
                        salvaLog($mensagemLog, $idUsuarioLog);
                    } else {
                        $flesh = $query['flesh'];
                        $verificarErro = 1;
                    }
                }

                if ($verificarErro == 0) {
                    $flesh = "Palavra alterada com sucesso! <a href=\"./?acao=minhas_palavras\">Voltar</a>";
                    if ($tipoUsuarioSistema <= 1) {
                        $conteudoSistema = "./apresentacao/admin/palavra/formAlterarPalavra.php";
                    } if ($tipoUsuarioSistema == 2) {
                        $conteudoSistema = "./apresentacao/colaborador/palavra/formAlterarPalavra.php";
                    }
                } else {
                    if ($tipoUsuarioSistema <= 1) {
                        $conteudoSistema = "./apresentacao/admin/palavra/formAlterarPalavra.php";
                    } if ($tipoUsuarioSistema == 2) {
                        $conteudoSistema = "./apresentacao/colaborador/palavra/formAlterarPalavra.php";
                    }
                }
            }
            break;

        case "salvar_palavra_alterada_super":
            if ($usuarioLogado == TRUE) {
                if ((!isset($_POST['palavraPortugues'])) or (!isset($_POST['palavraIndigena'])) or (!isset($_POST['tipoLingua'])) or (!isset($_POST['povo']))) {
                    redirecionar("./");
                }
                $verificarErro = 0;
                $flesh = '';

                // Recebendo dados do formulário de alteração de palavras

                $id_palavra = $_POST['idPalavra'];
                $palavraPortugues = trim(strip_tags($_POST['palavraPortugues']));
                $palavraIndigena = trim(strip_tags($_POST['palavraIndigena']));
                $observacaoPalavra = trim(strip_tags($_POST['observacaoPalavra']));
                $id_lingua = trim(strip_tags($_POST['tipoLingua']));
                $id_povo = trim(strip_tags($_POST['povo']));




                // Validação de palavra português //
                if (strlen($palavraPortugues) < 1) {
                    $verificarErro = 1;
                    $flesh = 'Por favor informe o campo Palavra Português!';
                } else if (strlen($palavraPortugues) > 50) {
                    $verificarErro = 1;
                    $flesh = 'A Palavra em português está muito grande, o máximo é de 50 letras!';
                }
                // Fim da validação de palavra português //
                // Validação de palavra indigena //
                if ($verificarErro == 0) {
                    if (strlen($palavraIndigena) < 1) {
                        $verificarErro = 1;
                        $flesh = 'Por favor informe o campo Palavra Indigena!';
                    } else if (strlen($palavraIndigena) > 50) {
                        $verificarErro = 1;
                        $flesh = 'A Palavra Indigena está muito grande, o máximo é de 50 letras!';
                    }
                }
                // Fim da validação de palavra indigena //
                // Validação de Povo //
                if ($verificarErro == 0) {
                    if ($id_povo == "") {
                        $verificarErro = 1;
                        $flesh = 'Por favor selecione o "Povo"!';
                    }
                }
                // Fim de validação de povo //
                // Validação de lingua //
                if ($verificarErro == 0) {
                    if ($id_lingua == "") {
                        $verificarErro = 1;
                        $flesh = 'Por favor selecione o "Lingua"!';
                    }
                }
                // Fim de validação de lingua //
                // Instanciando a classe Palavra para fazer a persistência
                if ($verificarErro == 0) {
                    $palavra = new Palavra();
                    $query = $palavra->alterarPalavra($palavraPortugues, $palavraIndigena, $observacaoPalavra, $id_lingua, $id_povo, $id_palavra);
                    if ($query['verificarErro'] == 0) {

                        // salvando logs.
                        $mensagemLog = "A palavra " . $id_palavra . " foi alterada.";
                        $idUsuarioLog = $_SESSION['user_id'];
                        salvaLog($mensagemLog, $idUsuarioLog);
                    } else {
                        $flesh = $query['flesh'];
                        $verificarErro = 1;
                    }
                }

                if ($verificarErro == 0) {
                    $flesh = "Palavra alterada com sucesso! <a href=\"./\">Voltar</a>";
                    $conteudoSistema = "./apresentacao/admin/palavra/formAlterarPalavraSuper.php";
                } else {
                    $conteudoSistema = "./apresentacao/admin/palavra/formAlterarPalavraSuper.php";
                }
            }
            break;

        case "inserir_imagem_palavra":
            if ($usuarioLogado == TRUE) {
                if ((!isset($_GET['palavra'])) or (!is_numeric(base64_decode($_GET['palavra'])))) {
                    redirecionar("./?acao=minhas_palavras");
                }
                $id_palavra = base64_decode($_GET['palavra']);
                if ($tipoUsuarioSistema <= 1) {
                    $conteudoSistema = "./apresentacao/colaborador/palavra/inserirImagemPalavra.php";
                } else if ($tipoUsuarioSistema == 2) {
                    $conteudoSistema = "./apresentacao/colaborador/palavra/inserirImagemPalavra.php";
                }
            }
            break;

        case "salvar_imagem_palavra":
            if ($usuarioLogado == TRUE) {
                if ((!isset($_FILES['imagemPalavra'])) or (!isset($_POST['idPalavra']))) {
                    redirecionar("./?acao=minhas_palavras");
                }

                $verificarErro = 0;
                $flesh = '';

                $id_palavra = $_POST['idPalavra'];
                $pastaDestino = 'imagem';

                $tiposPermitidos = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/jpg', 'image/png');

                $tamanhoPermitido = 1024 * 1024 * 2; // 1 Mg

                $arqName = $_FILES['imagemPalavra']['name'];
                $arqType = $_FILES['imagemPalavra']['type'];
                $arqSize = $_FILES['imagemPalavra']['size'];
                $arqTemp = $_FILES['imagemPalavra']['tmp_name'];
                $arqErro = $_FILES['imagemPalavra']['error'];

                if ($arqErro != 0) {
                    switch ($arqErro) {
                        case 1: $flesh = 'O arquivo ultrapassa o limite de tamanho especifiado no sistema (2 MB)';
                            break;
                        case 2: $flesh = 'O arquivo ultrapassa o limite de tamanho especifiado no sistema (2 MB)';
                            break;
                        case 3: $flesh = 'Erro no upload do arquivo. Tente novamente!';
                            break;
                        case 4: $flesh = 'Erro no upload do arquivo. Tente novamente!';
                            break;
                    }
                    $verificarErro = 1;
                }

                if ($verificarErro == 0) {
                    if (array_search($arqType, $tiposPermitidos) == false) {
                        $flesh = 'O tipo de arquivo enviado é inválido!';
                        $verificarErro = 1;
                        // Verifica o tamanho do arquivo enviado
                    } else if ($arqSize > $tamanhoPermitido) {
                        $flesh = 'O arquivo ultrapassa o limite de tamanho especifiado no sistema (2 MB)';
                        $verificarErro = 1;
                        // Não houveram erros, move o arquivo
                    }
                }

//                $verificarErro = 1;
                if ($verificarErro == 0) {
                    $arr = explode('.', $arqName);
                    $extensao = strtolower(end($arr));

                    $nomeArquivo = "img_" . md5(uniqid(time())) . "." . $extensao;


                    if (!move_uploaded_file($arqTemp, $pastaDestino . "/" . $nomeArquivo)) {
                        die("Erro ao tentar fazer upload");
                    } else {
                        $palavra = new Palavra();
                        $query = $palavra->inserirImagemPalavra($nomeArquivo, $id_palavra);
                        if ($query['verificarErro'] == 0) {
                            // salvando logs.
                            $mensagemLog = "Foi inserida uma imagem para a palavra " . $id_palavra . ".";
                            $idUsuarioLog = $_SESSION['user_id'];
                            salvaLog($mensagemLog, $idUsuarioLog);
                        } else {
                            $flesh = $query['flesh'];
                            $verificarErro = 1;
                        }
                    }
                }

                if ($verificarErro == 0) {
                    $flesh = "Imagem foi inserida com sucesso!<br/><br/>";
                    $linkAlterarSom = '<a href="./?acao=inserir_som_palavra&palavra=' . base64_encode($id_palavra) . '">Alterar som</a>';
                    $flesh .= "Para alterar o som clique em " . $linkAlterarSom;
                    if ($tipoUsuarioSistema <= 1) {
                        $conteudoSistema = "./apresentacao/colaborador/palavra/inserirImagemPalavra.php";
                    } else if ($tipoUsuarioSistema == 2) {
                        $conteudoSistema = "./apresentacao/colaborador/palavra/inserirImagemPalavra.php";
                    }
                } else {
                    if ($tipoUsuarioSistema <= 1) {
                        $conteudoSistema = "./apresentacao/colaborador/palavra/inserirImagemPalavra.php";
                    } else if ($tipoUsuarioSistema == 2) {
                        $conteudoSistema = "./apresentacao/colaborador/palavra/inserirImagemPalavra.php";
                    }
                }
            }
            break;

        case "inserir_som_palavra":
            if ($usuarioLogado == TRUE) {
                if ((!isset($_GET['palavra'])) or (!is_numeric(base64_decode($_GET['palavra'])))) {
                    redirecionar("./?acao=minhas_palavras");
                }
                $id_palavra = base64_decode($_GET['palavra']);

                $conteudoSistema = "./apresentacao/colaborador/palavra/inserirSomPalavra.php";
            }
            break;

        case "salvar_som_palavra":
            if ($usuarioLogado == TRUE) {
                if ((!isset($_FILES['somPalavra'])) or (!isset($_POST['idPalavra']))) {
                    redirecionar("./?acao=minhas_palavras");
                }

                $flesh = '';
                $verificarErro = 0;

                $id_palavra = $_POST['idPalavra'];
                $pastaDestino = './sons';

                $tiposPermitidos = array('audio/mpeg3', 'audio/mpeg', 'audio/x-mpeg-3', 'audio/mp3');

                $tamanhoPermitido = 1024 * 1024 * 2; // 2 Mb

                $arqName = $_FILES['somPalavra']['name'];
                $arqType = $_FILES['somPalavra']['type'];
                $arqSize = $_FILES['somPalavra']['size'];
                $arqTemp = $_FILES['somPalavra']['tmp_name'];
                $arqErro = $_FILES['somPalavra']['error'];

                if ($arqErro != 0) {
                    switch ($arqErro) {
                        case 1: $flesh = 'O arquivo ultrapassa o limite de tamanho especifiado no sistema (2 MB)';
                            break;
                        case 2: $flesh = 'O arquivo ultrapassa o limite de tamanho especifiado no sistema (2 MB)';
                            break;
                        case 3: $flesh = 'Erro no upload do arquivo. Tente novamente!';
                            break;
                        case 4: $flesh = 'Erro no upload do arquivo. Tente novamente!';
                            break;
                    }
                    $verificarErro = 1;
                }

                if ($verificarErro == 0) {
                    if (array_search($arqType, $tiposPermitidos) == false) {
                        $flesh = 'O tipo de arquivo enviado é inválido!';
                        $verificarErro = 1;
                        // Verifica o tamanho do arquivo enviado
                    } else if ($arqSize > $tamanhoPermitido) {
                        $flesh = 'O arquivo ultrapassa o limite de tamanho especifiado no sistema (2 MB)';
                        $verificarErro = 1;
                        // Não houveram erros, move o arquivo
                    }
                }

                //$verificarErro = 1;
//                $flesh = 'Upload com sucesso!';
                if ($verificarErro == 0) {
                    $arr = explode(".", $arqName);
                    $extensao = strtolower(end($arr));

                    $nomeArquivo = "som_" . md5(uniqid(time())) . "." . $extensao;

                    if (!move_uploaded_file($arqTemp, $pastaDestino . "/" . $nomeArquivo)) {
                        die("Erro ao tentar fazer upload");
                    } else {
                        $palavra = new Palavra();
                        $query = $palavra->inserirSomPalavra($nomeArquivo, $id_palavra);
                        if ($query['verificarErro'] == 0) {

                            // salvando logs.
                            $mensagemLog = "Foi inserido um som para a palavra " . $id_palavra . ".";
                            $idUsuarioLog = $codigoUsuarioLog;
                            salvaLog($mensagemLog, $idUsuarioLog);
                        } else {
                            $flesh = $query['flesh'];
                            $verificarErro = 1;
                        }
                    }
                }

                if ($verificarErro == 0) {
                    $flesh = "O som foi inserido com sucesso!";
                    $conteudoSistema = "./apresentacao/colaborador/palavra/inserirSomPalavra.php";
                } else {
                    $conteudoSistema = "./apresentacao/colaborador/palavra/inserirSomPalavra.php";
                }
            }

            break;


        case "minhas_palavras":
            if ($usuarioLogado == TRUE) {
                if (($tipoUsuarioSistema == 0) or ( $tipoUsuarioSistema == 1)) {
                    $conteudoSistema = "./apresentacao/admin/palavra/minhas_palavras.php";
                } else if ($tipoUsuarioSistema == 2) {
                    $conteudoSistema = "./apresentacao/colaborador/palavra/minhas_palavras.php";
                }
            }
            break;

        case "excluir_palavra":
            if ($usuarioLogado == TRUE) {
                $id_palavra = base64_decode($_GET['palavra_excluir']);
                $palavraExcluir = new Palavra();
                $query = $palavraExcluir->excluir_palavra($id_palavra);

                if ($query['verificarErro'] == 0) {

                    // salvando logs.
                    $mensagemLog = "A palavra " . $id_palavra . " foi excluída.";
                    $idUsuarioLog = $codigoUsuarioLog;
                    salvaLog($mensagemLog, $idUsuarioLog);

                    $conteudoSistema = "./apresentacao/colaborador/palavra/minhas_palavras.php";
                } else {
                    echo $query['flesh'];
                    $conteudoSistema = "./apresentacao/colaborador/palavra/minhas_palavras.php";
                }
            }
            break;

        case "excluir_palavra_super":
            if ($tipoUsuarioSistema == 0) {
                $id_palavra = base64_decode($_GET['palavra_excluir']);
                $palavraExcluir = new Palavra();
                $query = $palavraExcluir->excluir_palavra($id_palavra);

                if ($query['verificarErro'] == 0) {

                    // salvando logs.
                    $mensagemLog = "A palavra " . $id_palavra . " foi excluída.";
                    $idUsuarioLog = $codigoUsuarioLog;
                    salvaLog($mensagemLog, $idUsuarioLog);

                    //$conteudoSistema = "./apresentacao/colaborador/palavra/minhas_palavras.php";
                    redirecionar("./");
                } else {
                    echo $query['flesh'];
                    $conteudoSistema = "./";
                }
            }
            break;

///////////////////////////////////////////////////
//------ Trabalhando com a Lingua----------//
///////////////////////////////////////////////////
        case "lingua":
            if ($usuarioLogado == TRUE) {
                $conteudoSistema = "./apresentacao/admin/lingua/verTipoLingua.php";
            }
            break;

        case "cadastro_lingua" :

            if ($usuarioLogado == TRUE) {
                $conteudoSistema = "./apresentacao/admin/lingua/formTipoLingua.php";
            }
            break;

        case "salvar_lingua" :
            if ($usuarioLogado == TRUE) {
                $flesh = '';
                $verificarErro = 0;

                if (!isset($_POST['nomeLingua'])) {
                    redirecionar("./?acao=lingua");
                }

                $nomeLingua = trim(strip_tags($_POST['nomeLingua']));
                $observacaoLingua = trim(strip_tags($_POST['observacaoLingua']));

                if (strlen($nomeLingua) < 1) {
                    $flesh = "O \"Nome da Lingua\" está muito curto!";
                    $verificarErro = 1;
                } else if (strlen($nomeLingua) > 50) {
                    $flesh = "O \"Nome da Lingua\" está muito longo, máximo de 50 letras!";
                    $verificarErro = 1;
                }

                if ($verificarErro == 0) {
                    $lingua = new Lingua();
                    $query = $lingua->inserirLingua($nomeLingua, $observacaoLingua);
                    if ($query['verificarErro'] == 0) {
                        // salvando logs.
                        $mensagemLog = "Uma nova lingua foi inserida.";
                        $idUsuarioLog = $codigoUsuarioLog;
                        salvaLog($mensagemLog, $idUsuarioLog);
                    } else {
                        $flesh = $query['flesh'];
                        $verificarErro = 1;
                    }
                }
                if ($verificarErro == 1) {
                    $conteudoSistema = "./apresentacao/admin/lingua/formTipoLingua.php";
                } else {
                    redirecionar("./?acao=lingua");
                }
            }
            break;

        case "alterar_lingua" :

            if ($usuarioLogado == TRUE) {
                if ((!isset($_GET['lingua'])) or (!is_numeric(base64_decode($_GET['lingua'])))) {
                    redirecionar("./?acao=povo");
                }
                $id_lingua = base64_decode($_GET['lingua']);
                $conteudoSistema = "./apresentacao/admin/lingua/formAlterarTipoLingua.php";
            }

            break;

        case "salvar_lingua_alterar":
            if ($usuarioLogado == TRUE) {
                $flesh = '';
                $verificarErro = 0;
                if (!isset($_POST['nomeLingua'])) {
                    redirecionar("./?acao=lingua");
                }
                $id_lingua = $_POST['idTipoLingua'];
                $nomeLingua = trim(strip_tags($_POST['nomeLingua']));
                $observacaoLingua = trim(strip_tags($_POST['observacaoLingua']));

                if (strlen($nomeLingua) < 1) {
                    $flesh = "O \"Nome da Lingua\" está muito curto!";
                    $verificarErro = 1;
                } else if (strlen($nomeLingua) > 50) {
                    $flesh = "O \"Nome da Lingua\" está muito longo, máximo de 50 letras!";
                    $verificarErro = 1;
                }

                if ($verificarErro == 0) {
                    $lingua = new Lingua();
                    $query = $lingua->salvarLinguaAlterar($id_lingua, $nomeLingua, $observacaoLingua);
                    if ($query['verificarErro'] == 0) {

                        // salvando logs.
                        $mensagemLog = "A lingua " . $id_lingua . " foi alterada.";
                        $idUsuarioLog = $codigoUsuarioLog;
                        salvaLog($mensagemLog, $idUsuarioLog);

                        redirecionar("./?acao=lingua");
                    } else {
                        $flesh = $query['flesh'];
                        $verificarErro = 1;
                    }
                }

                if ($verificarErro == 0) {
                    redirecionar("./?acao=lingua");
                } else {
                    $conteudoSistema = "./apresentacao/admin/lingua/formAlterarTipoLingua.php";
                }
            }
            break;

        case "excluir_lingua":
            if ($usuarioLogado == TRUE) {
                $flesh = '';
                $idLingua = base64_decode($_GET['lingua']);
                $lingua = new Lingua();
                $query = $lingua->excluirLingua($idLingua);
                if ($query['verrificarErro'] == 0) {

// salvando logs.
                    $mensagemLog = "Uma lingua foi excluída.";
                    $idUsuarioLog = $codigoUsuarioLog;
                    salvaLog($mensagemLog, $idUsuarioLog);

                    redirecionar("./?acao=lingua");
                } else {
                    $flesh = $query['flesh'];
                    $conteudoSistema = "./apresentacao/admin/lingua/verTipoLingua.php";
                }
            }
            break;


///////////////////////////////////////////////////
//----------- Trabalhando com Povo---------------//
///////////////////////////////////////////////////

        case "povo":
            if ($usuarioLogado == TRUE) {
                $conteudoSistema = "./apresentacao/admin/povo/verPovo.php";
            }
            break;

        case "cadastro_povo":
            if ($usuarioLogado == TRUE) {
                $conteudoSistema = "./apresentacao/admin/povo/formPovo.php";
            }
            break;

        case "salvar_povo":
            if ($usuarioLogado == TRUE) {
                $flesh = '';
                $verificarErro = 0;

                $nomePovo = trim(strip_tags($_POST['nomePovo']));
                $observacaoPovo = trim(strip_tags($_POST['observacaoPovo']));

                if (strlen($nomePovo) < 1) {
                    $flesh = "O \"Nome do Povo\" está muito curto!";
                    $verificarErro = 1;
                } else if (strlen($nomePovo) > 50) {
                    $flesh = "O \"Nome do Povo\" está muito longo, máximo de 50 letras!";
                    $verificarErro = 1;
                }

                if ($verificarErro == 0) {
                    $povo = new Povo();
                    $query = $povo->inserirPovo($nomePovo, $observacaoPovo);
                    if ($query['verificarErro'] == 0) {
                        // salvando logs.
                        $mensagemLog = "Um novo povo foi inserido.";
                        $idUsuarioLog = $codigoUsuarioLog;
                        salvaLog($mensagemLog, $idUsuarioLog);
                    } else {
                        $flesh = $query['flesh'];
                        $verificarErro = 1;
                    }
                }

                if ($verificarErro == 0) {
                    redirecionar("./?acao=povo");
                } else {
                    $conteudoSistema = "./apresentacao/admin/povo/formPovo.php";
                }
            }
            break;

        case "alterar_povo":
            if ($usuarioLogado == TRUE) {
                if ((!isset($_GET['povo'])) or (!is_numeric(base64_decode($_GET['povo'])))) {
                    redirecionar("./?acao=povo");
                }
                $id_povo = base64_decode($_GET['povo']);
                $conteudoSistema = "./apresentacao/admin/povo/formAlterarPovo.php";
            }
            break;

        case "salvar_povo_alterar":
            if ($usuarioLogado == TRUE) {
                if ((!isset($_POST['idPovo'])) or (!isset($_POST['nomePovo']))) {
                    redirecionar("./?acao=povo");
                }

                $flesh = '';
                $verificarErro = 0;

                $id_povo = $_POST['idPovo'];
                $nomePovo = trim(strip_tags($_POST['nomePovo']));
                $observacaoPovo = $_POST['observacaoPovo'];

                if (strlen($nomePovo) < 1) {
                    $flesh = "O \"Nome do Povo\" está muito curto!";
                    $verificarErro = 1;
                } else if (strlen($nomePovo) > 50) {
                    $flesh = "O \"Nome do Povo\" está muito longo, máximo de 50 letras!";
                    $verificarErro = 1;
                }

                if ($verificarErro == 0) {
                    $povo = new Povo();
                    $query = $povo->salvaPovoAlterar($id_povo, $nomePovo, $observacaoPovo);

                    if ($query['verificarErro'] == 0) {
                        // salvando logs.
                        $mensagemLog = "O povo com id: " . $id_povo . " , foi alterado.";
                        $idUsuarioLog = $codigoUsuarioLog;
                        salvaLog($mensagemLog, $idUsuarioLog);
                    } else {
                        $flesh = $query['flesh'];
                        $verificarErro = 1;
                    }
                }

                if ($verificarErro == 0) {
                    redirecionar("./?acao=povo");
                } else {
                    $conteudoSistema = "./apresentacao/admin/povo/formAlterarPovo.php";
                }
            }
            break;

        case "excluir_povo":
            if ($usuarioLogado == TRUE) {
                $flesh = '';
// pegando o idPovo pela requisição get e decodificando a criptografia
                $id_povo = base64_decode($_GET['povo']);

                $povo = new Povo();
                $query = $povo->excluirPovo($id_povo);
                if ($query['verificarErro'] == 0) {

// salvando logs.
                    $mensagemLog = "O Povo " . $id_povo . "foi excluído.";
                    $idUsuarioLog = $codigoUsuarioLog;
                    salvaLog($mensagemLog, $idUsuarioLog);

                    redirecionar("./?acao=povo");
                } else {
                    $flesh = $query['flesh'];
                    $conteudoSistema = "./apresentacao/admin/povo/verPovo.php";
                }
            }
            break;



////////////////////////////////////////////////////////
//----- Trabalhando com Gerenciamento de usuario------//
////////////////////////////////////////////////////////

        case "usuario":
            if (($usuarioLogado == TRUE) and ( ($tipoUsuarioSistema == 0) or ( $tipoUsuarioSistema == 1))) {
                $conteudoSistema = "./apresentacao/admin/usuario/gerenciamentoUsuario.php";
            }
            break;

        case "habilitar_colaborador":
            if (($usuarioLogado == TRUE) and ( ($tipoUsuarioSistema == 0) or ( $tipoUsuarioSistema == 1))) {
                $id_colaborador = base64_decode($_GET['colaborador']);

                if (!is_numeric($id_colaborador)) {
                    die("Erro de Colaborador!");
                };

                $usuario = new Usuario();
                $query = $usuario->habilitarColaborador($id_colaborador);

                if ($query['verificarErro'] == 0) {

// salvando logs.
                    $mensagemLog = "O Colaborador " . $id_colaborador . " foi habilitado.";
                    $idUsuarioLog = $codigoUsuarioLog;
                    salvaLog($mensagemLog, $idUsuarioLog);

                    redirecionar("./?acao=usuario");
                } else {
                    echo $query['flesh'];
                }
            }
            break;

        case "habilitar_moderador":
            if (($usuarioLogado == TRUE) and ( ($tipoUsuarioSistema == 0) or ( $tipoUsuarioSistema == 1))) {
                $id_moderador = base64_decode($_GET['moderador']);

                if (!is_numeric($id_moderador)) {
                    die("Erro de Moderador!");
                };

                $usuario = new Usuario();
                $query = $usuario->habilitarModerador($id_moderador);

                if ($query['verificarErro'] == 0) {


// salvando logs.
                    $mensagemLog = "O moderador " . $id_moderador . " foi habilitado.";
                    $idUsuarioLog = $codigoUsuarioLog;
                    salvaLog($mensagemLog, $idUsuarioLog);

                    redirecionar("./?acao=usuario");
                } else {
                    echo $query['flesh'];
                }
            }
            break;

        case "desabilitar_moderador":
            if (($usuarioLogado == TRUE) and ( ($tipoUsuarioSistema == 0) or ( $tipoUsuarioSistema == 1))) {
                $id_moderador = base64_decode($_GET['moderador']);

                if (!is_numeric($id_moderador)) {
                    die("Erro de Moderador!");
                };

                $usuario = new Usuario();
                $query = $usuario->desabilitarModerador($id_moderador);

                if ($query['verificarErro'] == 0) {

// salvando logs.
                    $mensagemLog = "O Moderador " . $id_moderador . " foi desabilitado.";
                    $idUsuarioLog = $codigoUsuarioLog;
                    salvaLog($mensagemLog, $idUsuarioLog);

                    redirecionar("./?acao=usuario");
                } else {
                    echo $query['flesh'];
                }
            }
            break;

        case "reprovar_colaborador":
            if (($usuarioLogado == TRUE) and ( ($tipoUsuarioSistema == 0) or ( $tipoUsuarioSistema == 1))) {
                $id_colaborador = base64_decode($_GET['colaborador']);

                if (!is_numeric($id_colaborador)) {
                    die("Erro de Colaborador!");
                };

                $usuario = new Usuario();
                $query = $usuario->desabilitarColaborador($id_colaborador);

                if ($query['verificarErro'] == 0) {

// salvando logs.
                    $mensagemLog = "O Colabordor " . $id_moderador . " foi reprovado.";
                    $idUsuarioLog = $codigoUsuarioLog;
                    salvaLog($mensagemLog, $idUsuarioLog);

                    redirecionar("./?acao=usuario");
                } else {
                    echo $query['flesh'];
                }
            }
            break;

////////////////////////////////////////////////////////
//-------------------- Ajuda -------------------------//
//////////////////////////////////////////////////////// 


        case "sobre":
            $conteudoSistema = "./sobre/sobre.php";
            break;

        case "artigo":
            $conteudoSistema = "./sobre/artigo.php";
            break;

        case "gravar_pronuncia":
            $conteudoSistema = "./sobre/gravarPronuncia.php";
            break;

        case "manual":
            $conteudoSistema = "./sobre/manual.php";
            break;

        case "fale_conosco":
            $conteudoSistema = "./sobre/faleConosco.php";
            break;

        case "extra":
            $conteudoSistema = "./sobre/extra.php";
            break;
    }
}

// Metodo de redirencionamento
function redirecionar($url) {
    header("location:" . $url);
    exit();
}

/**
 * Função para salvar mensagens de LOG no MySQL
 *
 * @param string $mensagem - A mensagem a ser salva
 *
 * @return bool - Se a mensagem foi salva ou não (true/false)
 */
function salvaLog($mensagem, $idUsuario = -1) {

    $ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
    $hora = date('Y-m-d H:i:s', time()); // Salva a data e hora atual (formato MySQL)
// Usamos o mysql_escape_string() para poder inserir a mensagem no banco
// sem ter problemas com aspas e outros caracteres
    $mensagemLog = mysql_escape_string($mensagem);

// Monta a query para inserir o log no sistema
    $sql = "INSERT INTO `logs` VALUES (NULL," . $idUsuario . ", '" . $hora . "', '" . $ip . "', '" . $mensagemLog . "')";

    if (mysql_query($sql)) {
        return true;
    } else {
        return false;
    }
}

function validaEmail($email) {

    $pattern = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';

    if (preg_match($pattern, $email))
        return true;
    else
        return false;
}

// Função que valida o CPF
//function validaCPF($cpf) { // Verifiva se o número digitado contém todos os digitos
//    $cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
//
//    // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
//    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
//        return false;
//    } else {   // Calcula os números para verificar se o CPF é verdadeiro
//        for ($t = 9; $t < 11; $t++) {
//            for ($d = 0, $c = 0; $c < $t; $c++) {
//                $d += $cpf{$c} * (($t + 1) - $c);
//            }
//            $d = ((10 * $d) % 11) % 10;
//            if ($cpf{$c} != $d) {
//                return false;
//            }
//        }
//        return true;
//    }
//}

function validaCPF($cpf) {

//Etapa 1: Cria um array com apenas os digitos numéricos, isso permite receber o cpf em diferentes formatos como "000.000.000-00", "00000000000", "000 000 000 00" etc...
    $j = 0;
    for ($i = 0; $i < (strlen($cpf)); $i++) {
        if (is_numeric($cpf[$i])) {
            $num[$j] = $cpf[$i];
            $j++;
        }
    }
//Etapa 2: Conta os dígitos, um cpf válido possui 11 dígitos numéricos.
    if (count($num) != 11) {
        $isCpfValid = false;
    }
//Etapa 3: Combinações como 00000000000 e 22222222222 embora não sejam cpfs reais resultariam em cpfs válidos após o calculo dos dígitos ve rificares e por isso precisam ser filtradas nesta parte.
    else {
        for ($i = 0; $i < 10; $i++) {
            if ($num[0] == $i && $num[1] == $i && $num[2] == $i && $num[3] == $i && $num[4] == $i && $num[5] == $i && $num[6] == $i && $num[7] == $i && $num[8] == $i) {
                $isCpfValid = false;
                break;
            }
        }
    }
    //Etapa 4: Calcula e compara o primeiro dígito verificador.
    if (!isset($isCpfValid)) {
        $j = 10;
        for ($i = 0; $i < 9; $i++) {
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        }
        $soma = array_sum($multiplica);
        $resto = $soma % 11;
        if ($resto < 2) {
            $dg = 0;
        } else {
            $dg = 11 - $resto;
        }
        if ($dg != $num[9]) {
            $isCpfValid = false;
        }
    }
    //Etapa 5: Calcula e compara o segundo dígito verificador.
    if (!isset($isCpfValid)) {
        $j = 11;
        for ($i = 0; $i < 10; $i++) {
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        }
        $soma = array_sum($multiplica);
        $resto = $soma % 11;
        if ($resto < 2) {
            $dg = 0;
        } else {
            $dg = 11 - $resto;
        }
        if ($dg != $num[10]) {
            $isCpfValid = false;
        } else {
            $isCpfValid = true;
        }
    }

    //$isCpfValid;


    if ($isCpfValid == FALSE) {
        return FALSE;
    } else {
        return TRUE;
    }
}

