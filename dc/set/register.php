<?php
	$fname = isset($_REQUEST['fname'])?$_REQUEST['fname']:false;
	$lname = isset($_REQUEST['lname'])?$_REQUEST['lname']:false;
	$tel = isset($_REQUEST['tel'])?$_REQUEST['tel']:false;
	$username = isset($_REQUEST['username'])?strtolower($_REQUEST['username']):false;
	$password = isset($_REQUEST['password'])?$_REQUEST['password']:false;
	$cpassword = isset($_REQUEST['cpassword'])?$_REQUEST['cpassword']:false;
	$error = $pass = false;
	if(!$fname||$fname==''||!$lname||$lname==''||!$tel||$tel==''||!$username||$username==''||!$password||$password==''||!$cpassword||$cpassword==''){
		$error = true;
		$errorData = 'NOTVALID';
	}
	if($password!==$cpassword){
		$error = true;
		$errorData = 'NOTMATCH';
	}
	if(!$error){
		$strSQL = sprintf(
				"
				SELECT
					username
				FROM
					`member`
				WHERE
					username = '%s'
				",
				mysql_real_escape_string($username)
		);
		$objQuery = mysql_query($strSQL);
		if($objQuery&&mysql_num_rows($objQuery)==0){
			$strSQL = sprintf(
					"
					INSERT INTO
						`member`
					VALUES(
						NULL,
						'%s',
						'%s',
						'%s',
						'%s',
						'%s'
					)
					",
					mysql_real_escape_string($fname),
					mysql_real_escape_string($lname),
					mysql_real_escape_string($tel),
					mysql_real_escape_string($username),
					mysql_real_escape_string($password)
			);
			$objQuery = mysql_query($strSQL);
			if($objQuery){
				$pass = true;
			} else {
				$errorData = 'SQLERROR';
				$data['strSQL'] = $strSQL;
			}
		} else {
			if($objQuery){
				$errorData = 'SQLERROR';
				$data['strSQL'] = $strSQL;
			} else
				$errorData = 'USEREXIST';
		}
		if($pass){
			$data['status'] = 'SUCCESS';
		} else {
			$data['status'] = 'ERROR';
			$data['reason'] = $errorData;
		}
	} else {
		$data['status'] = 'ERROR';
		$data['reason'] = $errorData;
	}
	echo json_encode($data);
?>