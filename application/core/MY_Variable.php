<?php

/**
 * Description of MY_Variable una variable es una caracteristica del
 * cuadro estadistico, con ayuda de estos crearemos filtros.
 *
 * @author anb
 */
class MY_Variable {
    
    const TIPO_ENTERO = 1;
    const TIPO_REAL = 2;
    const TIPO_BINARIO = 3;
    const TIPO_CADENA = 4;
    const TIPO_LISTA = 5;
    const NOMBRE_KEY = 'variable_';
    const TABLA_LISTA = 'tabla_lista_';
    
    private $id_variable;
    private $nombre;
    private $nombre_key;
    private $value_data;
    private $patron_a_validar;
    private $tabla_lista;
    private $activo;
    
    /**
     * 
     * @param Mix $data 
     * - Array
     * - String
     */
    public function __construct($data) {
        if (is_array($data)) {
            $this->id_variable = $data['id_variable'];
            $this->nombre = $data['nombre'];
            $this->nombre_key = MY_Variable::NOMBRE_KEY . $data['id_variable'];
            $this->value_data = $data['value_data'];
            $this->patron_a_validar = $data['patron_a_validar'];
            $this->tabla_lista = MY_Variable::TABLA_LISTA . $data['id_variable'];
            $this->activo = $data['activo'];
        } else if (is_string($data)) {
           $this->id_variable = $data; 
        } else {
            echo "error"; exit;
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
    
    public static function validarTipoLista($data) {
        // {value1,value2}
        
        
        
    }
    
}
