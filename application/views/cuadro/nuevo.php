<h3>Crear Cuadro</h3>
<form action="" method="post">
    <input type="hidden" name="id_objetivo" value="<?php echo $id_objetivo ?>"/>
    
<div class="row">    
    <div class="col-md-7">
        <div class="col-sm-3"><label>Titulo del cuadro :</label></div>
        <div class="col-sm-6"><textarea name="titulo" class="form-control input-sm"></textarea></div>
        <div class="col-sm-3"></div>
    </div>    
</div>
    
<div class="row">    
    <div class="col-md-7">
        <div class="col-sm-3"><label>Agregar variable :</label></div>
        <div class="col-sm-7"><input type="text" name="variable" id="variable" class="form-control input-sm" placeholder="Search"></div>
        <div class="col-sm-2"><button type="button" name="add" id="add" class="btn btn-default input-sm">OK</button></div>
    </div>    
</div>
    
<div class="row">
    <div class="col-md-7">
        <div class="col-sm-3"></div>
        <div class="col-sm-7">
            Lista de variables:<br/>
            <div id="lista-variables"></div>
    </div>
</div>
    
<div class="row">
    <div class="col-md-7">
        <div class="col-sm-5"></div>
        <div class="col-sm-7">
            <button type="button" class="btn btn-primary input-sm">Cancelar</button>
            <button type="submit" class="btn btn-primary input-sm">Guardar</button>
        </div>
    </div>
</div>    

</form>

