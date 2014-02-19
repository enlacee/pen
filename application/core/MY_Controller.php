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
    
    public $dataView = array();    
    private $flagGrid = false;
    
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
    
    
    /**
     * Carga la libreria jqgrid util para la VISTA
     * @param array $data parametro que agrega mas js o css 
     *  $data['css'] = array ('file.css');
     *  $data['js'] = array ('file.js');
     */
    protected function loadJqgrid(array $data = array())
    {   
        if ($this->flagGrid == false) {           
            $this->dataView['css'][] = "jqgrid/css/cupertino/jquery-ui-1.10.4.custom.min.css";
            $this->dataView['css'][] = "jqgrid/css/ui.jqgrid.css";                  
            $this->dataView['js'][] = "jqgrid/i18n/grid.locale-en.js";
            $this->dataView['js'][] = "jqgrid/jquery.jqGrid.min.js";
            $this->dataView['js'][] = "jqgrid/fixGridSize.js";
            $this->flagGrid = true;
        }
        if (isset($data['css']) && !empty($data['css'])) {            
            if (is_string($data['css'])){
                    $this->dataView['css'][] = $data['css'];
            } elseif (count($data['css'] > 0)) {
                foreach ($data['css'] as $key => $value) {
                    $this->dataView['css'][] = $value;
                }
            }            
        } elseif (isset($data['js']) && !empty($data['js'])) {
            if (is_string($data['js'])) {
                $this->dataView['js'][] = $data['js'];
            } elseif (count($data['js'] > 0)) {
                foreach ($data['js'] as $key => $value) {
                    $this->dataView['js'][] = $value;
                }
            }        
        }
        
        return $this->dataView;       
    }
        
    

    
}
