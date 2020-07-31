<div class="app-menu">	
	<div class="p-4 h-100">
    	<div class="scroll">
        <div class="card mb-2">
		  <div class="card-header p-0 heading-icon pb-3">
		  	Questions
		  </div>
		  <div class="separator mb-2"></div>
		  <ul class="list-group">
			<?php 
			$i = 1;
			if (! empty ($questions)) {
				foreach ($questions as $q) {
					?>
					<li class=" media border-bottom d-flex my-2 pb-3">
						<div class="media-left pr-2">
							<?php echo $i; ?>-
						</div>
						<div class="media-body">
							<?php 
							$qn = strip_tags ($q['question']); 
							$qn = character_limiter ($qn, 100);
							?>
							<a class="py-0" href="<?php echo site_url ('coaching/tests/question_create/'.$coaching_id.'/'.$course_id.'/'.$test_id.'/'.$q['parent_id'].'/'.$q['question_id'].'/'.$q['type']); ?>" class="<?php if ($q['question_id'] == $question_id) echo 'text-danger'; ?>"><?php echo $qn; ?></a>
						</div>
						
					</li>
					<?php
					$i++;
				}
				
			} else {
				?>
				<li class="list-group-item ">
					<span class="text-danger">No questions found</span>
				</li>
				<?php
			}
			?>
		  </ul>
		</div>
		</div>
	</div>
	<a class="app-menu-button d-inline-block d-xl-none" href="#">
		<i class="simple-icon-options"></i>
	</a>
</div>