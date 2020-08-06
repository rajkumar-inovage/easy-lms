<div class="row">
  <div class="col-12 mb-5">
	<?php 
	if ( ! empty ($results) ) {
  		echo form_open('coaching/tests_actions/remove_questions/'.$course_id.'/'.$test_id, array('class'=>'form-horizontol', 'id'=>'validate-1') );

		$num_parent = 1;
		foreach ( $results as $parent_id=>$all_questions) {
			$parent 	= $all_questions['parent'];
			$questions 	= $all_questions['questions'];
			?>
			<div class="card mb-3">
	            
	            <div class="w-100 card-body align-self-center border-bottom pb-2 d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
	            	<div>
						<span class="badge badge-primary">Section <?php echo $num_parent; ?></span>
						<div class="text-primary pt-2">
		            		<?php echo $parent['question']; ?>
		            	</div>
					</div>
					<div class="text-right">
						
		            	<div class="">

		            		<div class="btn-group">
                                <!-- <div class="btn btn-primary btn-lg pl-4 pr-0 check-button">
                                    <label class="custom-control custom-checkbox mb-0 d-inline-block">
				                    <input type="checkbox" class="custom-control-input checks checkAll" id="checkAll<?php echo $parent_id; ?>" value="<?php echo $parent_id; ?>" onclick="check_all ()">
                                        <span class="custom-control-label">&nbsp;</span>
                                    </label>
                                </div> -->
                                <!-- <button type="button" class="btn btn-lg btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button> -->
								<button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Add New
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
									<?php
									echo anchor ('coaching/tests/question_group_create/'.$coaching_id.'/'.$course_id.'/'.$test_id, '<i class="fa fa-plus"></i> Add Section', array('class'=>'dropdown-item'));
									echo anchor ('coaching/tests/question_create/'.$coaching_id.'/'.$course_id.'/'.$test_id.'/'.$parent_id, '<i class="fa fa-plus"></i> Add Question', array('class'=>'dropdown-item'));
									?>
                                </div>
                            </div>

		            	</div>
					</div>
	            </div>

	            <!------ // Sub Questions // ------>
				<?php 
				$num_question = 1;
				if ( ! empty($questions)) {
					foreach ($questions as $id=>$row) {
						?>
			            <div class="card-body border-bottom d-flex flex-grow-1 min-width-zero min-width-zero align-items-md-center">
			                <div class="list-item-heading mb-0 truncate w-90 w-xs-100 mt-0">
			                    <span class="mr-3 float-left"><?php echo $num_question; ?>.</span>
			                    <div class="mb-0 w-80" >
			                    	<?php echo $row['question']; ?>
			                    </div>
			                    <div>
			                    	<?php
										$template = 'view_'.$row['type'];
										$data['result'] = $row;
										$this->load->view (ANSWER_TEMPLATE . $template, $data);
			                    	?>
			                    </div>
			                </div>
			                <div class="w-10 w-xs-100 text-right">
			                    <div class="btn-groudp">
									<a href="<?php echo site_url ('coaching/tests/question_create/'.$coaching_id.'/'.$course_id.'/'.$test_id.'/'.$row['parent_id'].'/'.$id); ?>" class="btn btn-info d-none"><i class="simple-icon-edit "></i></a>			                    	
									<a href="void()" class="text-danger" onclick="show_confirm ('Delete this question?')"><i class="simple-icon-trash "></i></a>
			                    </div>
			                </div>
			                <label class="custom-control custom-checkbox mb-1 align-self-center pr-0 d-none">
			                    <input type="checkbox" class="custom-control-input checks checks<?php echo $parent_id; ?>" name="questions[]" id="select<?php echo $id; ?>" type="checkbox" value="<?php echo $id; ?>" >
			                    <span class="custom-control-label">&nbsp;</span>
			                </label>
			            </div>
			            <?php
			            $num_question++;
					}
				}
				?>                
	        </div>
			
			<?php 
			$num_parent++;
		}
	} else { 
		?>
		<div class="alert alert-danger">
			<h4> <?php echo 'No questions added in test'; ?></h4>
			<p>You can <?php echo anchor ('coaching/tests/question_group_create/'.$coaching_id.'/'.$course_id.'/'.$test_id, 'Create Questions', array ('class'=>'btn btn-sm btn-primary') ); ?>  in this test.
			</p>
		</div>
	<?php } ?>
	</form>
  </div>
</div>