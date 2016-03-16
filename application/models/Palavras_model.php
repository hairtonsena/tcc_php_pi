<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Palavras_model
 *
 * @author hairton
 */
class Palavras_model extends CI_Model {

    public function consultarNumeroRegistro() {

        $this->db->select('*');
        $this->db->from('palavra');
        $this->db->join('lingua', 'lingua.idLingua = palavra.idLingua');
        $this->db->join('povo', 'povo.idPovo = palavra.idPovo');



        return $this->db->count_all_results();
    }

    public function buscaPesquisa($pesquisa = '') {
        $this->db->select('*');
        $this->db->from('palavra');
        $this->db->join('lingua', 'lingua.idLingua = palavra.idLingua');
        $this->db->join('povo', 'povo.idPovo = palavra.idPovo');
        $this->db->like(array('palavra.palavraPortugues' => $pesquisa));
        $this->db->or_like(array('palavra.palavraIndigina' => $pesquisa));
        return $this->db->get();
    }

    public function buscaFiltro($lingua, $povo, $limit) {
        $this->db->select('*');
        $this->db->from('palavra');
        $this->db->join('lingua', 'lingua.idLingua = palavra.idLingua');
        $this->db->join('povo', 'povo.idPovo = palavra.idPovo');

        if ($lingua == 0) {
            $this->db->where(array('povo.idPovo' => $povo));
        } else if ($povo == 0) {
            $this->db->where(array('lingua.idLingua' => $lingua));
        } else {
            $this->db->where(array('lingua.idLingua' => $lingua, 'povo.idPovo' => $povo));
        }

        $this->db->limit($limit['inicio'], $limit['totalpagina']);

        return $this->db->get();
    }

    public function buscaFiltroMinhas($lingua, $povo, $limit, $id_usuario) {
        $this->db->select('*');
        $this->db->from('palavra');
        $this->db->join('lingua', 'lingua.idLingua = palavra.idLingua');
        $this->db->join('povo', 'povo.idPovo = palavra.idPovo');
        $this->db->where('idUsuario', $id_usuario);
        if ($lingua == 0) {
            $this->db->where(array('povo.idPovo' => $povo));
        } else if ($povo == 0) {
            $this->db->where(array('lingua.idLingua' => $lingua));
        } else {
            $this->db->where(array('lingua.idLingua' => $lingua, 'povo.idPovo' => $povo));
        }

        $this->db->limit($limit['inicio'], $limit['totalpagina']);

        return $this->db->get();
    }

    public function consultarPalavras($limit) {

        $this->db->select('*');
        $this->db->from('palavra');
        $this->db->join('lingua', 'lingua.idLingua = palavra.idLingua');
        $this->db->join('povo', 'povo.idPovo = palavra.idPovo');
        $this->db->limit($limit['inicio'], $limit['totalpagina']);


        return $query = $this->db->get();
    }

//    Início de sessão de relatório
    public function buscarTodasPalavras() {

        $this->db->select('*');
        $this->db->from('palavra');
        $this->db->join('lingua', 'lingua.idLingua = palavra.idLingua');
        $this->db->join('povo', 'povo.idPovo = palavra.idPovo');

        return $query = $this->db->get();
    }

    public function buscaFiltroRelatorio($lingua, $povo) {
        $this->db->select('*');
        $this->db->from('palavra');
        $this->db->join('lingua', 'lingua.idLingua = palavra.idLingua');
        $this->db->join('povo', 'povo.idPovo = palavra.idPovo');

        if ($lingua == 0) {
            $this->db->where(array('povo.idPovo' => $povo));
        } else if ($povo == 0) {
            $this->db->where(array('lingua.idLingua' => $lingua));
        } else {
            $this->db->where(array('lingua.idLingua' => $lingua, 'povo.idPovo' => $povo));
        }

        return $this->db->get();
    }

    public function buscaFiltroRelatorioMinhas($lingua, $povo,$id_usuario) {
        $this->db->select('*');
        $this->db->from('palavra');
        $this->db->join('lingua', 'lingua.idLingua = palavra.idLingua');
        $this->db->join('povo', 'povo.idPovo = palavra.idPovo');
        $this->db->where("palavra.idUsuario",$id_usuario);
        if ($lingua == 0) {
            $this->db->where(array('povo.idPovo' => $povo));
        } else if ($povo == 0) {
            $this->db->where(array('lingua.idLingua' => $lingua));
        } else {
            $this->db->where(array('lingua.idLingua' => $lingua, 'povo.idPovo' => $povo));
        }

        return $this->db->get();
    }

     public function buscarTodasPalavrasUsuario($id_usuario) {

        $this->db->select('*');
        $this->db->from('palavra');
        $this->db->join('lingua', 'lingua.idLingua = palavra.idLingua');
        $this->db->join('povo', 'povo.idPovo = palavra.idPovo');
        $this->db->where("palavra.idUsuario",$id_usuario);
        return $query = $this->db->get();
    }

    
    // Fim de sessão de relatório

    public function consultarNumeroRegistroPorUsuario($id_usuario) {
        $this->db->select('*');
        $this->db->from('palavra');
        $this->db->join('lingua', 'lingua.idLingua = palavra.idLingua');
        $this->db->join('povo', 'povo.idPovo = palavra.idPovo');
        $this->db->where('idUsuario', $id_usuario);


        return $this->db->count_all_results();
    }

    public function consultarPalavrasPorUsuario($limit, $id_usuario) {
        $this->db->select('*');
        $this->db->from('palavra');
        $this->db->join('lingua', 'lingua.idLingua = palavra.idLingua');
        $this->db->join('povo', 'povo.idPovo = palavra.idPovo');
        $this->db->where('idUsuario', $id_usuario);
        $this->db->limit($limit['inicio'], $limit['totalpagina']);

        return $query = $this->db->get();
    }

    public function buscaPesquisaPorUsuario($pesquisa = '', $id_usuario) {
        $this->db->select('*');
        $this->db->from('palavra');
        $this->db->join('lingua', 'lingua.idLingua = palavra.idLingua');
        $this->db->join('povo', 'povo.idPovo = palavra.idPovo');
        $this->db->where('idUsuario', $id_usuario);
        $this->db->like(array('palavra.palavraPortugues' => $pesquisa));
        $this->db->or_like(array('palavra.palavraIndigina' => $pesquisa));
        return $this->db->get();
    }

    public function consultarPalavrasExiste($dados) {
        return $query = $this->db->get_where('palavra', array('palavraPortugues' => $dados['palavraPortugues'],
            'palavraIndigina' => $dados['palavraIndigina'],
            'idPovo' => $dados['idPovo'],
            'idLingua' => $dados['idLingua'],)
        );
    }

    public function obterPalavraId($id_palavra) {
        $this->db->select('*');
        $this->db->from('palavra');
        $this->db->join('lingua', 'lingua.idLingua = palavra.idLingua');
        $this->db->join('povo', 'povo.idPovo = palavra.idPovo');
        $this->db->where(array('idPalavra' => $id_palavra));
        return $this->db->get();
    }

    public function obterAutorPalavra($id_palavra) {
        $this->db->select('*');
        $this->db->from('palavra');
        $this->db->join('usuario', 'usuario.idUsuario = palavra.idUsuario');
        $this->db->where(array('idPalavra' => $id_palavra));
        return $this->db->get();
    }

    public function salvarNovaPalavra($dados) {
        $this->db->insert('palavra', $dados);
    }

    public function alterarPalavra($dados, $id_palavra) {
        $this->db->where('idPalavra', $id_palavra);
        $this->db->update('palavra', $dados);
    }

    public function excluirPalavra($id_palavra) {
        $this->db->delete('palavra', array('idPalavra' => $id_palavra));
    }

}
