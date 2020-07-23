<div class="row">
  <div class="col-12">
    <?php if (!empty($courses)): ?>
    <div class="card card-default border-0 mb-2">
      <div class="card-body p-0">
        <ul class="list-group">
          <?php foreach ($courses as $i => $course): 
              $category_id = isset($course['cat_id']) ? $course['cat_id'] : $cat_id;
              $toggle_to = (intval($course['status']) === COURSE_STATUS_ACTIVE)?COURSE_STATUS_INACTIVE:COURSE_STATUS_ACTIVE;
            ?>
            <li class="list-group-item position-relative">
              <div class="media">
                <div class="media-left">
                  <strong><?php echo ($i + 1) . "."?></strong>
                </div>
                <div class="media-body text-justify">
                  <div>
                    <strong><?php echo $course['title']; ?></strong>
                  </div>
                  <div class="d-flex flex-column flex-sm-row justify-content-between justify-content-md-start">
                    <span><strong>Created ON:</strong> <?php echo date('j<\s\up>S</\s\up> F, Y', $course['created_on']); ?></span>
                    <span class="ml-md-3 "><strong>Created By:</strong> <?php echo $course['created_by']; ?></span>
                    <span class="ml-md-3 "><strong>Lessons:</strong> <?php echo $course['lessons']; ?></span>
                    <span class="ml-md-3 "><strong>Tests:</strong> <?php echo $course['tests']; ?></span>
                  </div>
                  <p><?php echo excerpt($course['description'], 30); ?></p>
                  <a class="btn btn-info btn-sm d-md-none shadow-sm stretched-link" href="<?php echo site_url ('student/courses/view/'.$coaching_id.'/'.$member_id.'/'.$course['course_id']); ?>">View <i class="fa fa-eye"></i>
                  </a>
                </div>
                <div class="media-right my-auto d-none d-md-table-cell">
                  <a class="btn btn-outline-primary border-primary shadow-sm stretched-link" href="<?php echo site_url ('student/courses/view/'.$coaching_id.'/'.$member_id.'/'.$course['course_id']); ?>">View <i class="fa fa-eye"></i>
                  </a>
                </div>
              </div>
            </li>
            <?php endforeach;?>
        </ul>
      </div>
    <?php else: ?>
      <div class="alert alert-danger" role="alert">There are no courses for you. Click <a href="<?php echo site_url('coaching/courses/create/' . $coaching_id . '/' . $cat_id); ?>" class="alert-link">here</a> to get your first course.</div>
    <?php endif;?>
  </div>
</div>