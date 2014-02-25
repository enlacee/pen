/**
 * Lista de variables
 * @author Anb
 */
jQuery("#list").jqGrid({
   	url:'/adm_variable/jqlistar?q=2',
	datatype: "json",
   	colNames:['id','Nombre', 'Tipo variable', 'Fecha registro'],
   	colModel:[
   		{name:'id_variable',index:'id_variable', width:55},
   		{name:'nombre',index:'nombre', width:150},
   		{name:'tipo_variable',index:'tipo_variable', width:100},
   		{name:'fecha_registro',index:'fecha_registro', width:90, align:"right"}
   	],
   	rowNum:10,
   	rowList:[10,20,30],
   	pager: '#pager',
   	sortname: 'id_variable',
    viewrecords: true,
    sortorder: "desc",
    /*caption:"JSON Example"*/
});
jQuery("#list").jqGrid('navGrid','#pager',{edit:false,add:false,del:false});

//$("#list47").jqGrid('setGridWidth', 250);
fixGridSize($("#list"));