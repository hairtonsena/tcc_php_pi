<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Lingua extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('form_validation');


        $this->load->model('Lingua_model');
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
        if ($this->verificar_usuario_logado()) {
            $menu_sistema = 'visitante/menuTop';
            $conteudo_sistema = 'visitante/homeVisitante';

            $linguas = $this->Lingua_model->obter_todas_lingua()->result();





            $dados = array(
                'linguas' => $linguas
            );



            if ($this->verificar_usuario_logado() == TRUE) {
                if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado('tipo_usuario') == 1) {
                    $menu_sistema = 'admin/menuTop';
                    $conteudo_sistema = 'admin/lingua/verTipoLingua';
                } else if ($this->tipo_usuario_logado() == 2) {
                    $menu_sistema = 'colaborador/menuTop';
                    $conteudo_sistema = 'colaborador/homeColaborador';
                }
            }

            $this->saida_tela($menu_sistema, $conteudo_sistema, $dados);
        } else {
            redirect(base_url());
        }
    }

    public function nova() {
        if ($this->verificar_usuario_logado()) {

            $menu_sistema;
            $conteudo_sistema;

            if ($this->verificar_usuario_logado() == TRUE) {
                if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado('tipo_usuario') == 1) {
                    $menu_sistema = 'admin/menuTop';
                    $conteudo_sistema = 'admin/lingua/formTipoLingua';
                } else if ($this->tipo_usuario_logado() == 2) {
                    $menu_sistema = 'colaborador/menuTop';
                    $conteudo_sistema = 'colaborador/homeColaborador';
                }
            }

            $dados = array(
            );


            $this->saida_tela($menu_sistema, $conteudo_sistema, $dados);
        } else {
            redirect(base_url());
        }
    }

    public function salvar_nova() {
        if ($this->verificar_usuario_logado()) {
            $this->form_validation->set_rules('nomeLingua', 'Lingua', 'required|min_length[1]|max_length[50]');
            if ($this->form_validation->run() == FALSE) {
                $this->nova();
            } else {

                $nomeLingua = strip_tags($this->input->post('nomeLingua'));
                $obsLingua = strip_tags($this->input->post('observacaoLingua'));

                $dados = array(
                    'nomeLingua' => $nomeLingua,
                    'obsLingua' => $obsLingua
                );

                $this->Lingua_model->inserirLingua($dados);

                redirect(base_url('lingua'));
            }
        } else {
            redirect(base_url());
        }
    }

    public function alterar($id_lingua = NULL) {
        if ($this->verificar_usuario_logado()) {
            if ($id_lingua == NULL) {
                $id_lingua = strip_tags($this->uri->segment(3));
            }

            $lingua = $this->Lingua_model->obter_lingua_id($id_lingua)->result();

            if (count($lingua) == 0) {
                redirect(base_url());
            }



            $menu_sistema;
            $conteudo_sistema;

            if ($this->verificar_usuario_logado() == TRUE) {
                if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado('tipo_usuario') == 1) {
                    $menu_sistema = 'admin/menuTop';
                    $conteudo_sistema = 'admin/lingua/formAlterarTipoLingua';
                } else if ($this->tipo_usuario_logado() == 2) {
                    $menu_sistema = 'colaborador/menuTop';
                    $conteudo_sistema = 'colaborador/homeColaborador';
                }
            }



            $dados = array(
                'lingua' => $lingua
            );


            $this->saida_tela($menu_sistema, $conteudo_sistema, $dados);
        } else {
            redirect(base_url());
        }
    }

    public function salvar_alterada() {
        if ($this->verificar_usuario_logado()) {
            $this->form_validation->set_rules('nomeLingua', 'Lingua', 'required|min_length[1]|max_length[50]');

            $id_palavra = $this->input->post('idTipoLingua');

            if ($this->form_validation->run() == FALSE) {
                $this->alterar($id_palavra);
            } else {

                $nomeLingua = strip_tags($this->input->post('nomeLingua'));
                $obsLingua = strip_tags($this->input->post('observacaoLingua'));

                $dados = array(
                    'nomeLingua' => $nomeLingua,
                    'obsLingua' => $obsLingua
                );

                $this->Lingua_model->alterarLingua($dados, $id_palavra);

                redirect(base_url('lingua'));
            }
        } else {
            redirect(base_url());
        }
    }

    public function excluir() {
        if ($this->verificar_usuario_logado()) {

            $id_lingua = strip_tags($this->uri->segment(3));

            $lingua_existe = $this->Lingua_model->obter_lingua_id($id_lingua)->result();

            if (count($lingua_existe) == 0) {
                redirect(base_url('lingua'));
            }

            $this->Lingua_model->excluirLingua($id_lingua);

            redirect(base_url('lingua'));
            
        } else {
            redirect(base_url());
        }
    }

}
