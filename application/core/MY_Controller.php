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
    public $idUsuario = false;
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
        $this->load->helper('url');
        //$this->output->enable_profiler(TRUE);
    }
    /**
     * Carga una vista por defecto segun.
     *  - falta implementar interaccion con login
     */    
    private function iniciarLayout()
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
            $this->idUsuario = $userSession['id_usuario'];
            $this->auth = true;
        } else {
            $this->auth = false;
        }
    }    
    
    /**
     * Carga la libreria jqgrid util para la VISTA     
     *  $data['css'] = array ('file.css');
     *  $data['js'] = array ('file.js');
     */
    protected function loadJqgrid()
    {   
        if ($this->flagGrid == false) {           
            $this->dataView['css'][] = "jqgrid/css/cupertino/jquery-ui-1.10.4.custom.min.css";
            $this->dataView['css'][] = "jqgrid/css/ui.jqgrid.css";                  
            $this->dataView['js'][] = "jqgrid/i18n/grid.locale-en.js";
            $this->dataView['js'][] = "jqgrid/jquery.jqGrid.min.js";
            $this->dataView['js'][] = "jqgrid/fixGridSize.js";
            $this->flagGrid = true;
        }        
        return $this->dataView;       
    }
    
    protected function loadStatic(array $data = array()) {
        
        foreach ($data as $key => $value) {
            if ($key === 'css') {
                if (is_string($data[$key])) {
                    $this->dataView['css'][] = $value;
                } elseif (count($data[$key] > 0)) {
                    foreach ($data['css'] as $llave => $valor) {
                        $this->dataView['css'][] = $valor;
                    }                        
                }
            } elseif ($key === 'js') {
                if (is_string($data[$key])) {
                    $this->dataView['js'][] = $value;
                } elseif (count($data[$key] > 0)) {
                    foreach ($data['js'] as $llave => $valor) {
                        $this->dataView['js'][] = $valor;
                    }                        
                }                
            }   
        }

        return $this->dataView;
    }    
}
