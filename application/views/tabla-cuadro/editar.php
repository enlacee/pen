<?php if (validation_errors()):?>
<div class="alert alert-danger"><?php echo validation_errors();?></div>
<?php endif;?>
<h3>Edicion en Cuadro</h3>
<?php 
$atributes = array ('method' => 'post', 'name'=>'form-tabla-cuadro');
echo form_open("/tabla_cuadro/editar/$idCuadro/$id", $atributes); ?>
<input type="hidden" name="id_cuadro" id="id_cuadro" value="<?php echo $idCuadro ?>"/>
<input type="hidden" name="id_registro" id="id_registro" value="<?php echo $id ?>"/>
<!-- inicio form -->
<?php /*echo "<pre>"; print_r($objCuadro); exit;*/ foreach ($objCuadro as $indice => $arreglo): ?>
    <?php foreach ($arreglo as $key => $obj): //echo "<pre>"; print_r($obj); exit; ?>
        <?php if (Variable_model::TIPO_LISTA_STRING == $obj->tipo_variable): ?>
            <?php $this->load->view('tabla-cuadro/form/_lista_editar', array('obj' => $obj)); ?>            
        <?php else: ?>
            <?php $this->load->view('tabla-cuadro/form/_cadena_editar', array('obj' => $obj)); ?>
        <?php endif; ?>        
    <?php endforeach; ?>
<?php endforeach;?>

<div class="row form-group">
    <div class="col-md-7">
        <div class="col-sm-5"></div>
        <div class="col-sm-7">
            <a href="/tabla_cuadro/index/<?php echo $idCuadro ?>" class="btn btn-primary input-sm">Cancelar</a>
            <button type="submit" class="btn btn-primary input-sm">Guardar</button>
        </div>
    </div>
</div> 
<?php form_close(); ?>
