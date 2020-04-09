 <div class="row mb-4 justify-content-center align-middle v-middle ">
  <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4 text-center">
  </div>
</div>


<div class="row justify-content-center align-middle v-middle mt-4">
  <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
	
	<div class="card card-default paper-shadow ">
	  <div class="card-header bg-white text-center pb-1">
	  	<h4 class="text-center">Find your coaching</h4>
		<h6 class="text-center"></h6>
	  </div>
	  <div class="card-body ">
	  	<?php echo form_open ('public/page_actions/find_coaching', ['id'=>'find-coaching']); ?>
	  	<div class="form-group">
	  		<label>Type in a few letters to search your coaching</label>
	  		<input type="text" name="search" class="form-control">
	  	</div>
	  	<div class="form-group text-center">
	  		<input type="submit" name="submit" class="btn btn-success" value="Search">
	  	</div>
	  	<?php form_close(); ?>
	  </div>
	  

	  <div class="card-body ">
	  	<div id="message-div" class="mb-1"></div>
	  	<div id="result-div"></div>
	  </div>
	  
	  <hr>

	  <div class="card-body ">
	  	<p>If you want to set-up account for your own coaching or institution, please click the button below</p>
	  	<?php echo anchor('public/login/create_coaching', 'Set-up a new coaching account', ['class'=>'btn btn-info btn-block']); ?>
	  	<p><small>You can set-up account for your institute, coaching or organisation using the above button</small></p>
	  </div>

	  <div class="card-body px-lg-5 py-lg-5 text-info d-none">
		<p class="mt-4 text-info font-weight-bold">Note: If you are a student or employee looking for your organisation, you must use the link/URL shared by your Admin </p>
	  </div>

	</div>
  </div>
</div>
