<div class="row justify-content-center ">
	<?php
		if (! empty ($dashboard_menu)) {
			foreach ($dashboard_menu as $menu) {
				$link = $menu['controller_path'].'/'.$menu['controller_nm'].'/'.$menu['action_nm'];
				?>
				<div class="col-6 ">
					<div class="card mb-2">
						<div class="card-body text-center">
							<a href="<?php echo site_url ($link); ?>" class="text-decoration-none stretched-link text-reset">
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