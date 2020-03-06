<div class="row ">
	<div class="col-md-9">
		<div class="row ">
			<div class="col-md-3 col-xs-4 ">
				<div class="card my-2 border-primary">
					<div class="card-body height-100 d-flex align-items-center justify-content-center">
						<h4 class="card-title text-center my-3">
							<?php if ($row['finalized'] == 1) { ?>
								<a href="<?php echo site_url ('coaching/tests/preview_test/'.$coaching_id.'/'.	$category_id.'/'.$test_id); ?>" class="text-black text-decoration-none stretched-link"><i class="fa fa-eye fa-2x d-block"></i> Preview Test</a>
							<?php } else { ?>
								<a href="<?php echo site_url ('coaching/tests/preview_test/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>" class="text-black text-decoration-none stretched-link"><i class="fas fa-question fa-2x d-block"></i> Questions</a>
							<?php } ?>
						</h4>
					</div>
				</div>
			</div>
            
            <?php if ($row['test_type'] == TEST_TYPE_REGULAR) { ?>
			<div class="col-md-3 col-xs-4 px-2">
				<div class="card my-2 border-primary">
					<div class="card-body height-100 d-flex align-items-center justify-content-center">
						<h4 class="card-title text-center my-3">
							<a href="<?php echo site_url ('coaching/tests/enrolments/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>" class="text-black text-decoration-none stretched-link"><i class="fas fa-user-plus fa-2x d-block"></i> Enrolments</a>
						</h4>
					</div>
				</div>
			</div>
			<?php } ?>
			
			<div class="col-md-3 col-xs-4 px-2">
				<div class="card my-2 border-primary">
					<div class="card-body height-100 d-flex align-items-center justify-content-center">
						<h4 class="card-title text-center my-3">
							<a href="<?php echo site_url ('coaching/reports/submissions/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>" class="text-black text-decoration-none stretched-link"><i class="far fa-file-alt fa-2x d-block"></i> Submissions</a>
						</h4>
					</div>
				</div>
			</div>
			
			<?php if ($row['finalized'] == 1) { ?>
			<div class="col-md-3 col-xs-4 px-2">
				<div class="card my-2 bg-purple-500">
					<div class="card-body height-100 d-flex align-items-center justify-content-center">
						<h4 class="card-title text-center my-3">
							<a href="javascript:void(0)" onclick="javascript:show_confirm ('Test will not be available to students after unpublishing. Continue?', '<?php echo site_url('coaching/tests_actions/unfinalise_test/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>')" title="Unpublish Test" class="text-white text-decoration-none stretched-link"><i class="fas fa-times fa-2x d-block"></i> Unpublish</a>
						</h4>
					</div>
				</div>
			</div>
			<?php } else { ?>
			<div class="col-md-3 col-xs-4 px-2">
				<div class="card my-2 bg-success">
					<div class="card-body height-100 d-flex align-items-center justify-content-center">
						<h4 class="card-title text-center my-3">
							<a href="javascript:void(0)" onclick="javascript:show_confirm ('Publish this test?', '<?php echo site_url('coaching/tests_actions/finalise_test/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>')" title="Publish Test" class="text-white text-decoration-none stretched-link"><i class="fas fa-check fa-2x d-block"></i> Publish</a>
						</h4>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		
		<div class="row d-none">
			<div class="col-md-3 col-xs-4 px-2">
				<div class="card my-2 bg-primary">
					<div class="card-body height-100 d-flex align-items-center justify-content-center">
						<h4 class="card-title text-center my-3">
							<a href="<?php echo site_url ('coaching/tests/print_test/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>" target="_blank" title="Print Test" class="text-white text-decoration-none stretched-link"><i class="fas fa-print fa-2x d-block"></i> Print Test</a>
						</h4>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-xs-4 px-2">
				<div class="card my-2 bg-primary">
					<div class="card-body height-100 d-flex align-items-center justify-content-center">
						<h4 class="card-title text-center my-3">
							<a href="<?php echo site_url ('coaching/tests_actions/export_pdf/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>" target="_blank" title="Export As PDF" class="text-white text-decoration-none stretched-link"><i class="fas fa-file-export fa-2x d-block"></i> Export Test</a>
						</h4>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-xs-4 px-2">
				<div class="card my-2 bg-orange-500">
					<div class="card-body height-100 d-flex align-items-center justify-content-center">
						<h4 class="card-title text-center my-3">
							<a href="javascript:void(0)" onclick="javascript:show_confirm ('This will delete all questions in this test. Continue?', '<?php echo site_url('coaching/tests_actions/reset_test/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>')" title="Reset Test" class="text-white text-decoration-none stretched-link"><i class="fas fa-sync fa-2x d-block"></i> Reset</a>
						</h4>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-xs-4 px-2">
				<div class="card my-2 bg-red-500">
					<div class="card-body height-100 d-flex align-items-center justify-content-center">
						<h4 class="card-title text-center my-3">
							<a href="javascript:void(0)" onclick="javascript:show_confirm ('Are you sure you want to delete this test?', '<?php echo site_url('coaching/tests_actions/delete_test/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>')" title="Delete Test" class="text-white text-decoration-none stretched-link"><i class="fas fa-trash fa-2x d-block"></i> Delete</a>
						</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	
			
	<div class="col-md-3 ">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Actions</h4>
			</div>
			<ul class="list-group"> 
				<?php if ($row['finalized'] == 1) { ?>
					<li class="list-group-item ">
						<a href="<?php echo site_url ('coaching/tests/preview_test/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>"  class=""> <i class="fa fa-lens"></i> Preview Test </a>
					</li>
					<li class="list-group-item">
						<a href="javascript:void(0)" onclick="javascript:show_confirm ('Test will not be available to students after unpublishing. Continue?', '<?php echo site_url('coaching/tests_actions/unfinalise_test/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>')" class="" title="Unpublish Test" ><i class="fa fa-chevron-right "></i> Unpublish </a>
					</li>
				<?php } ?>
				<li class="list-group-item ">
					<a href="<?php echo site_url ('coaching/tests/preview_test/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>"  class=""> <i class="fa fa-chevron-right"></i> Questions </a>
				</li>
				<?php if ($row['test_type'] == TEST_TYPE_REGULAR) { ?>
					<li class="list-group-item ">
						<a href="<?php echo site_url ('coaching/tests/enrolments/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>"  class=""> <i class="fa fa-chevron-right"></i> Enrolments </a>
					</li>
				<?php } ?>
				<li class="list-group-item">
					<a href="<?php echo site_url ('coaching/reports/submissions/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>" > <span class="badge pull-right"><?php //echo $num_questions; ?></span> <i class="fa fa-chevron-right "></i> Submissions </a>
				</li>
				<li class="list-group-item">
					<a href="javascript:void(0)" onclick="javascript:show_confirm ('Publish this test?', '<?php echo site_url('coaching/tests_actions/finalise_test/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>')" class="" title="Publish Test" ><i class="fa fa-chevron-right "></i> Publish</a>
				</li>
				<li class="list-group-item">
					<a href="<?php echo site_url ('coaching/tests/print_test/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>" target="_blank" > <span class="badge pull-right"><?php //echo $num_questions; ?></span> <i class="fa fa-chevron-right "></i> Print Test </a>
				</li>
				<li class="list-group-item">
					<a href="<?php echo site_url ('coaching/tests_actions/export_pdf/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>" target="_blank" > <span class="badge pull-right"><?php //echo $num_questions; ?></span> <i class="fa fa-chevron-right "></i> Export As PDF </a>
				</li>
				<li class="list-group-item"> 
					<a href="<?php echo site_url('coaching/tests/edit/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>" class="" title="Edit Test" ><i class="fa fa-chevron-right "></i> Edit</a>
				</li>
				<li class="list-group-item">
					<a href="javascript:void(0)" onclick="javascript:show_confirm ('This will delete all questions in this test. Continue?', '<?php echo site_url('coaching/tests_actions/reset_test/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>')" class="" title="Reset Test" ><i class="fa fa-chevron-right "></i> Reset</a>
				</li>
				<li class="list-group-item">
					<a href="javascript:void(0)" onclick="javascript:show_confirm ('Are you sure you want to delete this test?', '<?php echo site_url('coaching/tests_actions/delete_test/'.$coaching_id.'/'.$category_id.'/'.$test_id); ?>')" class="" title="Delete Test" ><i class="fa fa-chevron-right "></i> Delete</a>
				</li>                        
			</ul>
		</div>
		
	</div>
	
</div>