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
class Povo_model extends CI_Model {

    public function obter_todos_povo() {
        return $this->db->get('povo');
    }

    public function obter_povo_id($id_povo) {
        return $this->db->get_where('povo', array('idPovo' => $id_povo));
    }

    public function inserirPovo($dados) {
        $this->db->insert('povo', $dados);
    }

    public function alterarPovo($dados, $id_povo) {
        $this->db->where('idPovo', $id_povo);
        $this->db->update('povo', $dados);
    }

    public function excluirPovo($id_povo) {
        $this->db->delete('povo', array('idPovo' => $id_povo));
    }

}
