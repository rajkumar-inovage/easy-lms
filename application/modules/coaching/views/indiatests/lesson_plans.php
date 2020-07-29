<h2 class="text-center mb-4 d-none">Available Lesson Plans In IndiaTests&reg;</h2>

<div class="card mb-4 d-none">
	<div class="card-body">
		<div class="row">
			<div class="col-md-4">
				<select id="categories" class="form-control">
					<option value="0" <?php if ($category_id == 0) echo 'selectd="selected"'; ?>>Plan Categories</option>
					<?php
					if (!empty ($categories)) {
						foreach ($categories as $cat) {
							?>
							<option value="<?php echo $cat['id']; ?>" <?php if ($category_id == $cat['id']) echo 'selected="selected"'; ?>><?php echo $cat['title']; ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>

			<div class="col-md-4">
				<select id="amount" class="form-control">
					<option value="-1" <?php if ($amount == '-1') echo 'selected="selected"'; ?>>All Type</option>
					<option value="0" <?php if ($amount == 0) echo 'selected="selected"'; ?>>Free</option>
					<option value="1" <?php if ($amount == 1) echo 'selected="selected"'; ?>>Paid</option>
				</select>
			</div>

		</div>
	</div>
</div>

	<div class="row list disable-text-selection" data-check-all="checkAll">
		<?php 
		if ( ! empty ($plans)) {
			foreach ($plans as $row) {
				?>
                <div class="col-xl-3 col-lg-4 col-12 col-sm-6 mb-4">
                    <div class="card">
                        <div class="position-relative">                        	
	                        <?php 
							if ($row['amount'] == 0) {
								echo '<span class="badge badge-pill badge-dark position-absolute badge-top-left">Free</span>';
							} else {
								echo '<span class="badge badge-pill badge-dark position-absolute badge-top-left "><i class="fa fa-rupee-sign"></i> '.$row['amount'] . ' </span>';
							}
							?>
							<?php 
								echo '<span class="badge badge-pill badge-theme-1 position-absolute badge-top-right">'.$row['tests_in_plan'].' Lessons</span>';
							?>
                        </div>
                        <div class="card-body">
                            <div class="row">                                
                                <div class="col-12">
                                    <h4 class="list-item-heading mb-4 pt-1"><?php echo $row['title']; ?></h4>
                                    <p class="text-muted">
										Category: <?php echo $row['cat_title']; ?>
									</p>
                                    <footer>
                                        <p class="text-muted text-small mb-0 font-weight-light">
                                        	<?php 
											if ($row['added'] == true) {
												echo anchor ('coaching/indiatests/lessons_in_plan/'.$coaching_id.'/'.$course_id.'/'.$row['plan_id'].'/'.$amount, 'Import Lessons', ['class'=>'btn btn-success']);
											} else {
												if ($row['amount'] == 0) {
													echo anchor ('coaching/indiatest_actions/lessons_in_plan/'.$coaching_id.'/'.$course_id.'/'.$row['plan_id'].'/0', 'Import Lessons', ['class'=>'btn btn-success']);
												} else {
													echo anchor ('coaching/indiatest_actions/buy_lesson_plan/'.$coaching_id.'/'.$course_id.'/'.$row['plan_id'], 'Buy Plan', ['class'=>'btn btn-outline-primary']);
												}
											}
											?>
                                        </p>
                                    </footer>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


				
				<?php 
			}
		} else { 
			?>

			<div class="col-12">
				<div class="alert alert-danger ">
					<span class="">No plans found</span>
				</div>
			</div>
	    	<?php 
	    } // if result ?>
	</div>
