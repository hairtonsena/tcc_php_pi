<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Palavras extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->model('Palavras_model');
        $this->load->model('Povo_model');
        $this->load->model('Lingua_model');
        $this->load->model('Categoria_model');
    }

    private $menu_sistema = 'visitante/menuTop';
    private $conteudo_sistema = 'visitante/homeVisitante';
    private $dados = NULL;
    private $numeroPagina = 0;
    private $quantidadeRegistroPalavras = 0;
    protected $numeroRegistroPorPagina = 20;
    protected $todas_palavras = array();

    protected function verificar_usuario_logado() {
        if (($this->session->userdata('id_usuario')) && ($this->session->userdata('nome_usuario')) && ($this->session->userdata('email_usuario')) && ($this->session->userdata('senha_usuario'))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    protected function tipo_usuario_logado() {
        return $this->session->userdata('tipo_usuario');
    }

    protected function saida_tela() {

        $this->load->view('tela/titulo');
        $this->load->view($this->menu_sistema);
        $this->load->view($this->conteudo_sistema, $this->dados);
        $this->load->view('tela/rodape');
    }

    public function index() {

        $opcaoLingua = 0;
        $opcaoPovo = 0;


        if (isset($_GET['pg'])) {
            $this->numeroPagina = $_GET['pg'] - 1;
        }


        $registro_palavras = "";
        $qtde_paginas = 0;

//        Condição para o campo de pesquisa
        if ((isset($_GET['p']))) {

            $pesquisa = trim(strip_tags($_GET['p']));

            $registro_palavras = $this->Palavras_model->buscaPesquisa($pesquisa)->result();

            $quantidadeRegistroPalavras = 0;
//            Condição para os filtros
        } else if ((!empty($_GET['lingua'])) || (!empty($_GET['povo']))) {

            $opcaoLingua = $_GET['lingua'];
            $opcaoPovo = $_GET['povo'];

            $limit = array(
                'inicio' => $this->numeroRegistroPorPagina,
                'totalpagina' => $this->numeroPagina * $this->numeroRegistroPorPagina,
            );

            $registro_palavras = $this->Palavras_model->buscaFiltro($opcaoLingua, $opcaoPovo, $limit)->result();

            $registro_totais_filtros = $this->Palavras_model->buscaFiltroRelatorio($opcaoLingua, $opcaoPovo)->result();


            $qtde_paginas = ceil(count($registro_totais_filtros) / $this->numeroRegistroPorPagina);

//         Se não aver condição alguma fas isso   
        } else {
            $limit = array(
                'inicio' => $this->numeroRegistroPorPagina,
                'totalpagina' => $this->numeroPagina * $this->numeroRegistroPorPagina,
            );

            $registro_palavras = $this->Palavras_model->consultarPalavras($limit)->result();


            $quantidadeRegistroPalavras = $this->Palavras_model->consultarNumeroRegistro();
            $qtde_paginas = ceil($quantidadeRegistroPalavras / $this->numeroRegistroPorPagina);
        }




        $this->todas_palavras = NULL;

        foreach ($registro_palavras as $reg_pal) {
            if ((!strlen($reg_pal->imagemPalavra) > 2) || (!file_exists("./imagem/" . $reg_pal->imagemPalavra)) || $reg_pal->imagemPalavra == NULL) {
                $reg_pal->imagemPalavra = 'sem_imagem.jpg';
            }

            if ($reg_pal->obsPalavra == "" || $reg_pal->obsPalavra == NULL) {
                $reg_pal->obsPalavra = 1;
            }


            $this->todas_palavras[] = $reg_pal;
        }


        $linguas = $this->Lingua_model->obter_todas_lingua_ativas()->result();

        $povos = $this->Povo_model->obter_todos_povo_ativo()->result();








        if ($this->verificar_usuario_logado() == TRUE) {
            if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado('tipo_usuario') == 1) {
                $this->menu_sistema = 'admin/menuTop';
                $this->conteudo_sistema = 'admin/homeColaborador';
            } else if ($this->tipo_usuario_logado() == 2) {
                $this->menu_sistema = 'colaborador/menuTop';
                $this->conteudo_sistema = 'colaborador/homeColaborador';
            }
        }


        $this->dados = array(
            'registro_pralavras' => $this->todas_palavras,
            'linguas' => $linguas,
            'povos' => $povos,
            'opcaoLingua' => $opcaoLingua,
            'opcaoPovo' => $opcaoPovo,
            'qtde_paginas' => $qtde_paginas,
            'tipoUsuarioSistema' => $this->session->userdata('tipo_usuario'),
        );


        $this->saida_tela();
    }

    public function minhas() {

        if ($this->verificar_usuario_logado() == TRUE) {

            $id_usuario_logado = $this->session->userdata('id_usuario');

            if (isset($_GET['pg'])) {
                $this->numeroPagina = $_GET['pg'] - 1;
            }

            $opcaoLingua = 0;
            $opcaoPovo = 0;

            $registro_palavras = "";
            $qtde_paginas = 0;

            if (isset($_GET['p'])) {

                $pesquisa = trim(strip_tags($_GET['p']));

                $registro_palavras = $this->Palavras_model->buscaPesquisaPorUsuario($pesquisa, $id_usuario_logado)->result();

                $quantidadeRegistroPalavras = 0;
            } else if ((!empty($_GET['lingua'])) || (!empty($_GET['povo']))) {

                $opcaoLingua = $_GET['lingua'];
                $opcaoPovo = $_GET['povo'];

                $limit = array(
                    'inicio' => $this->numeroRegistroPorPagina,
                    'totalpagina' => $this->numeroPagina * $this->numeroRegistroPorPagina,
                );

                $registro_palavras = $this->Palavras_model->buscaFiltroMinhas($opcaoLingua, $opcaoPovo, $limit, $id_usuario_logado)->result();

                $registro_totais_filtros = $this->Palavras_model->buscaFiltroRelatorioMinhas($opcaoLingua, $opcaoPovo, $id_usuario_logado)->result();


                $qtde_paginas = ceil(count($registro_totais_filtros) / $this->numeroRegistroPorPagina);

//         Se não aver condição alguma fas isso   
            } else {
                $limit = array(
                    'inicio' => $this->numeroRegistroPorPagina,
                    'totalpagina' => $this->numeroPagina * $this->numeroRegistroPorPagina,
                );

                $registro_palavras = $this->Palavras_model->consultarPalavrasPorUsuario($limit, $id_usuario_logado)->result();

                $this->quantidadeRegistroPalavras = $this->Palavras_model->consultarNumeroRegistroPorUsuario($id_usuario_logado);
                $qtde_paginas = ceil($this->quantidadeRegistroPalavras / $this->numeroRegistroPorPagina);
            }




            $this->todas_palavras = NULL;

            foreach ($registro_palavras as $reg_pal) {
                if ((!strlen($reg_pal->imagemPalavra) > 2) || (!file_exists("./imagem/" . $reg_pal->imagemPalavra)) || $reg_pal->imagemPalavra == NULL) {
                    $reg_pal->imagemPalavra = 'sem_imagem.jpg';
                }

                if ($reg_pal->obsPalavra == "" || $reg_pal->obsPalavra == NULL) {
                    $reg_pal->obsPalavra = 1;
                }

                $this->todas_palavras[] = $reg_pal;
            }

            $linguas = $this->Lingua_model->obter_todas_lingua_ativas()->result();

            $povos = $this->Povo_model->obter_todos_povo_ativo()->result();


            $this->dados = array(
                'registro_pralavras' => $this->todas_palavras,
                'qtde_paginas' => $qtde_paginas,
                'linguas' => $linguas,
                'povos' => $povos,
                'opcaoLingua' => $opcaoLingua,
                'opcaoPovo' => $opcaoPovo,
            );

            if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado() == 1) {
                $this->menu_sistema = 'admin/menuTop';
                $this->conteudo_sistema = 'admin/palavra/minhas_palavras';
            } else if ($this->tipo_usuario_logado() == 2) {
                $this->menu_sistema = 'colaborador/menuTop';
                $this->conteudo_sistema = 'colaborador/palavra/minhas_palavras';
            }

            $this->saida_tela();
        } else {
            redirect(base_url());
        }
    }

    public function nova_palavra() {
        if ($this->verificar_usuario_logado() == TRUE) {

            $povos = $this->Povo_model->obter_todos_povo()->result();

            $linguas = $this->Lingua_model->obter_todas_lingua()->result();

            $tipo_palavra = $this->Categoria_model->obter_todos_tipo()->result();

            if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado() == 1) {
                $this->menu_sistema = 'admin/menuTop';
                $this->conteudo_sistema = 'admin/palavra/formPalavra';
            } else if ($this->tipo_usuario_logado() == 2) {
                $this->menu_sistema = 'colaborador/menuTop';
                $this->conteudo_sistema = 'colaborador/palavra/formPalavra';
            }


            $this->dados = array(
                'linguas' => $linguas,
                'povos' => $povos,
                'tipo_palavra' => $tipo_palavra
            );

            $this->saida_tela();
        } else {
            redirect(base_url());
        }
    }

    public function salvar_palavra() {
        if ($this->verificar_usuario_logado() == TRUE) {

            $this->form_validation->set_rules('palavraPortugues', 'Palavra Portuques', 'required|min_length[1]|max_length[50]');
            $this->form_validation->set_rules('palavraIndigena', 'Palavra Indigena', 'required|min_length[1]|max_length[50]');
            $this->form_validation->set_rules('povo', 'Povo', 'required', array('required' => 'Selecione o povo'));
            $this->form_validation->set_rules('tipoLingua', 'Lingua', 'required', array('required' => 'Selecione a Linga'));


            if ($this->form_validation->run() == FALSE) {
                $this->nova_palavra();
            } else {

                $palavra_protugues = $this->input->post('palavraPortugues');
                $palavra_indigena = $this->input->post('palavraIndigena');

                $povo = $this->input->post('povo');
                $lingua = $this->input->post('tipoLingua');

                $id_ususario = $this->session->userdata('id_usuario');

                $dados = array(
                    'palavraPortugues' => $palavra_protugues,
                    'palavraIndigina' => $palavra_indigena,
                    'idPovo' => $povo,
                    'idLingua' => $lingua,
                    'idUsuario' => $id_ususario,
                );

                $palavra_existe = $this->Palavras_model->consultarPalavrasExiste($dados)->result();

                if (count($palavra_existe) > 0) {
                    echo 'Já existe';
                } else {

                    $this->Palavras_model->salvarNovaPalavra($dados);

                    $palavra_existe = $this->Palavras_model->consultarPalavrasExiste($dados)->result();

                    $id_palavra_cadastrada;
                    foreach ($palavra_existe as $pal_exi) {
                        $id_palavra_cadastrada = $pal_exi->idPalavra;
                    }

                    $this->inserir_imagem($id_palavra_cadastrada);
                }
            }
        } else {
            redirect(base_url());
        }
    }

    public function alterar($id_palavra = NULL) {
        if ($this->verificar_usuario_logado()) {
            if ($id_palavra == NULL) {
                $id_palavra = $this->uri->segment(3);
            }


            $palavra = $this->Palavras_model->obterPalavraId($id_palavra)->result();
            $povos = $this->Povo_model->obter_todos_povo()->result();

            $linguas = $this->Lingua_model->obter_todas_lingua()->result();

            if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado() == 1) {
                $this->menu_sistema = 'admin/menuTop';
                $this->conteudo_sistema = 'admin/palavra/formAlterarPalavra';
            } else if ($this->tipo_usuario_logado() == 2) {
                $this->menu_sistema = '';
                $this->conteudo_sistema = '';
            }


            $this->dados = array(
                'palavra' => $palavra,
                'povos' => $povos,
                'linguas' => $linguas
            );

            $this->saida_tela();
        } else {
            redirect(base_url());
        }
    }

    public function salvar_palavra_alterarda() {
        if ($this->verificar_usuario_logado() == TRUE) {

            $this->form_validation->set_rules('palavraPortugues', 'Palavra Portuques', 'required|min_length[1]|max_length[50]');
            $this->form_validation->set_rules('palavraIndigena', 'Palavra Indigena', 'required|min_length[1]|max_length[50]');
            $this->form_validation->set_rules('povo', 'Povo', 'required', array('required' => 'Selecione o Povo'));
            $this->form_validation->set_rules('tipoLingua', 'Lingua', 'required', array('required' => 'Selecione a Linga'));

            $id_palavra = $this->input->post('idPalavra');

            if ($this->form_validation->run() == FALSE) {
                $this->alterar($id_palavra);
            } else {

                $palavra_protugues = $this->input->post('palavraPortugues');
                $palavra_indigena = $this->input->post('palavraIndigena');

                $povo = $this->input->post('povo');
                $lingua = $this->input->post('tipoLingua');

                $id_ususario = $this->session->userdata('id_usuario');

                $dados = array(
                    'palavraPortugues' => $palavra_protugues,
                    'palavraIndigina' => $palavra_indigena,
                    'idPovo' => $povo,
                    'idLingua' => $lingua,
                    'idUsuario' => $id_ususario,
                );

                $palavra_existe = $this->Palavras_model->consultarPalavrasExiste($dados)->result();

                if (count($palavra_existe) > 0) {
                    echo 'Já existe';
                } else {

                    $this->Palavras_model->alterarPalavra($dados, $id_palavra);

                    $palavra_existe = $this->Palavras_model->consultarPalavrasExiste($dados)->result();

                    $id_palavra_cadastrada;
                    foreach ($palavra_existe as $pal_exi) {
                        $id_palavra_cadastrada = $pal_exi->idPalavra;
                    }

                    // echo $id_palavra_cadastrada;

                    $this->inserir_imagem($id_palavra_cadastrada);
                }
            }
        } else {
            redirect(base_url());
        }
    }

    public function inserir_imagem($id_palavra = NULL, $erros_upload = NULL) {
        if ($this->verificar_usuario_logado() == TRUE) {

            if ($id_palavra == NULL) {
                $id_palavra = $this->uri->segment(3);
            }

            $palavra = $this->Palavras_model->obterPalavraId($id_palavra)->result();

            $povos = $this->Povo_model->obter_todos_povo()->result();

            $linguas = $this->Lingua_model->obter_todas_lingua()->result();

            if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado() == 1) {
                $this->menu_sistema = 'admin/menuTop';
                $this->conteudo_sistema = 'admin/palavra/inserirImagemPalavra';
            } else if ($this->tipo_usuario_logado() == 2) {
                $this->menu_sistema = 'colaborador/menuTop';
                $this->conteudo_sistema = 'colaborador/palavra/inserirImagemPalavra';
            }


            foreach ($palavra as $pal) {
                if ((!strlen($pal->imagemPalavra) > 2) || (!file_exists("./imagem/" . $pal->imagemPalavra)) || $pal->imagemPalavra == NULL) {
                    $pal->imagemPalavra = 'sem_imagem.jpg';
                }
            }


            $this->dados = array(
                'palavra' => $palavra,
                'povos' => $povos,
                'linguas' => $linguas,
                'erros_upload' => $erros_upload,
            );

            $this->saida_tela();
        } else {
            redirect(base_url());
        }
    }

    public function salvar_imagem() {
        if ($this->verificar_usuario_logado()) {

            $id_palavra = $this->input->post('idPalavra');

            $palavra_existe = $this->Palavras_model->obterPalavraId($id_palavra)->result();

            if (count($palavra_existe) == 0) {

                exit();
            }

            $config['upload_path'] = 'imagem';
            $config['encrypt_name'] = TRUE;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 1024 * 1024 * 2;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('imagemPalavra')) {
                $error = array('error' => $this->upload->display_errors());

                echo $error['error'];
            } else {

                $palavra;

                foreach ($palavra_existe as $pal_exi) {
                    $palavra = $pal_exi;
                }

                if (is_file("imagem/" . $palavra->imagemPalavra)) {
                    unlink('imagem/' . $palavra->imagemPalavra);
                }


                $dados_update = array(
                    'imagemPalavra' => $this->upload->data('file_name'),
                );


                $this->Palavras_model->alterarPalavra($dados_update, $id_palavra);

                echo 'imagem alterada com sucesso';
            }
        } else {
            redirect(base_url());
        }
    }

    public function inserir_som($id_palavra = NULL, $erros_upload = NULL) {
        if ($this->verificar_usuario_logado()) {
            if ($id_palavra == NULL) {
                $id_palavra = $this->uri->segment(3);
            }

            $palavra = $this->Palavras_model->obterPalavraId($id_palavra)->result();

            if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado() == 1) {
                $this->menu_sistema = 'admin/menuTop';
                $this->conteudo_sistema = 'admin/palavra/inserirSomPalavra';
            } else if ($this->tipo_usuario_logado() == 2) {
                $this->menu_sistema = '';
                $this->conteudo_sistema = '';
            }


            $this->dados = array(
                'palavra' => $palavra,
                'erros_upload' => $erros_upload,
            );


            $this->saida_tela();
        } else {
            redirect(base_url());
        }
    }

    public function salvar_som() {
        if ($this->verificar_usuario_logado()) {

            $id_palavra = $this->input->post('idPalavra');


            $palavra_existe = $this->Palavras_model->obterPalavraId($id_palavra)->result();

            if (count($palavra_existe) == 0) {
                exit();
            }

            $config['upload_path'] = 'sons';
            $config['encrypt_name'] = TRUE;
            $config['allowed_types'] = 'mpeg3|mpeg|x-mpeg-3|mp3';
            $config['max_size'] = 1024 * 1024 * 2;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('somPalavra')) {
                $error = array('error' => $this->upload->display_errors());

                echo $error['error'];
            } else {

                $palavra;

                foreach ($palavra_existe as $pal_exi) {
                    $palavra = $pal_exi;
                }

                if (is_file("sons/" . $palavra->somPalavra)) {
                    unlink('sons/' . $palavra->somPalavra);
                }


                $dados_update = array(
                    'somPalavra' => $this->upload->data('file_name'),
                );


                $this->Palavras_model->alterarPalavra($dados_update, $id_palavra);

                echo 'Som alterado com sucesso';
            }
        } else {
            redirect(base_url());
        }
    }

    public function excluir() {
        if ($this->verificar_usuario_logado()) {
            $id_palavra = $this->uri->segment(3);

            $palavra_excluir;

            $palavra = $this->Palavras_model->obterPalavraId($id_palavra)->result();

            foreach ($palavra as $pal) {
                $palavra_excluir = $pal;
            }

            if (is_file('imagem/' . $palavra_excluir->imagemPalavra)) {
                unlink('imagem/' . $palavra_excluir->imagemPalavra);
            }

            if (is_file('sons/' . $palavra_excluir->somPalavra)) {
                unlink('sons/' . $palavra_excluir->somPalavra);
            }

            $this->Palavras_model->excluirPalavra($id_palavra);

//redirect(base_url('palavras/minhas'));

            echo "Excluirdo com sucesso";
        } else {
            redirect(base_url());
        }
    }

    public function autor_palavra() {
        if ($this->verificar_usuario_logado()) {

            $id_palavra = strip_tags($this->input->post('palavra'));

            $palavra = $this->Palavras_model->obterAutorPalavra($id_palavra)->result();


            $dados = array(
                'palavra' => $palavra,
            );


//            foreach ($palavra as $pal) {
//                echo "Nome: " . $pal->nomeUsuario . '<br/>';
//                echo "E-mail: " . $pal->emailUsuario . '<br/>';
//            }



            $this->load->view('tela/informacaoAutor', $dados);
            //$this->load->view('tela/titulo');
        }
    }

    public function gerar_relatorio() {

        $registro_palavras;

        if ((!empty($_GET['lingua'])) || (!empty($_GET['povo']))) {

            $opcaoLingua = $_GET['lingua'];
            $opcaoPovo = $_GET['povo'];

            $registro_palavras = $this->Palavras_model->buscaFiltroRelatorio($opcaoLingua, $opcaoPovo)->result();
        } else {

            $registro_palavras = $this->Palavras_model->buscarTodasPalavras()->result();
        }

        foreach ($registro_palavras as $reg_pal) {
            if ((!strlen($reg_pal->imagemPalavra) > 2) || (!file_exists("./imagem/" . $reg_pal->imagemPalavra)) || $reg_pal->imagemPalavra == NULL) {
                $reg_pal->imagemPalavra = 'sem_imagem.jpg';
            }



            if ($reg_pal->obsPalavra == "" || $reg_pal->obsPalavra == NULL) {
                $reg_pal->obsPalavra = 1;
            }
        }



        $html = $this->reternoHtmlRelatorioVisitante($registro_palavras);


        // echo $html;

        $this->gerarPdf($html);
    }

    public function gerar_relatorio_minhas() {
        if ($this->verificar_usuario_logado() == TRUE) {

            $id_usuario_logado = $this->session->userdata('id_usuario');

            $registro_palavras;

            if ((!empty($_GET['lingua'])) || (!empty($_GET['povo']))) {

                $opcaoLingua = $_GET['lingua'];
                $opcaoPovo = $_GET['povo'];

                $registro_palavras = $this->Palavras_model->buscaFiltroRelatorioMinhas($opcaoLingua, $opcaoPovo, $id_usuario_logado)->result();
            } else {


                $registro_palavras = $this->Palavras_model->buscarTodasPalavrasUsuario($id_usuario_logado)->result();
            }

            foreach ($registro_palavras as $reg_pal) {
                if ((!strlen($reg_pal->imagemPalavra) > 2) || (!file_exists("./imagem/" . $reg_pal->imagemPalavra)) || $reg_pal->imagemPalavra == NULL) {
                    $reg_pal->imagemPalavra = 'sem_imagem.jpg';
                }



                if ($reg_pal->obsPalavra == "" || $reg_pal->obsPalavra == NULL) {
                    $reg_pal->obsPalavra = 1;
                }
            }



            $html = $this->reternoHtmlRelatorioVisitante($registro_palavras);


            // echo $html;

            $this->gerarPdf($html);
        } else {
            redirect(base_url());
        }
    }

    protected function reternoHtmlRelatorioVisitante($dados) {
        $html = '<html><head> </head><body>';

        $html .= '<h1> Relatório das palavras indegenas </h1>';

        $html .= '<table style="width:100% ;border: 1px solid #000"><thead><tr><td>Imagem</td><td>Português</td><td>Indigena</td><td>Lingua</td><td>Povo</td></tr></thead><tbody>';

        foreach ($dados as $dd) {
            $html .= '<tr>';
            $html .= '<td><img src="' . base_url("imagem/" . $dd->imagemPalavra) . '" width="100" height="100" /> </td>';
            $html .= '<td>' . $dd->palavraPortugues . '</td>';
            $html .= '<td>' . $dd->palavraIndigina . '</td>';
            $html .= '<td>' . $dd->nomeLingua . '</td>';
            $html .= '<td>' . $dd->nomePovo . '</td>';


            $html .= '</tr>';
        }


        $html .= '</tbody></table>';
        $html .= '</body></html>';

        return $html;
    }

    protected function gerarPdf($html) {
        $this->load->library('mpdf/mpdf');

        $mpdf = new mPDF('c', 'A4', '', '', 32, 25, 27, 25, 16, 13);

        $mpdf->SetDisplayMode('fullpage');

        $mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list
// LOAD a stylesheet
//        $stylesheet = file_get_contents('mpdfstyletables.css');
//        $mpdf->WriteHTML($stylesheet, 1); // The parameter 1 tells that this is css/style only and no body/html/text

        $mpdf->WriteHTML($html);

        $mpdf->Output();
        exit;
    }

}
