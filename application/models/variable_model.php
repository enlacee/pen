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
        $this->db->trans_start(); 
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
                //registrar ac_tabla_lista_xxx
                $objVariable->setValue_data($variable['value_data']);                
                //crear tabla
                $this->dbforge->add_field(App_variable::getFieldTableLista());
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->drop_table($objVariable->getTabla_lista());
                $this->dbforge->create_table($objVariable->getTabla_lista());                
                //insert data
                $registrosLista = $objVariable->getValuesInArrayFormatInsert();
                //echo "ver dataaa "; echo"<pre>"; print_r($registrosLista); echo "<hr>"; var_dump($registrosLista); exit;
                $this->db->insert_batch($objVariable->getTabla_lista(), $registrosLista); 
                
                
                
                //$this->dbforge->create_table($objVariable->getTabla_lista());
            }
            $this->actualizar($variable); 
            //03 : registrar tabla (lista) = value_data
            
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
