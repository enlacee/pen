<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth  extends MY_Controller {
        
    public function __construct() {
        parent::__construct();
    }
    
    public function login()
    {   
        $this->load->model('Usuario_model');        
        if ($this->input->post()) {
            $dataUsuario = $this->Usuario_model->auth($this->input->post('email'), $this->input->post('password'));
            
            // para enviar mensaje de respuesta xq no se concecto.
            $bandera = $this->guardarSessionUser($dataUsuario);
            redirect('/index');
        } 
    }
    
    /**
     * Guardar la session
     */
    private function guardarSessionUser($data) 
    {   
        $flag = false;
        if (count($data) > 0) {             
            $this->session->set_userdata('user', $data[0]);
            $flag = true;
        }
        
        return $flag;
    }
    
    public function salir()
    {   
        $this->session->sess_destroy();
        redirect('/index');
    }
}
