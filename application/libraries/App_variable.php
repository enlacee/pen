<?php

/**
 * Description of App_variable una variable es una caracteristica del
 * cuadro estadistico, con ayuda de estos crearemos filtros.
 *
 * @author anb
 */
class App_variable {
    
    const TIPO_ENTERO = 1;
    const TIPO_REAL = 2;
    const TIPO_BINARIO = 3;
    const TIPO_CADENA = 4;
    const TIPO_LISTA = 5;
    const NOMBRE_KEY = 'variable_';
    const TABLA_LISTA = 'tabla_lista_';
    
    private $id_variable = null;
    private $nombre = null;
    private $nombre_key = null;
    private $value_data = null;
    private $patron_a_validar = null;
    private $tabla_lista = null;
    private $activo = null;    

    /**
     * Solo si dato es numero o array construira en parte el objeto
     * @param Mix $data 
     * - Array
     * - String
     */
    public function App_variable($data = '') {
        
        if (is_array($data)) {
            $this->id_variable = $data['id_variable'];
            $this->nombre = $data['nombre'];
            $this->nombre_key = self::NOMBRE_KEY . $data['id_variable'];
            $this->value_data = $data['value_data'];
            $this->patron_a_validar = $data['patron_a_validar'];
            $this->tabla_lista = self::TABLA_LISTA . $data['id_variable'];
            $this->activo = $data['activo'];
        } else if (is_numeric($data)) {
           $this->id_variable = $data;
           $this->nombre_key = self::NOMBRE_KEY . $data;
           $this->tabla_lista = self::TABLA_LISTA . $data;
        } else {
            //echo "error : ".__CLASS__; exit;
        }         
    }

    public function getId_variable() {
        return $this->id_variable;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getNombre_key() {
        return $this->nombre_key;
    }

    public function getValue_data() {
        return $this->value_data;
    }

    public function getPatron_a_validar() {
        return $this->patron_a_validar;
    }

    public function getTabla_lista() {
        return $this->tabla_lista;
    }

    public function getActivo() {
        return $this->activo;
    }

    public function setId_variable($id_variable) {
        $this->id_variable = $id_variable;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setNombre_key($nombre_key) {
        $this->nombre_key = $nombre_key;
    }

    public function setValue_data($value_data) {
        $this->value_data = $value_data;
    }

    public function setPatron_a_validar($patron_a_validar) {
        $this->patron_a_validar = $patron_a_validar;
    }

    public function setTabla_lista($tabla_lista) {
        $this->tabla_lista = $tabla_lista;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
    }
    
    // ----------------------------------------------------------------------//
    // validacion y otras ayudas
    
    /**
     * 
     * @param string $string cadena con formato {value,value}
     * @return Array datos en un arreglo simple.
     */
    public function getValuesInArray($string = '')
    {
        //crear data
        if (!empty($this->getValue_data()) || !empty ($string)) {
            if (!empty($this->getValue_data())) {
                $string = $this->limpiarCadenaLista($this->getValue_data());            
            } elseif(!empty ($string)) {
                $string = $this->limpiarCadenaLista($string);
            } 
            $string = preg_split('#,#', $string);
        } else {
            $string = false;
        }
        
        return $string;
    }
    
    /**
     * Obteger array con formato para guardar directo en la tabla
     * @return type
     */
    public function getValuesInArrayFormatInsert()
    {
        $array = $this->getValuesInArray();
        $new = array();
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                $new[] = array('value' => $value);
            }
            return $new;
        }
        return $array;
    }
    
    /**
     *  Formato para usar en $this->dbforge->add_field($fields);
     * @return array
     */
    public static function getFieldTableLista()
    {
        $fields = array(
              'id' => array(
                  'type' => 'INT',
                  'constraint' => 6,
                  'unsigned' => TRUE,
                  'auto_increment' => TRUE
              ),
              'value' => array(
                  'type' => 'VARCHAR',
                  'constraint' => '50',
              )
          );
        
          return $fields;
    }
    
    private function limpiarCadenaLista($str)
    {
        $str = str_replace("\t", "", $str);        
        $str = str_replace("{", "", $str);
        $str = str_replace("}", "", $str);
        
        return $str;
    }
    
}
