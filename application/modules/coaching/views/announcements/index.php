
	<div class="card card-default">
		<div class="-table-responsive" id="users-list">
			<table class="table table-bordered v-middle mb-0" id="data-tables">
				<thead>
					<tr>
						<th width="">#</th>
						<th width="">Title</th>
						<th width="" class="text-center">Status</th>
						<th width="" class="text-center">Action</th>
					</tr>
				</thead>

				<tbody>
					<?php 
					$i=1;
					foreach($results as $row) { 
						?>
					<tr>
						<td class=""><?php echo $i; ?></td>
						<td><?php echo anchor ('coaching/announcements/create_announcement/'.$coaching_id.'/'.$row['announcement_id'], $row['title']); ?></td>
						<td class="text-center">
							<?php 
							$status= $row['status'];
							if($status==1){
								echo '<span class="text-success font-weight-bold">Active</span>';
							}
							else{
								echo '<span class="text-danger font-weight-bold">Inactive</span>';
							}
							?>							
						</td>
						<td class="text-center"><span class="px-2">
							<?php echo anchor ('coaching/announcements/create_announcement/'.$coaching_id.'/'.$row['announcement_id'], '<i class="fa fa-edit"></i>'); ?>
							</span>
							<span class="px-2">
								<!-- <?php //echo anchor ('coaching/announcements/delete_announcement/'.$coaching_id.'/'.$row['announcement_id'], 'Delete'); ?> -->
								<a href="javascript:void(0)" onclick="show_confirm ('<?php echo 'Are you sure want to delete this announcement?' ; ?>','<?php echo site_url('coaching/announcements/delete_announcement/'.$coaching_id.'/'.$row['announcement_id']); ?>' )"><i class="fa fa-trash"></i></a>

							</span>
						</td>
					</tr>
					<?php
					$i++; 

				}?> 
	
				</tbody>
			</table> 			
		</div>
	</div>
	
