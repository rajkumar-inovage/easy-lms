<div class="card">
	<div class="card-body">
		<canvas id="briefChart" width="100%" ></canvas>
	</div>
	<div class="card-footer">
		<ul class="nav nav-pills nav-fill" id="tabs_2">
			<li class="nav-.

			item">
				<p class="nav-link mb-0">
					<span class="badge bg-primary rounded-circle height-30 width-30 d-flex align-items-center justify-content-center mx-auto"> <?php echo $num_questions; ?></span>
					<span class="display mt-4">Questions</span>
				</p>
			</li>
			<li class="nav-item">
				<p class="nav-link mb-0">
					<span class="badge bg-dark rounded-circle height-30 width-30 d-flex align-items-center justify-content-center mx-auto text-white"> <?php echo $testMarks['marks']; ?></span>
					<span class="display mt-4">Test Marks</span>
				</p>
			</li>
			<li class="nav-item">
				<p class="nav-link mb-0">
					<span class="badge bg-orange-500 rounded-circle height-30 width-30 d-flex align-items-center justify-content-center mx-auto"> <?php echo $ob_marks[$attempt_id]['obtained']; ?></span>
					<span class="display mt-4">Score in this attempt</span>
				</p>
			</li>
			<li class="nav-item ">
				<p class="nav-link mb-0">
					<span class="badge bg-primary rounded-circle height-30 width-30 d-flex align-items-center justify-content-center mx-auto"> <?php echo $max_marks; ?></span>
					<span class="display mt-4">Maximum Score in this test</span>
				</p>
			</li>
		</ul>
	</div>
</div>
