<?php
	if(!$_USER['id']){
		$authRequire = true;
	}
	$orderID = isset($_REQUEST['orderid'])?$_REQUEST['orderid']:'';
	if($orderID){
		$strSQL = sprintf(
		"
			SELECT
				*
			FROM
				`order`
			WHERE
				orderID = '%s'
		",
		mysql_real_escape_string($orderID)
		);
		$objQuery = mysql_query($strSQL);
		if($objQuery&&mysql_num_rows($objQuery)==1){
			$row = mysql_fetch_assoc($objQuery);
			if($_USER['member']&&$row['memberID']==$_USER['id']){
				$data.='<div class="progress">
								<div class="progress-bar progress-bar-'.getMemberOrderTr($row['status']).' progress-bar-striped active" role="progressbar" aria-valuenow="'.($row['status']).'" aria-valuemin="0" aria-valuemax="7" style="width:'.(($row['status']+1)/7*100).'%">
									'.getOrderStatus($row['status']).'
								</div>
							</div>';
// 				$data.= '<div class="container"><div class="row">';
				$data.= '<div class="col-sm-2"><strong>รหัสการสั่งซื้อ : </strong></div><div class="col-sm-4">'.$row['orderID'].'</div>';
				$data.= '<div class="col-sm-2"><strong>สถานะ : </strong></div><div class="col-sm-4">'.getOrderStatus($row['status']).'</div>';
				$data.= '<div class="col-sm-2"><strong>ราคาที่ตกลง : </strong></div><div class="col-sm-4">'.$row['price'].'</div>';
				$data.= '<div class="col-sm-12"><strong>หมายเหตุ : </strong></div><div class="col-sm-12"><span>'.$row['note'].'</span></div>';
				$data.= '<div class="col-sm-12"><strong>เอกสารแนบ : </strong></div>';
				$photo = Array();
				$file = Array();
				switch($row['status']){
					case '0':
						$file[] = 'files.php?type=get&action=pdf&orderid='.$orderID.'&tag=purchase';
						break;
					case '1':
						$photo[] = 'files.php?type=get&action=photo&orderid='.$orderID.'&tag=quote';
						$photo[] = 'files.php?type=get&action=photo&orderid='.$orderID.'&tag=structure';
						break;
				}
				foreach($photo as $photo)
					$data.= '<div class="col-sm-12 text-center"><a href="'.$photo.'&_='.date('U').'" target="_blank"><img src="'.$photo.'&_='.date('U').'" class="img-responsive img-thumbnail"></a></div>';
				foreach($file as $file)
					$data.= '<div class="col-sm-12 text-center embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="'.$file.'&_='.date('U').'"></iframe></div><div class="col-sm-12 text-center"><a href="'.$file.'&_='.date('U').'" target="_blank">บันทึกไฟล์</a></div>';
// 				$data.= '</div></div>';
			} elseif($_USER['admin']){
				$data = 'admin';
			} else {
				$data = '<div class="alert alert-danger"><strong>ข้อผิดพลาด!</strong> คุณไม่มีสิทธิ์ในการดูเนื้อหาในหน้านี้</div>';
				$noPermisson = true;
			}
			if(!$noPermisson){
				$strSQL = sprintf(
						"
			SELECT
				dateTime,status
			FROM
				`orderlog`
			WHERE
				orderID = '%s'
			ORDER BY
				dateTime
			DESC
		",
						mysql_real_escape_string($orderID)
				);
				$objQuery = mysql_query($strSQL);
				if($objQuery&&mysql_num_rows($objQuery)>=1){
					$tableData = '';
					while($row = mysql_fetch_assoc($objQuery)){
						if($_USER['member']){
							$tableData.='<tr>
										<td class="col-sm-2 text-center">'.date('d/m/Y H:i:s',strtotime($row['dateTime'])).'</td>
										<td class="col-sm-10">เปลี่ยนสถานะเป็น '.getOrderStatus($row['status']).'</td>
									</tr>';
						} elseif($_USER['admin']){
							$tableData = '<tr><td>admin</td></tr>';
						}
					}
				} else {
					$tableData = '<tr><td colspan="2" class="text-center danger">ข้อผิดพลาด!</strong> มีปัญหาในการเรียกข้อมูล โปรดติดต่อผู้ดูแลระบบ</td></tr>';
				}
			}
		} else {
			if($objQuery)
				$data = '<div class="alert alert-danger"><strong>ข้อผิดพลาด!</strong> ไม่พบการสั่งซื้อหมายเลข '.$orderID.'</div>';
			else 
				$data = '<div class="alert alert-danger"><strong>ข้อผิดพลาด!</strong> มีปัญหาในการเรียกข้อมูล โปรดติดต่อผู้ดูแลระบบ</div>';
		}
	} else {
		$data = '<div class="alert alert-danger"><strong>ข้อผิดพลาด!</strong> ไม่พบการสั่งซื้อ กรุณาติดต่อผู้ดูแลระบบ</div>';
	}
?>
<div class="row">
	<div class="box">
		<div class="panel panel-default">
			<div class="panel-heading text-center">รายละเอียดการสั่งซื้อ</div>
			<div class="panel-body"><?php echo $data;?></div>
		</div>
		<div class="panel panel-default<?php echo $tableData==''?' hidden':'';?>">
			<div class="panel-heading text-center">ประวัติการติดตามคำสั่งซื้อ</div>
			<div class="panel-body">
				<div class="table-responsive">          
					<table class="table table-striped table-hover table-bordered">
						<thead>
							<tr>
								<th class="col-sm-2">วันที่ เวลา</th>
								<th class="col-sm-10">รายละเอียด</th>
							</tr>
						</thead>
						<tbody>
							<?php echo $tableData;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>