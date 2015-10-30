$(document).ready(function(){
	$("#todaylist").click(function(){
		var callback = function(data){
			
		}
		$.post("mylist",{time:today},callback);
		//return false;
	});
	$(".mylist_back").click(function(){
		var r = confirm("确定取消这一订单？");
		if(r == true){
			var id = $(this).attr("sign");
			var callback = function(data){
				//$(this).parents(".mylist_tr").remove();
				alert(data);
				location.reload();
			}
			$.post("back",{id:id},callback);
		}
		return false;
	});
})
