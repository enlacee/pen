<?php
/**
 * @author Anibal Copitan <acopitan@gmail.com>
 * @category Libreria
 * 
 * Encapsulamiento de funciones que se cargan al iniciar el controlador
 * base CI_Controller ejm : auth, cron, check, etc..
 */

class MY_Controller extends CI_Controller {
    public $auth;
    
    public function __construct()
    {
        parent::__construct();
        $this->dependenciasBasicas();
        $this->iniciarLayout();
        
        //login
        $this->validarUsuario();
    }

    private function dependenciasBasicas()
    {   
        //$this->load->library('session');
        $this->load->helper('url');
    }
    /**
     * Carga una vista por defecto segun.
     *  - falta implementar interaccion con login
     */    
    public function iniciarLayout()
    {
        $this->load->library('layout');
    }
    
    /**
     * validacion  de acceso a la applicacion
     * - administrador 
     * - usuario 
     */    
    public function validarUsuario()
    {   
        //$this->session->userdata('user','');
        $userSession = $this->session->userdata('user');        
        if (is_array($userSession) && count($userSession) > 0) {            
            $this->auth = true;
        } else {
            $this->auth = false;
        }
    }
}
