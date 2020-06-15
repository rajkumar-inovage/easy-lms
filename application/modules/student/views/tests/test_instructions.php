<div class="card card-primary paper-shadow" data-z="0.5">
	<div class="card-header">
		<h4><?php echo ($test['title']); ?></h4>
	</div>
	<div class="card-body">
		<ol class="pl-4">
			<li>Test Duration: <strong><span class="completeDuration"><?php echo $test['time_min']; ?></span> </strong>minutes.</li>
			<li>Questions: <span class="completeDuration"><?php echo $num_test_questions; ?></span> </li>
			<li>Marks: <span class="completeDuration"><?php echo $test_marks; ?></span> </li>
			<li>Pass Percentage: <span class="completeDuration"><?php echo $test['pass_marks']; ?>%</span> </li>
			<li>Timer and Test Submission: The clock will show you the remaining time to complete the examination. </li>
			<li>The Question Palette displayed on the right side of screen will show the status of each question using one of the following symbols:
			<table class="table">
				<tbody>
					<tr>
						<td><span class="btn btn-sm btn-secondary text-white" title="Not Visited">1</span></td>
						<td>You have not visited the question yet.</td>
					</tr>
					<tr>
						<td><span class="btn btn-sm btn-danger" title="Not Answered">3</span></td>
						<td>You have not answered the question.</td>
					</tr>    
					<tr>
						<td><span class="btn btn-sm btn-success" title="Answered">5</span></td>
						<td>You have answered the question.</td>
					</tr>
					<tr>
						<td><span class="btn btn-sm btn-warning" title="Mark for Review">7</span></td>
						<td>You have marked the question for review.</td>
					</tr>
				</tbody>
			</table>
			<li>Bookmark Questions: The Marked for Review status for a question simply indicates that you would like to look at that question again. Selected answer will be considered for evaluation.</li>
			<li>Question Palette (not in Smart Phones): You can click on the "&gt;" arrow to collapse the question palette thereby maximizing the question window. To view the question palette again, you can click on "&lt;" which appears on the right side of question window.</li>
		</ol>
		<strong>Answering a Question : </strong>
		<ol class="pl-4" start="6">
			<li>Procedure for answering a multiple choice type question:
				<ol class="pl-4" type="a">
					<li>To select your answer, click on the button of one of the options</li>
					<li>To deselect your chosen answer, click on the button of the chosen option again or click on the <strong>Clear Response</strong> button</li>
					<li>To change your chosen answer, click on the button of another option</li>
					
				</ol>
			</li>
			<li>You can shuffle between tests and questions anytime during the examination as per your convenience only during the time stipulated.</li>
		</ol>
	</div>
	<div class="card-footer">
		<p class="btn-toolbar btn-toolbar-demo">
			<?php if ($start_test == true) { ?>
				<a href="<?php echo site_url ('student/tests/start_test/'.$coaching_id.'/'.$member_id.'/'.$test_id); ?>" class="btn btn-success  ">Start Test <i class="fa fa-play-circle"></i> </a>
			<?php } ?>
		</p>
	</div>
</div>