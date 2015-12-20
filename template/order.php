<?php
	$requireDialog[] = 'template/product.php';
	$strSQL = 
			"
			SELECT
				*
			FROM
				`product`
			WHERE
				status = '1'
			ORDER BY
				productID
			ASC
			";
	$objQuery = mysql_query($strSQL);
	if($objQuery&&mysql_num_rows($objQuery)>0){
		$tableDataRes = '';
		$dataRes = array();
		$tableData = '';
		while($row = mysql_fetch_assoc($objQuery)){
			$data.= '
					<div class="col-sm-4 text-center">
						<a href="javascript:voidf();" data-toggle="modal" data-target="#modalProduct_'.$row['productID'].'" class="thumbnail">
			 				<img src="files.php?type=get&action=img&tag=product&id='.$row['productID'].'&_='.date('U').'" alt="'.$row['name'].'" class="img-responsive" />
							<kbd>'.$row['name'].'</kbd>    
						</a>
					</div>';
		}
	}
?>
<ul class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#custom">ลูกค้ากำหนดเอง</a></li>
	<li><a data-toggle="tab" href="#basic">รูปแบบพื้นฐาน</a></li>
</ul>
<div class="tab-content">
	<div id="custom" class="tab-pane fade in active">
	</div>
	<div id="basic" class="tab-pane fade">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<?php echo $data;?>
				</div>
				<div class="col-sm-12"></div>
				<div class="col-sm-3">รหัสรูปแบบ : </div>
				<div class="col-sm-9"><input type="text" readonly id="productID" style="border:none;"></div>
				<div class="col-sm-3">สีของชิ้นงาน</div>
				<div class="col-sm-9">
					<select id="colorselector">
						<option value="RAL7032" data-color="#b5b0a1" selected="selected">RAL 7032</option>
						<option value="RAL9001" data-color="#e9e0d2">RAL 9001</option>
						<option value="RAL7047" data-color="#c8c8c7">RAL 7047</option>
						<option value="RAL9010" data-color="#f1ece1">RAL 9010</option>
						<option value="Ghostwhite" data-color="#f8f8ff">Ghostwhite</option>
					</select>
					<kbd id="colorTitle" class="">RAL 7032</kbd>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body form-group">
		<div class="col-sm-12"><strong>อัพโหลดใบสั่งซื้อ : </strong></div>
		<div class="col-sm-3"><small><abbr title="นามสกุลของไฟล์จะต้องเป็น .pdf เท่านั้น">(รูปแบบไฟล์ PDF เท่านั้น)</abbr></small></div>
		<div class="col-sm-9"><input type="file" /></div>
		<div class="col-sm-12"><strong>อัพโหลดรูปโครงสร้างชิ้นงาน : </strong></div>
		<div class="col-sm-3"><small><abbr title="นามสกุลของไฟล์จะต้องเป็น .jpg หรือ .jpeg เท่านั้น">(รูปแบบไฟล์ JPG เท่านั้น)</abbr></small></div>
		<div class="col-sm-9"><input type="file" /></div>
		<div class="col-sm-12"><strong>รายละเอียด : </strong></div>
		<div class="col-sm-12"><textarea class="form-control"></textarea></div>
	</div>
</div>