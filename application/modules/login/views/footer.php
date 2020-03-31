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

	<div id="loader">
		<img src="<?php echo base_url (THEME_PATH . 'assets/img/loader.gif'); ?>" width="30" height="30">
	</div>

    <!-- Core -->
    <script src="<?php echo base_url(THEME_PATH . 'assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url(THEME_PATH . 'assets/js/bootstrap.bundle.min.js'); ?>"></script>
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
  </body>
</html>