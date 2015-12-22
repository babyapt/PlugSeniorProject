/**
 * Customize Script
 */
$(function(){
	$( '#loginForm' ).submit(function (event){
		event.preventDefault();
		var username = $('#usr').val();
		var password = $('#pwd').val();
		if(username!=''&&password!='')
		$.post('dataCenter.php',{
			'type': 'get',
			'action': 'login',
			'username': username,
			'password': password
		},function(data){
			data = $.parseJSON(data);
			console.log(data);
			if(data.status=='SUCCESS'){
				$('#loginForm').html('<div class="alert alert-success"><strong>เข้าสู่ระบบสำเร็จ</strong> อีก 3 วินาทีจะทำการเปลี่ยนหน้า หรือ <a href="'+document.location+'">คลิกที่นี่</a></div>');
				setTimeout(function(){
					document.location = document.location;
				}, 3000);
			} else if(data.status=='ERROR'){
				switch(data.reason){
				case 'NOTVALID':
					if(username=='') wrongField('#usr','กรุณากรอกชื่อผู้ใช้');
					if(password=='') wrongField('#pwd','กรุณากรอกรหัสผ่าน');
					break;
				case 'SQLERROR':
					alert('กรุณาติดต่อเจ้าของเว็บไซต์');
					break;
				case 'NOTFOUND':
					$('#usr').focus();
					wrongField('#usr','ไม่พบชื่อผู้ใช้');
					break;
				case 'WRONGPASS':
					$('#pwd').focus();
					wrongField('#pwd','รหัสผ่านผิดพลาด');
					break;
				}
			} else {
				alert('กรุณาติดต่อเจ้าของเว็บไซต์');
			}
		});
		else {
			if(username=='') wrongField('#usr','กรุณากรอกชื่อผู้ใช้');
			if(password=='') wrongField('#pwd','กรุณากรอกรหัสผ่าน');
		}
	});
	$( '#registerForm' ).submit(function (event){
		event.preventDefault();
		var fname = $('#fname').val();
		var lname = $('#lname').val();
		var tel = $('#tel').val();
		var username = $('#rusr').val();
		var password = $('#rpwd').val();
		var cpassword = $('#cpwd').val();
		var error = false;
		var errorData = '';
		if(fname==''||!fname){	error = true;	wrongField('#fname','กรุณากรอกชื่อจริง');}
		if(lname==''||!lname){	error = true;	wrongField('#lname','กรุณากรอกนามสกุล');}
		if(tel==''||!tel){	error = true;	wrongField('#tel','กรุณากรอกเบอร์โทรศัพท์');}
		if(username==''||!username){	error = true;	wrongField('#rusr','กรุณากรอกชื่อผู้ใช้');}
		if(password==''||!password){	error = true;	wrongField('#rpwd','กรุณากรอกรหัสผ่าน');}
		if(cpassword==''||!cpassword){	error = true;	wrongField('#cpwd','กรุณากรอกรหัสผ่านอีกครั้ง');}
		if(cpassword!==password){	error = true;	wrongField('#cpwd','รหัสผ่านไม่ตรงกัน');}
		if(!error)
			$.post('dataCenter.php',{
				'type': 'set',
				'action': 'register',
				'fname': fname,
				'lname': lname,
				'tel': tel,
				'username': username,
				'password': password,
				'cpassword': cpassword
			},function(data){
				data = $.parseJSON(data);
				console.log(data);
				if(data.status=='SUCCESS'){
					var preReg = $('#registerForm').html();
					$('#usr').val($('#rusr').val());
					$('#registerForm').html('<div class="alert alert-success"><strong>สมัครสมาชิกสำเร็จ</strong> รออีก 3 วินาที หรือ <a href="javascript:voidf();" data-dismiss="modal">คลิกที่นี่</a> เพื่อปิดหน้าต่างนี้</div>');
					setTimeout(function(){
						$('#registerModal').modal('hide');
						$('#registerForm').html(preReg);
					}, 3000);
				} else if(data.status=='ERROR'){
					switch(data.reason){
					case 'NOTVALID':
						if(fname==''||!fname){	wrongField('#fname','กรุณากรอกชื่อจริง');}
						if(lname==''||!lname){	wrongField('#lname','กรุณากรอกนามสกุล');}
						if(tel==''||!tel){	wrongField('#tel','กรุณากรอกเบอร์โทรศัพท์');}
						if(username==''||!username){	wrongField('#rusr','กรุณากรอกชื่อผู้ใช้');}
						if(password==''||!password){	wrongField('#rpwd','กรุณากรอกรหัสผ่าน');}
						if(cpassword==''||!cpassword){	wrongField('#cpwd','กรุณากรอกรหัสผ่านอีกครั้ง');}
						break;
					case 'SQLERROR':
						alert('กรุณาติดต่อเจ้าของเว็บไซต์');
						break;
					case 'NOTMATCH':
						wrongField('#cpwd','รหัสผ่านไม่ตรงกัน');
						break;
					case 'USEREXIST':
						$('#pwd').focus();
						wrongField('#rusr','มีชื่อผู้ใช้นี้อยู่แล้วในระบบ');
						break;
					}
				} else {
					alert('กรุณาติดต่อเจ้าของเว็บไซต์');
				}
			});
			else {
				if(fname==''||!fname){	wrongField('#fname','กรุณากรอกชื่อจริง');}
				if(lname==''||!lname){	wrongField('#lname','กรุณากรอกนามสกุล');}
				if(tel==''||!tel){	wrongField('#tel','กรุณากรอกเบอร์โทรศัพท์');}
				if(username==''||!username){	wrongField('#rusr','กรุณากรอกชื่อผู้ใช้');}
				if(password==''||!password){	wrongField('#rpwd','กรุณากรอกรหัสผ่าน');}
				if(cpassword==''||!cpassword){	wrongField('#cpwd','กรุณากรอกรหัสผ่านอีกครั้ง');}
				if(cpassword!==password){	wrongField('#cpwd','รหัสผ่านไม่ตรงกัน');}
			}
		console.log('test');
	});
	$( '#logout' ).click(function(){
		$.post('dataCenter.php',{
			'type': 'get',
			'action': 'logout'
		},function(data){
			document.location = document.location;
		})
	});
});
function wrongField(obj,text){
	var objo = $( obj );
	var oldClass = objo.attr("class");
	setTimeout("$('"+obj+"').attr( 'class','"+oldClass+"' ).popover('destroy');", 3000);
	$( objo ).addClass('alert-danger');
	$( objo ).popover({content:text, placement: 'bottom'});
	$( objo ).popover("show");
}
function voidf(){
	return true;
}