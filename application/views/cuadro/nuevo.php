<?php if (validation_errors()):?>
<div class="alert alert-danger">
<?php echo validation_errors();?>
</div>
<?php endif;?>
<h3>Crear Cuadro</h3>
<?php 
$atributes = array (
    'method' => 'post',
    'name'=>'form-cuadro');
echo form_open("", $atributes); ?>
    <input type="hidden" name="id_objetivo" value="<?php echo $id_objetivo ?>"/>
    
<div class="row form-group">    
    <div class="col-md-7">
        <div class="col-sm-3"><label>Titulo :</label></div>
        <div class="col-sm-6"><input  type="text" name="titulo" class="form-control input-sm" value="<?php echo set_value('titulo'); ?>"></div>
        <div class="col-sm-3"></div>
    </div>    
</div>
    
<div class="row form-group">    
    <div class="col-md-7">
        <div class="col-sm-3"><label>Agregar variable :</label></div>
        <div class="col-sm-7"><input type="text" name="variable" id="variable" class="form-control input-sm" autocomplete="off" placeholder="Search"></div>
        <div class="col-sm-2"><button type="button" name="add" id="add" class="btn btn-default input-sm">OK</button></div>
    </div>    
</div>
    
<div class="row form-group">
    <div class="col-md-7">
        <div class="col-sm-3"></div>
        <div class="col-sm-7">
            Lista de variables:<br/>
            <div id="lista-variables"></div>
    </div>
    </div>
</div>
    
<div class="row form-group">
    <div class="col-md-7">
        <div class="col-sm-5"></div>
        <div class="col-sm-7">
            <a href="/objetivo/index/<?php echo $id_objetivo ?>" class="btn btn-primary input-sm">Cancelar</a>
            <button type="submit" class="btn btn-primary input-sm">Guardar</button>
        </div>
    </div>
</div>    

</form>

