<div class="row justify-content-center">
	<div class="col-md-3">

		<div class="card mb-3">
			<div class="card-header ">
				<h4 class="d-flex justify-content-between">
					<span>Users</span>
					<span class="badge badge-primary"><?php echo $users['total']; ?></span>
				 </h4>
			</div>
			<ul class="list-group">
				<li class="list-group-item media">
					<div class="media-body"><?php echo anchor ('coaching/users/index/'.$coaching_id.'/'.USER_ROLE_TEACHER, 'Teachers'); ?></div>
					<div class="media-right"><?php echo $users['num_teachers']; ?></div>
				</li>
				<li class="list-group-item media">
					<div class="media-body"><?php echo anchor ('coaching/users/index/'.$coaching_id.'/'.USER_ROLE_STUDENT, 'Student'); ?></div>
					<div class="media-right"><?php echo $users['num_students']; ?></div>
				</li>
				<li class="list-group-item media d-none">
					<div class="media-body"><?php echo anchor ('coaching/users/index/'.$coaching_id.'/0/'.USER_STATUS_ENABLED, 'Active'); ?></div>
					<div class="media-right"><?php echo $users['num_active']; ?></div>
				</li>
				<li class="list-group-item media">
					<div class="media-body"><?php echo anchor ('coaching/users/index/'.$coaching_id.'/0/'.USER_STATUS_DISABLED, 'Disabled'); ?></div>
					<div class="media-right"><?php echo $users['num_disabled']; ?></div>
				</li>
				<li class="list-group-item media">
					<div class="media-body"><?php echo anchor ('coaching/users/index/'.$coaching_id.'/0/'.USER_STATUS_UNCONFIRMED, 'Pending'); ?></div>
					<div class="media-right"><?php echo $users['num_pending']; ?></div>
				</li>
			</ul>
		</div>
		<!-- // Users // -->

		<div class="card mb-3">
			<div class="card-header ">
				<h4 class="d-flex justify-content-between">
					<span>Tests</span>
					<span class="badge badge-primary"><?php echo $tests['total']; ?></span>
				 </h4>
			</div>
			<ul class="list-group">
				<li class="list-group-item media">
					<div class="media-body"><?php echo anchor ('coaching/tests/index/'.$coaching_id.'/0/'.TEST_STATUS_PUBLISHED, 'Published'); ?></div>
					<div class="media-right"><?php echo $tests['num_published']; ?></div>
				</li>
				<li class="list-group-item media">
					<div class="media-body"><?php echo anchor ('coaching/tests/index/'.$coaching_id.'/0/'.TEST_STATUS_UNPUBLISHED, 'Un-published'); ?></div>
					<div class="media-right"><?php echo $tests['num_unpublished']; ?></div>
				</li>
			</ul>
		</div>

	</div>

	<div class="col-md-9">
		<div class="card-decks card-group">
			<?php
			if (! empty ($dashboard_menu)) {
				foreach ($dashboard_menu as $menu) {
					$link = $menu['controller_path'].'/'.$menu['controller_nm'].'/'.$menu['action_nm'].'/'.$coaching_id;
					?>
						<div class="card mb-2">
							<div class="card-body">
								<h4 class="text-center h-100">
									<a href="<?php echo site_url ($link); ?>" class="text-decoration-none stretched-link link-text-color">
										<span class="d-block"><?php echo $menu['icon_img']; ?></span>
										<span><?php echo $menu['menu_desc']; ?></span>
									</a>
								</h4>						
							</div>
						</div>
					<?php
				}
			}
			?>
		</div>
	</div>
</div>
