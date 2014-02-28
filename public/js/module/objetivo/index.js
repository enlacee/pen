/**
 * Lista de variables
 * @author Anb
 */
var $id = $('#id_objetivo').val();
jQuery("#list").jqGrid({
   	url:'/cuadro/jqlistar?id_objetivo=' + $id,
	datatype: "json",
   	colNames:['id_cuadro','Titulo', 'Fecha registro'],
   	colModel:[
   		{name:'id_cuadro',index:'id_cuadro', width:55},
   		{name:'titulo',index:'titulo', width:400},   		
   		{name:'fecha_registro',index:'fecha_registro', width:90, align:"right"}
   	],
   	rowNum:10,
   	rowList:[10,20,30],
   	pager: '#pager',
   	sortname: 'id_cuadro',
    viewrecords: true,
    sortorder: "desc",
    /*caption:"JSON Example"*/
});
jQuery("#list").jqGrid('navGrid','#pager',{edit:false,add:false,del:false});

//$("#list47").jqGrid('setGridWidth', 250);
fixGridSize($("#list"));