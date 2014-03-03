<?php

/**
 * Description of cuadro
 *
 * @author anb
 */
class Cuadro extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function nuevo($idObjetivo)
    {
        $this->load->helper('form');        
        $this->load->library('form_validation');
        $this->load->library('app_variable');
        $this->load->library('app_cuadro');        
        
        $numero = (int)$idObjetivo;
        if ($numero > 0) { // 0 = false            
            if($this->input->post()) {                
                $this->_nuevoValidarForm();
                if ($this->form_validation->run() == false) {
                    // error en alguna validacion
                } else {                
                    $this->_registrarCuadro();
                    redirect("objetivo/index/".$this->input->post('id_objetivo'));
                }
            }
            
            $data = array(
                'titulo' => 'Cuadros',
                'id_objetivo' => $idObjetivo
            );            
            $this->loadJqgrid();
            $this->loadStatic(array('js'=>'js/vendor/jquery-ui/jquery-ui-1.10.4.custom.min.js'));
            $dataScript = $this->loadStatic(array('js'=> 'js/module/cuadro/nuevo.js'));
            $this->layout->view('cuadro/nuevo', array_merge($data, $dataScript));
        }
    }
    
    /**
     * 
     */
    private function _nuevoValidarForm()
    {
        $this->form_validation->set_rules('titulo','Titulo','trim|required|min_length[2]');
        $this->form_validation->set_rules('variableData','Variables','required');
        
    }
    
    private function _registrarCuadro()
    {
        $this->load->model('Cuadro_model');
        $this->load->dbforge();
        //01
        $cuadro = array();
        $cuadro['id_objetivo'] = $this->input->post('id_objetivo');
        $cuadro['titulo'] = $this->input->post('titulo');       
        $cuadro['creado_por'] = $this->idUsuario;
        $cuadro['table_cuadro'] = '';
        $cuadro['fecha_registro'] = date('Y-m-d h:i:s');
        //02
        $cuadro['variableData'] = $this->input->post('variableData');
        return $this->Cuadro_model->insertar($cuadro);
    }
    
    /**
     * Listar Cuadros estadisticos por Objetivo
     */
    public function jqlistar()
    {   
        $this->load->model('Cuadro_model');
        $responce = new stdClass();
        
        $id_objetivo = $this->input->get('id_objetivo');
        $page = $this->input->get('page');
        $limit = $this->input->get('rows');
        $sidx = $this->input->get('sidx');
        $sord = $this->input->get('sord');
        if (!$sidx) $sidx = 1;        
        
        $dataGrid['id_objetivo'] = $id_objetivo;
        if (isset($_GET['searchField']) && ($_GET['searchString'] != null)) {
            $operadores["eq"] = "=";
            $operadores["ne"] = "<>";
            $operadores["lt"] = "<";
            $operadores["le"] = "<=";
            $operadores["gt"] = ">";
            $operadores["ge"] = ">=";
            $operadores["cn"] = "LIKE";
            if ($_GET['searchOper'] == "cn") {
                $dataGrid['string'] = $_GET['searchField'] . " " . $operadores[$_GET['searchOper']] . " '%" . $_GET['searchString'] . "%' ";
            } else {
                $dataGrid['string'] = $_GET['searchField'] . " " . $operadores[$_GET['searchOper']] . "'" . $_GET['searchString'] . "'";
            }                
        }        
        $count = $this->Cuadro_model->jqListar($dataGrid, true);
        
        if ($count > 0) {
            $total_pages = ceil($count/$limit);
        } else {
           $total_pages = 0; 
        }
        if ($page > $total_pages) $page = $total_pages;
        $start = $limit * $page - $limit;         

        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        
        $dataGrid['oderby'] = array('sidx' => $sidx, 'sord' => $sord);
        $dataGrid['limit'] = $limit;
        $dataGrid['start'] = $start;
       
        $result = $this->Cuadro_model->jqListar($dataGrid);
        $i = 0;
        while (list($clave, $row) = each($result)) {
            $responce->rows[$i]['id'] = $row['id_cuadro'];
            $responce->rows[$i]['cell'] = array(
                $row['id_cuadro'],
                $row['titulo'],
                $row['fecha_registro']);
            $i++;        
        }
        
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($responce));
    }
    
    /**
     * Editar y Eliminar de datos
     * - eliminar incluye drop
     */
    public function jqeditar()
    {   
        $this->load->model('Cuadro_model');
        $this->load->dbforge();        
        
        if($this->input->post()) {
            $id = $this->input->post('id');            
            if(empty($id)) {echo "return"; return; }
            
            $where = "id_cuadro = " . $id;            
            if ($this->input->post('oper') == 'edit') {
                $dataUpdate = array('titulo' => $this->input->post('titulo'));                
                $this->db->update( 'ac_cuadros', $dataUpdate, $where);                
                
            } else if ($this->input->post('oper') == 'del') {
                $numRelacion = $this->Cuadro_model->relacionConUsuarios($id);                
                if($numRelacion == 0) {                    
                    $this->db->delete( 'ac_cuadros', $where);
                    $this->dbforge->drop_table('tabla_cuadro_'.$id);                    
                    $responce = true;
                } else {                   
                   $responce = false; 
                }
                $this->output->set_content_type('application/json');
                $this->output->set_output(json_encode($responce));
            }
        }
    }
}
