
<div id="header">
<div id="header_left">
<h3>Tables List:</h3>
<select name="tables" id="tables" onchange="document.location.href = this.options[this.selectedIndex].value" 
        disabled class="input-sm">
	<option value="#">select table</option>
<?php foreach( $tables as $table ) : ?>
	<option value="<?php echo site_url('scaffolding') . '?table=' . $table; ?>"<?php echo ( isset( $_GET['table'] ) && $_GET['table'] == $table ) ? ' selected="selected"' : ""; ?>><?php echo $table ?></option>}
<?php endforeach; ?></select>
</div>
<div id="header_right">

<?php echo anchor('scaffolding'.$table_url, $this->lang->line('scaff_view_records')); ?> &nbsp;&nbsp;|&nbsp;&nbsp;
<?php echo anchor('scaffolding/add'.$table_url,  $this->lang->line('scaff_create_record')); ?>
</div>
</div>
<br clear="all">
<div id="outer">
<?php

/* End of file header.php */
/* Location: ./application/views/scaffolding/header.php */