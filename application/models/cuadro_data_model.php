<?php

/**
 * Description of cuadro_data_model
 *
 * @author anb
 */
class Cuadro_data_model extends CI_Model {
    
    private $cuadro = null;
    private $numVariables = null;

    public function __construct($id = null) {
        parent::__construct();
        
        if (!empty($id)){
            $this->cuadro = $this->_listarDataCuadro($id);            
            $this->numVariables = count($this->cuadro);
            $this->_vincularDatos();
        }        
    }
    
    public function getNumVariables()
    {
        return $this->numVariables;
    }
    
    /**
     * Agrega datos si es una variable TIPO LISTA
     */
    private function _vincularDatos()
    {
        $arreglo = $this->cuadro;
        foreach ($arreglo as $indice => $obj) {                        
            if ($obj->tipo_variable == Variable_model::TIPO_LISTA_STRING) {
                $obj->value_data_tabla = $this->_listarSegunTipo($obj->table_lista);
            }            
        }
    }
    
    /**
     * Lista de toda la tabla
     * @param type $ac_tabla_lista_id
     * @return type
     */
    private function _listarSegunTipo($ac_tabla_lista_id)
    {   
        $keyCache = __CLASS__ . __FUNCTION__ .'_'. $ac_tabla_lista_id;
        
        if (($rs = $this->cache->file->get($keyCache)) == false ) {
            $tabla = $this->db->dbprefix($ac_tabla_lista_id); 
            $rs = $this->db->select()->from($tabla)->get()->result_array();
            $this->cache->file->save($keyCache, $rs, 600); 
        }
        return $rs;
    }
    
    /*
     * lista de datos x cache
     */
    private function _listarDataCuadro($id)
    {
        $keyCache = __CLASS__ . __FUNCTION__ .'_'. $id;        
        
        if (($rs = $this->cache->file->get($keyCache)) == false ) {
            $this->db->select('*');
            $this->db->from('ac_cuadros as c');
            $this->db->join('ac_cuadros_variables as cv', 'c.id_cuadro = cv.id_cuadro');
            $this->db->join('ac_variables as v', 'cv.id_variable = v.id_variable');
            $this->db->where('c.id_cuadro',$id);      
            $rs = $this->db->get()->result();            
            $this->cache->file->save($keyCache, $rs, 600); 
        }
        return $rs;
    }
}
