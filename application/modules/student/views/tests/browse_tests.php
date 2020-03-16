<section class="content">
    <nav>
        <div class="nav nav-tabs nav-justified" role="tablist">
            <button class="nav-item nav-link bg-transparent border-bottom-0 active" id="nav-enrolled-tab" data-toggle="tab" data-target="#enrolled" role="tab" aria-controls="nav-home" aria-selected="false">Enrolled Tests</button>
            <button class="nav-item nav-link bg-transparent border-bottom-0" id="nav-public-tab" data-toggle="tab" data-target="#public" role="tab" aria-controls="nav-profile" aria-selected="true">Public Tests</button>
        </div>
    </nav>
    <div class="tab-content px-0 bg-transparent">
        <div class="tab-pane fade show active" id="enrolled" role="tabpanel" aria-labelledby="nav-enrolled-tab">
        	<div class="row">
        		<div class="col-12 order-2">
        			<div class="card mb-4">
        				<div class="card-header">
        					<h4 class="card-title my-1 text-center">Upcoming Tests</h4>
        				</div>
        				<div class="card-body p-0">
							<div class="list-group">
							    <?php
							    foreach ($upcoming_tests as $i => $row) {
							    	$classes = "list-group-item list-group-item-action disabled border-right-0 border-left-0";
							    	if($i == 0){
							    		$classes .= " border-top-0";
							    	}
							    	if($i == (count($upcoming_tests)-1)){
							    		$classes .= " border-bottom-0";
							    	}
							    	echo anchor('student/tests/take_test/'.$coaching_id.'/'.$member_id.'/'.$row['category_id'].'/'.$row['test_id'], $row['title'], array('title'=>'Take Test', 'class'=> $classes));
							    }
							    ?>
							</div>
        				</div>
        				<div class="card-footer bg-transparent">
							<nav aria-label="Page navigation example">
							    <ul class="pagination justify-content-end mb-0">
							        <li class="page-item disabled">
							            <a class="page-link" href="#" aria-label="Previous">
							                <span aria-hidden="true">&laquo;</span>
							                <span class="sr-only">Previous</span>
							            </a>
							        </li>
							        <li class="page-item active"><a class="page-link" href="#">1</a></li>
							        <li class="page-item"><a class="page-link" href="#">2</a></li>
							        <li class="page-item">
							            <a class="page-link" href="#" aria-label="Next">
							                <span aria-hidden="true">&raquo;</span>
							                <span class="sr-only">Next</span>
							            </a>
							        </li>
							    </ul>
							</nav>
        				</div>
        			</div>
        		</div>
        		<div class="col-12 order-1">
        			<div class="card mb-4">
        				<div class="card-header">
        					<h4 class="card-title my-1 text-center">Ongoing Tests</h4>
        				</div>
        				<div class="card-body p-0">
							<div class="list-group">
								<?php
								foreach ($ongoing_tests as $i => $row) {
									$difficulty = $this->common_model->sys_parameter_name (SYS_QUESTION_DIFFICULTIES, $row['difficulty_level'])
								?>
								    <a href="<?php echo 'student/tests/take_test/'.$coaching_id.'/'.$member_id.'/'.$row['category_id'].'/'.$row['test_id']; ?>" class="list-group-item list-group-item-action flex-column align-items-start border-right-0 border-left-0 border-top-0">
								        <div class="d-flex w-100 justify-content-between">
								            <h5 class="mb-1"><?php echo $row['title']; ?></h5>
								            <small class="text-nowrap"><?php echo $duration = $row['time_min'] . ' mins'; ?></small>
								        </div>
								        <p class="mb-1"><strong>Test ends on:</strong><?php echo date('d/m/Y', $row['end_date']); ?></p>
								        <small><strong>Difficulty:</strong><?php echo $difficulty['paramval'];?></small>
								    </a>
								<?php
								}
								?>
							</div>
        				</div>
        			</div>
        		</div>
        		<div class="col-12 order-3">
        			<div class="card mb-4">
        				<div class="card-header">
        					<h4 class="card-title my-1 text-center">Archived Tests</h4>
        				</div>
        				<div class="card-body p-0">
							<div class="list-group">
							    <a href="#" class="list-group-item list-group-item-action border-right-0 border-left-0 border-top-0"> Cras justo odio </a>
							    <a href="#" class="list-group-item list-group-item-action border-right-0 border-left-0">Dapibus ac facilisis in</a>
							    <a href="#" class="list-group-item list-group-item-action border-right-0 border-left-0">Morbi leo risus</a>
							    <a href="#" class="list-group-item list-group-item-action border-right-0 border-left-0">Porta ac consectetur ac</a>
							    <a href="#" class="list-group-item list-group-item-action border-right-0 border-left-0">Vestibulum at eros</a>
							    <a href="#" class="list-group-item list-group-item-action border-right-0 border-left-0"> Cras justo odio </a>
							    <a href="#" class="list-group-item list-group-item-action border-right-0 border-left-0">Dapibus ac facilisis in</a>
							    <a href="#" class="list-group-item list-group-item-action border-right-0 border-left-0">Morbi leo risus</a>
							    <a href="#" class="list-group-item list-group-item-action border-right-0 border-left-0">Porta ac consectetur ac</a>
							    <a href="#" class="list-group-item list-group-item-action border-right-0 border-left-0 border-bottom-0">Vestibulum at eros</a>
							</div>
        				</div>
        				<div class="card-footer bg-transparent">
							<nav aria-label="Page navigation example">
							    <ul class="pagination justify-content-end mb-0">
							        <li class="page-item disabled">
							            <a class="page-link" href="#" aria-label="Previous">
							                <span aria-hidden="true">&laquo;</span>
							                <span class="sr-only">Previous</span>
							            </a>
							        </li>
							        <li class="page-item active"><a class="page-link" href="#">1</a></li>
							        <li class="page-item"><a class="page-link" href="#">2</a></li>
							        <li class="page-item">
							            <a class="page-link" href="#" aria-label="Next">
							                <span aria-hidden="true">&raquo;</span>
							                <span class="sr-only">Next</span>
							            </a>
							        </li>
							    </ul>
							</nav>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
        <div class="tab-pane fade" id="public" role="tabpanel" aria-labelledby="nav-public-tab">
            <div class="card mb-2">
                <div class="card-body ">
                    <strong>Search</strong>
                    <?php echo form_open('tests/ajax_func/search_tests/'.$category_id, array('class'=>"", 'id'=>'search-form')); ?> <div class="form-group row mb-2">
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
                    <?php echo form_close(); ?>
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
                            if (! empty($tests)) {
                                foreach ($tests as $row) {
                                    ?> <tr>
                                        <td><?php echo $i; ?>
                                            <td> <?php echo anchor('student/tests/take_test/'.$coaching_id.'/'.$member_id.'/'.$row['category_id'].'/'.$row['test_id'], $row['title'], array('title'=>'Take Test', 'class'=>'btn-link')); ?><br>
                                                <?php echo $row['unique_test_id']; ?> </td>
                                                <td> <?php echo $duration = $row['time_min'] . ' mins'; ?> </td>
                                                <td> <?php echo anchor('student/tests/take_test/'.$coaching_id.'/'.$member_id.'/'.$row['category_id'].'/'.$row['test_id'], 'Take Test', array('title'=>'Take Test', 'class'=>'btn btn-primary btn-sm')); ?> </td>
                                            </tr> <?php
                                            $i++;
                                }
                            } else {
                                ?> <tr>
                                            <td colspan="5" class="text-center bg-danger text-white"><span>No tests found</span></td>
                                        </tr> <?php
                            }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
        </div>
    </div>
</section>
