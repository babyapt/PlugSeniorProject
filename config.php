<?php
session_start();
// Set System Variable
$_CONFIG = array(
		'dbhost'				=>	"localhost",
		'dbuser'				=>	"utccictc_pce",
		'dbpass'				=>	"P0JoUJfwic",
		'dbname'				=>	"utccictc_pce"
);
require_once 'require/connectDB.php';
// 	Function get pages files name
	function getPage(){
// 		Set variable $page = parameter "page" from POST or GET method (include URI parameter)
		$page = isset($_REQUIRE['page'])?$_REQUIRE['page']:'';
// 		Set directory of files to include in name of files. (Example 'include/')
		$return='include/';
// 		Check variable $page is set and not NULL
		if($page&&isset($page)){
// 			Decide case of variable $page
			switch ($page){
// 				On variable $page is set to 'register' will do this case
				case 'register':	break;
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
	$requireDialog = '';
?>