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


<?php 
if ( ! empty ($plans)) {
	echo '<div class="row">';
		foreach ($plans as $row) {
			?>
			<div class="col-xs-6 col-lg-3 col-12 mb-4">
				<div class="card">
					
					<div class="card-body position-relative">
						<div class="heading-icon pt-2" style="font-size:1.2rem;"><?php echo $row['title']; ?></div>
							
						<?php 
							if ($row['amount'] == 0) {
								echo '<span class="badge-success badge badge-pill position-absolute badge-top-left">Free</span>';
							} else {
								echo '<span class="badge-info badge badge-pill position-absolute badge-top-left"><i class="fa fa-rupee-sign"></i> '.$row['amount'] . ' </span>';
							}
						?>						
						
						<span class="text-grey-500">
							Category: <?php echo $row['cat_title']; ?>
						</span>
						<div class="w-100 text-left pt-3">
						<?php 
							echo '<span class="badge badge-secondary mb-1">'.$row['tests_in_plan'].' Tests</span>';
						?>
						</div>
						<footer class="mt-4 text-center">
							<?php 
							if ($row['added'] == true) {
								echo anchor ('coaching/indiatests/lessons_in_plan/'.$coaching_id.'/'.$course_id.'/'.$row['plan_id'].'/'.$amount, 'Import Lessons', ['class'=>'btn btn-small btn-primary']);
							} else {
								if ($row['amount'] == 0) {
									echo anchor ('coaching/indiatest_actions/lessons_in_plan/'.$coaching_id.'/'.$course_id.'/'.$row['plan_id'].'/0', 'Import Lessons', ['class'=>'btn btn-small btn-primary']);
								} else {
									echo anchor ('coaching/indiatest_actions/buy_lesson_plan/'.$coaching_id.'/'.$course_id.'/'.$row['plan_id'], 'Buy Plan', ['class'=>'btn btn-small btn-primary']);
								}
							}
							?>
						</footer>
					</div>
				</div>
			</div>
			<?php 
		}
	echo '</div>';
} else { 
	?>
	<div class="alert alert-danger">
		<span class="text"><?php echo 'Presently there are no lessons. Please revisit this page again shortly.'; ?></span>
	</div>
	<?php 
} // if result 
?>