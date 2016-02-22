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
class Lingua_model extends CI_Model {

    public function obter_todas_lingua() {
        return $this->db->get('lingua');
    }

    public function obter_lingua_id($id_lingua){
        return $this->db->get_where('lingua',array('idLingua'=>$id_lingua));
    }

    public function inserirLingua($dados){
        $this->db->insert('lingua',$dados);
    }
    
    public function alterarLingua($dados,$id_lingua){
        $this->db->where('idLingua',$id_lingua);
        $this->db->update('lingua',$dados);
    }
    
    public function excluirLingua($id_lingua){
        $this->db->delete('lingua',array('idLingua'=>$id_lingua));
    }
    
}
