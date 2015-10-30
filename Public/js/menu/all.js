$(document).ready(function(){
	//alert("hello world!");
	$(".fp_listBtn").click(function(){
		var name = $(this).parent().siblings().eq(1).text();
		//var pic_url = $(this).parent().siblings().eq(0).text();
		var time = new Date();
		//alert(time);
		var r = confirm("确认点菜："+name);
		if(r == true){
			var desk_id = $("#select_desk option:selected").val();
			if(desk_id != 0){
				var callback = function(data){
					if(data){
						alert(data);
					}
					else{
						alert("服务器返回错误");
					}
				}
				$.post("addList",{name:name,desk_id:desk_id},callback);
			}
			else{
				alert("请在右侧选桌子号～");
			}
		}
	});
})
