<div id="registerModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">สมัครสมาชิก</h4>
			</div>
			<div class="modal-body form-group">
				<form id="registerForm" role="form">
					<label for="fname">ชื่อจริง:</label>
					<input type="text" class="form-control" id="fname" name="fname" placeholder="โปรดใส่ชื่อจริง">
					<label for="lname">นามสกุล:</label>
					<input type="text" class="form-control" id="lname" name="lname" placeholder="โปรดใส่นามสกุล">
					<label for="tel">เบอร์โทรศัพท์:</label>
					<input type="text" class="form-control" id="tel" name="tel" placeholder="โปรดใส่เบอร์โทรศัพท์">
					<label for="rusr">ชื่อผู้ใช้:</label>
					<input type="text" class="form-control" autofocus id="rusr" name="rusr" placeholder="โปรดใส้ชื่อผู้ใช้">
					<label for="rpwd">รหัสผ่าน:</label>
					<input type="password" class="form-control" id="rpwd" name="rpwd" placeholder="โปรดใส่รหัสผ่าน">
					<label for="cpwd">ยืนยันรหัสผ่าน:</label>
					<input type="password" class="form-control" id="cpwd" name="cpwd" placeholder="โปรดใส่รหัสผ่านอีกครั้ง">
					<span class="help-block"></span>
					<input type="submit" id="registerSubmit" class="btn btn-block btn-primary" value="สมัครสมาชิก" />
					<button type="button" class="btn btn-block" data-dismiss="modal">ยกเลิก</button>
				</form>
			</div>
		</div>
	</div>
</div>