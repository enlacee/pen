<?php

/**
 * Description of objetivo
 *
 * @author anb
 */
class Objetivo_model extends CI_Model {
    
    protected $_name = 'ac_usuarios';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Lista de objetivos para el usuario (administrador, usuario)
     * @return type
     */
    /*public function getObjetivos()
    {
        //$query = $this->db->get($this->_name, 10);
       // return $query->result_array();        
    }
    */
}
