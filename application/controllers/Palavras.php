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
    }

    private $menu_sistema = 'visitante/menuTop';
    private $conteudo_sistema = 'visitante/homeVisitante';
    private $dados = NULL;
    private $numeroPagina = 0;
    private $quantidadeRegistroPalavras = 0;
    protected $numeroRegistroPorPagina = 6;
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

        if (isset($_GET['pg'])) {
            $this->numeroPagina = $_GET['pg'];
        }

        $quantidadeRegistroPalavras = $this->Palavras_model->consultarNumeroRegistro();
        $registro_palavras = "";



        if ((isset($_GET['pesquisarPalavra']) && (isset($_GET['opcaoPesquisa'])))) {

            $opcaoPesquisa = mysql_escape_string(trim(strip_tags($_GET['opcaoPesquisa'])));
            $pesquisarPalavra = mysql_escape_string(trim(strip_tags($_GET['pesquisarPalavra'])));

            if ($opcaoPesquisa == 'portugues') {
                $registro_palavras = "SELECT * FROM palavra P inner join lingua L on(P.idLingua=L.idLingua) inner join povo PV on(P.idPovo=PV.idPovo) WHERE P.palavraPortugues LIKE '%" . $pesquisarPalavra . "%' order by palavraPortugues";
            } else if ($opcaoPesquisa == 'indigena') {
                $registro_palavras = "SELECT * FROM palavra P inner join lingua L on(P.idLingua=L.idLingua) inner join povo PV on(P.idPovo=PV.idPovo) WHERE P.palavraIndigina LIKE '%" . $pesquisarPalavra . "%' order by palavraPortugues";
            } else if ($opcaoPesquisa == 'tipo') {
                $registro_palavras = "SELECT * FROM palavra P inner join lingua L on(P.idLingua=L.idLingua) inner join povo PV on(P.idPovo=PV.idPovo) WHERE L.nomeLingua LIKE '%" . $pesquisarPalavra . "%' order by palavraPortugues";
            } else if ($opcaoPesquisa == 'povo') {
                $registro_palavras = "SELECT * FROM palavra P inner join lingua L on(P.idLingua=L.idLingua) inner join povo PV on(P.idPovo=PV.idPovo)  WHERE PV.nomePovo LIKE '%" . $pesquisarPalavra . "%' order by P.palavraPortugues";
            }

            $quantidadeRegistroPalavras = 0;
        } else {
            $limit = array(
                'inicio' => $this->numeroRegistroPorPagina,
                'totalpagina' => $this->numeroPagina * $this->numeroRegistroPorPagina,
            );

            $registro_palavras = $this->Palavras_model->consultarPalavras($limit)->result();
        }

        $qtde_paginas = ceil($quantidadeRegistroPalavras / $this->numeroRegistroPorPagina);

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
            'qtde_paginas' => $qtde_paginas,
            'tipoUsuarioSistema' => $this->session->userdata('tipo_usuario'),
        );

        $this->saida_tela();
    }

    public function minhas() {
        if ($this->verificar_usuario_logado() == TRUE) {

            if (isset($_GET['pg'])) {
                $this->numeroPagina = $_GET['pg'];
            }


            $this->quantidadeRegistroPalavras = $this->Palavras_model->consultarNumeroRegistroPorUsuario($this->session->userdata('id_usuario'));
            $registro_palavras = "";



            if ((isset($_GET['pesquisarPalavra']) && (isset($_GET['opcaoPesquisa'])))) {

                $opcaoPesquisa = mysql_escape_string(trim(strip_tags($_GET['opcaoPesquisa'])));
                $pesquisarPalavra = mysql_escape_string(trim(strip_tags($_GET['pesquisarPalavra'])));

                if ($opcaoPesquisa == 'portugues') {
                    $registro_palavras = "SELECT * FROM palavra P inner join lingua L on(P.idLingua=L.idLingua) inner join povo PV on(P.idPovo=PV.idPovo) WHERE P.palavraPortugues LIKE '%" . $pesquisarPalavra . "%' order by palavraPortugues";
                } else if ($opcaoPesquisa == 'indigena') {
                    $registro_palavras = "SELECT * FROM palavra P inner join lingua L on(P.idLingua=L.idLingua) inner join povo PV on(P.idPovo=PV.idPovo) WHERE P.palavraIndigina LIKE '%" . $pesquisarPalavra . "%' order by palavraPortugues";
                } else if ($opcaoPesquisa == 'tipo') {
                    $registro_palavras = "SELECT * FROM palavra P inner join lingua L on(P.idLingua=L.idLingua) inner join povo PV on(P.idPovo=PV.idPovo) WHERE L.nomeLingua LIKE '%" . $pesquisarPalavra . "%' order by palavraPortugues";
                } else if ($opcaoPesquisa == 'povo') {
                    $registro_palavras = "SELECT * FROM palavra P inner join lingua L on(P.idLingua=L.idLingua) inner join povo PV on(P.idPovo=PV.idPovo)  WHERE PV.nomePovo LIKE '%" . $pesquisarPalavra . "%' order by P.palavraPortugues";
                }

                $quantidadeRegistroPalavras = 0;
            } else {
                $limit = array(
                    'inicio' => $this->numeroRegistroPorPagina,
                    'totalpagina' => $this->numeroPagina * $this->numeroRegistroPorPagina,
                );

                $registro_palavras = $this->Palavras_model->consultarPalavrasPorUsuario($limit, $this->session->userdata('id_usuario'))->result();
            }


            $qtde_paginas = ceil($this->quantidadeRegistroPalavras / $this->numeroRegistroPorPagina);

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


            $this->dados = array(
                'registro_pralavras' => $this->todas_palavras,
                'qtde_paginas' => $qtde_paginas,
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



            if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado() == 1) {
                $this->menu_sistema = 'admin/menuTop';
                $this->conteudo_sistema = 'admin/palavra/formPalavra';
            } else if ($this->tipo_usuario_logado() == 2) {
                $this->menu_sistema = 'colaborador/menuTop';
                $this->conteudo_sistema = 'colaborador/palavra/formPalavra';
            }


            $this->dados = array(
                'linguas' => $linguas,
                'povos' => $povos
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

                    redirect($this->inserir_imagem($id_palavra_cadastrada));
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

                    redirect($this->inserir_imagem($id_palavra_cadastrada));
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

                $this->inserir_imagem($id_palavra, $error);
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

                $this->inserir_som($id_palavra, $error);
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



             $this->load->view('tela/informacaoAutor',$dados);
            //$this->load->view('tela/titulo');
        }
    }

}
