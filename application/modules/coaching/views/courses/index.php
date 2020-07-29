<div class="row">
    <div class="col-12 list" data-check-all="checkAll"> 
    <?php 
    $i = 1;
    if ( ! empty ($courses)) { 
      foreach ($courses as $row) { 
        ?>
        <div class="card d-flex flex-row mb-3">
          <div class="d-flex flex-grow-1 min-width-zero">
              <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                  <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0" href="<?php echo site_url ('coaching/courses/manage/'.$coaching_id.'/'.$row['course_id']); ?>">
                      <?php 
                      if ($row['status'] == LESSON_STATUS_PUBLISHED) {
                        echo '<i class="simple-icon-check heading-icon"></i>';
                      } else {
                        echo '<i class="simple-icon-refresh heading-icon"></i>';
                      }
                      ?>
                      <span class="align-middle d-inline-block"><?php echo $row['title']; ?></span>
                  </a>
                  <p class="mb-0 text-muted text-small w-15 w-xs-100"></p>
                  <p class="mb-0 text-muted text-small w-15 w-xs-100"></p>
                  <div class="w-15 w-xs-100">
                    <a class="btn btn-primary" href="<?php echo site_url ('coaching/courses/manage/'.$coaching_id.'/'.$row['course_id']); ?>"><i class="fa fa-cog"></i> Manage </a>

                  </div>
                </div>
            </div>
        </div>
        <?php 
        $i++; 
      } 
    } else {
      ?>
      <div class="alert alert-danger" role="alert">
        No courses found
        <?php echo anchor ('coaching/lessons/create/'.$coaching_id, 'Create Course'); ?>
      </div>
      <?php
    }
    ?>
  </div>
</div>
