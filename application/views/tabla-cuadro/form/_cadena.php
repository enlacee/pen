<div class="row form-group">    
    <div class="col-md-12">
        <div class="col-sm-3"><?php echo form_label($obj->nombre, $obj->nombre_key); ?></div>
        <div class="col-sm-6">
            <input type="text" name="<?php echo $obj->nombre_key ?>" id="<?php echo $obj->nombre_key ?>"
                   class="form-control input-sm"
                   value="<?php echo set_value($obj->nombre_key); ?>">
        </div>
        <div class="col-sm-3"></div>
    </div>    
</div>
