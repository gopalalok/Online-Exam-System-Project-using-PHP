<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/Exam.php');
	$exm = new Exam();
?>

<?php
 	if(isset($_GET['delques']))
 	{
 		$quesNo = (int)$_GET['delques'];
 		$delQue = $exm->delQuestion($quesNo);
 	} 
?>

<div class="main">

	<?php
 		if(isset($delQue))
		{
			echo $delQue;
		}
 
	?>
	<div class="manageuser">
		<table class="tblone">
			<tr>
				<th width="10%">NO</th>
				<th width="70%">Questions</th>
				<th width="20%">Action</th>
			</tr>
	<?php
		$getData = $exm->getQuesByOrder();
		if($getData)
		{
			$i = 0;
			while ($result = $getData->fetch_assoc())
			{
				$i++;

	?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $result['ques']; ?></td>
				<td>				
					<a onclick="return confirm('Are you sure to Remove')" href="?delques=<?php echo $result['quesNo']; ?>" >Remove</a> 
			</tr>
	<?php } } ?>
		</table>
	</div>	
</div>
<?php include 'inc/footer.php'; ?>