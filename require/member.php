<?php
	$menu = '';
	switch (isset($_SESSION['memberType'])?$_SESSION['memberType']:''){
		case 'MEMBER':
			if(isset($_SESSION['memberID'])?$_SESSION['memberID']:''){
				$menu = '<li>
									<a href="javascript:voidf();" class="dropdown-toggle" data-toggle="dropdown">
										สมาชิก<span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<li><a href="#">แก้ไขข้อมูลส่วนตัว</a></li>
										<li><a href="?page=addOrder">สั่งสินค้า</a></li>
										<li><a href="?page=order">ดูรายการสั่งซื้อ</a></li> 
									</ul>
								</li>';
				$menu .= '<li><a href="javascript:voidf();" id="logout">ออกจากระบบ</a></li>';
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
			$menu = '<li><a href="javascript:voidf();" data-toggle="modal" data-target="#loginModal">เข้าสู่ระบบ</a></li>';
			$requireDialog[] = 'template/login.php';
			break;
	}
	echo $menu;
?>