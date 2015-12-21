<?php
	$path = isset($_REQUEST['path'])?$_REQUEST['path']:'';
	if(file_exists($path)){
		unlink($path);
		$preData['initialPreview'][] = [];
		$data = json_encode($preData);
		echo $data;
	}
?>