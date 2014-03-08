<?php

/**
 * Description of tabla_cuadro
 *
 * @author anb
 */
class Tabla_cuadro  extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index($idCuadro)
    {
        $this->load->model('Variable_model');
        $this->load->model('Cuadro_data_model');
        $this->load->driver('cache');
        $this->load->library('app_jqgrid');        
        
        $objCuadro = new Cuadro_data_model($idCuadro);            
        $result = $objCuadro->jqListar();
        $campos = $result['campos'];
        
        $dataObj = array(            
            'idHead' => '#list',
            'idPager' => '#pager',
            'url' => '/some/url',
            'colNames' => array_keys($this->_getIdColumnas($campos, 'title')),
            'colModel' => array_keys($this->_getIdColumnas($campos, 'alias')),
            'sortname' => 'id',
            'sortorder' => 'asc'
        );
        $data = array(
            'titulo' => 'tabla cuadro dinamico',
            'mensajeBox' => $this->session->flashdata('mensajeBox'),
            'idCuadro' => $idCuadro
        );
        $objJqgrid = new App_jqgrid($dataObj);
        $this->loadJqgrid();
        $this->loadStatic(array("jstring" => $objJqgrid->getGrid_1()));
        $this->layout->view('tabla-cuadro/index', $data);        
    }
    
    public function nuevo($idCuadro)
    {   $this->_validarNumero("xxx", "1,2,3");
        $this->load->model('Variable_model');
        $this->load->model('Cuadro_data_model');
        $this->load->driver('cache');
        $this->load->helper('form');        
        $this->load->library('form_validation');
        
        $objCuadro = new Cuadro_data_model($idCuadro);    
        $data = array(
            'titulo' => 'Cuadro Usuario',
            'mensajeBox' => $this->session->flashdata('mensajeBox'),
            'idCuadro' => $idCuadro,
            'objCuadro' => $objCuadro
        );           

        $dataPost = $this->input->post();
        if ($dataPost) {                
            $id_cuadro = (int) $this->input->post('id_cuadro');            
            if ($id_cuadro > 0) {
                $this->_validarForm($objCuadro);
                if ($this->form_validation->run() == false) {
                    // error en alguna validacion       
                } else {
                    unset($dataPost['id_cuadro']);
                    $this->db->insert($objCuadro->getNombreTabla(), $dataPost);
                    $this->session->set_flashdata('mensajeBox', 'Se registro corectamente  en el cuadro: <strong>' . $idCuadro . '</strong>');
                    redirect("tabla_cuadro/index/$idCuadro");                     
                    exit;
                }
            }
        }  
        
        $this->layout->view('tabla-cuadro/nuevo', $data);
    }
    
    /*
     * Validar formulario de acuerdo al objeto cuadro.
     * - lista : diferente de cero
     * - cadena+otros : campo requerido
     * falta implementar otras validaciones en BACK.
     */    
    private function _validarForm($objCuadro)
    {   
        foreach ($objCuadro as $indice => $arreglo) {
            foreach ($arreglo as $key => $obj){
                if ($obj->tipo_variable == Variable_model::TIPO_LISTA_STRING) {
                    $this->form_validation->set_rules($obj->nombre_key,$obj->nombre,'required|callback_value_check');
                } else if ($obj->tipo_variable == Variable_model::TIPO_ENTERO_STRING) {
                    
                } else {
                   $this->form_validation->set_rules($obj->nombre_key,$obj->nombre,'trim|required'); 
                }       
            }       
        }        
    }
    
    /**
     * Validacion de datos segun codeigniter
     * Solo admite numeros de con digitos del [1-9]
     * @param type $str
     * @return boolean
     */    
    public function value_check($str)
    {
        if (!preg_match('#^[1-9].*$#', $str)) {
            $this->form_validation->set_message('value_check', 'El campo %s no es valido 0.');
            return FALSE;
        } else {
            return TRUE;
        }        
    }
    
    //--------------------------------------------------------------------------
    //--------------------------------- JQGRID ---------------------------------    
    public function jqlistar()
    {
        $this->load->model('Variable_model');
        $this->load->model('Cuadro_data_model');
        $this->load->driver('cache');
        $idCuadro = $this->input->get('id_cuadro');
        if (preg_match('#^[1-9].*$#', $idCuadro)) {     
            $responce = new stdClass();
            $objCuadro = new Cuadro_data_model($idCuadro);            
            $result = $objCuadro->jqListar();
            
            $i = 0;
            while (list($clave, $row) = each($result['data'])) {
                $responce->rows[$i]['id'] = $row['id'];
                /*$responce->rows[$i]['cell'] = array(
                    $row['id'],
                    $row['titulo'],
                    $row['fecha_registro'],
                    $link);
                */
                $responce->rows[$i]['cell'] = $this->_ayudaJqlistar($row, $result['campos']); 
                $i++;        
            }

            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($responce));
        }
    }
    
    /*
     * array simple para los dos parametros con el mismo KEY
     * NOTA: el orden de los 2 array tiene que ser la misma.
     * el select modelo 'objCuadro->jqListar()' es quien crea.. 
     */
    private function _ayudaJqlistar($row, $columnas)
    {
        $arregloVacio = $this->_getIdColumnas($columnas, 'alias');
        foreach ($arregloVacio as $key => $value) {
            $arregloVacio[$key] = isset($row[$key]) ? $row[$key] : null;
        }        
        return $arregloVacio;
    }    
    
    /**
     * Obtener la columna indicada segun sea conveniente
     * Array
        (
            [id] => ac_tabla_lista_6.value
            [alias] => variable_6_LISTA
            [title] => Sexo
        )
     * @param array $columnas
     * @return null
     */
    private function _getIdColumnas(array $columnas, $keyColumna = 'alias')
    {
        $envace = array();
        foreach ($columnas as $key => $arreglo) {
            foreach ($arreglo as $indice => $valor) {                
                if ($indice == $keyColumna) {
                    $envace[$valor] = null;
                    break;
                }   
            }
        }
        return $envace;
    }
    
    //--------------------------------------------------------------------------
    /**
     * Only Delete
     * @return type
     */
    public function jqeditar()
    {
        $this->load->model('Variable_model');
        $this->load->model('Cuadro_data_model');
        $this->load->driver('cache');        
        
        if($this->input->post()) {
            $id = $this->input->post('id');            
            if(empty($id)) {echo "return"; return; }
            
            $where = "id = $id";
            $responce = false;
            if ($this->input->post('oper') == 'edit') {
               // $dataUpdate = array('titulo' => $this->input->post('titulo'));
                
            } else if ($this->input->post('oper') == 'del') {
                $idCuadro = $this->input->get('id_cuadro');
                
                if (preg_match('#^[1-9].*$#', $idCuadro)) {                    
                    $objCuadro = new Cuadro_data_model($idCuadro);
                    $this->db->delete($objCuadro->getNombreTabla(), $where);
                    $responce = true;
                }
                $this->output->set_content_type('application/json');
                $this->output->set_output(json_encode($responce));
            }
        }
    }
}
