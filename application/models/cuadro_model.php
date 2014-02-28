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
        $this->db->trans_begin();
        try {
            // 01 : cuadro
            $dataVariableData = $cuadro['variableData'];
            if(isset($cuadro['variableData'])){ unset($cuadro['variableData']); }
            $this->db->insert($this->_name, $cuadro);
            $id_cuadro = $this->db->insert_id();

            // 02 : cuadro variables
            $objCuadro = new App_cuadro($id_cuadro);
            $cuadros_variables = $objCuadro->formatToArrayForCuadroVariables($dataVariableData);
            $this->db->insert_batch('ac_cuadros_variables', $cuadros_variables);

            $cuadro['id_cuadro'] = $id_cuadro;
            $cuadro['table_cuadro'] = $objCuadro->getTable_cuadro();
            $this->dbforge->add_field($this->_getFieldTableCuadro($cuadros_variables));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->drop_table($objCuadro->getTable_cuadro());
            $this->dbforge->create_table($objCuadro->getTable_cuadro());        

            // 03 : actializar cuadro
            $this->actualizar($cuadro);
            $this->db->trans_commit();
            
        } catch (Exception $exc) {
            log_message('error', 'Error en : '.__CLASS__.__FUNCTION__);
            log_message('error', $exc->getTraceAsString());
            $this->db->trans_rollback();
        }        
        return $id_cuadro;
    }
    
    /**
     * Ayuda para Crear una tabla dinamica. retorna Array con la estructura 
     * adecuada para la tala cuadro
     * @param Array $dataVariable n variables
     * @return array
     */       
    private function _getFieldTableCuadro(array $cuadros_variables)
    {
        $fields = array(
              'id' => array(
                  'type' => 'INT',
                  'constraint' => 6,
                  'unsigned' => TRUE,
                  'auto_increment' => TRUE
                  )
          );        

        $fieldNews = array();        
        foreach ($cuadros_variables as $key => $value) {
            if($value['es_lista_multiple'] === null) { //VARCHAR
                $fieldNews['variable_' . $value['id_variable']] = array (
                    'type' => 'VARCHAR',
                    'constraint' => '20'                   
                );                
            } else if ($value['es_lista_multiple'] === 1 || $value['es_lista_multiple'] === 0) {
                $fieldNews['variable_' . $value['id_variable']] = array (
                    'type' => 'INT',
                    'constraint' => 6                   
                );                
            }
        }        
        return array_merge($fields, $fieldNews);
    }    
       
    
    public function actualizar(array $data = array())
    {   
        $id_variable = 'id_cuadro';
        if (array_key_exists($id_variable, $data) && !empty($data[$id_variable])) {
            $this->db->where($id_variable, $data[$id_variable]);
            unset($data[$id_variable]);
            $this->db->update($this->_name ,$data);
        }        
    }
    /**
     * 
     * @param String $dataGrid cadena SQL
     * @param Boolean $num_rows obtenero numero de filas
     * @return mix string or Array.
     */
    public function jqListar(array $dataGrid, $num_rows = false)
    {
        $rs = false; 
        // inicio filtro.pdre
        $this->db->where('id_objetivo', $dataGrid['id_objetivo']);   
        
        if ($num_rows === true) {
            if (!empty($dataGrid['string'])) {
                $this->db->where($dataGrid['string']);   
            }            
            
        } else {
            
            if (!empty($dataGrid['string'])) {
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
        
        $this->db->select('id_cuadro, id_objetivo, creado_por, titulo, fecha_registro');        
        $query = $this->db->get($this->_name); 
        //log_message('error', print_r($this->db->last_query(),true));        
        if ($num_rows === true) {            
            $rs = $query->num_rows();
        } else {
            $rs = $query->result_array();
        }
        
        return $rs;
    }    
    

}
