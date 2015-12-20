<?php
session_start();
// Set System Variable
$_CONFIG = array(
		'dbhost'				=>	"localhost",
		'dbuser'				=>	"utccictc_pce",
		'dbpass'				=>	"P0JoUJfwic",
		'dbname'				=>	"utccictc_pce"
);
$requireDialog = Array();
require_once 'require/connectDB.php';
// 	Function get pages files name
	function getPage(){
// 		Set variable $page = parameter "page" from POST or GET method (include URI parameter)
		$page = isset($_REQUEST['page'])?$_REQUEST['page']:'';
// 		Set directory of files to include in name of files. (Example 'include/')
		$return='include/';
// 		Check variable $page is set and not NULL
		if($page&&isset($page)){
// 			Decide case of variable $page
			switch ($page){
// 				On variable $page is set to 'register' will do this case
				case 'register':	break;
				case 'addOrder':	$return.='addOrder.php'; break;
				case 'order':	$return.='order.php'; break;
				case 'orderDetail':	$return.='orderDetail.php'; break;
// 				On variable $page is not match any case before wii do this default
				default: $return.='index.php';	break;
			}
// 			End switch
		} else {
// 			Begins Else
//			Set variable $return to a default files when variable $page is not set or NULL
			$return .= 'index.php';
		}
// 		End If
//		Check file exists
		if(file_exists($return)){
// 			If file exists will return variable $return
			return $return;
		} else {
// 			If file not exists will return '404.php';
			return '404.php';
		}
// 		End if
	}
	function getMemberOrderTr($status){
		$return = '';
		switch ($status){
			case '0':
			case '2':
			case '3':
			case '4':
			case '5':
			case '6':
				$return = 'active';
				break;
			case '1':
				$return = 'warning';
				break;
			case '7':
				$return = 'success';
				break;
			default:
				$return = 'danger';
				break;
		}
		return $return;
	}
	function getOrderStatus($status){
		$return = '';
		switch ($status){
			case '0':	$return = 'กำลังรอพิจารณา';	break;
			case '1':	$return = 'ส่งใบเสนอราคาเรียบร้อยแล้ว';	break;
			case '2':	$return = 'รอบริษัทอนุมัติการผลิต';	break;
			case '3':	$return = 'ผ่านการอนุมัติ(รอดำเนินการผลิต)';	break;
			case '4':	$return = 'กำลังอยู่ในกระบวนการผลิต';	break;
			case '5':	$return = 'เสร็จสิ้นกระบวนการผลิต';	break;
			case '6':	$return = 'กำลังรอการส่งมอบ';	break;
			case '7':	$return = 'กำลังอยู่ในระหว่างการจัดส่ง';	break;
			case '8':	$return = 'จบการขาย';	break;
		}
		return $return;
	}
	$requireDialog = '';
?>