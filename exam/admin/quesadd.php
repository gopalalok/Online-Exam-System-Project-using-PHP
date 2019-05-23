<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/Exam.php');
	$exm = new Exam();
?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$addQue = $exm->AddQuestions($_POST);
	} 
	$total = $exm->getTotalRows();
	$next = $total+1; 
?>
<style type="text/css">
.adminpanel{width: 480px;color: #999;margin: 20px auto 0;padding: 30px;border: 1px solid #ddd;}
input[type="number"] {
  border: 1px solid #ddd;
  margin-bottom: 10px;
  padding: 5px;
  width: 100px;
}
</style>
<div class="main">
<h1>Admin Panel</h1>
<?php
	if(isset($addQue))
	{
		echo $addQue;
	}

?>
	<div class="adminpanel">
		<form action="" method="post">
			<table>
				<tr>
					<td>Questions No</td>
					<td>:</td>
					<td><input type="number" value="<?php if(isset($next)){ echo $next;} ?>" name="quesNo" /></td>
				</tr>
				<tr>
					<td>Questions</td>
					<td>:</td>
					<td><input type="text" value="" name="ques" placeholder="Enter Questions....." required /></td>
				</tr>
				<tr>
					<td>Choice One</td>
					<td>:</td>
					<td><input type="text" value="" name="ans1" placeholder="Enter Choice One....." required /></td>
				</tr>
				<tr>
					<td>Choice Two</td>
					<td>:</td>
					<td><input type="text" value="" name="ans2" placeholder="Enter Choice Two....." required /></td>
				</tr>
				<tr>
					<td>Choice Three</td>
					<td>:</td>
					<td><input type="text" value="" name="ans3" placeholder="Enter Choice Three....." required /></td>
				</tr>
				<tr>
					<td>Choice Four</td>
					<td>:</td>
					<td><input type="text" value="" name="ans4" placeholder="Enter Choice Four....." required /></td>
				</tr>
				<tr>
					<td>Correct Ans</td>
					<td>:</td>
					<td><input type="number" value="" name="rightAns" placeholder="Enter Corect Answer No....." required /></td>
				</tr>
				<tr>
					<td colspan="3" align="center"><input  type="submit" value="AddQuestion" /></td>
				</tr>
			</table>
		</form>



	</div>
</div>
<?php include 'inc/footer.php'; ?>