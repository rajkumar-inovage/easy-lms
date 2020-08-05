<?php
$a = 'a';
for ($i=1; $i<=QB_NUM_ANSWER_CHOICES; $i++) : 
	if ( $result['answer_'.$i] == $i) {
		$class = 'text-success';
	} else {
		$class = '';
	}
	if ($result['choice_'.$i] != '') {
		?>
		<div class="mb-0 ml-4 <?php echo $class; ?>">
			<span class="mr-2 float-left">
				<?php echo $a; ?>. 
			</span>
			<div class="">
				<?php echo $result['choice_'.$i]; ?>
			</div>
		</div>
		<?php 
	}
	$a++;
endfor; 
?>