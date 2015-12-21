<?php
	if(!$_USER['id']) $authRequire = true;
	$requireDialog[] = 'require/bootstrap-colorselector.php';
?>
<div class="row">
	<div class="box">
		<?php require_once 'template/order.php';?>
	</div>
</div>