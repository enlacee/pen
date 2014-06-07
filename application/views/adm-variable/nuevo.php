<?php if (validation_errors()):?>
<div class="alert alert-danger">
<?php echo validation_errors();?>
</div>
<?php endif;?>

<h3>Crear Variable</h3>
<?php 
$atributes = array (
    'method' => 'post','class' => 'form-horizontal',
    'role' => 'form', 'name'=>'form-variable');
echo form_open("", $atributes); ?>
  <div class="form-group">
    <label class="col-sm-2 control-label">Nombre</label>
    <div class="col-sm-4">
        <input type="text" name="nombre" id="nombre" class="form-control input-sm" value="<?php echo set_value('nombre'); ?>">        
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword" class="col-sm-2 control-label">Tipo de variable</label>
    <div class="col-sm-3">
        <select name="tipo_variable" id="tipo_variable" class="form-control input-sm">
            <option value = "" <?php echo set_select('tipo_variable', '', TRUE); ?>>-- select --</option>
            <option value = "1" <?php echo set_select('tipo_variable', '1'); ?>>entero</option>
            <option value = "2" <?php echo set_select('tipo_variable', '2'); ?>>real</option>
            <!--<option value = "3" <?php echo set_select('tipo_variable', '3'); ?>>binario</option>-->
            <option value = "4" <?php echo set_select('tipo_variable', '4'); ?>>cadena</option>
            <option value = "5" <?php echo set_select('tipo_variable', '5'); ?>>lista</option>
        </select>      
    </div>
  </div>
    <div class="row col-sm-12">
        <div class="col-sm-2"></div>
        <div class="col-sm-5">
            <p class="bg-info" id="1" data-patron-validar="Opcional: 1,2,3,4 ó 1-4">Ejem: 1 , 2 , 3</p>
            <p class="bg-info" id="2" data-patron-validar="Opcional: rango de 1.0-7.5">Ejem: 1.5 , 1.26</p>
            <p class="bg-info" id="3" data-patron-validar="">Ejem: 0 ó 1 (seleccion por defecto)</p>
            <p class="bg-info" id="4" data-patron-validar="">Ejem: cadena de texto</p>
            <p class="bg-info" id="5" data-patron-validar="">Ejem: {valor1, valor2}</p>
        </div>
    </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Valor</label>
    <div class="col-sm-4">
        <textarea name="value" id="value" class="form-control input-sm"><?php echo set_value('value'); ?></textarea>
    </div>
  </div>    
    
    <div class="form-group" id="patron">
        <label class="col-sm-2 control-label">Patron a validar</label>
        <div class="col-sm-3">
            <input type="text" name="patron" id="patron" class="form-control input-sm"
                   value="<?php echo set_value('patron'); ?>" placeholder="">
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