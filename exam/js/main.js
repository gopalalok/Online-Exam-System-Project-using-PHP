$(function(){
	$("#regSubmit").click(function(){
		var name 		= $("#name").val();
		var username 	= $("#username").val();
		var password 	= $("#password").val();
		var cnfpassword = $("#cnfpassword").val();
		var email 		= $("#email").val();
		var dataString 	= 'name='+name+'&username='+username+'&password='+password+'&cnfpassword='+cnfpassword+'&email='+email;
		$.ajax({
			type:"POST",
			url:"getregister.php",
			data: dataString,
			success: function(data){
				$("#msg").html(data);									
				setTimeout(function(){
					$("#msg").fadeOut();
					},4000);					
			}
		});
		return false;
	});

	$("#loginSubmit").click(function(){
		var email 		= $("#email").val();
		var password 	= $("#password").val();
		
		var dataString 	= 'email='+email+'&password='+password;
		$.ajax({
			type:"POST",
			url:"getlogin.php",
			data: dataString,
			success: function(data){
				if($.trim(data) == "empty")
				{
					$(".empty").show();					
					setTimeout(function(){
						$(".empty").fadeOut();
					},4000);
				}
				else if($.trim(data) == "disable")
				{
					
					$(".disable").show();
					setTimeout(function(){
						$(".disable").fadeOut();
					},4000);
				}				
				else if($.trim(data) == "error")
				{
					
					$(".error").show();
					setTimeout(function(){
						$(".error").fadeOut();
					},4000);
				}
				else
				{
					window.location = "exam.php";
				}
			}
		});
		return false;
	});

	
});