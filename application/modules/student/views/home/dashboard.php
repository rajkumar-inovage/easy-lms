<div class="row justify-content-center ">
	<?php
		if (! empty ($dashboard_menu)) {
			foreach ($dashboard_menu as $menu) {
				$link = $menu['controller_path'].'/'.$menu['controller_nm'].'/'.$menu['action_nm'].'/'.$coaching_id.'/'.$member_id;
				?>
				<div class="col-6 ">
					<div class="card mb-2">
						<div class="card-body text-center">
							<a href="<?php echo site_url ($link); ?>" class="stretched-link text-pink-500">
								<?php echo $menu['icon_img']; ?><br>
								<span><?php echo $menu['menu_desc']; ?></span>
							</a>
						</div>
					</div>
				</div>
				<?php
			}
		}
	?>
</div>