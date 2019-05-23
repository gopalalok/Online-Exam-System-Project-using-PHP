<?php include 'inc/header.php'; ?>
<div class="main">
<h1>Online Exam System - User Registration</h1>
	<div class="segment" style="margin-right:30px;">
		<img src="img/regi.png"/>
	</div>
	<div class="segment">
	<form action="" method="post">
		<table>

		     <tr>
           <td>Name</td>
           <td><input type="text" name="name" id="name" /></td>
         </tr>
		    <tr>
           <td>Username</td>
           <td><input name="username" type="text" id="username" /></td>
         </tr>
         <tr>
           <td>Password</td>
           <td><input type="password" name="password" title="Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter and one digit" id="password"  /></td>
         </tr>

          <tr>
           <td>Confirm Password</td>
           <td><input type="password" title="Please enter the same Password as above" name="cnfpassword" id="cnfpassword"  /></td>
         </tr>
         
         <tr>
           <td>E-mail</td>
           <td><input name="email" type="text" id="email" /></td>
         </tr>
         <tr>
           <td></td>
           <td><input type="submit" id="regSubmit" value="SignUp">
         </tr>
       </table>
	   </form>
	   <p>Already Registered ? <a href="index.php">Login</a> Here</p>
     <span id="msg"></span>
	</div>

	
</div>
 
<?php include 'inc/footer.php'; ?>