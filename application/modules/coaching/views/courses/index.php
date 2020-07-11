<div class="row">
  <div class="col-lg-3">
    <div class="card card-default mb-2">
      <div class="card-header d-flex justify-content-center">
        <h4 class="card-title">Categories
        </h4>
      </div>
      <div>
        <ul class="list-group list-group-menu">
          <li class="list-group-item <?php echo ($cat_id == 0) ? 'active' : ''; ?>">
            <a href="<?php echo site_url('coaching/courses/index/' . $coaching_id); ?>">
              <i class="fa fa-chevron-right fa-fw">
              </i> All Courses
            </a>
          </li>
          <?php if (!empty($categories)): ?>
          <?php foreach ($categories as $category): ?>
          <li class="list-group-item <?php echo ($cat_id == $category['cat_id']) ? 'active' : ''; ?>">
            <a href="<?php echo site_url('coaching/courses/index/' . $coaching_id . '/' . $category['cat_id']); ?>">
              <i class="fa fa-chevron-right fa-fw">
              </i>
              <?php echo $category['title']; ?>
            </a>
          </li>
          <?php endforeach;?>
          <?php endif;?>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-lg-9">
    <?php if (!empty($courses)): ?>
    <div class="card card-default border-bottom-0 mb-2">
      <div class="card-header d-flex justify-content-center">
        <h4 class="card-title">Courses
        </h4>
      </div>
      <div>
      <div class="card-body p-0">
        <table class="table mb-0 text-center">
          <thead>
            <tr>
              <th scope="col" class="text-left w-25">Course Name</th>
              <th scope="col" class="w-25">Created ON</th>
              <th scope="col" class="w-25">Created By</th>
              <th scope="col">Status</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($courses as $course): ?>
            <tr>
              <th scope="row" class="text-left"><?php echo $course['title']; ?></th>
              <td><span><?php echo date('j<\s\up>S</\s\up> F, Y', $course['created_on']); ?></span></td>
              <td><?php echo $course['created_by']; ?></td>
              <td><?php echo (intval($course['status']) === COURSE_STATUS_ACTIVE) ? '<span class="badge badge-pill badge-success">Active</span>' : '<span class="badge badge-pill badge-danger">Inactive</span>'; ?></td>
              <td>
                <a class="btn btn-info btn-sm" href="<?php echo site_url ('coaching/courses/manage/'.$coaching_id.'/'.$course['course_id']); ?>"><i class="fa fa-cog"></i> Manage
                </a>               
                <div class="d-flex justify-content-center d-none">
                  <a href="<?php echo site_url('coaching/courses/edit/' . $coaching_id . '/' . $course['cat_id'] . '/' . $course['course_id']); ?>" class="btn btn-primary p-0 height-30 width-30 rounded-circle d-flex align-items-center justify-content-center mr-1" title="Edit"><i class="fa fa-pencil-alt"></i></a>
                  <a href="#" class="btn btn-info p-0 height-30 width-30 rounded-circle d-flex align-items-center justify-content-center mr-1" title="Set Inactive"><i class="fa fa-exchange-alt"></i></a>
                  <a href="#" class="btn btn-danger p-0 height-30 width-30 rounded-circle d-flex align-items-center justify-content-center mr-1" title="Move to Trash"><i class="fa fa-trash"></i></a>
                  <div class="dropdown show h-100 d-flex align-items-center">
                    <a class="btn btn-success dropdown-toggler p-0 height-30 width-30 rounded-circle d-flex align-items-center justify-content-center" title="More Options" href="javascript:void(0);" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-ellipsis-v">
                      </i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                      <h6 class="dropdown-header">Manage Course</h6>
                      <a class="dropdown-item" href="<?php echo site_url('coaching/lessons/index/' . $coaching_id . '/' . $course['course_id']); ?>">
                        <i class="fa fa-swatchbook">
                        </i> Lessons
                      </a>
                      <a class="dropdown-item" href="#">
                        <i class="fas fa-chalkboard-teacher ">
                        </i> Classes
                      </a>
                      <a class="dropdown-item" href="<?php echo site_url('coaching/tests/index/' . $coaching_id . '/' . $course['course_id']); ?>">
                        <i class="fa fa-puzzle-piece">
                        </i> Tests
                      </a>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
    <?php endif;?>
  </div>
</div>