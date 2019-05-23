<?php include 'inc/header.php'; ?>
<?php
	Session::checkLogin();  
?>
<div class="main">
<h1>Online Exam System - User Login</h1>
	<div class="segment" style="margin-right:30px;">
		<img src="img/test.png"/>
	</div>
	<div class="segment">
	<form action="" method="post">
		<table class="tbl">    
			 <tr>
			   <td>Email</td>
			   <td><input name="email" id="email" type="text"></td>
			 </tr>
			 <tr>
			   <td>Password </td>
			   <td><input name="password" type="password" id="password"></td>
			 </tr>
			 
			  <tr>
			  <td></td>
			   <td><input type="submit" id="loginSubmit" value="Login">
			   </td>
			 </tr>
       </table>
	   </form>
	   <p>New User ? <a href="register.php">Signup</a> Free</p>
	   <p>Forgot Password ? <a href="forgotpassword.php">Forgot Password</a> </p>
	   <span class="empty" style="display:none">Field must not be Empty !</span>
	   <span class="error" style="display:none">Email or Password not matched !</span>
	   <span class="disable" style="display:none">User ID Disable !</span>
	</div>


	
</div>
<?php include 'inc/footer.php'; ?>