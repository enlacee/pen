$(function () {
    
    var $variable = $('#variable');
    $variable.autocomplete({
        source: function (request, response) {
           $.ajax({
               url: '/adm_variable/jsonlistavariable/'+$variable.val(),
               type: 'GET',
               dataType: 'json',
               data: request,
               success: function (data) {
                   console.log('data',data);
                   response($.map(data, function (value, key) { 
                       console.log('value',value);
                       console.log('key',key);
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
    
    // agregar
    $('#add').click(function(){ 
        var $input = '<input type="text" name="variableData[]" value="'+$variable.val()+'" readonly/>';
        $("#lista-variables").append('<p> - '+$input+'</p>');
        $variable.val('')
                .focus();
    });
});