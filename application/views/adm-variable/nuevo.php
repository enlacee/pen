<h2>Crear Variable</h2>
<form name="form-variable" class="form-horizontal" role="form" action="">
  <div class="form-group">
    <label class="col-sm-2 control-label">Nombre</label>
    <div class="col-sm-4">
        <input type="text" name="nombre" id="nombre" class="form-control input-sm">        
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword" class="col-sm-2 control-label">Tipo de variable</label>
    <div class="col-sm-3">
        <select name="tipo_variable" id="tipo_variable" class="form-control input-sm">
            <option value = "" >-- select --</option>
            <option value = "entero" >entero</option>
            <option value = "real" >real</option>
            <option value = "cadena" >cadena</option>
            <option value = "binariao" >binario</option>
        </select>      
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Valor</label>
    <div class="col-sm-4">
        <textarea name="value" id="value" class="form-control input-sm"></textarea>
    </div>
  </div>    
    <div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Patron a validar</label>
            <div class="col-sm-3">
                <input type="text" name="patron_a_validar" id="patron_a_validar" class="form-control input-sm"
                       placeholder="1,2,3  o  1-3">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-2">
            <button type="submit" class="btn btn-primary input-sm">Guardar</button>
        </div>        
    </div>
</form>