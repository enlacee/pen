<?php

/**
 * Description of App_jqgrid
 *
 * @author anb 2014
 */
class App_jqgrid {    
    
    private $dataTable = array();
    private $idHead = null;
    private $idPager = null;
    private $url = null;
    private $urlParam = array(); //
    private $datatype = 'json';
    
    private $colNames = array();
    private $colModel = array();
    
    private $sortname = null;
    private $viewrecords = 'true';
    private $sortorder = null;    
    
    /**
     * Crear el objeto.
     * @param type $data
     * 
    $data = array(
            'data' => array()
            'idHead' => '#idHead',
            'idPager' => '#idPager',
            'url' => '/some/url',
            'colNames' => array(),
            'colModel' => array(),
            'sortname' => 'id',
            'sortorder' => 'asc'
    ); 
     *    
     */
    public function __construct($data = array()) {
        
        if (is_array($data) && count($data) > 0) {            
            $this->idHead = isset($data['idHead']) ? $data['idHead'] : null;
            $this->idPager = isset($data['idPager']) ? $data['idPager'] : null; 
            $this->url = isset($data['url']) ? $data['url'] : null;
            $this->colNames = isset($data['colNames']) ? $data['colNames'] : null;
            $this->colModel = isset($data['colModel']) ? $data['colModel'] : null;
            $this->sortname = isset($data['sortname']) ? $data['sortname'] : null;
            $this->sortorder = isset($data['sortorder']) ? $data['sortorder'] : null;         
        }       
    }
    
    /**
     * Genera Grid falta mejorar
     * @return type
     */
    public function getGrid_1()
    {
        $colNames = $this->_colNames();
        $colModel = $this->_colModel();
        
        $string = <<<EOT
                
var id = $('#id_cuadro').val();
                
jQuery("#list").jqGrid({
   	url:'/tabla_cuadro/jqlistar?id_cuadro='+id,
	datatype: "json",
   	colNames:[{$colNames}],
   	colModel:[{$colModel}],
   	/*rowNum:10,
   	rowList:[10,20,30],*/
   	pager: '#pager',
   	sortname: 'id',
    viewrecords: true,
    sortorder: "desc",
    editurl:"/tabla_cuadro/jqeditar?id_cuadro="+id,
    /*caption:"JSON Example"*/
});
jQuery("#list").jqGrid('navGrid','#pager',{search:false, edit:false,add:false,del:true});

//$("#list47").jqGrid('setGridWidth', 250);
fixGridSize($("#list"));
EOT;
        
        return $string;        
    }
    
    private function _colNames()
    {   
        $string = "";
        if(is_array($this->colNames)) {            
            foreach ($this->colNames as $key => $value) {
              //['id','Titulo', 'Fecha registro', 'Action']  
              $string .= "'$value',";  
            }
            $string = substr($string, 0, ($string)-1);
        }
        return $string;
    }

    private function _colModel()
    {   $string = "";
        if(is_array($this->colModel)) {
            foreach ($this->colModel as $key => $value) {
              //{name:'titulo',index:'titulo', width:400}, 
              $string .= "{name:'{$value}', index:'{$value}'},"; 
            } 
            $string = substr($string, 0, ($string)-1);
        }
        
        return $string;
    }
}  