<?php

class Variable_model  extends CI_Model {
    
    protected $_name = 'ac_variables';
    const TIPO_ENTERO = 1;
    const TIPO_REAL = 2;
    const TIPO_BINARIO = 3;
    const TIPO_CADENA = 4;
    const TIPO_LISTA = 5;
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * 
     * @param array $data
     * @return Integer Id autonumerico
     */
    public function insertar(array $variable = array())
    {   
        $this->db->trans_begin();
        try {
            // 01 : registrar
            $this->db->insert($this->_name, $variable);
            $insert_id = $this->db->insert_id();
            //02 : actualizar
            $objVariable = new App_variable($insert_id);
            $variable['id_variable'] = $objVariable->getId_variable();
            $variable['nombre_key'] = $objVariable->getNombre_key();            
            if ($variable['tipo_variable'] == App_variable::TIPO_LISTA) {
                $variable['table_lista'] = $objVariable->getTabla_lista();
                $variable['patron_a_validar'] = '';
                //03 :
                $objVariable->setValue_data($variable['value_data']);
                $this->dbforge->add_field(App_variable::getFieldTableLista());
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->drop_table($objVariable->getTabla_lista());
                $this->dbforge->create_table($objVariable->getTabla_lista());                
                //insert data
                $registrosLista = $objVariable->getValuesInArrayFormatInsert();
                $this->db->insert_batch($objVariable->getTabla_lista(), $registrosLista);
            }
            $this->actualizar($variable);
            $this->db->trans_commit();
            
        } catch (Exception $exc) {            
            log_message($exc->getTraceAsString());
            $this->db->trans_rollback();
        }   
            
        $this->db->trans_complete();        
        return $insert_id;
    }
    
    public function actualizar(array $data = array())
    {   
        $id_variable = 'id_variable';
        if (array_key_exists($id_variable, $data) && !empty($data[$id_variable])) {
            $this->db->where($id_variable, $data[$id_variable]);
            unset($data[$id_variable]);
            $this->db->update($this->_name ,$data);
        }        
    }
}
