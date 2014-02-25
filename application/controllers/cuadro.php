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
        $this->load->library('app_variable');
        $this->load->library('app_cuadro');        
        
        $numero = (int)$idObjetivo;
        if ($numero > 0) { // 0 = false            
            if($this->input->post()) {                
                $this->_nuevoValidarForm();
                if ($this->form_validation->run() == false) {
                    // error en alguna validacion
                } else {                
                    $this->_registrarCuadro();
                    redirect("objetivo/index/".$this->input->post('id_objetivo'));
                }
            }
            
            $data = array(
                'titulo' => 'Cuadros',
                'id_objetivo' => $idObjetivo
            );            
            $this->loadJqgrid();
            $this->loadStatic(array('js'=>'js/vendor/jquery-ui/jquery-ui-1.10.4.custom.min.js'));
            $dataScript = $this->loadStatic(array('js'=> 'js/module/cuadro/nuevo.js'));
            $this->layout->view('cuadro/nuevo', array_merge($data, $dataScript));
        }
    }
    
    /**
     * 
     */
    private function _nuevoValidarForm()
    {
        $this->form_validation->set_rules('titulo','Titulo','trim|required|min_length[2]');
        $this->form_validation->set_rules('variableData','Variables','required');
        
    }
    
    private function _registrarCuadro()
    {
        $this->load->model('Cuadro_model');
        $this->load->dbforge();
        //01
        $cuadro = array();
        $cuadro['id_objetivo'] = $this->input->post('id_objetivo');
        $cuadro['titulo'] = $this->input->post('titulo');       
        $cuadro['creado_por'] = $this->idUsuario;
        $cuadro['table_cuadro'] = '';
        $cuadro['fecha_registro'] = date('Y-m-d h:i:s');
        //02
        $cuadro['variableData'] = $this->input->post('variableData');
        return $this->Cuadro_model->insertar($cuadro);
    }    
}
