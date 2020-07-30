<div class="row">
  <div class="col-12">
    <?php if (!empty($courses)): ?>
      <?php foreach ($courses as $i => $course): 
        $category_id = isset($course['cat_id']) ? $course['cat_id'] : $cat_id;
        $toggle_to = (intval($course['status']) === COURSE_STATUS_ACTIVE)?COURSE_STATUS_INACTIVE:COURSE_STATUS_ACTIVE;
      ?>
        <div class="card d-flex flex-row mb-3">
          <?php if($course['feat_img']!=''): ?>
            <a class="d-flex" href="<?php echo site_url ('student/courses/view/'.$coaching_id.'/'.$member_id.'/'.$course['course_id']); ?>">
              <img src="<?php echo site_url( $course['feat_img'] ); ?>" class="list-thumbnail responsive border-0 card-img-left" />
            </a>
            <?php else: ?>
            <a class="d-flex" href="<?php echo site_url ('student/courses/view/'.$coaching_id.'/'.$member_id.'/'.$course['course_id']); ?>">
              <img src="<?php echo site_url('contents/system/default_course.jpg'); ?>" class="list-thumbnail responsive border-0 card-img-left" />
            </a>
          <?php endif; ?>
          <div class="pl-2 d-flex flex-grow-1 min-width-zero">
            <div class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
              <a href="<?php echo site_url ('student/courses/view/'.$coaching_id.'/'.$member_id.'/'.$course['course_id']); ?>" class="w-40 w-sm-100">
                <p class="list-item-heading mb-0 truncate"><strong class="mr-3"><?php echo ($i + 1) . "."?></strong><strong><?php echo $course['title']; ?></strong></p>
              </a>
              <p class="mb-0 text-muted text-small w-15 w-sm-100"><strong>Lessons:</strong> <?php echo $course['lessons']; ?></p>
              <p class="mb-0 text-muted text-small w-15 w-sm-100"><strong>Tests:</strong> <?php echo $course['tests']; ?></p>
              <div class="w-15 w-sm-100">
                <a class="btn btn-outline-primary btn-xs" href="<?php echo site_url ('student/courses/view/'.$coaching_id.'/'.$member_id.'/'.$course['course_id']); ?>">View <i class="fa fa-eye"></i>
                  </a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach;?>
    <?php else: ?>
      <div class="alert alert-danger" role="alert">There are no courses for you. Click <a href="<?php echo site_url('coaching/courses/create/' . $coaching_id . '/' . $cat_id); ?>" class="alert-link">here</a> to get your first course.</div>
    <?php endif;?>
  </div>
</div>