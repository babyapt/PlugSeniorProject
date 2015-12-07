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
				window.location = window.location;
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
	$( '#logout' ).click(function(){
		$post('dataCenter.php',{
			
		},function(data){
			
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