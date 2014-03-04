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
            'mensajeBox' => $this->session->flashdata('mensajeBox'),
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
                } else {
                   $this->form_validation->set_rules($obj->nombre_key,$obj->nombre,'trim|required'); 
                }       
            }       
        }        
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
