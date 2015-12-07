<?php
	$objConnect = @mysql_connect($_CONFIG['dbhost'],$_CONFIG['dbuser'],$_CONFIG['dbpass']);
	if($objConnect){
		$objDB = mysql_select_db($_CONFIG['dbname']);
	} else {
		$error = 'DBFAIL';
		require_once('error.php');
	}
?>