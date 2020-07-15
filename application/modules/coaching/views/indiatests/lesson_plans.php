<h2 class="text-center mb-4">Available test plans In IndiaTests&reg;</h2>
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
							echo '<span class="badge badge-success p-2">Free</span>';
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
						if ($row['amount'] == 0) {
							echo anchor ('coaching/indiatest_actions/buy_lesson_plan/'.$coaching_id.'/'.$row['plan_id'], 'Get Plan', ['class'=>'btn btn-success']);
						} else {
							echo anchor ('coaching/indiatest_actions/buy_lesson_plan/'.$coaching_id.'/'.$row['plan_id'], 'Buy Plan', ['class'=>'btn btn-primary']);
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
