<?php
	$tag = isset($_REQUEST['tag'])?$_REQUEST['tag']:'';
	$file = isset($_FILES['file_data'])?$_FILES['file_data']:false;
	$path = $key = $extra = '';
	$error = $pass = false;
	switch($tag){
		case 'order':
			$path = 'order/temp/';
			$name = isset($_REQUEST['name'])?$_REQUEST['name']:'';
			switch ($name){
				case 'purchase':
					if($file['type']!='application/pdf')
						$error = true;
					else
						$path.= session_id().'_purchase.pdf';
					break;
				case 'draft':
					if($file['type']!='image/jpeg')
						$error = true;
					else
						$path.= session_id().'_draft.jpg';
					break;
				default:	$error=true;	break;
			}
			break;
		default:	$error = true;	break;
	}
	if($file&&!$error){
		if(move_uploaded_file($file['tmp_name'],$path)){
			$pass = true;
		}
		if($pass){
// 			$preExtra['type'] = "set";
// 			$preExtra['action'] = "delete";
// 			$preExtra['path'] = $path;
// 			$preDetail['url'] ="dataCenter.php";
// 			$preDetail['key'] = $key;
// 			$preDetail['extra'] = $preExtra;
// 			$preData['initialPreviewConfig'][] = $preDetail; 
// 			$preData['initialPreview'][] = [];
			$preData['initialPreviewCount'][] = 1;
			$data = json_encode($preData);
		} else {
			$data = "{error: 'Cannot write file..'}";
		}
	} else {
		$data = "{error: 'ERROR.'}";
	}
	echo $data;
?>