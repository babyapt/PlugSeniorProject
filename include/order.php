<?php
	if(!$_USER['id']){
		$authRequire = true;
	}
	$strSQL = sprintf(
		"
		SELECT
			orderID,
			productID,
			status
		FROM
			`order`
		WHERE
			memberID = '%s'
		ORDER BY
			orderID
		DESC
		",
		mysql_real_escape_string($_USER['id'])
	);
	$objQuery = mysql_query($strSQL);
	if($objQuery&&mysql_num_rows($objQuery)>0){
		$tableDataRes = '';
		$dataRes = array();
		$tableData = '';
		while($row = mysql_fetch_assoc($objQuery)){
			$wait = '';
			switch($row['status']){
				case '0':
					$wait = ' <span class="label label-info">รอการตอบกลับจากบริษัท</span>';
					break;
				case '1':
					$wait = ' <span class="label label-warning">รอการตอบกลับจากลูกค้า</span>';
					$dataRes[] ='<tr class="'.getMemberOrderTr($row['status']).'">
											<td><a href="?page=orderDetail&orderid='.$row['orderID'].'">'.$row['orderID'].'</td>
											<td>'.($row['productID']?'เลือกรูปแบบพื้นฐาน':'กำหนดเองโดยลูกค้า').$wait.'</td>
											<td>'.getOrderStatus($row['status']).'</td>
										</tr>';
					break;
			}
			$tableData.='<tr class="'.getMemberOrderTr($row['status']).'">
									<td><a href="?page=orderDetail&orderid='.$row['orderID'].'">'.$row['orderID'].'</td>
									<td>'.($row['productID']?'เลือกรูปแบบพื้นฐาน':'กำหนดเองโดยลูกค้า').$wait.'</td>
									<td>'.getOrderStatus($row['status']).'</td>
								</tr>';
		}
		if(sizeof($dataRes)<=0){
			$tableDataRes = '<tr><td colspan="3" class="text-center">ไม่พบคำสั่งซื้อที่รอการตอบกลับ</td></tr>';
		} else {
			sort($dataRes);
			foreach ($dataRes as $val){
				$tableDataRes.= $val;
			}
		}
	} else {
		if(!$objQuery){
			$tableDataRes.= '<tr><td colspan="3" class="text-center danger"><strong>ข้อผิดพลาด!</strong> มีปัญหาในการเรียกข้อมูล โปรดติดต่อผู้ดูแลระบบ</td></tr>';
			$tableData.= '<tr><td colspan="3" class="text-center danger"><strong>ข้อผิดพลาด!</strong> มีปัญหาในการเรียกข้อมูล โปรดติดต่อผู้ดูแลระบบ</td></tr>';
		} else {
			$tableDataRes = '<tr><td colspan="3" class="text-center">ไม่พบข้อมูล</td></tr>';
			$tableData = '<tr><td colspan="3" class="text-center">ไม่พบข้อมูล</td></tr>';
		}
	}
?>
<div class="row">
	<div class="box">
		<div class="panel panel-default">
			<div class="panel-heading">รายการสั่งซื้อที่รอการตอบกลับจากลูกค้า</div>
			<div class="panel-body">
				<div class="table-responsive">          
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>รหัสการสั่งซื้อ</th>
								<th>ประเภทการสั่งซื้อ</th>
								<th>สถานะ</th>
							</tr>
						</thead>
						<tbody>
							<?php echo $tableDataRes;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">รายการสั่งซื้อย้อนหลัง(ทุกรายการ)</div>
			<div class="panel-body">
				<div class="table-responsive">          
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>รหัสการสั่งซื้อ</th>
								<th>ประเภทการสั่งซื้อ</th>
								<th>สถานะ</th>
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