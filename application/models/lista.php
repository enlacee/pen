<?php

class Lista_model  extends CI_Model {
    
    protected $_name = 'ac_lista';

    public function __construct()
    {
        parent::__construct();
    }
    
    public function insertar($data)
    {   
        $this->db->insert($this->_name, $data);
        return $this->db->insert_id();        
    }
}
