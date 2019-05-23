<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/User.php');
	$usr = new User();
?>
<?php
 	if(isset($_GET['dis']))
 	{
 		$dblid = (int)$_GET['dis'];
 		$dblUser = $usr->DisableUser($dblid);
 	} 
?>
<?php
 	if(isset($_GET['ena']))
 	{
 		$enblid = (int)$_GET['ena'];
 		$enblUser = $usr->EnableUser($enblid);
 	} 
?>
<?php
 	if(isset($_GET['del']))
 	{
 		$delid = (int)$_GET['del'];
 		$delUser = $usr->DeleteUser($delid);
 	} 
?>

<div class="main">
	<?php
 		if(isset($dblUser))
		{
			echo $dblUser;
		}
 
	?>
	<?php
 		if(isset($enblUser))
		{
			echo $enblUser;
		}
 
	?>
	<?php
 		if(isset($delUser))
		{
			echo $delUser;
		}
 
	?>
	<div class="manageuser">
		<table class="tblone">
			<tr>
				<th>NO</th>
				<th>Name</th>
				<th>Username</th>
				<th>Email</th>
				<th>Action</th>
			</tr>
	<?php
		$userData = $usr->getAllUser();
		if($userData)
		{
			$i = 0;
			while ($result = $userData->fetch_assoc())
			{
				$i++;

	?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php 
					if($result['status'] == '1')
					{
						echo "<span class='error'>".$result['name']."</span>" ;
					}
					else
					{
						echo $result['name'];
					}
				  ?>
				</td>
				<td><?php echo $result['username']; ?></td>
				<td><?php echo $result['email']; ?></td>
				<td>
					<?php if($result['status'] == '0') { ?>
						<a onclick="return confirm('Are you sure to Disable')" href="?dis=<?php echo $result['userId']; ?>" >Disable</a>
					<?php } else{?>
						<a onclick="return confirm('Are you sure to Enable')" href="?ena=<?php echo $result['userId']; ?>" >Enable</a>
					<?php } ?>					
					||<a onclick="return confirm('Are you sure to Remove')" href="?del=<?php echo $result['userId']; ?>" >Remove</a> 
			</tr>
	<?php } } ?>
		</table>
	</div>	
</div>
<?php include 'inc/footer.php'; ?>