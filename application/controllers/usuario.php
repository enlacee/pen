<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends MY_Controller {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->layout->view('usuario/index');        
    }
    
    public function objetivo($indice = '')
    {
        $data = array(
            'titulo' => 'Objetivos',
            'idObjetivo' => $indice
        );
        $this->loadJqgrid();
        $this->loadStatic(array("js"=>"js/module/usuario/objetivo.js"));
        $this->layout->view('usuario/objetivo',$data);

    }
    
    public function cuadro($indice)
    {
        $data = array(
            'titulo' => 'Cuadro',
            'idCuadro' => $indice
        );
        $this->loadJqgrid();
        //$this->loadStatic(array("js"=>"js/module/usuario/cuadro.js"));
        $this->layout->view('usuario/objetivo',$data);        
        
    }
    
    
}
