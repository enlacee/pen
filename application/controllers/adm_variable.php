<?php
/**
 * Description of adm_variable
 *
 * @author anb
 */
class Adm_variable extends MY_Controller {
    
    public function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    
    /**
     * lista de variables creadas para los cuadros estadisticos
     */
    public function index()
    {
        $this->load->library('layout');        
        $data['titulo'] = "Variables";        
        $data['mensajeBox'] = $this->session->flashdata('mensajeBox');
        $this->loadJqgrid();        
        $this->loadStatic(array("js"=>"js/module/adm-variable/index.js"));
        $this->layout->view('adm-variable/index', $data);
    }

    /**
     * 
     */
    public function nuevo()
    {   
        $this->load->helper('form');        
        $this->load->library('form_validation');
        $this->load->library('app_variable');
        $data['titulo'] = "Nueva Variable";
        $dataLibrary = $this->loadStatic(array('js' => "js/module/adm-variable/nuevo.js"));
        
        if ($this->input->post()) { 
            $this->_nuevoValidarForm($this->input->post('tipo_variable'));
            if ($this->form_validation->run() == false) {
                // error en alguna validacion
            } else {                
                $this->_registrarVariable();
                $this->session->set_flashdata('mensajeBox', 'Se registro corectamente la variable: <strong>'.$this->input->post('nombre', true).'</strong>');
                redirect('adm_variable/index');
            }
        }
        
        $this->layout->view('adm-variable/nuevo', array_merge($data, $dataLibrary));
    }
    
    /**
     * Validar formulario segun CI
     */
    private function _nuevoValidarForm($tipo_variable)
    {   
        $this->form_validation->set_rules('nombre','Nombre','trim|required|min_length[2]|maxlength[80]');
        $this->form_validation->set_rules('tipo_variable','Tipo Variable','required');
        if (App_variable::TIPO_LISTA == $tipo_variable) {
            $this->form_validation->set_rules('value', 'Valor','trim|required|callback_value_check');
        }
        $this->form_validation->set_rules('patron_a_validar');        
    }
    
    private function _registrarVariable()
    {   
        $this->load->model('Variable_model');
        $this->load->dbforge();
        
        $variable = array();
        $variable['nombre'] = $this->input->post('nombre', true);
        $variable['tipo_variable'] = $this->input->post('tipo_variable');
        $variable['value_data'] = $this->input->post('value');
        $variable['patron_a_validar'] = $this->input->post('patron_a_validar');
        $variable['nombre_key'] = '';
        $variable['fecha_registro'] = date('Y-m-d h:i:s');
      
        return $this->Variable_model->insertar($variable);       
    }
    
    /**
     * lista de variables (busqueda con 1 paramaetro)
     * ojo error con GET
     */
    public function jsonListaVariable()
    {   
        $this->load->model('Variable_model');
        
        if ($this->input->post()) {
            $term = $this->input->post('term');
            $data = $this->Variable_model->buscar($term);
            $json = array(); 
            foreach ($data as $key => $value) {
                $json[$value['id_variable']] = $value['nombre'] . "|". $value['tipo_variable'];
            }            
            /*$json = array (array('value' => '1', 'key' => 'rios'));*/
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($json));
        }
    }


    /** ------------------------------------------------------------------------
     * Validacion de datos segun codeigniter
     * @param type $str
     * @return boolean
     */
    public function value_check($str)
    {
        if (!preg_match('#^{(\w+.*)(,)*}$#i', $str) && !empty($str)) {
            $this->form_validation->set_message('value_check', 'El campo %s no es valido con este formato: {valor1,valor2}');
            return FALSE;
        } else {
            return TRUE;
        }        
    }
    
    /**
     * Listar variables
     */
    public function jqlistar()
    {   
        $this->load->model('Variable_model');
        $responce = new stdClass();
        
        $page = $this->input->get('page');
        $limit = $this->input->get('rows');
        $sidx = $this->input->get('sidx');
        $sord = $this->input->get('sord');
        if (!$sidx) $sidx = 1;        

        $dataGridString = null;
        if (isset($_GET['searchField']) && ($_GET['searchString'] != null)) {
            $operadores["eq"] = "=";
            $operadores["ne"] = "<>";
            $operadores["lt"] = "<";
            $operadores["le"] = "<=";
            $operadores["gt"] = ">";
            $operadores["ge"] = ">=";
            $operadores["cn"] = "LIKE";
            if ($_GET['searchOper'] == "cn") {
                $dataGridString = $_GET['searchField'] . " " . $operadores[$_GET['searchOper']] . " '%" . $_GET['searchString'] . "%' ";
            } else {
                $dataGridString = $_GET['searchField'] . " " . $operadores[$_GET['searchOper']] . "'" . $_GET['searchString'] . "'";
            }                
        }        
        $count = $this->Variable_model->jqListar($dataGridString, true);
        
        if ($count > 0) {
            $total_pages = ceil($count/$limit);
        } else {
           $total_pages = 0; 
        }
        if ($page > $total_pages) $page = $total_pages;
        $start = $limit * $page - $limit;         

        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        
        $dataGrid = array (
            'oderby' => array('sidx' => $sidx, 'sord' => $sord),
            'limit' => $limit,
            'start' => $start,
            'string' => $dataGridString);        
        $result = $this->Variable_model->jqListar($dataGrid);
        $i = 0;
        while (list($clave, $row) = each($result)) {
            $responce->rows[$i]['id'] = $row['id_variable'];
            $responce->rows[$i]['cell'] = array(
                $row['id_variable'],
                $row['nombre'],
                $row['tipo_variable'],
                $row['fecha_registro']);
            $i++;        
        }
        
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($responce));
    }
    
    /**
     * Edicion de datos
     */
    public function jqeditar()
    {    
        if($this->input->post()) {            
            if(!empty($this->input->post('id'))) {
                $dataUpdate = array('nombre' => $this->input->post('nombre'));
                $where = "id_variable = ".$this->input->post('id');
                $this->db->update( 'ac_variables', $dataUpdate, $where);
            }
        }
    }    
}
