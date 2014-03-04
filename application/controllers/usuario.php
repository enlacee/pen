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
        $this->loadStatic(array("js"=>"js/module/usuario/index.js"));
        $this->layout->view('usuario/objetivo',$data);

    }
    
    public function cuadro($indice)
    {   
        $this->load->model('Variable_model');
        $this->load->model('Cuadro_data_model');
        $this->load->driver('cache');
        $this->loadJqgrid();
        
        $objCuadro = new Cuadro_data_model($indice);    
        $data = array(
            'titulo' => 'Cuadro Usuario',
            'idCuadro' => $indice,
            'objCuadro' => $objCuadro
        );
        
        //$this->loadStatic(array("js"=>"js/module/usuario/cuadro.js"));
        $this->layout->view('usuario/cuadro',$data);        
    }
    
    /**
     * Listar Cuadros estadisticos por Objetivo
     * Y codicion
     * - lista los cuadros estadisticos que pertenecen al usuario
     * - y los que no pertenece ah nadie.
     */
    public function jqlistar()
    {   
        $this->load->model('Usuario_model');
        $this->load->driver('cache');
        
        $responce = new stdClass();
        $id_objetivo = $this->input->get('id_objetivo');
        
        $dataGrid['id_objetivo'] = $id_objetivo;
        $dataGrid['id_usuario'] = $this->idUsuario;
       
        $result = $this->Usuario_model->jqListar($dataGrid);
        
        $i = 0;
        while (list($clave, $row) = each($result)) { //ico ui-icon ui-icon-pencil
            $link = '<a class="link" href="/usuario/cuadro/'.$row['id_cuadro'].'">ver</a>';
            $responce->rows[$i]['id'] = $row['id_cuadro'];
            $responce->rows[$i]['cell'] = array(
                $row['id_cuadro'],
                $row['titulo'],
                $row['fecha_registro'],
                $link);
            $i++;        
        }
        
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($responce));
    }
}
