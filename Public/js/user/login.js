$(document).ready(function(){
	var username = getCookie("username");
	if(username){
		if(username != "admin"){
			$("#login").html("Hi,"+username);
			$("#exit").html("<a href='../User/quit'>退出</a>");
			$("#register").html("<a href='../User/todaylist'>我的订单</a>");
		}
		else{
			$("#login").html("Hi,"+username);
			$("#exit").html("<a href='../User/quit'>退出</a>");
			$("#register").html("<a href='../User/mangelist'>管理订单</a>");
		}
	}
	else{
		//alert("hello world");
	}
})
