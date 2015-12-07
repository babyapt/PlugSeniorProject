<?php
	$menu = '';
	switch (isset($_SESSION['memberType'])?$_SESSION['memberType']:''){
		case 'MEMBER':
			if(isset($_SESSION['memberID'])?$_SESSION['memberID']:''){
				$menu = '<li><a href="javascript:voidf();">สมาชิก</a></li>';
				$menu .= '<li><a href="javascript:voidf();" id="logout">ออกจากระบบ</a></li>';
			}
			break;
		case 'ADMIN':
			if(isset($_SESSION['empID'])?$_SESSION['empID']:''){
				
			}
			break;
		default :
			$menu = '<li><a href="javascript:voidf();" data-toggle="modal" data-target="#loginModal">เข้าสู่ระบบ</a></li>';
			$requireDialog .= file_get_contents('template/login.php');
			break;
	}
	echo $menu;
?>