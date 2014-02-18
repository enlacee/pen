<?php

class Usuario_model  extends CI_Model {
    
    protected $_name = 'ac_usuarios';
    const ACTIVO = 1;
    const INACTIVO = 0;
    
    private $_es_super_usuario = 1;

    public function __construct()
    {
        parent::__construct();
    }
    
    public function auth($login, $pswd, $type = false)
    {   
        $dataUsuario = $this->_getUsuario($login, $pswd); 
        return $dataUsuario;
    }
    
    /**
     * Obtener datos de superUsuario
     */
    private function _getUsuario($login, $pswd)
    {
        $this->load->database();
        $sql = $this->db->query('
        SELECT 
        id_usuario,
        email,
        pswd,
        nombre,
        apellido,
        es_super_usuario,
        fecha_registro
        FROM '. $this->_name .'
        WHERE email = "' . $login . '" AND pswd = "' . $pswd . '"'
        );
        
        return $sql->result_array();        
    }
}
