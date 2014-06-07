<?php
/**
 * Description of App_cuadro
 *
 * @author anb
 */
class App_cuadro {
    
    private $id_cuadro = null;
    private $id_objetivo = null;
    private $titulo = null;
    private $creado_por = null;
    private $table_cuadro = null;

    const TABLA_CUADRO = 'tabla_cuadro_';
    
    public function App_cuadro($data = '') {
        
        if (is_array($data)) { // no usado x el momento.
            $this->id_cuadro = $data['id_cuadro'];
            $this->id_objetivo = $data['id_objetivo'];
            $this->titulo = $data['titulo'];
            $this->creado_por = $data['creado_por'];
            $this->table_cuadro = $data['table_cuadro'];
           
        } else if (is_numeric($data)) {
           $this->id_cuadro = $data;           
           $this->table_cuadro = self::TABLA_CUADRO . $data;
        }         
    } 
    
    public function getId_cuadro() {
        return $this->id_cuadro;
    }

    public function getId_objetivo() {
        return $this->id_objetivo;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getCreado_por() {
        return $this->creado_por;
    }

    public function getTable_cuadro() {
        return $this->table_cuadro;
    }

    public function setId_cuadro($id_cuadro) {
        $this->id_cuadro = $id_cuadro;
    }

    public function setId_objetivo($id_objetivo) {
        $this->id_objetivo = $id_objetivo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setCreado_por($creado_por) {
        $this->creado_por = $creado_por;
    }

    public function setTable_cuadro($table_cuadro) {
        $this->table_cuadro = $table_cuadro;
    }

    // ----------------------------------------------------------------------//
    // validacion y otras ayudas
    /**
     *  Formato para usar en $this->dbforge->add_field($fields);
     * @return array
     */
    public static function getFieldTable()
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
    
    /**
     * Public no static : para usar funciones de ayuda.
     * @param type $id_cuadro
     * @param array $dataVariables
     * @return type
     */
    public function formatToArrayForCuadroVariables(array $dataVariables)
    {/*
[variableData] => Array
        (
            [0] => sexo|LISTA|1:4
            [1] => tipo de gestion|LISTA|1:3
            [2] => area geografica|LISTA:5
        )        
        */
        $id_cuadro = $this->id_cuadro;
        $arreglo = array();
        if (!empty($id_cuadro) && count($dataVariables) > 0) {
            foreach ($dataVariables as $key => $value) {
            $arreglo[$key]['id_cuadro'] = $id_cuadro;
            $arreglo[$key]['id_variable'] = $this->_obtenerIdVariable($value);
            $arreglo[$key]['es_lista_multiple'] = $this->_obtenerEsListaMultiple($value);
            }
        }
        
        // dar formato para insert CI
        foreach ($arreglo as $key => $value) {
            
        }
        
        
        return $arreglo;        
    }
    
    /**
     * Obtener id siguiendo el patro : 
     *      [1] = sexo|LISTA|1:4
     *      [2] = tipo de gestion|LISTA|1:3
     * @param type $string
     * @return type
     */
    private function _obtenerIdVariable($string)
    {
        $data = preg_split("/:/", $string);
        return isset($data[1]) ? $data[1] : false;
    }
    
    /**
     * Filtra si es LISTA y si es del tipo
     * - 0 = simple
     * - 1 = multiple
     * @param type $string formato sexo|LISTA|1:3
     * @return int
     */
    private function _obtenerEsListaMultiple($string)
    {  
        $return = null;
        $stringSplit = preg_split("/\|/", $string);        
        if (isset($stringSplit[1])) {
            $variableTipo = substr($stringSplit[1], 0,5);
            if ($variableTipo == App_variable::TIPO_LISTA_STRING) { 
                if(isset($stringSplit[2])) {
                    if(substr($stringSplit[2], 0,1) == '1') { // es lista multiple
                        $return = 1;
                    }                    
                } else {
                    $return = 0;
                }
            }
        }
        return $return;        
    }       
}

    