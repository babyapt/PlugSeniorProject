<div id="loginModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<?php if(!$authRequire){?><button type="button" class="close" data-dismiss="modal">&times;</button><?php }?>
				<h4 class="modal-title">ระบบสมาชิก</h4>
			</div>
			<div class="modal-body form-group">
				<form id="loginForm" role="form">
					<label for="usr">ชื่อผู้ใช้:</label>
					<input type="text" class="form-control" autofocus id="usr" name="usr" placeholder="โปรดใส้ชื่อผู้ใช้">
					<label for="pwd">รหัสผ่าน:</label>
					<input type="password" class="form-control" id="pwd" name="pwd" placeholder="โปรดใส่รหัสผ่าน">
					<span class="help-block">ลืมรหัสผ่าน?</span>
					<input type="submit" id="loginSubmit" class="btn btn-block btn-primary" value="เข้าสู่ระบบ" />
					<button type="button" id="register" class="btn btn-block"  data-toggle="modal" data-target="#registerModal">สมัครสมาชิก</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
	if($authRequire) echo '
		<script>
			$(function(){
				$("#loginModal").modal({
    				backdrop: "static",
    				keyboard: false
				}).modal("show");
			});
		</script>';
	require_once 'template/register.php';
?>