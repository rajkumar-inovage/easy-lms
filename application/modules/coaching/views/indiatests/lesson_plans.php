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

<div class="card">
	<ul class="list-group">
		<?php 
		if ( ! empty ($plans)) {
			foreach ($plans as $row) {
				?>
				<li class="list-group-item media">
					<div class="media-body">
						<h4>
							<?php //echo anchor ('coaching/indiatests/tests_in_plan/'.$coaching_id.'/'.$category_id.'/'.$row['plan_id'], $row['title'], array ('class'=>'link-text-color', 'title'=>'Browse all tests in this plan ')); ?>
							<?php echo $row['title']; ?>
						</h4>
						<span class="text-grey-500">
							Category: <?php echo $row['cat_title']; ?>
						</span>
					</div>
                    <div class="media-right">
						<?php 
						if ($row['amount'] == 0) {
							echo '<span class="badge badge-secondary p-2">Free</span>';
						} else {
							echo '<span class="badge badge-secondary p-2"><i class="fa fa-rupee-sign"></i> '.$row['amount'] . ' </span>';
						}
						?>
                    </div>
                    <div class="media-right">
						<?php 
							echo '<span class="badge badge-secondary p-2">'.$row['tests_in_plan'].' Tests</span>';
						?>
                    </div>
                    <div class="media-right">
						<?php 
						if ($row['added'] == true) {
							echo anchor ('coaching/indiatests/lessons_in_plan/'.$coaching_id.'/'.$course_id.'/'.$row['plan_id'].'/'.$amount, 'Import Lessons', ['class'=>'btn btn-success']);
						} else {							
							if ($row['amount'] == 0) {
								echo anchor ('coaching/indiatest_actions/lessons_in_plan/'.$coaching_id.'/'.$course_id.'/'.$row['plan_id'].'/0', 'Import Lessons', ['class'=>'btn btn-success']);
							} else {
								echo anchor ('coaching/indiatest_actions/buy_lesson_plan/'.$coaching_id.'/'.$course_id.'/'.$row['plan_id'], 'Buy Plan', ['class'=>'btn btn-primary']);
							}
						}
						?>
                    </div>

				</li>
				<?php 
			}
		} else { 
		?>
		<li class="list-group-item">
			<span class="text-danger"><?php echo 'No Plans Found'; ?></span>
		</li>
	    <?php } // if result ?>
	</ul>
</div>
