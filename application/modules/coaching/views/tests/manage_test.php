<div class="card mb-3 d-none">
	<div class="card-header">
		Prepare
	</div>
	<div class="card-body">
		<ul class="list-inline">
		  <li class="list-inline-item">
		  	<a class="" href="<?php echo site_url ('coaching/tests/questions/'.$coaching_id.'/'.	$category_id.'/'.$test_id); ?>">Questions</a>
		  </li>
		  <li class="list-inline-item">
	      	<a class="" href="<?php echo site_url ('coaching/tests/question_group_create/'.$coaching_id.'/'.	$category_id.'/'.$test_id); ?>">Add Question</a>
	      </li>
	      <?php if ($test['test_type'] == TEST_TYPE_REGULAR) { ?>
			  <li class="list-inline-item">	      
		      	<a class="" href="<?php echo site_url ('coaching/tests/enrolments/'.$coaching_id.'/'.	$category_id.'/'.$test_id); ?>">Enrolments</a>
			  </li>
		  <?php } ?>
		</ul>

	</div>
</div>


<div class="card mb-3 d-none">
	<div class="card-header">
		Publish
	</div>
	<div class="card-body">
		<ul class="list-inline">
		  <?php if ($test['finalized'] == 0) { ?>
			  <li class="list-inline-item">
		      	<a class="" href="javascript:void(0)" onclick="javascript:show_confirm ('Publish this test?', '<?php echo site_url('coaching/tests_actions/finalise_test/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>')" title="Publish Test">Publish</a>
		      </li>
	      <?php } else { ?>
			  <li class="list-inline-item">
		      	<a class="" href="javascript:void(0)" onclick="javascript:show_confirm ('Publish this test?', '<?php echo site_url('coaching/tests_actions/finalise_test/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>')" title="Publish Test">Un-Publish</a>
		      </li>
	      <?php } ?>
		  <li class="list-inline-item">
		      <a class="" href="<?php echo site_url ('coaching/tests/preview_test/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>" title="Preview Test">Preview </a>
		  </li>
		  <li class="list-inline-item">
		      <a class="" href="<?php echo site_url ('coaching/tests/print_test/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>" target="_blank" title="Print Test">Print</a>
		  </li>
		  <li class="list-inline-item">
		      <a class="" href="<?php echo site_url ('coaching/tests_actions/export_pdf/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>" target="_blank" title="Export As PDF">Export</a>
		  </li>
		  <li class="list-inline-item">
		      <a class="" href="<?php echo site_url ('coaching/tests/create_test/'.$coaching_id.'/'.	$category_id.'/'.$test_id); ?>">Submissions</a>
		  </li>
		</ul>

	</div>
</div>