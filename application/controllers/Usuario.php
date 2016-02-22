<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Usuario_model');
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






            $usuarios = $this->Usuario_model->obter_todos_usuario()->result();



            $dados = array(
                'usuarios' => $usuarios,
            );


            if ($this->tipo_usuario_logado() == 0 || $this->tipo_usuario_logado() == 1) {
                $menu_sistema = 'admin/menuTop';
                $conteudo_sistema = 'admin/usuario/gerenciamentoUsuario';
            } else if ($this->tipo_usuario_logado() == 2) {
                $menu_sistema = 'colaborador/menuTop';
                $conteudo_sistema = 'colaborador/homeColaborador';
            }



            $this->saida_tela($menu_sistema, $conteudo_sistema, $dados);
        } else {
            redirect(base_url());
        }
    }

    public function habilitar_colaborador() {
        if ($this->verificar_usuario_logado()) {

            $id_usuario = strip_tags($this->uri->segment(3));

            $senhaGerada = rand(10000000, 99999999);


            // $usuarios = $this->Usuario_model->obter_todos_usuario()->result();

            $dados = array(
                'statusUsuario' => 1,
                    //'senhaUsuario' => $senhaGerada
            );

            $this->Usuario_model->alterar_dados_usuario($dados, $id_usuario);

            redirect(base_url('usuario'));
        } else {
            redirect(base_url());
        }
    }

    public function reprovar_colaborador() {
        if ($this->verificar_usuario_logado()) {

            $id_usuario = strip_tags($this->uri->segment(3));


            // $usuarios = $this->Usuario_model->obter_todos_usuario()->result();

            $dados = array(
                'statusUsuario' => -1,
            );

            $this->Usuario_model->alterar_dados_usuario($dados, $id_usuario);

            redirect(base_url('usuario'));
        } else {
            redirect(base_url());
        }
    }

    public function habilitar_moderador() {
        if ($this->verificar_usuario_logado()) {

            $id_usuario = strip_tags($this->uri->segment(3));


            // $usuarios = $this->Usuario_model->obter_todos_usuario()->result();

            $dados = array(
                'idTipoUsuario' => 1,
            );

            $this->Usuario_model->alterar_dados_usuario($dados, $id_usuario);

            redirect(base_url('usuario'));
        } else {
            redirect(base_url());
        }
    }

    public function desabilitar_moderador() {

        if ($this->verificar_usuario_logado()) {

            $id_usuario = strip_tags($this->uri->segment(3));


            // $usuarios = $this->Usuario_model->obter_todos_usuario()->result();

            $dados = array(
                'idTipoUsuario' => 2,
            );

            $this->Usuario_model->alterar_dados_usuario($dados, $id_usuario);

            redirect(base_url('usuario'));
        } else {
            redirect(base_url());
        }
    }

}
