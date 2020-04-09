<div class="row justify-content-center">
	<div class="col-md-9">
		<div class="card-decks card-group">
			<?php
			if (! empty ($dashboard_menu)) {
				foreach ($dashboard_menu as $menu) {
					$link = $menu['controller_path'].'/'.$menu['controller_nm'].'/'.$menu['action_nm'].'/'.$coaching_id;
					?>
						<div class="card mb-2">
							<div class="card-body">
								<h4 class="text-center d-flex justify-content-center align-items-center h-100">
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
