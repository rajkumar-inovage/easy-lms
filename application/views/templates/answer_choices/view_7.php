<?php
for ($i=1; $i<=QB_NUM_ANSWER_CHOICES; $i++) : 
	if ( $result['answer_'.$i] == $i) {
		$class = 'text-success';
	} else {
		$class = '';
	}
	?>
	<div class="mb-0 <?php echo $class; ?>">
		<span class="mr-2 float-left">
			<?php echo $a; ?>. 
		</span>
		<div class="">
			<?php echo $result['choice_'.$i]; ?>
		</div>
	</div>	
	<?php 
endfor; // $i
?>