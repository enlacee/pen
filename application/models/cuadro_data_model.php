<?php

/**
 * Description of cuadro_data_model
 *
 * @author anb
 */
class Cuadro_data_model extends CI_Model {
    
    public $cuadro = null;
    private $numVariables = null;
    private $nombre_tabla = null;

    public function __construct($id = null) {
        parent::__construct();
        
        if (!empty($id)){
            $this->cuadro = $this->_listarDataCuadro($id);            
            $this->numVariables = count($this->cuadro);
            $this->_vincularDatos();
        }
        return $this->cuadro;
    }
    
    public function getNumVariables()
    {
        return $this->numVariables;
    }
    
    /**
     * Objener 1 registro de la tabla Cuadro dinamico
     * y agregar dichos valores al objeto.
     * @param Integer $idRegistro id de la tabla dinamica
     * @param Boolean $addObj
     * @return Array data
     */
    public function getRegistro($idRegistro, $addObj = false)
    {
        $this->db->select()->from($this->getNombreTabla());
        $query = $this->db->where('id', $idRegistro)->limit(1)->get();
        $dataRegistro = $query->row_array();
        
        // asociacion directa.
        if ($addObj == true) {            
            foreach ($this->cuadro as $indice => $obj) {                
                $obj->data_por_registro = $dataRegistro[$obj->nombre_key];           
            }        
        }        
        return $dataRegistro;
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
        $rs = null;
        if (!empty($ac_tabla_lista_id)) {
            $keyCache = __CLASS__ . __FUNCTION__ .'_'. $ac_tabla_lista_id;

            if (($rs = $this->cache->file->get($keyCache)) == false ) {
                $tabla = $this->db->dbprefix($ac_tabla_lista_id); 
                $rs = $this->db->select()->from($tabla)->get()->result_array();
                $rs = $this->_formatearArraySimple($rs);
                $this->cache->file->save($keyCache, $rs, 600); 
            }
        }
        return $rs;
    }
    
    /*
     * Formato de array db a array simple
     * array
        (
            [0] => Array([id] => 1 [value] => M)
            [1] => Array([id] => 2 [value] => F)
        )
     */
    private function _formatearArraySimple($data)
    {
        $new = array();
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $new[$value['id']] = $value['value'];            
            }
        }
        return $new;
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
    
    /**
     * obtener nombre de la tabla del cuadro estadistico 'generado'.
     */
    public function getNombreTabla()
    {   
        if ($this->nombre_tabla == null) {
            $nombre = null;
            foreach ($this->cuadro as $indice => $obj) {
                $nombre = $obj->table_cuadro;
                break;
            }
            $this->nombre_tabla = $this->db->dbprefix($nombre);
        }            

        return $this->nombre_tabla;
    }
    
    //--------------------------------------------------------------------------
    //--------------------------------------------------------------------------
    /**
     * function de generacion de data para el Cuadro Dinamico.
select * from ac_tabla_cuadro_1
inner join ac_tabla_lista_6 on ac_tabla_cuadro_1.variable_6 = ac_tabla_lista_6.id -- si es LISTA      
     */
    public function jqListar()
    {   
        $this->cuadro;
        $campos = array();
        $tablaPadre = $this->getNombreTabla();
        
        $select_1 = "$tablaPadre.id";
        $campos[0] = array('id' => $select_1, 'alias' => 'id', 'title' => 'ID');
        //--  
        
        $this->db->select($select_1);        
        $this->db->from($tablaPadre);
        $c = 1;
        foreach ($this->cuadro as $indice => $obj) {
            if (Variable_model::TIPO_LISTA_STRING == $obj->tipo_variable) {
                $tableLista = $this->db->dbprefix($obj->table_lista);
                $stringJoin = $tablaPadre .".".$obj->nombre_key . " = " . "$tableLista.id";
                $select_2 = "$tableLista.value AS ". $obj->nombre_key .'_'.Variable_model::TIPO_LISTA_STRING;
                
                $campos[$c] = array(
                    'id' => "$tableLista.value",
                    'alias' => $obj->nombre_key .'_'.Variable_model::TIPO_LISTA_STRING,
                    'title' => $obj->nombre);                                
                $this->db->join($tableLista, $stringJoin);
                $this->db->select($select_2);
               
            } else {                
                $select_3 = $tablaPadre .".".$obj->nombre_key;                
                $campos[$c] = array(
                    'id' => $select_3,
                    'alias' => $obj->nombre_key,
                    'title' => $obj->nombre);                
                $this->db->select($select_3);  
            }
            $c++;
        }
        $rs = array (
            'data' => $this->db->get()->result_array(),
            'campos' => $campos);
        
        return $rs;
    }    
}
