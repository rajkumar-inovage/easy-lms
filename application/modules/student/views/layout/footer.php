		</div>    	
	</main>
	
	<footer class="light-footer bg-white mt-4 fixed-bottom border-top shadow-sm py-2">
		<div class="container">
		  <div class="d-flex justify-content-between text-center">
		  	<span><i class="fa fa-home"></i><br> Tests </span>
		  	<span><i class="fa fa-home"></i><br> Reports </span>
		  	<span><i class="fa fa-home"></i><br> Account </span>
		  	<span><i class="fa fa-home"></i><br> Tests </span>
		  </div>
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