$(function () {
    
    var $variable = $('#variable');
    $variable.autocomplete({
        source: function (request, response) {
           $.ajax({
               url: '/adm_variable/jsonlistavariable/',
               type: 'post',
               dataType: 'json',
               data: request,
               success: function (data) {
                   //console.log('data',data);
                   response($.map(data, function (value, key) { 
                        return {
                            label: value,
                            value: value+':'+key,
                            //value: key
                        };
                   }));
               }
           });
        },
        minLength: 2
    });
    
    $('#add').click(function() { 
        //var patron = /^([a-zA-Z ñ Ñ á Á éÉ íÍ óÓ úÚ 0-9]+)(:)(\d+)$/;
        var patron = /^([a-zA-Z\s]+)(\|)([A-Z]+)(:)(\d+)$/;
        if (patron.test($variable.val())) {            
            var $input = '<input type="text" name="variableData[]" value="'+$variable.val()+'" readonly class="form-control input-sm"/>';
            var s = getTipodeVariable($variable.val());            
            if(getTipodeVariable($variable.val()) == 'LISTA') {
                var checkbox = 'Multiple:<input type="checkbox" name="variableDataListaMultiple" value = "1" />';
                $input += checkbox;
            }
            $("#lista-variables").append('<p>'+$input+'</p>');
            $variable.val('')
                    .focus();
        } else {
            alert("Expresion no es adecuado corregir.");
        }

    });
});


// ----------------------- function de ayuda
function getTipodeVariable(str) {
    //var str = "sexo|LISTA:5";
    var res = str.split(":",1);    
    var string_tvariable = res[0];
    var arreglo_tvariable = string_tvariable.split("|");    
    return arreglo_tvariable[1];
}
