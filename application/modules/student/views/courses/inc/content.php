<div class="app-menu">
  <div class="d-flex flex-column overflow-hidden p-4 h-100">
    <div class="d-flex border-bottom mb-3 pb-3">
      <div class="flex-grow-1 my-auto">
        <h4 class="mb-0">Progress</h4>
      </div>
      <div class="flex-shrink-0 my-auto">
        <div role="progressbar" class="progress-bar-circle position-relative" data-color="#5b87ac" data-trail-color="rgba(255,255,255,0.2)" aria-valuenow="<?php echo $progress['total_progress']; ?>" aria-valuemax="<?php echo $progress['total_pages']; ?>" data-show-percent="true"></div>
      </div>
    </div>
    <div class="d-flex flex-column flex-grow-1 flex-shrink-1 overflow-auto scroll" style="flex-basis: 0;">
      <?php
      if (!empty($lessons)) {
        foreach ($lessons as $i => $lesson) {
          ?>
            <div class="d-flex">
              <div class="flex-grow-1 my-auto">
                <div class="<?php echo ($lesson['lesson_id'] == $lesson_id)?"text-primary":""; ?>">Chapter <?php echo $i+1; ?></div>
                <h4 class="mb-0">
                  <a class="<?php echo ($lesson['lesson_id'] == $lesson_id)?"text-primary":""; ?>" href="<?php echo site_url ('student/courses/content/'.$coaching_id.'/'.$member_id.'/'.$course_id.'/'.$lesson['lesson_id']); ?>" ><?php echo $lesson['title']; ?></a>
                </h4>
              </div>
              <div class="flex-shrink-0 my-auto">
                <strong><?php echo ($lesson['progress'])?'<i class="fas fa-check text-primary"></i>':''; ?></strong>
              </div>
            </div>
            <?php
            if ($lesson_id == $lesson['lesson_id'] && ! empty($pages)) {
              echo '<div class="separator my-1"></div>';
              foreach ($pages as $page) {
              ?>
                <div class="d-flex flex-row mb-2 pb-2 border-bottom">
                  <div class="flex-grow-1 my-auto text-nowrap">
                    <a class="<?php echo ($page['page_id'] == $page_id)?"text-primary":""; ?>" href="<?php echo site_url ('student/courses/content/'.$coaching_id.'/'.$member_id.'/'.$course_id.'/'.$lesson_id.'/'.$page['page_id']); ?>" ><?php echo $page['title']; ?></a>
                  </div>
                  <div class="flex-shrink-0 my-auto">
                    <strong><?php echo ($page['progress'])?'<i class="fas fa-check text-primary"></i>':''; ?></strong>
                  </div>
                </div>
              <?php
              }
            }
            ?>
            <?php echo ((count($lessons)-1) !== $i)?'<div class="separator my-2"></div>':null;?>
          <?php
        }
      }
      ?>
    </div>
  </div>
  <a class="app-menu-button d-inline-block d-xl-none" href="#">
    <i class="simple-icon-options"></i>
  </a>
</div>