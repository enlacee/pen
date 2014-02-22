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
        $dataLibrary = $this->loadStatic(array("js"=>"js/modules_grid/37array.js"));
        $this->layout->view('objetivo/index', array_merge($data, $dataLibrary));
    }    
}
