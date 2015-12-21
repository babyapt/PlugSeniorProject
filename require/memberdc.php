<?php
	switch (isset($_SESSION['memberType'])?$_SESSION['memberType']:''){
		case 'MEMBER':
			if(isset($_SESSION['memberID'])?$_SESSION['memberID']:''){
				$_USER['id'] = $_SESSION['memberID'];
			}
			$_USER['member'] = true;
			break;
		case 'ADMIN':
			if(isset($_SESSION['empID'])?$_SESSION['empID']:''){
				$_USER['id'] = $_SESSION['empID'];
			}
			$_USER['admin'] = true;
			$_USER['type'] = $type;
			break;
		default :
			break;
	}
?>