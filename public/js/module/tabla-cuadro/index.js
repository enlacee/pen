/**
 * Lista de cuadros estadisticos por objetivo
 * @author Anb
 */
var $id = $('#id_cuadro').val();
jQuery("#list").jqGrid({
   	url:'/tabla_cuadro/jqlistar?id_cuadro='+$id,
	datatype: "json",
   	colNames:['id','Titulo', 'Fecha registro', 'Action'],
   	colModel:[
   		{name:'id',index:'id', width:55},
   		{name:'titulo',index:'titulo', width:400},   		
   		{name:'fecha_registro',index:'fecha_registro', width:120, align:"right"},
                {name:'action',width:100, align:"center"}
   	],
   	/*rowNum:10,
   	rowList:[10,20,30],*/
   	pager: '#pager',
   	sortname: 'id_cuadro',
    viewrecords: true,
    sortorder: "desc",
    /*caption:"JSON Example"*/
});
jQuery("#list").jqGrid('navGrid','#pager',{search:false, edit:false,add:false,del:false});

//$("#list47").jqGrid('setGridWidth', 250);
fixGridSize($("#list"));