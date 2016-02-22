<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Passe extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
        $this->load->library('session');
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Usuario_model');
    }

    public function index() {

        $menu_sistema = 'visitante/menuTop';
        $conteudo_sistema = 'seguranca/loguin_usuario';
        $dados = NULL;

        $this->saida_tela($menu_sistema, $conteudo_sistema, $dados);
    }

    protected function saida_tela($menu_sistema, $conteudo_sistema, $dados) {
        $this->load->view('tela/titulo');
        $this->load->view($menu_sistema);
        $this->load->view($conteudo_sistema, $dados);
        $this->load->view('tela/rodape');
    }

    public function logar() {

        $this->form_validation->set_rules('apelido', 'Apelido', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[3]|callback_validarUsuario_check');

        if ($this->form_validation->run() == FALSE) {

            $this->index();
        } else {
            redirect(base_url());
        }
    }

    function validarUsuario_check() {
        $dadosLogin = array(
            'apelidoUsuario' => $this->input->post('apelido'),
            'senhaUsuario' => $this->input->post('senha')// md5($this->input->post('senha'))
        );

        $userLogin = $this->Usuario_model->obterUsuarioLogin($dadosLogin)->result();

        if (empty($userLogin)) {
            $this->form_validation->set_message('validarUsuario_check', 'Email ou senha incorretos!');
            return FALSE;
        } else {
            foreach ($userLogin as $ul) {
                if ($ul->statusUsuario == 0) {
                    $this->form_validation->set_message('validarUsuario_check', 'Usuário aguardando aprovação!');
                    return FALSE;
                } else {


                    $dadosUser = array(
                        'id_usuario' => $ul->idUsuario,
                        'nome_usuario' => $ul->nomeUsuario,
                        'email_usuario' => $ul->emailUsuario,
                        'senha_usuario' => $ul->senhaUsuario,
                        'tipo_usuario' => $ul->idTipoUsuario
                    );
                    $this->session->set_userdata($dadosUser);
                }
            }
            return TRUE;
        }
    }

    public function logout() {
        $this->session->unset_userdata('id_usuario');
        $this->session->unset_userdata('nome_usuario');
        $this->session->unset_userdata('email_usuario');
        $this->session->unset_userdata('senha_usuario');
        $this->session->unset_userdata('tipo_usuario');

        redirect(base_url());
    }

    public function novo_colaborador($mensagem = NULL) {
        $menu_sistema = 'visitante/menuTop';
        $conteudo_sistema = 'seguranca/cadastra_usuario';
        $dados = array(
            'mensagem' => $mensagem
        );

        $this->saida_tela($menu_sistema, $conteudo_sistema, $dados);
    }

    public function enviar_solicitacao() {

        $this->form_validation->set_rules('nome', 'Nome', 'required|trim|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('apelido', 'Apelido', 'required|trim|min_length[2]|max_length[50]|is_unique[usuario.apelidoUsuario] ');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|min_length[5]|max_length[70]|is_unique[usuario.emailUsuario]');
        $this->form_validation->set_rules('cpf', 'CPF', 'required|trim|min_length[11]|max_length[14]|is_unique[usuario.cpfUsuario]');
        $this->form_validation->set_rules('telefone', 'Telefone', 'trim|min_length[8]|max_length[15]');
        $this->form_validation->set_rules('link', 'Link', 'trim|min_length[5]|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            $this->novo_colaborador();
        } else {

            $nome = strip_tags($this->input->post('nome'));
            $apelido = strip_tags($this->input->post('apelido'));
            $email = strip_tags($this->input->post('email'));
            $cpf = strip_tags($this->input->post('cpf'));
            $telefone = strip_tags($this->input->post('telefone'));
            $link = strip_tags($this->input->post('link'));
            $descricao = strip_tags($this->input->post('descricao'));


            $dados = array(
                'nomeUsuario' => $nome,
                'apelidoUsuario' => $apelido,
                'emailUsuario' => $email,
                'cpfUsuario' => $cpf,
                'telefoneUsuario' => $telefone,
                'linkUsuario' => $link,
                'descricaoUsuario' => $descricao,
            );

            $this->Usuario_model->inserirNovoColaborador($dados);
            
            $mensagem = "Sua solicitação de colaborador foi realizada com sucesso! Aguarde avaliação dos seus dados. O resultado será encaminhado para o seu email juntamente com sua senha. Obrigado " . $nome;
            
            $this->novo_colaborador($mensagem);
        }
    }

}
