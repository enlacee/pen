<!--<button type="button" class="btn btn-default btn-sm">
  <span class="glyphicon glyphicon-circle-arrow-left"></span> Star
</button>-->

Cuadro <?php echo $idCuadro ?> : <?php echo anchor("/tabla_cuadro/nuevo/$idCuadro", 'nuevo cuadro');?>
<input type="hidden" name="id_cuadro" id="id_objetivo" value="<?php echo $idCuadro ?>"/>


<!-- JQGRID -->
<table id="list47"></table>
<div id="plist47"></div>  