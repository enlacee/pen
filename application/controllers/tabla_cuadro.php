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
        $data = array(
            'titulo' => 'tabla cuadro',
            'idCuadro' => $idCuadro
        );
        $this->loadJqgrid();
        $this->loadStatic(array("js"=>"js/modules_grid/37array.js"));
        $this->layout->view('tabla-cuadro/index',$data);        
    }
    
    public function nuevo($idCuadro)
    {
        $this->load->model('Variable_model');
        $this->load->model('Cuadro_data_model');
        $this->load->driver('cache');
        $this->load->helper('form');        
        $this->load->library('form_validation');        
        $this->loadJqgrid();
        
        $objCuadro = new Cuadro_data_model($idCuadro);    
        $data = array(
            'titulo' => 'Cuadro Usuario',
            'idCuadro' => $idCuadro,
            'objCuadro' => $objCuadro
        );       
        
        
        echo "<pre>"; print_r($this->input->post()); echo "</pre>";
          
        if($this->input->post()) {                
            $id_cuadro = (int) $this->input->post('id_cuadro');
            //echo "entro";            var_dump($id_cuadro);
            if ($id_cuadro > 0) {
                $this->_validarForm($objCuadro);
                if ($this->form_validation->run() == false) {
                    // error en alguna validacion
                    //redirect($_SERVER['HTTP_REFERER']);
                    //exit;       
                } else {   
                    echo "todo ok en form";
                    exit;
                    //$this->_registrarCuadro();
                    //redirect("objetivo/index/".$this->input->post('id_objetivo'));
                }


            }

        }          
        
        //$this->loadStatic(array("js"=>"js/module/usuario/cuadro.js"));
        $this->layout->view('tabla-cuadro/nuevo', $data);
    }
    
    /*
     * Validar formulario de acuerdo al objeto cuadro.
     */    
    private function _validarForm($objCuadro)
    {   
        
        foreach ($objCuadro as $indice => $arreglo) {
            foreach ($arreglo as $key => $obj){
                if ($obj->tipo_variable == Variable_model::TIPO_LISTA_STRING) {
                    $this->form_validation->set_rules($obj->nombre_key,$obj->nombre,'required|callback_value_check');
                } else {
                   $this->form_validation->set_rules($obj->nombre_key,$obj->nombre,'trim|required'); 
                }       
            }       
        }

        
        
        
        
        //$this->form_validation->set_rules('variable_6','sexo','required|callback_value_check');
        //$this->form_validation->set_rules('value', 'Valor','trim|required|callback_value_check');
        //$this->form_validation->set_rules('variableData','Variables','required');
        
    }

    /** ------------------------------------------------------------------------
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
}
