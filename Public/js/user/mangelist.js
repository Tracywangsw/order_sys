$(document).ready(function(){
	$(".select_input").focus(function(){
		if($(this).val() == "请输入菜名"){
			$(this).attr("value","");
		}
	});
	$("#select_menu").blur(function(){
		if($(this).val() == ""){
			$(this).attr("value","请输入菜名");
		}
	});
	$("#confirm_change").click(function(){
		var j = $(".change_checkbox:checked").length;
		var changeList = new Array(j);
		var change_state = $("#change_state option:selected").val();
		$(".change_checkbox:checked").each(function(i){
			changeList[i] = $(this).val();
		});
		if(!change_state){
			alert("请选择所修改菜的状态");
		}
		else if(j == 0){
			alert("请选中至少一个菜");
		}
		var callback =function(data){
			if(data == "修改成功"){
				alert(data);
				location.reload();
			}
		}
		$.post("changestate",{change_state:change_state,changeList:changeList},callback);
		//return false;
	});
})
