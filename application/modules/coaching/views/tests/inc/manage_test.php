<div class="app-menu">	
	<div class="p-4 h-100">
    	<div class="scroll">
			<div class="flex-column pt-3">
				<span class="float-left">MM: 32</span>
				<span class="float-right">QUESTIONS: 32</span>
			</div>
			<div class="separator mt-4"></div>
			<div class="mt-3 d-inline-block">
				<a class="" href="<?php echo site_url ('coaching/tests/manage/'.$coaching_id.'/'.$course_id.'/'.$test_id); ?>"><?php echo $test['title']; ?></a><br>
				<?php if ($test['finalized'] == 1) { ?>
					<span class="badge badge-success mt-3">Published</span>
				<?php } else { ?>
					<span class="badge badge-secondary mt-3">Un-Published</span>
				<?php } ?>
			</div>
			<div class="mt-3">
				<h4>Actions</h4>
				<div class="separator my-3"></div>
				<ul class="list-unstyled mb-5">
					<li>
						<a class="" href="<?php echo site_url ('coaching/tests/questions/'.$coaching_id.'/'.	$course_id.'/'.$test_id); ?>">Questions</a>
					</li>
					<li>
						<?php if ($test['finalized'] != 1) { ?>
			      		<a class="" href="<?php echo site_url ('coaching/tests/question_group_create/'.$coaching_id.'/'.	$course_id.'/'.$test_id); ?>">Add Section</a>
			      		<?php } ?>
			      		<?php if ($test['test_type'] == TEST_TYPE_REGULAR) { ?>
			      		<a class="" href="<?php echo site_url ('coaching/tests/enrolments/'.$coaching_id.'/'.	$course_id.'/'.$test_id); ?>">Enrolments</a>
				  		<?php } ?>
					</li>
					<li>
						<?php if ($test['finalized'] == 0) { ?>
						<a class="" href="javascript:void(0)" onclick="javascript:show_confirm ('Publish this test?', '<?php echo site_url('coaching/tests_actions/finalise_test/'.$coaching_id.'/'.$course_id.'/'.$test_id); ?>')" title="Publish Test">Publish</a>
						<?php } else { ?>
						<a class="" href="javascript:void(0)" onclick="javascript:show_confirm ('Un-publish this test? Test will not be available to users after un-publish.', '<?php echo site_url('coaching/tests_actions/unfinalise_test/'.$coaching_id.'/'.$course_id.'/'.$test_id); ?>')" title="Un-Publish Test">Un-Publish</a>
						<?php } ?>
					</li>
					<li>
						<a class="" href="<?php echo site_url ('coaching/tests/preview_test/'.$coaching_id.'/'.$course_id.'/'.$test_id); ?>" title="Preview Test">Preview </a>
					</li>
					<li>
						<a class=" d-none" href="<?php echo site_url ('coaching/tests/print_test/'.$coaching_id.'/'.$course_id.'/'.$test_id); ?>" target="_blank" title="Print Test">Print</a>
					</li>
					<li>
						<a class=" d-none" href="<?php echo site_url ('coaching/tests_actions/export_pdf/'.$coaching_id.'/'.$course_id.'/'.$test_id); ?>" target="_blank" title="Export As PDF">Export</a>
					</li>
					<li>
						<a class="" href="<?php echo site_url ('coaching/reports/submissions/'.$coaching_id.'/'.	$course_id.'/'.$test_id); ?>">Submissions</a>
					</li>
					<li>
						<a class="" href="<?php echo site_url ('coaching/tests/create_test/'.$coaching_id.'/'.	$course_id.'/'.$test_id); ?>">Edit</a>
					</li>
					<li>
				 		<a class="" href="javascript:void(0)" onclick="javascript:show_confirm ('This will delete all questions in this test. Continue?', '<?php echo site_url('coaching/tests_actions/reset_test/'.$coaching_id.'/'.$course_id.'/'.$test_id); ?>')" title="Reset Test">Reset</a>
					</li>
					<li>
				  		<a class="" href="javascript:void(0)" onclick="javascript:show_confirm ('Are you sure you want to delete this test?', '<?php echo site_url('coaching/tests_actions/delete_test/'.$coaching_id.'/'.$course_id.'/'.$test_id); ?>')" title="Delete Test" >Delete</a>
					</li>
                </ul>
			</div>
		</div>
	</div>
	<a class="app-menu-button d-inline-block d-xl-none" href="#">
		<i class="simple-icon-options"></i>
	</a>
</div>