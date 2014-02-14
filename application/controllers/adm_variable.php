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
        $this->layout->view('adm-variable/index', $data);         
        
    }
    
    /**
     * 
     */
    public function nuevo()
    {
        $data['titulo'] = "Nueva Variable";        
        $this->layout->view('adm-variable/nuevo', $data);          
    }
    
}
