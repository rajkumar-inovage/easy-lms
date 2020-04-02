<div class="card card-default">
	<div class="-table-responsive" id="users-list">
		<table class="table table-bordered v-middle mb-0" id="data-tables">
			<thead>
				<tr>
					<th width="">#</th>
					<th width="">Class Name</th>
					<th width="">Meeting ID</th>
					<th width="" class="text-center">Action</th>
				</tr>
			</thead>

			<tbody>
			<?php 
				$i=1;
				if (! empty ($class)) {
					foreach ($class as $row) { 
						?>
						<tr>
							<td class=""><?php echo $i; ?></td>
							<td><?php echo $row['class_name']; ?></td>
							<td><?php echo $row['meeting_id']; ?></td>
							<td class="text-center">
								<a href="<?php echo site_url ('student/virtual_class/join_class/'.$coaching_id.'/'.$row['class_id'].'/'.$member_id); ?>" class='btn btn-primary mr-1' target="_blank"><i class="fa fa-plus"></i> Join</a>

							</td>
						</tr>
						<?php
						$i++; 
					}

				} else {
					?>
					<tr>
						<td colspan="6"><span class="text-danger">No classroom created yet</span></td>
						</td>
					</tr>
					<?php
				}
			?> 
			</tbody>
		</table> 
	</div>
</div>

