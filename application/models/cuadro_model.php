<?php

/**
 * Description of cuadro_model
 *
 * @author anb
 */
class Cuadro_model  extends CI_Model {
    
    protected $_name = 'ac_cuadros';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function insertar(array $cuadro = array())
    {   
        $this->db->insert($this->_name, $cuadro);
        $insert_id = $this->db->insert_id();        
        return $insert_id;
    }
    
}
