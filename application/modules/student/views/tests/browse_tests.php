<div class="card">
    <div class="card-header py-2 d-none">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a href="<?php echo site_url ('student/tests/index/'.$coaching_id.'/'.$member_id.'/'.TEST_TYPE_REGULAR); ?>" class="nav-link <?php if ($test_type == TEST_TYPE_REGULAR) echo 'text-danger font-weight-bold';  ?>">Enroled Tests</a>
            </li>
            <li class="nav-item">
                <a href="<?php echo site_url ('student/tests/index/'.$coaching_id.'/'.$member_id.'/'.TEST_TYPE_PRACTICE); ?>" class="nav-link <?php if ($test_type == TEST_TYPE_PRACTICE) echo 'text-danger';  ?>">Other Tests</a>
            </li>    
        </ul>
    </div>
  
    <?php if ($test_type == TEST_TYPE_REGULAR) { ?>
        <div class="card-header ">
            <ul class="nav nav-pills nav-fill">
              <li class="nav-item"><a class="nav-link active" href="#ongoing" data-toggle="tab">Active</a></li>
              <li class="nav-item"><a class="nav-link" href="#upcoming" data-toggle="tab">New</a></li>
              <li class="nav-item"><a class="nav-link" href="#archived" data-toggle="tab">Old</a></li>
              <li class="nav-item"><a class="nav-link" href="#practice" data-toggle="tab">Practice</a></li>
            </ul>
        </div>

        <div class="tab-content py-1 px-0">
            <div class="active tab-pane " id="ongoing">
             <?php 
             if (! empty ($tests['ongoing'])) {
                echo '<ul class="list-group list-group-flush ">';
                    foreach ($tests['ongoing'] as $row) {
                        ?>
                        <li class="list-group-item media -v-middle">
                          <div class="media-left">
                            <span class="icon-block half bg-red-500 rounded-circle text-white" title="Report">
                              <i class="fa fa-superscript"></i>
                            </span>
                          </div>
                          <div class="media-body">
                            <h4 class=""><?php echo $row['title']; ?></h4>
                            <div class="">
                                <span class="badge badge-success">
                                  Active Test
                                </span>
                                <p class="text-muted">
                                  Started On: <?php echo date ('d M Y', $row['start_date']); ?><br>
                                  Ending On: <?php echo date ('d M Y', $row['end_date']); ?>
                                </p>
                            </div>

                            <?php echo anchor ('student/tests/test_instructions/'.$coaching_id.'/'.$member_id.'/'.$row['test_id'], 'Take Test', ['class'=>'btn btn-primary']); ?>
                          </div>

                        </li>
                        
                        <?php
                    }
                echo '</ul>';
             } else {
                ?>
                <div class="text-danger my-4">
                    No tests right now 
                </div>
                <?php
             }
             ?>
            </div>
            <div class="tab-pane" id="upcoming">
             <?php 
             if (! empty ($tests['upcoming'])) {
                echo '<ul class="list-group list-group-flush">';
                    foreach ($tests['upcoming'] as $row) {
                        ?>
                        <li class="list-group-item">
                            <div class="media v-middle">
                              <div class="media-left">
                                <div class="icon-block s30 bg-red-400 text-white" title="Report">
                                  <i class="fa fa-file"></i>
                                </div>
                              </div>
                              <div class="media-body">
                                <?php echo anchor ('student/tests/test_instructions/'.$coaching_id.'/'.$member_id.'/'.$row['test_id'], $row['title'], ['class'=>'link-text-color']); ?>
                                <div class="text-grey-600">
                                    Starting On: <?php echo date ('d M Y', $row['start_date']); ?>                              
                                </div>
                              </div>
                            </div>
                        </li>
                        <?php
                    }
                echo '</ul>';
             } else {
                ?>
                <div class="text-danger my-4">
                    No tests right now
                </div>
                <?php
             }
             ?>             
            </div>
            <div class="tab-pane" id="archived">
             <?php 
             if (! empty ($tests['archived'])) {
                echo '<ul class="list-group list-group-flush ">';
                    foreach ($tests['archived'] as $row) {
                        ?>
                        <li class="list-group-item">
                            <div class="media v-middle">
                              <div class="media-left">
                                <div class="icon-block s30 bg-red-400 text-white" title="Report">
                                  <i class="fa fa-file"></i>
                                </div>
                              </div>
                              <div class="media-body">
                                <?php echo anchor ('student/reports/test_report/'.$coaching_id.'/'.$member_id.'/0/'.$row['test_id'], $row['title'], ['class'=>'link-text-color']); ?>
                                <div class="text-grey-600">
                                    Ended On: <?php echo date ('d M Y', $row['end_date']); ?>
                                </div>
                              </div>
                            </div>
                        </li>
                        <?php
                    }
                echo '</ul>';
             } else {
                ?>
                <div class="text-danger my-4">
                    No tests right now
                </div>
                <?php
             }
             ?>
            </div>

            <div class="tab-pane " id="practice">
              sdsd
            </div>

        </div>
    <?php } else { ?>
      <div class="card-bodys">
        <?php 
        if (! empty ($tests)) {
            echo '<ul class="list-group list-group-flush ">';
                foreach ($tests as $row) {
                    ?>
                    <li class="list-group-item">
                        <div class="media v-middle">
                          <div class="media-left">
                            <div class="icon-block s30 bg-red-400 text-white" title="Report">
                              <i class="fa fa-file"></i>
                            </div>
                          </div>
                          <div class="media-body">
                            <?php echo anchor ('student/tests/test_instructions/'.$coaching_id.'/'.$member_id.'/'.$row['test_id'], $row['title'], ['class'=>'link-text-color']); ?>
                            <div class="text-light">
                              
                            </div>
                          </div>
                        </div>
                    </li>
                    <?php
                }
            echo '</ul>';
        } else {
            ?>
            <div class="text-danger my-4">
                No tests right now
            </div>
            <?php
        }
        ?>
      </div>
    <?php } ?>
</div>