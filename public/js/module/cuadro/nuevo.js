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
    
    $('#add').click(function() { 
        var patron = /^([a-zA-Z ñ Ñ á Á éÉ íÍ óÓ úÚ 0-9]+)(:)(\d+)$/;
        if (patron.test($variable.val())) {
            var $input = '<input type="text" name="variableData[]" value="'+$variable.val()+'" readonly class="form-control input-sm"/>';
            $("#lista-variables").append('<p>'+$input+'</p>');
            $variable.val('')
                    .focus();
        } else {
            alert("Expresion no es adecuado corregir.");
        }

    });
});