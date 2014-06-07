<div class="row form-group">    
    <div class="col-md-12">
        <div class="col-sm-3"><?php echo form_label($obj->nombre, $obj->nombre_key); ?></div>
        <div class="col-sm-6">
        <select name="<?php echo  $obj->nombre_key ?>" class="form-control input-sm">
            <option value="" <?php set_select($obj->nombre_key, '', TRUE)?>>-</option>
            <?php if(isset($obj->value_data_tabla) && $obj->value_data_tabla != null): ?>
                <?php foreach ($obj->value_data_tabla as $key => $value): ?>
                <option value = "<?php echo $key ?>" <?php echo set_select($obj->nombre_key, $key) ?>><?php echo $value ?></option>      
                <?php endforeach; ?>
            <?php else: ?>
                <option value="none">No existen datos para la lista.</option>
            <?php endif;?>    
        </select> 
        </div>
        <div class="col-sm-3"></div>
    </div>    
</div>

