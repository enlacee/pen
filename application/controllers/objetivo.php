<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of objetivo padre de cuadros estadisticos.
 *
 * @author anb
 */
class Objetivo  extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index($indice)
    {
        $data = array(
            'titulo' => 'Objetivos',
            'idObjetivo' => $indice
        );
        $this->loadJqgrid();
        $this->loadStatic(array("js"=>"js/module/objetivo/index.js"));
        $this->layout->view('objetivo/index', $data);
    }    
}
