
	<div class="card card-default my-3 my-lg-5">
		<div class="-table-responsive" id="users-list">
			<table class="table table-bordered v-middle mb-0" id="data-tables">
				<thead>
					<tr>
						<th width="">SR. No</th>
						<th width="">Title</th>
						<th width="">Description</th>
						<th width="" class="text-center">Start Date</th>
						<th width="" class="text-center">End Date</th>
						<th width="" class="text-center">Created By</th>
					
					</tr>
				</thead>

				<tbody>
					 <?php 
					 $i=1;
					 foreach($results as $row){
					 	$original_date=$row['end_date'];
						$startdate = date("d-m-Y", $original_date);
					    $expire =($startdate);
						$today = date("d-m-Y"); 
	    
	      			if($expire >= $today){ ?>
	      			
					<tr>
						<td class="font-weight-bold"><?php echo $i; ?></td>
						<td><?php echo $row['title']; ?></td>
						<td><?php echo $row['description']; ?></td>
						<td class="text-center"><?php 
						$original_date=$row['start_date'];
						$new_date = date("d-m-Y", $original_date);

						echo $new_date; ?></td>
						<td class="text-center"><?php 
						$original_date=$row['end_date'];
						$new_date = date("d-m-Y", $original_date);

						echo $new_date; ?></td>
						
						<td class="text-center"><?php echo $row['created_by']; ?></td>
					</tr>
					 <?php $i++;  } } ?> 
	
				</tbody>
			</table> 
			
		</div>
	</div>
	
