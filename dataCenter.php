<?php
	require_once 'config.php';
	require_once 'require/memberdc.php';
	$type = isset($_REQUEST['type'])?$_REQUEST['type']:'';
	$action = isset($_REQUEST['action'])?$_REQUEST['action']:'';
	$file = 'dc/';
	$file .= $type.'/';
	if(file_exists($file)){
		$file .= $action.'.php';
		if(file_exists($file)){
			require_once $file;
		} else {
			echo 'ERROR';
			exit();
		}
	} else {
		echo 'ERROR';
		exit();
	}
?>