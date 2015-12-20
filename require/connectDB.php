<?php
	$objConnect = @mysql_connect($_CONFIG['dbhost'],$_CONFIG['dbuser'],$_CONFIG['dbpass']);
	if($objConnect){
		$objDB = mysql_select_db($_CONFIG['dbname']);
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $objConnect);
	} else {
		$error = 'DBFAIL';
		require_once('error.php');
	}
?>