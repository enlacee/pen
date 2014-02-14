<?php
/**
 * @author Anibal Copitan <acopitan@gmail.com>
 * @category Libreria
 * 
 * Encapsulamiento de funciones que se cargan al iniciar el controlador
 * base CI_Controller ejm : auth, cron, check, etc..
 */

class MY_Controller extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->iniciarLayout();
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
    public function login()
    {
        
    }
    
}
