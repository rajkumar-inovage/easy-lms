<div class="row justify-content-center">
	<div class="col-md-9">
		<div class="card " oncopy="return false;" oncut="return false;" onpaste="return false;" onmousedown="return false;" onselectstart="return false;">
			<div class="card-header pb-0" >
				<h1 class="card-title"><?php echo $test['title']; ?></h1>
			</div>
			<div class="card-body pb-0" >
				<?php 
				echo form_open('coaching/tests_actions/remove_questions/'.$category_id.'/'.$test_id, array('class'=>'form-horizontol', 'id'=>'validate-1') );

				if ( ! empty ($results) ) {
					$num_parent = 1;
					foreach ( $results as $parent_id=>$all_questions) {
						$parent 	= $all_questions['parent'];
						$questions 	= $all_questions['questions'];
						?>
						<div class="d-flex justify-content-between mx-0">
							<span class="mr-2">
								<?php if ( $test['finalized'] == 0) { ?>
									<label for="checkAll<?php echo $parent_id; ?>" class="ml-2">Section <?php echo $num_parent; ?></label>
								<?php } ?>
							</span>
						</div>
						<div class="d-flex justify-content-between mb-0">
							<div >
							<?php
								if ( $test['finalized'] == 0) {
									echo anchor ('coaching/tests/question_group_create/'.$coaching_id.'/'.$category_id.'/'.$test_id.'/'.$parent_id, $parent['question']);
								} else {
									echo $parent['question'];
								}
							?>
							</div>
						</div>
					
						<?php 
						$num_question = 1;
						if ( ! empty($questions)) {
							foreach ($questions as $id=>$row) {
								?>
								<div class="d-flex justify-content-start mt-2">
									<span class="mr-2">
										<label for="select<?php echo $id; ?>">Question <?php echo $num_question; ?></label>
									</span>
								</div>
								<div class="d-flex justify-content-between">
									<?php 
									if ( $test['finalized'] == 0) {
										echo anchor ('coaching/tests/question_create/'.$coaching_id.'/'.$category_id.'/'.$test_id.'/'.$row['parent_id'].'/'.$id, $row['question']);
									} else {
										echo $row['question'];
									}
									?>
									<span class="actions">
									
									</span>
								</div>
								<?php echo $this->qb_model->display_answer_choices($row['type'], $row); ?>
								<?php
								$num_question++;
							}
						}
						$num_parent++;
					}
					?>
					<?php
				} else { 
					?>	
					<div class="alert alert-danger">
						<strong> <?php echo 'No questions found in test'; ?></strong>
						<p>You can <?php echo anchor('coaching/tests/question_group_create/'.$category_id.'/'.$test_id, 'Create Questions', array ('class'=>'btn btn-sm btn-link') ); ?> or <?php echo anchor('coaching/tests/upload_test_questions/'.$category_id.'/'.$test_id, 'Upload Questions', array ('class'=>'btn btn-sm btn-link') ); ?> in this test.
						</p>
					</div>
					<?php 
				}
				echo form_close();
				?>
			</div>
		</div>


		<?php
			echo $answer_content;
		?>

 	</div>
</section>
<br>
<?php if ($print) { ?>
<script>
	window.print();
</script>
<?php } ?>