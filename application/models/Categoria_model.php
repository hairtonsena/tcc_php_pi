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
class Categoria_model extends CI_Model {

    public function obter_todos_tipo() {
        return $this->db->get('tipo_palavra');
    }

    public function obter_lingua_pesquisa($pesquisa){
        $this->db->like("nomeLingua",$pesquisa);
        $this->db->or_like("obsLingua",$pesquisa);
        return $this->db->get("lingua");
    }

        public function obter_todas_lingua_ativas(){
        return $this->db->get_where('lingua',array('statusLingua'=>1));
    }

        public function obter_lingua_id($id_lingua){
        return $this->db->get_where('lingua',array('idLingua'=>$id_lingua));
    }

    public function obter_palavras_por_lingua($id_lingua){
        return $this->db->get_where('palavra',array("idLingua"=>$id_lingua));
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
