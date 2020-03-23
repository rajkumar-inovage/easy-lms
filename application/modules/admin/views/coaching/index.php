<div class="card card-default">
	<div class="table-responsive">
	<table class="table  mb-0 table-hover ">
		<thead>
			<tr>
				<th width="5%">#</th>
				<th width="30%"><?php echo 'Coaching Name'; ?></th>
				<th width="30%"><?php echo 'Coaching URL'; ?></th>
				<th><?php echo 'Subscription Plan'; ?></th>
				<th><?php echo 'Actions'; ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$i = 1;
        if ( ! empty ($results)) { 
			foreach ($results as $row) {
				?>
				<tr>
				    <td><?php echo $i; ?></td>
					<td>
						<?php echo anchor('coaching/home/dashboard/'.$row['id'], $row['coaching_name'], array('title'=>'Plans', 'class'=>'btn-link')); ?><br>
						<?php echo $row['reg_no']; ?>
					</td>
					
					<td><?php echo site_url('?sub='.$row['coaching_url']); ?></td>
					<td><?php echo $row['title']; ?></td>
                    <td>
                        <?php 
                            echo anchor ('admin/coaching/edit/'.$row['id'], 'Edit', array('class'=>'btn btn-link'));
                            echo anchor ('coaching/home/dashboard/'.$row['id'], 'Dashboard', array('class'=>'btn btn-primary'));
                        ?>
                    </td>
				</tr>
				<?php
				$i++;
			} // foreach 
        } else {
            ?>
            <tr>
                <td colspan="4"><span class="text-danger">No coaching accounts created yet </td>
            </tr>
            <?php
        }
		?>
		</tbody>
	</table>
	</div>
</div>