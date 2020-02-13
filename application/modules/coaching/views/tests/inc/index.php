<div data-scrollable>

	<h4 class="category">Search</h4>
	<div class="sidebar-block">
		<?php echo form_open('tests/admin/search_tests/'.$category_id); ?>
			<?php if (!isset($search)) $search = ''; ?>
			<div class="form-group">
				<input id="forumSearch" type="text" class="form-control" placeholder="Search test-name" name="search" value="<?php echo set_value ('search', $search); ?>" >
			</div>
			<p class="text-muted">Search test-name</p>
			<input type="submit" class="btn btn-inverse paper-shadow relative" data-z="0.5" data-hover-z="1" value="Search">
			<?php
				if ($node_details['level'] >= TEST_LEVEL_YEAR) {
					echo anchor ('tests/admin/create/'.$category_id, 'Create Test', array('class'=>'btn btn-success'));					
				}
			?>
		</form>
	</div>
	
	<?php if ( ! empty ($my_subscriptions)) { ?>
		<h4 class="category">Filter</h4>
		<ul class="sidebar-block list-group list-group-menu list-group-minimal">
			<?php
			foreach ($my_subscriptions as $row) { 
				if (isset ($row['category_id'])) {
					$id = $row['category_id'];
				} else {
					$id = $row['id'];								
				}
				
				if ($id == $category_id) {
					$class = 'active'; 
				} else {
					$class = '';
				}
				
				// Get num tests 
				$tests = $this->tests_model->tests_in_category ($id);
				$count = 0;
				if ( ! empty ($tests)) {
					$num_tests = count ($tests);
					//$count = $count + $num_tests;
					$create_badge = '<span class="label label-default pull-right">'.$num_tests.'</span>';

					$details = $this->common_model->node_details ($id, SYS_TREE_TYPE_TEST);
					?>
					<li class="list-group-item <?php echo $class; ?>">
						<?php 
						if ($this->session->userdata('admin_user') == 1) {
							echo anchor ('tests/admin/index/'.$id, $details['title'] . $create_badge);
						} else {
							echo anchor ('tests/frontend/index/'.$id, $details['title'] . $create_badge);
						}
						?>
					</li>
					<?php
				} else {
					$num_tests = 0;
				}
			}
			?>
		</ul>
		
	<?php } ?>
</div>