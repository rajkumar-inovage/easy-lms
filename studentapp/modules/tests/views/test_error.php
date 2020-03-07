<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="widget box">
			<div class="widget-header">
				<h4><i class="icon-reorder"></i> Alert</h4>		
			</div>
			
			<div class="widget-content">
				<?php if ($error == TEST_ERROR_MAX_ATTEMPT_REACHED) { ?>
				<div class="alert alert-warning fade in">
					<strong>Warning!</strong> Your maximum attempts has reached the limit.
					<p>You cannot attempt this test any more.</p>
				</div>
				<?php } else if ($error == TEST_ERROR_RECENTLY_TAKEN) { ?>
				<div class="alert fade in">
					<strong>Test locked!</strong>.
					<p>This test has been locked, as you have recently taken this test.</p>
					<p>Next attempt will be avalailable only after 
						<span>
							<script src="<?php echo base_url (TEMPLATE_PATH . 'assets/js/countdown.js'); ?>"></script>
							<script language="javascript">
								// Function for submit form when time is over.	
								function countdownComplete(){
									window.close ();
									//document.location.href = '<?php echo site_url('tests/page/subscribed_tests/'.$category_id);?>';
								}
								// === *** SHOW TIMER *** === //
								var test2 = new Countdown( {  
														time: <?php echo $time_remaining; ?> , 
														rangeHi : 'hour',
														width:200, 
														height:60,
														hideLine	: true,
														numbers		: 	{
															color	: "#000000",
															bkgd	: "#ffffff",
															rounded	: 0.15,				// percentage of size
														},											
														onComplete	: countdownComplete
													} );
								var CountdownImageFolder = "images/"; 
								var CountdownImageBasename = "flipper";
								var CountdownImageExt = "png";
								var CountdownImagePhysicalWidth = 41;
								var CountdownImagePhysicalHeight = 90;
								
							</script>
						</span>
					</p>
					<p>
						<a href="#" onclick="" class="btn btn-sm"> Request Reset  </a>
					</p>
				</div>
				<?php }  else if ($error == TEST_ERROR_OFFLINE_TEST) { ?>
					<strong>This Test is OFFLINE, held only in Campus.</strong>
				<?php }?>			
				<p>
					<a href="#" onclick="window.close()" class="btn btn-sm"> Close </a>
				</p>

			</div> <!-- // widget-content -->
		</div> <!-- // widget -->
	</div>
</div>