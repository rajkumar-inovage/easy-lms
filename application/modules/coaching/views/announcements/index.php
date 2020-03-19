
	<div class="card card-default">
		<div class="-table-responsive" id="users-list">
			<table class="table table-bordered v-middle mb-0" id="data-tables">
				<thead>
					<tr>
						<th width="">SR. No</th>
						<th width="">Title</th>
						<th width="">Description</th>
						<th width="">Start Date</th>
						<th width="">End Date</th>
						<th width="">Status</th>
						<th width="">Created By</th>
						<th width="">Action</th>
					</tr>
				</thead>

				<tbody>
					 <?php 
					 $i=1;
					 foreach($results as $row){?>
	    
	      			
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $row['title']; ?></td>
						<td><?php echo $row['description']; ?></td>
						<td><?php 
						$original_date=$row['start_date'];
						$new_date = date("d-m-Y", $original_date);

						echo $new_date; ?></td>
						<td><?php 
						$original_date=$row['end_date'];
						$new_date = date("d-m-Y", $original_date);

						echo $new_date; ?></td>
						<td>
							<?php 
							$status= $row['status'];
							if($status==1){
								echo "Active";
							}
							else{
								echo "Inactive";
							}

							?>
							
						</td>
						<td><?php echo $row['created_by']; ?></td>
						<td><span class="px-2">
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
			<div class="create-announcement mx-3 my-sm-3 my-lg-4">
				<?php echo anchor ('coaching/announcements/create_announcement/'.$coaching_id, 'Create Announcement', array('class'=>'btn btn-primary')); ?>
			</div>
		</div>
	</div>
	
