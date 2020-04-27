
<div class="card mb-4 shadow-sm">
	<div class="card-header ">
		<h4>My Classrooms</h4>
	</div>
	<ul class="list-group ">
		<?php 
		$i=1;
		if (! empty ($my_classrooms)) {
			foreach($my_classrooms as $row) { 
				?>
				<li class="list-group-item media">
					<div class="media-left">
						<?php if ($row['running'] == 'true') { ?>
							<span class="icon-block s25 rounded-circle bg-success">
								<i class="fa fa-video"></i>
							</span>
						<?php } else { ?>
							<span class="icon-block half rounded-circle bg-grey-200">
								<i class="fa fa-video"></i>									
							</span>
						<?php } ?>
					</div>
					<div class="media-body">
						<h4 class=""><?php echo $row['class_name']; ?></h4>
						<?php if ($row['running'] == 'true') { ?>
							<span class="badge badge-success">Class has started</span>
						<?php } else { ?>
							<span class="badge badge-default bg-grey-200">Class not started</span>
						<?php } ?>							
						<?php //echo anchor ('coaching/virtual_class/class_details/'.$coaching_id.'/'.$row['class_id'], $row['class_name']); ?>
						<div class="mt-2">
							<?php 
							if ($row['running'] == 'true') {
								echo anchor ('student/virtual_class/join_class/'.$coaching_id.'/'.$row['class_id'].'/'.$member_id, '<i class="fa fa-plus"></i> Join Class', ['class'=>'btn btn-success mr-1']);
							} else {
								echo anchor ('student/virtual_class/join_class/'.$coaching_id.'/'.$row['class_id'].'/'.$member_id, '<i class="fa fa-plus"></i> Join Class', ['class'=>'btn btn-default mr-1']);
							}
							?>
						</div>
					</div>

					<div class="media-right">
					</div>
				</li>
				<?php
				$i++;
				if ($i >= 3) {
					break;
				}
			}
		} else {
        	?>
            <div class="text-danger my-4">
                No class right now 
            </div>
            <?php
        }
		?>
	</ul>
	<div class="card-footer text-right">
		<?php echo anchor ('student/virtual_class/index/'.$coaching_id.'/'.$member_id, '<i class="fa fa-video"></i> All Classrooms', ['class'=>'btn btn-link mr-1']); ?>
	</div>
</div>

<div class="card mb-4 shadow-sm">
	<div class="card-header ">
		<h4>My Tests</h4>
	</div>
	<ul class="list-group ">
		<?php 
		$i=1;
        if (! empty ($tests['ongoing'])) {
            echo '<ul class="list-group list-group-flush ">';
                foreach ($tests['ongoing'] as $row) {
                    ?>
                    <li class="list-group-item ">
                        <div class="media v-middle ">
                          <div class="media-left">
                            <span class="icon-block half bg-red-400 rounded-circle text-white" title="Report">
                              <i class="fa fa-superscript"></i>
                            </span>
                          </div>
                          <div class="media-body">
                            <h4 class=""><?php echo $row['title']; ?></h4>
                            <div class="">
                                <span class="badge badge-success">
                                	Active Test
                                </span>
                                <p class="text-muted">
                                	Started On: <?php echo date ('d M Y', $row['start_date']); ?><br>
                                	Ending On: <?php echo date ('d M Y', $row['end_date']); ?>
                                </p>
                            </div>

                            <?php echo anchor ('student/tests/test_instructions/'.$coaching_id.'/'.$member_id.'/'.$row['test_id'], 'Take Test', ['class'=>'btn btn-primary']); ?>
                          </div>
                        </div>
                    </li>
                    
                    <?php
	       			$i++;
					if ($i >= 3) {
						break;
					}		
                }
            echo '</ul>';
        } else {
            ?>
            <div class="text-danger my-4">
                No tests right now 
            </div>
            <?php
        }
        ?>
	</ul>
	<div class="card-footer text-right">
		<?php echo anchor ('student/tests/index/'.$coaching_id.'/'.$member_id, '<i class="fa fa-superscript"></i> All Tests', ['class'=>'btn btn-link mr-1']); ?>
	</div>
</div>

<div class="row row-cols-1 row-cols-xs-2 justify-content-center">
	<?php
		if (! empty ($dashboard_menu)) {
			foreach ($dashboard_menu as $menu) {
				$link = $menu['controller_path'].'/'.$menu['controller_nm'].'/'.$menu['action_nm'].'/'.$coaching_id.'/'.$member_id;				
				?>
				<div class="col mb-4">
					<div class="card bg-primary ">
						<div class="card-body text-center">
							<a href="<?php echo site_url ($link); ?>" class="text-white">
								<?php echo $menu['icon_img']; ?><br>
								<?php echo $menu['menu_desc']; ?>
							</a>
						</div>
					</div>
				</div>	
				<?php
			}
		}
	?>
</div>