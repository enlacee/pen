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
                //echo "valido true"; exit;
                $variable = array();
                $variable['nombre'] = $this->input->post('nombre', true);
                $variable['tipo_variable'] = $this->input->post('tipo_variable');
                $variable['value'] = $this->input->post('value');
                $variable['patron_a_validar'] = $this->input->post('patron_a_validar');               
                
                $this->load->model('Variable_model');
                $this->Usuario_model->insertar($variable);
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
        
    }
}
