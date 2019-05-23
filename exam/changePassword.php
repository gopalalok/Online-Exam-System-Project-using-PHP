<?php include 'inc/header.php'; ?>
<?php
	Session::checkSession();
	$userid = Session::get("userid"); 
?>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST')	
	{	
		$updateUser = $usr->changePassword($userid,$_POST);
	}

?>
<div class="main">
<h1>Online Exam System - User Login</h1>
	<div class="segment" style="margin-right:30px;">
		<img src="img/test.png"/>
	</div>
	<div class="segment">
<?php
	if(isset($updateUser))
	{
		echo $updateUser;
	}
?>
	<form action="" method="post">
		<table class="tbl">    
			 <tr>
			 	<td>New Password</td>
           		<td>
           			<input type="password" name="password" title="Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit" id="password"  />
           		</td>        	
			 </tr>
			 <tr>
			   <td>Confirm Password</td>
			   	<td>
			   		<input type="password" title="Please enter the same Password as above" name="cnfpassword" id="cnfpassword"  />
			   </td>
			 </tr>
			 
			  <tr>
			  <td></td>
			   <td><input type="submit" value="change password">
			   </td>
			 </tr>
       </table>
	   </form>
	</div>


	
</div>
<?php include 'inc/footer.php'; ?>