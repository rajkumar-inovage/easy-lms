
<div class="mb-0 <?php echo $class; ?>">
	<span class="mr-2 float-left">
		a. 
	</span>
	<div class="">
		True
	</div>
</div>


<?php
if ( $result['answer_2'] == 1) {
	$class = 'text-success';
} else {
	$class = '';
}
?>
<div class="mb-0 <?php echo $class; ?>">
	<span class="mr-2 float-left">
		b. 
	</span>
	<div class="">
		False
	</div>
</div>
