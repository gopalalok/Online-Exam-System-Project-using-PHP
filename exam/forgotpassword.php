<?php include 'inc/header.php'; ?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $forgotPass = $usr->forgotPassword($_POST);
    }
?>
<div class="main">
<h1>Online Exam System - User Registration</h1>
	<div class="segment" style="margin-right:30px;">
		<img src="img/regi.png"/>
	</div>
	<div class="segment">
	<form action="" method="post">
		<table>         
         <tr>
           <td>E-mail</td>
           <td><input name="email" type="text" id="email" /></td>
         </tr>
         <tr>
           <td></td>
           <td><input type="submit" id="forgotPassword" value="Process">
         </tr>
         <?php
        if(isset($forgotPass))
        {
            echo $forgotPass;
        }
        ?>
       </table>
	   </form>
     <span id="msg"></span>
	</div>

	
</div>
 
<?php include 'inc/footer.php'; ?>