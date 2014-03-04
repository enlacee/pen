<?php

class Variable_model  extends CI_Model {
    
    protected $_name = 'ac_variables';
    const TIPO_ENTERO = 1;
    const TIPO_REAL = 2;
    const TIPO_BINARIO = 3;
    const TIPO_CADENA = 4;
    const TIPO_LISTA = 5;
    const TIPO_ENTERO_STRING = 'ENTERO';
    const TIPO_REAL_STRING = 'REAL';
    const TIPO_BINARIO_STRING = 'BINARIO';
    const TIPO_CADENA_STRING = 'CADENA';
    const TIPO_LISTA_STRING = 'LISTA';       
    
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
            log_message('error', 'Error en : '.__CLASS__.__FUNCTION__);
            log_message('error', $exc->getTraceAsString());
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
    
    /**
     * 
     * @param type $texto a buscar
     * @return Array lista de variables
     */
    public function buscar($texto = '')
    {
        if (!empty($texto)) {
            $query = "SELECT
                    id_variable,
                    tipo_variable,
                    nombre
                    FROM ac_variables 
                    WHERE nombre 
                    LIKE '%".$texto."%' LIMIT 7";
            $sql = $this->db->query($query);
            return $sql->result_array();
        }
    }
    
    public function jqListar($dataGrid, $num_rows = false)
    {   
        $rs = false;        
        if(is_string($dataGrid) && !empty($dataGrid)) {
            //$this->db->where('1=1'); 
            $this->db->where($dataGrid);            
        } elseif (is_array($dataGrid)) {
            
            if (isset($dataGrid['string']) && !empty($dataGrid)) {
               $this->db->where($dataGrid['string']);
               
            } else {                
                if (isset($dataGrid['oderby'])) {
                    $sidx = $dataGrid['oderby']['sidx'];
                    $sord = $dataGrid['oderby']['sord'];                
                    $this->db->order_by($sidx, $sord); 
                }            
                if (isset($dataGrid['limit'])) {
                    if ($dataGrid['limit'] && $dataGrid['start']) {
                        $this->db->limit($dataGrid['limit'], $dataGrid['start']);
                    }else {
                        $this->db->limit($dataGrid['limit']);
                    }
                }   
            }
        }
        
        $this->db->select('id_variable, nombre, tipo_variable, fecha_registro');        
        $query = $this->db->get($this->_name); 
        //log_message('error', print_r($this->db->last_query(),true));        
        if ($num_rows === true) {
            //$rs = $query->num_fields();
            $rs = $query->num_rows();
        } else {
            $rs = $query->result_array();
        }
        
        return $rs;
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function relacionConCuadros($id)
    {        
        $this->db->select("ac_variables.id_variable")->from($this->_name);
        $this->db->join('ac_cuadros_variables', "ac_variables.id_variable = ac_cuadros_variables.id_variable");
        $this->db->where("ac_variables.id_variable = $id");
        $this->db->limit(1);
        $query = $this->db->get();        
        return $query->num_rows();        
    }    
    
}
