<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ususario_model
 *
 * @author hairton
 */
class Usuario_model extends CI_Model {

    function obterUsuarioLogin($dados) {
        return $this->db->get_where('usuario', $dados);
    }

    function obter_todos_usuario() {
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->join('tipo_usuario', 'usuario.idTipoUsuario = tipo_usuario.idTipoUsuario');
        $this->db->where('usuario.idTipoUsuario >', 0);
        return $this->db->get();
    }

    function alterar_dados_usuario($dados,$id_usuario){
        $this->db->where('idUsuario',$id_usuario);
        $this->db->update('usuario', $dados);
    }
    
    function inserirNovoColaborador($dados){
        $this->db->insert('usuario',$dados);
    }
    
    
}

?>
