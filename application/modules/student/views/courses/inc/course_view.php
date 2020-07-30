<div class="app-menu">
  <div class="p-4 h-100">
    <div class="scroll">
      <?php
      $i = 1;
      if (! empty ($lessons)) {
        foreach ($lessons as $lesson) {
          ?>
            <div class="d-flex">
              <div class="flex-grow-1 my-auto">
                <div>Chapter <?php echo $i; ?></div>
                <h4>
                  <a class="text-grey-900" href="<?php echo site_url ('student/courses/view/'.$coaching_id.'/'.$member_id.'/'.$course_id.'/'.$lesson['lesson_id']); ?>" ><?php echo $lesson['title']; ?></a>
                </h4>
              </div>
              <div class="flex-shrink-0 my-auto">
                <strong><?php echo ($lesson['progress'])?'<i class="fas fa-check-double text-primary"></i>':'<i class="fas fa-check text-muted"></i>'; ?></strong>
              </div>
            </div>
            <?php
            if ($lesson_id == $lesson['lesson_id'] && ! empty($pages)) {
              echo '<hr>';
              foreach ($pages as $page) {
              ?>
                <div class="d-flex flex-row mb-2 pb-2 border-bottom">
                  <div class="flex-grow-1 my-auto text-nowrap">
                    <a class="text-grey-900" href="<?php echo site_url ('student/courses/view/'.$coaching_id.'/'.$member_id.'/'.$course_id.'/'.$lesson_id.'/'.$page['page_id']); ?>" ><?php echo $page['title']; ?></a>
                  </div>
                  <div class="flex-shrink-0 my-auto">
                    <strong><?php echo ($page['progress'])?'<i class="fas fa-check-double text-primary"></i>':'<i class="fas fa-check text-muted"></i>'; ?></strong>
                  </div>
                </div>
              <?php
              }
            }
            ?>
            <hr>
          <?php
          $i++;
        }
      }
      ?>
    </div>
  </div>
  <a class="app-menu-button d-inline-block d-xl-none" href="#">
    <i class="simple-icon-options"></i>
  </a>
</div>