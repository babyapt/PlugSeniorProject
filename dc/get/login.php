<?php
	$username = isset($_REQUEST['username'])?$_REQUEST['username']:'';
	$password = isset($_REQUEST['password'])?$_REQUEST['password']:'';
	$result = '';
	if($username&&$password){
		$strSQL = sprintf(
				"
				SELECT
					memberID,
					password
				FROM
					`member`
				WHERE
					username = '%s'
				",
			mysql_real_escape_string($username)
		);
		$objQuery = mysql_query($strSQL);
		if($objQuery){
			if(mysql_num_rows($objQuery)>0){
				$row = mysql_fetch_assoc($objQuery);
				if($row['password']===$password){
					$result['status'] = 'SUCCESS';
					$result['memberID'] = $row['memberID'];
					$_SESSION['memberType']='MEMBER';
					$_SESSION['memberID']=$result['memberID'];
				} else {
					$result['status'] = 'ERROR';
					$result['reason'] = 'WRONGPASS';
				}
			} else {
				$result['status'] = 'ERROR';
				$result['reason'] = 'NOTFOUND';
			}
		} else {
			$result['status'] = 'ERROR';
			$result['reason'] = 'SQLERROR';
			$result['strSQL'] = $strSQL;
		}
	} else {
		$result['status'] = 'ERROR';
		$result['reason'] = 'NOTVALID';
	}
	echo json_encode($result);
?>