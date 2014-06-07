<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth  extends MY_Controller {
        
    public function __construct() {
        parent::__construct();
    }
    
    public function login()
    {   
        $this->load->model('Usuario_model');
        $this->load->model('Objetivo_model');
        if ($this->input->post()) {
            $dataUsuario = $this->Usuario_model->auth($this->input->post('email'), $this->input->post('password'));
            $dataObjetivo = $this->Objetivo_model->getObjetivos();            
            $data = array (
               'user' => $dataUsuario,
               'user_objetivo' => $dataObjetivo
            );
            // para enviar mensaje de respuesta xq no se concreto.
            $bandera = $this->guardarSessionUser($data);
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
            $this->session->set_userdata($data);
            $flag = true;
        }
        
        return $flag;
    }
    
    /**
     * Cerrar session y limpiar datos en cache.
     */
    public function salir()
    {   
        $this->load->driver('cache');    
        $this->session->sess_destroy();
        $this->cache->file->clean();
        redirect('/index');
    }
}
