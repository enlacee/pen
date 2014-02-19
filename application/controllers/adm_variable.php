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
        $data['titulo'] = "Nueva Variable";        
        $dataLibrary = $this->loadStatic(array('js' => "js/module/adm-variable/nuevo.js"));        
        $this->layout->view('adm-variable/nuevo', array_merge($data, $dataLibrary));          
    }
    
}
