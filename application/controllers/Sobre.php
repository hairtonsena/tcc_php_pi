<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sobre extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('form_validation');
        //   $this->load->model('Povo_model');
    }

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

    public function saida_tela($menu_sistema, $conteudo_sistema, $dados) {
        $this->load->view('tela/titulo');
        $this->load->view($menu_sistema);
        $this->load->view($conteudo_sistema, $dados);
        $this->load->view('tela/rodape');
    }

    public function index() {

        $menu_sistema = 'visitante/menuTop';
        $conteudo_sistema = 'sobre/sobre';

        $dados = NULL;

        if ($this->verificar_usuario_logado() == TRUE) {
            if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado() == 1) {
                $menu_sistema = 'admin/menuTop';
                $conteudo_sistema = 'sobre/sobre';
            } else if ($this->tipo_usuario_logado() == 2) {
                $menu_sistema = 'colaborador/menuTop';
                $conteudo_sistema = 'sobre/sobre';
            }
        }


        $this->saida_tela($menu_sistema, $conteudo_sistema, $dados);
    }

    public function artigo() {

        $menu_sistema = 'visitante/menuTop';
        $conteudo_sistema = 'sobre/artigo';

        $dados = NULL;

        if ($this->verificar_usuario_logado() == TRUE) {
            if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado() == 1) {
                $menu_sistema = 'admin/menuTop';
                $conteudo_sistema = 'sobre/artigo';
            } else if ($this->tipo_usuario_logado() == 2) {
                $menu_sistema = 'colaborador/menuTop';
                $conteudo_sistema = 'sobre/artigo';
            }
        }


        $this->saida_tela($menu_sistema, $conteudo_sistema, $dados);
    }

    public function manual() {

        $menu_sistema = 'visitante/menuTop';
        $conteudo_sistema = 'sobre/manual';

        $dados = NULL;

        if ($this->verificar_usuario_logado() == TRUE) {
            if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado() == 1) {
                $menu_sistema = 'admin/menuTop';
                $conteudo_sistema = 'sobre/manual';
            } else if ($this->tipo_usuario_logado() == 2) {
                $menu_sistema = 'colaborador/menuTop';
                $conteudo_sistema = 'sobre/manual';
            }
        }


        $this->saida_tela($menu_sistema, $conteudo_sistema, $dados);
    }

    public function gravar_pronuncia() {

        $menu_sistema = 'visitante/menuTop';
        $conteudo_sistema = 'sobre/gravarPronuncia';

        $dados = NULL;

        if ($this->verificar_usuario_logado() == TRUE) {
            if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado() == 1) {
                $menu_sistema = 'admin/menuTop';
                $conteudo_sistema = 'sobre/gravarPronuncia';
            } else if ($this->tipo_usuario_logado() == 2) {
                $menu_sistema = 'colaborador/menuTop';
                $conteudo_sistema = 'sobre/gravarPronuncia';
            }
        }


        $this->saida_tela($menu_sistema, $conteudo_sistema, $dados);
    }

    function gravar_imagem() {
        $menu_sistema = 'visitante/menuTop';
        $conteudo_sistema = 'sobre/gravarImagem';

        $dados = NULL;

        if ($this->verificar_usuario_logado() == TRUE) {
            if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado() == 1) {
                $menu_sistema = 'admin/menuTop';
                $conteudo_sistema = 'sobre/gravarImagem';
            } else if ($this->tipo_usuario_logado() == 2) {
                $menu_sistema = 'colaborador/menuTop';
                $conteudo_sistema = 'sobre/gravarImagem';
            }
        }


        $this->saida_tela($menu_sistema, $conteudo_sistema, $dados);
    }

    public function fale_conosco(){
        $menu_sistema = 'visitante/menuTop';
        $conteudo_sistema = 'sobre/faleConosco';

        $dados = NULL;

        if ($this->verificar_usuario_logado() == TRUE) {
            if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado() == 1) {
                $menu_sistema = 'admin/menuTop';
                $conteudo_sistema = 'sobre/faleConosco';
            } else if ($this->tipo_usuario_logado() == 2) {
                $menu_sistema = 'colaborador/menuTop';
                $conteudo_sistema = 'sobre/faleConosco';
            }
        }


        $this->saida_tela($menu_sistema, $conteudo_sistema, $dados);
    }
    
    public function extra(){
        $menu_sistema = 'visitante/menuTop';
        $conteudo_sistema = 'sobre/extra';

        $dados = NULL;

        if ($this->verificar_usuario_logado() == TRUE) {
            if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado() == 1) {
                $menu_sistema = 'admin/menuTop';
                $conteudo_sistema = 'sobre/extra';
            } else if ($this->tipo_usuario_logado() == 2) {
                $menu_sistema = 'colaborador/menuTop';
                $conteudo_sistema = 'sobre/extra';
            }
        }


        $this->saida_tela($menu_sistema, $conteudo_sistema, $dados);
    }
    
}
