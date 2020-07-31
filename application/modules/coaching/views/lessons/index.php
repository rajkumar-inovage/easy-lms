<div class="mb-2"> 
	<div class="">
		<strong>Search</strong>
		<?php echo form_open('coaching/lessons_actions/search/'.$coaching_id.'/'.$course_id, array('class'=>"mt-3", 'id'=>'search-form')); ?>
			<div class="form-group row mb-2">

				<div class="col-sm-6 col-lg-3 mb-2">
					<select name="status" class="custom-select rounded" id="search-status" >
						<option value="-1">All Status</option>
						<option value="<?php echo LESSON_STATUS_PUBLISHED; ?>" <?php if ($status == LESSON_STATUS_PUBLISHED) echo 'selected="selected"'; ?> >Published</option>
						<option value="<?php echo LESSON_STATUS_UNPUBLISHED; ?>"  <?php if ($status == LESSON_STATUS_UNPUBLISHED) echo 'selected="selected"'; ?>>Unpublished</option>
					</select>
				</div>


				<div class="col-sm-6 col-lg-3">
					<div class="input-group position-relative">
						<input name="search_text" class="form-control rounded" type="search" placeholder="Search" aria-label="Search Lessons" aria-describedby="search-button">
						<div class="input-group-append position-absolute" style="top:1px; right:0; z-index:99;">
							<button class="btn btn-sm btn-primary " type="submit" id="search-button"><i class="fa fa-search"></i></button>
						</div>
					</div>
				</div>

			</div>
		</form>
	</div>
</div>

<div id="lessons-list">
	<?php $this->load->view ('lessons/inc/index', $data); ?>
</div>