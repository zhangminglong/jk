$(function(){
	var item_id = $("#item_id").val();
	
	$('#edit-cat').modal({
		"backdrop":'static'
	});
	
	//保存
	$("#save-cat").click(function(){
		var username = $("#username").val();
		var password = $("#password").val();
		$.post(
			"../index.php?m=Home&c=Attorn&a=save",
			{"username": username ,"item_id": item_id , "password": password	},
			function(data){
				if (data.error_code == 0) {
					alert("转让成功！");
					window.location.href="../index.php?m=Home&c=Item&a=index";
				}else{
					alert("转让失败：" + data.error_message);
				}
			},
			"json"
		);
		return false;
	}); 
	
	$(".exist-cat").click(function(){
		window.location.href="../index.php?m=Home&c=Item&a=show&item_id="+item_id;
		return false;
	});

});

