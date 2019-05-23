<?php include 'inc/header.php'; ?>
<?php
	Session::checkSession();
	$questions = $exm->getQuestions();
	$total = $exm->getTotalRows();
?>
<div class="main">
<h1>Welcome to Online Exam</h1>
	<div class="starttest">
		<h2>Test all type Questions</h2>
		<ul>
			<li><strong>Number of Questions:</strong><?php echo $total; ?></li>
			<li><strong>Questions Type:</strong>MCQ</li>
		</ul>
		<a href="test.php?q=<?php echo $questions['quesNo']; ?>">Start Test</a>
	</div>
	
  </div>
<?php include 'inc/footer.php'; ?>