		</div>
	</main>
	
	<div class="mt-4"></div>
	
	<div id="loader">
		<img src="<?php echo base_url (THEME_PATH . 'assets/img/loader.gif'); ?>" width="30" height="30">
	</div>

    <!-- Core -->
    <script src="<?php echo base_url(THEME_PATH . 'assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url(THEME_PATH . 'assets/js/bootstrap.bundle.min.js'); ?>"></script>
	<!-- Toastr JS for notifications -->
	<script type="text/javascript" src="<?php echo base_url (THEME_PATH . 'assets/js/toastr.min.js'); ?>"></script>
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