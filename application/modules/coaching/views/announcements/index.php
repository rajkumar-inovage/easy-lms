
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
						$timestamp=strtotime($original_date);
						$new_date = date("d-m-Y", $timestamp);

						echo $new_date; ?></td>
						<td><?php 
						$original_date=$row['end_date'];
						$timestamp=strtotime($original_date);
						$new_date = date("d-m-Y", $timestamp);

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
						<td><span class="px-2"><a href="#">Edit</a></span><span class="px-2"><a href="#">Delete</a></span></td>
					</tr>
					<?php
					$i++; 

				}?> 
	
				</tbody>
			</table> 
			<div class="create-announcement">
				<?php echo anchor ('coaching/announcements/create_announcement/'.$coaching_id, 'Create announcements'); ?>
			</div>
		</div>
	</div>
	
