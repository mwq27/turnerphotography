/* Author: 

*/
$("#csub").click(function(){
	var name = $("#name").val(), email = $("#email").val(), request = $("#request").val(), comments = $("#comments").val(), error = 0;
	var dataStr = "name="+name+"&email="+email+"&request="+request+"&comments="+comments;
	
	if(name == ""){
		$("#name-error").show();
		error = 1;
	}
	
	if(email == ""){
		$("#email-error").show();
		error = 1;
		
	}
	
	if(comments == ""){
		$("#comments-error").show();
		error = 1;
	}
	if(error == 1){
		return false;
	}
	$.ajax({
		url: "/content/contact",
		type: "post",
		data: dataStr,
		success: function(msg){
			 $("#msg-success").show();
			 $("#contactlink").overlay().close();
		}
	});
	
});
