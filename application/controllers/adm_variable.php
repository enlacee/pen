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
        $this->loadJqgrid();
        $dataLibrary = $this->loadStatic(array("js"=>"js/modules_grid/37array.js"));        
        $this->layout->view('adm-variable/index', array_merge($data, $dataLibrary));
    }

    /**
     * 
     */
    public function nuevo()
    {   
        $this->load->helper('form');        
        $this->load->library('form_validation');
          
        $data['titulo'] = "Nueva Variable";        
        $dataLibrary = $this->loadStatic(array('js' => "js/module/adm-variable/nuevo.js"));
        
        if ($this->input->post()) { 
            $this->_nuevoValidarForm();
            if ($this->form_validation->run() == false) {
                // error en alguna validacion
            } else {
                // validar datos de lista
                $this->_registrarVariable();
            }
        }
        $this->layout->view('adm-variable/nuevo', array_merge($data, $dataLibrary));
    }
    
    /**
     * Validar formulario segun CI
     */
    private function _nuevoValidarForm()
    {   
        $this->form_validation->set_rules('nombre','Nombre','trim|required|min_length[2]|maxlength[80]');
        $this->form_validation->set_rules('tipo_variable','Tipo Variable','required');
        $this->form_validation->set_rules('value', 'Valor','callback_value_check');
        $this->form_validation->set_rules('patron_a_validar');        
    }
    
    private function _registrarVariable()
    {   
        $this->load->model('Variable_model');
        $this->load->library('app_variable');
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
}
