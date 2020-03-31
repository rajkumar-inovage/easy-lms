		</div>    	
	</main>
	
	<footer class="light-footer mt-4 ">
		<div class="container">
		  <div class="d-flex justify-content-center">			
		  	<!--
			<p class="footer-info">
			  <strong><?php echo $this->session->userdata('SITE_TITLE'); ?></strong> © <?php echo date ('Y'); ?> - All Rights Reserved.
			</p>
			<span class="pull-right">Product of <a href="<?php echo COMPANY_URL; ?>"><strong><?php echo COMPANY_NAME; ?></strong></a></span>
			-->
		</div>
	</footer>

	<footer class="mt-4 fixed-bottom d-none">
		<div class="container-sm">
		  <div class="bg-white d-flex justify-content-between text-center border-top shadow-sm py-2 px-1">
		  	<?php
			$footer_menu = $this->session->userdata ('FOOTER_MENU');
			// Side-menu
			if (! empty ($footer_menu)) {
				if ($coaching_id == 0) {
					$coaching_id = $this->session->userdata ('coaching_id');
				}
				if ($member_id == 0) {
					$member_id = $this->session->userdata ('member_id');
				}
				foreach ($footer_menu as $menu) {
					$link = $menu['controller_path'].'/'.$menu['controller_nm'].'/'.$menu['action_nm'].'/'.$coaching_id.'/'.$member_id;
					?>
					<div class="">
						<a class="text-grey-900" href="<?php echo site_url($link); ?>">
							<?php echo $menu['icon_img']; ?><br>
							<?php echo $menu['menu_desc']; ?>
						</a>
					</div>
					<?php
				}
			}
			?>
		  </div>
		</footer>
	</div>

	<div id="loader">
		<img src="<?php echo base_url (THEME_PATH . 'assets/img/loader.gif'); ?>" width="30" height="30">
	</div>

    <!-- Core -->
    <script type="text/javascript" src="<?php echo base_url(THEME_PATH . 'assets/js/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url(THEME_PATH . 'assets/js/bootstrap.bundle.min.js'); ?>"></script>
	<!-- Toastr JS for notifications -->
	<script type="text/javascript" src="<?php echo base_url (THEME_PATH . 'assets/js/toastr.min.js'); ?>"></script>
	<!-- ChartJS -->
	<script type="text/javascript" src="<?php echo base_url (THEME_PATH . 'assets/js/chart.bundle.min.js'); ?>"></script>
	<!-- Application JS -->
	<script type="text/javascript" src="<?php echo base_url (THEME_PATH . 'assets/js/app.js'); ?>"></script>
	<!-- Custom JS (Dynamically included) -->
	<?php
	if (isset ($script)) {
		echo $script;	
	}
	?>	

	<script type="text/javascript">
		<?php //if ($this->session->has_userdata ('is_logged_in'))
		?>
	</script>
  </body>
</html>