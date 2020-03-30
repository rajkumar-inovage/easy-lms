<div class="row justify-content-center">
	<div class="col-md-10">
		<?php
		echo form_open ('payment/page/checkout/', array ('class'=>''));
		echo form_hidden ('owner_name', $user['first_name'] . " " . $user['last_name']);
		echo form_hidden ('email', $user['email']);
		echo form_hidden ('contact', $user['primary_contact']);
		echo form_hidden ('coaching_id', $coaching_id);
		echo form_hidden ('plan_id', $plan_id);
		?>
		<div class="card card-default">
			<div class="table-responsive" id="users-list">
				<table class="table table-bordered mb-0">
					<thead>
						<tr>
							<th width="60%">Title</th>
							<th>Price</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					if (! empty ($plan)) { 
						?>
						<tr>
							<td>
								<?php echo form_hidden('productinfo', $plan['title']); ?>
								<strong><?php echo $plan['title']; ?></strong><br>
								<?php echo $plan['description']; ?><br>
								<a href="#" onclick="show_confirm ('Remove this plan from cart?', '<?php echo site_url ('coaching/cart_actions/remove_item/'.$coaching_id.'/'.$plan['id']); ?>');">Remove</a>
							</td>
							<td>
								<?php
								$options = [];
								for ($i=3; $i<=12; $i=$i+3) {
									if ($i > 1)
										$options[$i] =  "$i Months";
									else
										$options[$i] =  "$i Month";
									if ($plan['id'] == FREE_SUBSCRIPTION_PLAN_ID) {
										break; // Show Only 1 month
									}
								}
								echo form_dropdown('plan_duration', $options, '', ['id'	=> 'plan_duration','class' => 'form-control']);
								?><br>
								<?php
								$price = $plan['price'];
								$amount = 0;
								if ($price > 0) {
									$amount = $price/12 * 3;
									$amount = round ($amount);
									echo '<i class="fa fa-rupee-sign"></i> '. $amount. ' per month ';
								} else {
									echo 'Free';
								}
								?> 
							</td>
						</tr>
						<tr>
							<th colspan="3" class="justify-content-between">
								Total Amount: <span id="plan_price" class="float-right"><i class="fa fa-rupee-sign"></i> <?php echo $amount; ?></span>
								<?php echo form_input(['type' => 'hidden','name' => 'tammount','id' => 'tammount','value' => $amount]); ?>
							</th>
						<tr>
						<tr>
							<th colspan="3" class="justify-content-between">
							<?php if ($price > 0) { ?>
								<?php echo form_button(array('type' => 'submit','class' => 'btn btn-primary btn-block','content' => 'Make Payment'));?>
							<?php } else { ?> 
								<a href="<?php echo site_url ('coaching/subscription_actions/change_plan/'.$coaching_id.'/'.$plan_id); ?>" class="btn btn-primary">Subscribe Plan</a>
							<?php } ?>
							</th>
						</tr>
						<?php 
					} else {
						?>
						<tr>
							<td colspan="3">No items in cart <?php echo anchor ('coaching/subscription/browse_plans/'.$coaching_id, 'Browse Plans' ); ?></td>
						</tr>
						<?php
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>