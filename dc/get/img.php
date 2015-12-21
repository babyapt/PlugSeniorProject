<?php
	$ID = isset($_REQUEST['id'])?$_REQUEST['id']:'';
	$tag = isset($_REQUEST['tag'])?$_REQUEST['tag']:'';
	header("content-type: image/jpeg");
	$photo = 'img/';
	$photo.= $tag.'/';
	$photo.= $ID.'.jpg';
	if(!file_exists($photo)){
			$photo = 'order/404.jpg';
	}
	readfile($photo);
?>