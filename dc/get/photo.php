<?php
	$memberID = isset($_SESSION['memberID'])?$_SESSION['memberID']:'';
	$memberType = isset($_SESSION['memberType'])?$_SESSION['memberType']:'';
	$orderID = isset($_REQUEST['orderid'])?$_REQUEST['orderid']:'';
	$tag = isset($_REQUEST['tag'])?$_REQUEST['tag']:'';
	header("content-type: image/jpeg");
	$photo = 'order/';
	$pass = false;
	$error = false;
	switch($memberType){
		case 'MEMBER':
			$strSQL = sprintf(
					"
			SELECT
				memberID
			FROM
				`order`
			WHERE
				orderID = '%s'
		",
					mysql_real_escape_string($orderID)
			);
			$objQuery = mysql_query($strSQL);
			if($objQuery&&mysql_num_rows($objQuery)==1){
				$row = mysql_fetch_assoc($objQuery);
				if($row['memberID']==$memberID){
					$pass = true;
				}
			}
			break;
	}
	$photo.= $tag.'/';
	$photo.= $orderID.'.jpg';
	if(!$pass||$error||!file_exists($photo)){
		if(!$pass)
			$photo = 'order/nopermission.jpg';
		else
		$photo = 'order/404.jpg';
	}
	readfile($photo);
?>