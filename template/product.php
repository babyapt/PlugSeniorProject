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
		$( '#send' ).click(function(){
			var error = false;
			if($( '#basic' ).css( 'display' )=="none")
				var type = "custom";
			else
				var type = "basic";
			if(type=="basic"&&$( '#productID' ).val()=='')	error = true;
			if($( '#purchaseFileCheck' ).val()==''||$( '#draftFileCheck' ).val()=='') error = true;
			if(!error){
				$.post('dataCenter.php',{
						'type': 'set',
						'action': 'addOrder',
						'orderType': type,
						'detail': $( '#detail' ).val(),
						'productID': $( '#productID' ).val(),  
						'color': $( '#colorselector' ).val()  
					},function(data){
						var data = $.parseJSON(data);
						if(data.status=="SUCCESS"){
							alert('ส่งคำสั่งซื้อสำเร็จ');
							document.location='?page=orderDetail&orderid='+data.orderid;
						} else {
							alert('มีข้อผิดพลาด\n'+data.error);
							console.log(data.strSQL);
						}
					});
			} else {
				var text = '';
				if(type=="basic"&&$( '#productID' ).val()=='')	text += 'กรุณาเลือกรูปแบบพื้นฐาน\n';
				if($( '#purchaseFileCheck' ).val()=='') text += 'กรุณาอัพโหลดใบสั่งซื้อ\n';
				if($( '#draftFileCheck' ).val()=='') text += 'กรุณาอัพโหลดโครงสร้างชิ้นงาน\n';
				alert(text);
			}
		});
	});
	var $pinput = $("#purchaseFile");
	$pinput.fileinput({
	    uploadUrl: "dataCenter.php", // server upload action
	    allowedFileExtensions: ["pdf"],
	    language: "th",
	    uploadExtraData: {type:'set',action:'upload',tag:'order',name:'purchase'},
	    uploadAsync: false,
	    showUpload: false, // hide upload button
	    showRemove: false, // hide remove button
	    minFileCount: 0,
	    maxFileCount: 1,
	    autoReplace: true,
	    validateInitialCount: true
	}).on("filebatchselected", function(event, files) {
	    // trigger upload method immediately after files are selected
	    $pinput.fileinput("upload");
	    $("#purchaseFileCheck").val("1");
	});
	$("#draftFile").fileinput({
	    uploadUrl: "dataCenter.php", // server upload action
	    allowedFileExtensions: ["jpg","jpeg"],
	    language: "th",
	    uploadExtraData: {type:'set',action:'upload',tag:'order',name:'draft'},
	    uploadAsync: false,
	    showUpload: false, // hide upload button
	    showRemove: false, // hide remove button
	    minFileCount: 0,
	    maxFileCount: 1,
	    autoReplace: true,
	    validateInitialCount: true
	}).on("filebatchselected", function(event, files) {
	    // trigger upload method immediately after files are selected
	    $("#draftFile").fileinput("upload");
	    $("#draftFileCheck").val("1");
	});
</script>