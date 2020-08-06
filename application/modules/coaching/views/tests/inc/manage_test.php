<div class="app-menu">
    <div class="p-4 h-100">
        <div class="scroll ps">
            <p class="text-muted text-small">Course Title</p>
            <p><?php echo $course['title']; ?></p>

			<div class="separator mt-4 mb-4"></div>

            <p class="text-muted text-small">Test Title</p>
            <p><?php echo $test['title']; ?></p>
 
 			<div class="d-flex justify-content-between">
				<span class="">MM</span> <span><?php echo $test_marks; ?></span>
			</div>
 			<div class="d-flex justify-content-between">
				<span class="">QUESTIONS </span> <span><?php echo $num_test_questions; ?></span>
			</div>
 			<div class="d-flex justify-content-between">
				<span class="">Status </span> 
				<?php if ($test['finalized'] == 1) { ?>
					<span class="badge badge-primary badge-pill">Published</span>
				<?php } else { ?>
					<span class="badge badge-light badge-pill">Un-Published</span>
				<?php } ?>
			</div>

			<div class="separator mt-4 mb-4"></div>

            <p class="text-muted text-small">Quick Links</p>
            <ul class="list-unstyled mb-5">
                <li>
                    <?php echo anchor ('coaching/tests/manage/'.$coaching_id.'/'.$course_id.'/'.$test_id, '<i class="fa fa-cog"></i> Manage Test'); ?>
                </li>
				<li>
					<a class="" href="<?php echo site_url ('coaching/tests/questions/'.$coaching_id.'/'.$course_id.'/'.$test_id); ?>"><i class="fa fa-question-circle"></i> Questions</a>
				</li>
				<li>
					<?php if ($test['finalized'] != 1) { ?>
			      		<a class="" href="<?php echo site_url ('coaching/tests/question_group_create/'.$coaching_id.'/'.$course_id.'/'.$test_id); ?>"><i class="fa fa-plus"></i> Add Question</a>
		      		<?php } ?>
				</li>
				<li>
					<?php if ($test['finalized'] == 0) { ?>
					<a class="" href="javascript:void(0)" onclick="javascript:show_confirm ('Publish this test?', '<?php echo site_url('coaching/tests_actions/finalise_test/'.$coaching_id.'/'.$course_id.'/'.$test_id); ?>')" title="Publish Test"><i class="fa fa-check"></i> Publish</a>
					<?php } else { ?>
						<a class="" href="javascript:void(0)" onclick="javascript:show_confirm ('Un-publish this test? Test will not be available to users after un-publish.', '<?php echo site_url('coaching/tests_actions/unfinalise_test/'.$coaching_id.'/'.$course_id.'/'.$test_id); ?>')" title="Un-Publish Test"><i class="fa fa-times"></i> Un-Publish</a>
					<?php } ?>
				</li>
				<li>
					<a class="" href="<?php echo site_url ('coaching/tests/preview_test/'.$coaching_id.'/'.$course_id.'/'.$test_id); ?>" title="Preview Test"><i class="fa fa-eye"></i> Preview </a>
				</li>
				<li>
					<a class="" href="<?php echo site_url ('coaching/reports/submissions/'.$coaching_id.'/'.$course_id.'/'.$test_id); ?>"><i class="fa fa-file"></i> Submissions</a>
				</li>
            </ul>

			<div class="mt-3 d-none">
				<h4>Actions</h4>
				<div class="separator my-3"></div>
				<ul class="list-unstyled mb-5">
					<li>
						<a class=" d-none" href="<?php echo site_url ('coaching/tests/print_test/'.$coaching_id.'/'.$course_id.'/'.$test_id); ?>" target="_blank" title="Print Test">Print</a>
					</li>
					<li>
						<a class=" d-none" href="<?php echo site_url ('coaching/tests_actions/export_pdf/'.$coaching_id.'/'.$course_id.'/'.$test_id); ?>" target="_blank" title="Export As PDF">Export</a>
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