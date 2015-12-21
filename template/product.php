<?php
	$data = '';
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
					<div id="modalProduct_'.$row['productID'].'" class="modal fade" role="dialog">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">'.$row['name'].'</h4>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-sm-12 text-center"><img src="files.php?type=get&action=img&tag=product&id='.$row['productID'].'&_='.date('U').'" alt="'.$row['name'].'" class="img-responsive img-thumbnail" /></div>
										<div class="col-sm-2">รายละเอียดสินค้า : </div><div class="col-sm-10">'.nl2br($row['detail']).'</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<div class="row text-center">
									<button type="button" class="btn btn-default selectProduct" data-dismiss="modal" data-productID="'.$row['productID'].'">เลือกรูปแบบนี้</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
								</div>
							</div>
						</div>
					</div>';
		}
	}
	echo $data;
?>
<script>
	$(function(){
		$( '.selectProduct' ).click(function(){
			$( '#productID' ).val($( this ).attr( 'data-productID' ));
		});
	});
</script>