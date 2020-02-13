<?php 

$finalized = $test['finalized']; 

// Count Questions in Test
$questions = $this->tests_model->getTestQuestions ( $test_id ); 
$num_questions = 0;
if ( is_array ($questions) ) {
	$num_questions = count($questions);
}
?> 
<div data-scrollable>
	<h4 class="category">Test Details</h4>
	<div class="sidebar-block">
		<div class="media margin-none">			
            <div class="media-body">
				<h4 class="sidebar-heading media-heading">
					<a href="#sidebar-test-info" data-toggle="collapse"><?php echo $test['title']; ?></a>
				</h4>
            </div>
		</div>
		<div class="collapse in" id="sidebar-test-info">
            <hr/>
            <p class="text-caption text-light">
				<i class="fa fa-clock-o fa-fw"></i> <?php echo $test['time_min']; ?> mins
				<i class="fa fa-calendar fa-fw"></i> <?php echo date('d/m/Y', $test['creation_date']); ?>
				<br/>
				<i class="fa fa-user fa-fw"></i> Max. Marks: <?php echo $test['max_marks']; ?>
				<br/>
				<i class="fa fa-check fa-fw"></i> Questions: <?php echo $num_questions; ?>
            </p>
			<?php if ( ! $finalized) { ?>
				<hr/>
				<a class="btn btn-white btn-sm paper-shadow relative" data-animated data-z="0.5" data-hover-z="1" href="<?php echo site_url ('coaching/tests/create/'.$category_id.'/'.$test_id); ?>">Edit details</a>
			<?php } ?>
		</div>
	</div>
	
	<h4 class="category">Manage Test</h4>
	<ul class="sidebar-block list-group list-group-menu list-group-minimal">
		
		<li class="list-group-item">
			<a href="<?php echo site_url ('coaching/tests/preview_test/'.$category_id.'/'.$test_id); ?>" > <span class="badge badge-success pull-right"><?php echo $num_questions; ?></span> <i class="fa fa-superscript fa-fw"></i> Question Sections </a>
		</li>
		<?php if ( ! $finalized) { ?>
			<li class="list-group-item">
				<a href="<?php echo site_url ('coaching/tests/question_group_create/'.$category_id.'/'.$test_id); ?>" > <span class="badge pull-right"><?php //echo $num_questions; ?></span> <i class="fa fa-plus fa-fw"></i> Create New Section </a>
			</li>
		<?php } ?>

	</ul>
	
	<h4 class="category">Status</h4>
	<div class="sidebar-block">
		<?php if ($finalized) { ?>
			<label class="label label-success">Published</label>
		<?php } else { ?>
			<label class="label label-default">Unpublished</label>
		<?php } ?>
	</div>

	<h4 class="category">Actions </h4>
	<ul class="sidebar-block list-group list-group-menu list-group-minimal">
		
		<li class="list-group-item">
			<a href="javascript:void ()" onclick="window.open ('<?php echo site_url ('tests/frontend/start_test/'.$category_id.'/'.$test_id); ?>','test_window', 'location=0,toolbar=0,menubar=0,fullscreen=1')" > <span class="badge pull-right"></span> <i class="fa fa-chevron-right fa-fw"></i> Take Test </a>
		</li>
		<?php if ($finalized) { ?>
			<li class="list-group-item">
				<a href="javascript:void(0)" onclick="javascript:show_confirm ('Test will not be available to students after unpublishing. Continue?', '<?php echo site_url('coaching/tests_actions/unfinalise_test/'.$category_id.'/'.$test_id); ?>')" class="" title="Unpublish Test" ><i class="fa fa-chevron-right fa-fw"></i> Unpublish </a>
			</li>
			<li class="list-group-item">
				<a href="<?php echo site_url ('tests/reports/all_reports/0/0/'.$test_id); ?>" > <span class="badge pull-right"><?php //echo $num_questions; ?></span> <i class="fa fa-chevron-right fa-fw"></i> Reports </a>
			</li>
		<?php } else { ?>
			<li class="list-group-item">
				<a href="javascript:void(0)" onclick="javascript:show_confirm ('Publish this test?', '<?php echo site_url('coaching/tests_actions/finalise_test/'.$category_id.'/'.$test_id); ?>')" class="" title="Publish Test" ><i class="fa fa-chevron-right fa-fw"></i> Publish</a>
			</li>
			<li class="list-group-item">
				<a href="javascript:void(0)" onclick="javascript:show_confirm ('This will delete all questions in this test. Continue?', '<?php echo site_url('coaching/tests_actions/reset_test/'.$category_id.'/'.$test_id); ?>')" class="" title="Reset Test" ><i class="fa fa-chevron-right fa-fw"></i> Reset</a>
			</li>
			<li class="list-group-item">
				<a href="javascript:void(0)" onclick="javascript:show_confirm ('Are you sure you want to delete this test?', '<?php echo site_url('coaching/tests_actions/delete_test/'.$category_id.'/'.$test_id); ?>')" class="" title="Delete Test" ><i class="fa fa-chevron-right fa-fw"></i> Delete</a>
			</li>
		<?php } ?>
			<li class="list-group-item">
				<a href="<?php echo site_url ('coaching/tests/print_test/'.$category_id.'/'.$test_id); ?>" target="_blank" > <span class="badge pull-right"><?php //echo $num_questions; ?></span> <i class="fa fa-chevron-right fa-fw"></i> Print Test </a>
			</li>
			<li class="list-group-item">
				<a href="<?php echo site_url ('coaching/tests_actions/export_pdf/'.$category_id.'/'.$test_id); ?>" target="_blank" > <span class="badge pull-right"><?php //echo $num_questions; ?></span> <i class="fa fa-chevron-right fa-fw"></i> Export As PDF </a>
			</li>

	</ul>

</div>