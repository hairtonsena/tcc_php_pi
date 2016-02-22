<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Povo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Povo_model');
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

            $povos = $this->Povo_model->obter_todos_povo()->result();



            $dados = array(
                'povos' => $povos,
            );


            if ($this->verificar_usuario_logado() == TRUE) {
                if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado('tipo_usuario') == 1) {
                    $menu_sistema = 'admin/menuTop';
                    $conteudo_sistema = 'admin/povo/verPovo';
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

    public function novo() {
        if ($this->verificar_usuario_logado()) {

            $menu_sistema;
            $conteudo_sistema;

            if ($this->verificar_usuario_logado() == TRUE) {
                if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado('tipo_usuario') == 1) {
                    $menu_sistema = 'admin/menuTop';
                    $conteudo_sistema = 'admin/povo/formPovo';
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

    public function salvar_novo() {
        if ($this->verificar_usuario_logado()) {
            $this->form_validation->set_rules('nomePovo', 'Povo', 'required|min_length[1]|max_length[50]');
            if ($this->form_validation->run() == FALSE) {
                $this->nova();
            } else {

                $nomePovo = strip_tags($this->input->post('nomePovo'));
                $obsPovo = strip_tags($this->input->post('observacaoPovo'));

                $dados = array(
                    'nomePovo' => $nomePovo,
                    'obsPovo' => $obsPovo
                );

                $this->Povo_model->inserirPovo($dados);

                redirect(base_url('povo'));
            }
        } else {
            redirect(base_url());
        }
    }

    public function alterar($id_povo = NULL) {
        if ($this->verificar_usuario_logado()) {
            if ($id_povo == NULL) {
                $id_povo = strip_tags($this->uri->segment(3));
            }

            $povo = $this->Povo_model->obter_povo_id($id_povo)->result();

            if (count($povo) == 0) {
                redirect(base_url());
            }



            $menu_sistema;
            $conteudo_sistema;

            if ($this->verificar_usuario_logado() == TRUE) {
                if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado('tipo_usuario') == 1) {
                    $menu_sistema = 'admin/menuTop';
                    $conteudo_sistema = 'admin/povo/formAlterarPovo';
                } else if ($this->tipo_usuario_logado() == 2) {
                    $menu_sistema = 'colaborador/menuTop';
                    $conteudo_sistema = 'colaborador/homeColaborador';
                }
            }



            $dados = array(
                'povo' => $povo
            );


            $this->saida_tela($menu_sistema, $conteudo_sistema, $dados);
        } else {
            redirect(base_url());
        }
    }

    public function salvar_alterado() {
        if ($this->verificar_usuario_logado()) {
            $this->form_validation->set_rules('nomePovo', 'Povo', 'required|min_length[1]|max_length[50]');

            $id_povo = $this->input->post('idPovo');

            if ($this->form_validation->run() == FALSE) {
                $this->alterar($id_povo);
            } else {

                $nomePovo = strip_tags($this->input->post('nomePovo'));
                $obsPovo = strip_tags($this->input->post('observacaoPovo'));

                $dados = array(
                    'nomePovo' => $nomePovo,
                    'obsPovo' => $obsPovo
                );

                $this->Povo_model->alterarPovo($dados, $id_povo);

                redirect(base_url('povo'));
            }
        } else {
            redirect(base_url());
        }
    }

    public function excluir() {
        if ($this->verificar_usuario_logado()) {

            $id_povo = strip_tags($this->uri->segment(3));

            $povo_existe = $this->Povo_model->obter_povo_id($id_povo)->result();

            if (count($povo_existe) == 0) {
                redirect(base_url('povo'));
            }

            $this->Povo_model->excluirPovo($id_povo);

            redirect(base_url('povo'));
        } else {
            redirect(base_url());
        }
    }

}
