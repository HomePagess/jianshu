/**
 * 
 */
 window.onload=function() {
 	code();
 	//登录验证
 	var fm=document.getElementsByTagName('form')[0];
 	fm.onsubmit=function() {
 		//能用客户端验证的，尽量用客户端
 		//用户名验证
 		if(fm.username.value.length<2||fm.username.value.length>20) {
 			alert("用户名不得小于2位或者大于20位");
 			fm.username.value='';//清空
 			fm.username.focus();//聚焦在该输入框上
 			return false;
 		}
 		if(/[<>\'\"\ \  ]/.test(fm.username.value)) {
 			alert("用户名不得包含非法字符");
 			fm.username.value='';//清空
 			fm.username.focus();//聚焦在该输入框上
 			return false;
 		}
 		
 		//密码验证
 		if(fm.password.value.length<6) {
 			alert("密码不得小于6位");
 			fm.password.value='';//清空
 			fm.password.focus();//聚焦在该输入框上
 			return false;
 		}
 		if(fm.password.value!=fm.notpassword.value) {
 			alert("密码不一致");
 			fm.notpassword.value='';//清空
 			fm.notpassword.focus();//聚焦在该输入框上
 			return false;
 		}
 		
 		//验证码验证
 		if(fm.yzm.value.length!=4) {
 			alert("验证码必须是4位！");
	 			fm.yzm.value='';//清空
	 			fm.yzm.focus();//聚焦在该输入框上
	 			return false;
 		}
 	}
 }