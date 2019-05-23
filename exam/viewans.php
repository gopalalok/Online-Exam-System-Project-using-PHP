<?php include 'inc/header.php'; ?>
<?php
	Session::checkSession();
	$total = $exm->getTotalRows();
?>

<div class="main">
<h1>Solution of <?php echo $total; ?></h1>
	<div class="viewans">
		<form method="post" action="">
		<table>
		<?php
			$getQues = $exm->getQuesByOrder();
			if($getQues){
				while ($question = $getQues->fetch_assoc()) {
			
		?> 
			<tr>
				<td colspan="2">
				 <h3><?php echo $question['quesNo']; ?>: <?php echo $question['ques']; ?></h3>
				</td>
			</tr>
			<?php
				$number = $question['quesNo'];
				$answer = $exm->getAnswer($number);
				if($answer)
				{
					while ($result = $answer->fetch_assoc()) {
			?>
			<tr>
				<td>
				 <input type="radio"  />
				 <?php
				  if($result['rightAns'] == '1'){
				  	echo "<span style='color:blue'>".$result['ans']. "</span>";
				  }
				  else
				  {
				  	echo $result['ans']; 
				  }
				 ?>
				</td>
			</tr>
		<?php }} ?>
			
	<?php }} ?>				
	</table>
	<a href="starttest.php">Start Again</a>
</div>
 </div>
<?php include 'inc/footer.php'; ?>