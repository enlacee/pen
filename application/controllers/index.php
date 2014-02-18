<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends MY_Controller {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        //var_dump($this->auth);
        $this->accesoUsuario();
        $this->load->view('index/index');
    }
    
    private function accesoUsuario()
    {   
        if ($this->auth) {
            $usuario = $this->session->userdata('user');
            if ($usuario['es_super_usuario'] == '1') {
                redirect('/adm_variable');
            } else {
                redirect('/usr_home'); 
            }
        }
    }
}
