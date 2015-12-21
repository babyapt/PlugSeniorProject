<?php
	$orderType = isset($_REQUEST['orderType'])?$_REQUEST['orderType']:false;
	$detail = isset($_REQUEST['detail'])?$_REQUEST['detail']:false;
	if($orderType == 'basic'){
		$productID = isset($_REQUEST['productID'])?"'".$_REQUEST['productID']."'":false;
		$color = isset($_REQUEST['color'])?color:false;
	}
	$error = $pass = false;
	if(!$orderType){
		$error = true;
		$errorData .= 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ\n';
	}
	if($orderType=='basic'&&(!$productID||!$color)) {
		$error = true;
		if(!$productID)
			$errorData .= 'ไม่พบรหัสรูปแบบ\n';
		if(!$color)
			$errorData .= 'ไม่พบสี\n';
	}
	$filePurchase = 'order/temp/'.session_id().'_purchase.pdf';
	$fileDraft = 'order/temp/'.session_id().'_draft.jpg';
	if(!file_exists($filePurchase)||!file_exists($fileDraft)){
		$error = true;
		if(!file_exists($filePurchase))
			$errorData .= 'ไม่พบไฟล์ใบสั่งซื้อ\n';
		if(!file_exists($fileDraft))
			$errorData .= 'ไม่พบไฟล์รูปโครงสร้างชิ้นงาน\n';
	}
	if(!$_USER['id']){
		$error = true;
		$errorData .= 'ไม่พบสิทธิ์ในการสั่งซื้อ\n'.$_USER['id'];
	}
	if($orderType!='basic'){
		$productID = 'NULL';
	}
	if(!$detail){
		$detail = '';
	}
	if(!$error){
		$strSQL = sprintf(
				"
				INSERT INTO
					`order`
				VALUES (
					NULL,
					'%s',
					%s,
					NULL,
					'%s',
					'0'
				)
				",
				mysql_real_escape_string($_USER['id']),
				$productID,
				mysql_real_escape_string($detail)
		);
		$objQuery = mysql_query($strSQL);
		if($objQuery){
			$qorderid = mysql_insert_id();
			$data['status'] = 'SUCCESS';
			$data['orderid'] = $qorderid;
			rename('order/temp/'.session_id().'_purchase.pdf','order/purchase/'.$qorderid.'.pdf');
			rename('order/temp/'.session_id().'_draft.jpg','order/draft/'.$qorderid.'.jpg');
			$strSQL2 = sprintf(
					"
				INSERT INTO
					`orderlog`
				VALUES (
					NULL,
					'%s',
					'1',
					'%s',
					NULL,
					'0'
				)
				",
					mysql_real_escape_string($qorderid),
					mysql_real_escape_string(date("Y-m-d H:i:s"))
			);
			$objQuery2 = mysql_query($strSQL2);
		} else {
			$data['status'] = 'ERROR';
			$data['error'] = 'ไม่สามารถบันทึกข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ\n';
			$data['strSQL'] = $strSQL;
		}
	} else {
		$data['status'] = 'ERROR';
		$data['error'] = $errorData;
	}
	echo json_encode($data);
?>