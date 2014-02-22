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
        
        $numero = (int)$idObjetivo;
        if ($numero > 0) { // 0 = false
            
            if($this->input->post()) {
                $this->_registrar();
                redirect("objetivo/index/".$this->input->post('id_objetivo'));
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
    
    private function _registrar()
    {
        $this->load->model('Cuadro_model');
        $this->load->dbforge();
        
        $cuadro = array();
        $cuadro['id_objetivo'] = $this->input->post('id_objetivo');
        $cuadro['titulo'] = $this->input->post('titulo');       
        $cuadro['creado_por'] = $this->idUsuario;
        $cuadro['table_cuadro'] = '';
        $cuadro['fecha_registro'] = date('Y-m-d h:i:s');
      
        return $this->Cuadro_model->insertar($cuadro);
    }
    
}
