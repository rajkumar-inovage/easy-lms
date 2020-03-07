<section class="content">
		<div class="card mb-2"> 

			<div class="card-body ">

				<strong>Search</strong>

				<?php echo form_open('tests/ajax_func/search_tests/'.$category_id, array('class'=>"", 'id'=>'search-form')); ?>

					<div class="form-group row mb-2">

						<div class="col-md-6 mb-2">						

							<select name="search_status" class="form-control custom-select">

								<option value="-1">All Status</option>

								<option value="<?php echo TEST_STATUS_PUBLISHED; ?>">Published</option>

								<option value="<?php echo TEST_STATUS_UNPUBLISHED; ?>">Unpublished</option>

							</select>

						</div>

						<div class="col-md-6">

							<div class="input-group ">

								<input name="search_text" class="form-control " type="search" placeholder="Search" aria-label="Search Test" aria-describedby="search-button">

								<div class="input-group-append">

									<button class="btn btn-sm btn-primary " type="submit" id="search-button"><i class="fa fa-search"></i></button>

								</div>

							</div>

						</div>

					</div>

				</form>

			</div>
		</div>
		<div class="card card-default">

			<div class="card-body table-responsive">

				<table class="table table-hover v-middle mb-0" id="test-lists">

					<thead>

						<tr>

							<th width="5%">#</th>

							<th width="70%">Test Name</th>

							<th>Duration</th>

							<th>Status</th>

						</tr>

					</thead>

					<tbody>

            		<?php 

            		$i = 1;

            		if ( ! empty ($tests)) { 

            			foreach ($tests as $row) { 

            			    ?>

							<tr>

								<td><?php echo $i; ?>

								<td>

									<?php echo anchor('student/tests/take_test/'.$coaching_id.'/'.$member_id.'/'.$row['category_id'].'/'.$row['test_id'], $row['title'], array('title'=>'Take Test', 'class'=>'btn-link')); ?><br>

									<?php echo $row['unique_test_id']; ?>

								</td>

								<td>

									<?php echo $duration = $row['time_min'] . ' mins'; ?>

								</td>

								<td>

									<?php echo anchor('student/tests/take_test/'.$coaching_id.'/'.$member_id.'/'.$row['category_id'].'/'.$row['test_id'], 'Take Test', array('title'=>'Take Test', 'class'=>'btn btn-primary btn-sm')); ?>

								</td>

							</tr>

							<?php 

							$i++; 

						} 

					} else {

            		    ?>

            		    <tr>

            		        <td colspan="5" class="text-center bg-danger text-white"><span>No tests found</span></td>

            		    </tr>

            		    <?php

            		}

            		?>

					</tbody>

				</table>

			</div>
		</div>
</section>