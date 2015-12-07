<?PHP 
	$aa = '2015-11-10 00:00:00';
	$aa = strtotime(" +2 days",strtotime($aa));
	$aa = (date("Y",$aa)+543).date("-m-d H:i:s",$aa);
		echo $aa;
?>