<?php

/**
 * Description of cuadro
 *
 * @author anb
 */
class Cuadro extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function nuevo($idObjetivo)
    {
        $this->load->helper('form');        
        $this->load->library('form_validation');        
        $data = array(
            'titulo' => 'Cuadros',
            'idObjetivo' => $idObjetivo
        );
        
        
         log_message('error', print_r($this->input->post(),true));
       
        
        $this->loadJqgrid();
        $this->loadStatic(array('js'=>'js/vendor/jquery-ui/jquery-ui-1.10.4.custom.min.js'));
        $dataScript = $this->loadStatic(array('js'=> 'js/module/cuadro/nuevo.js'));
        $this->layout->view('cuadro/nuevo', array_merge($data, $dataScript));
    }
    
}
