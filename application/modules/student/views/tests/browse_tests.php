<div class="card">
    <div class="card-header py-2 ">
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
        <div class="card-header py-2">
            <ul class="nav nav-pills nav-fill mx-auto">
              <li class="nav-item"><a class="nav-link active" href="#ongoing" data-toggle="tab">On Going</a></li>
              <li class="nav-item"><a class="nav-link" href="#upcoming" data-toggle="tab">Up Coming</a></li>
              <li class="nav-item"><a class="nav-link" href="#archived" data-toggle="tab">Archived</a></li>
            </ul>
        </div>

        <div class="tab-content py-1">
            <div class="active tab-pane " id="ongoing">
             <?php 
             if (! empty ($tests['ongoing'])) {
                echo '<ul class="list-group list-group-flush ">';
                    foreach ($tests['ongoing'] as $row) {
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
                                    Started On: <?php echo date ('d M Y', $row['start_date']); ?> &nbsp; Ending On: <?php echo date ('d M Y', $row['end_date']); ?>
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
        </div>
    <?php } else { ?>
      <div class="card-body">
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