<div class="row">
  <div class="col-lg-3">
    <div class="card border-0 card-default mb-2">
      <div class="card-header border border-bottom-0 p-3 d-flex justify-content-center">
        <div class="media">
          <div class="media-body my-auto text-center">
            <h4 class="card-title mb-0">Categories</h4>
          </div>
          <?php if($is_admin): ?>
          <div class="media-right p-1">
            <a href="javascript:void(0);" class="btn btn-sm border-primary text-primary p-0 height-30 width-30 rounded-circle d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Click to Edit Category" id="edit-categories">
              <i class="fa fa-pencil-alt"></i>
            </a>
          </div>
          <?php endif; ?>
        </div>
      </div>
      <div>
        <ul class="list-group list-group-menu">
          <li class="list-group-item">
            <div class="media">
              <div class="media-body p-3 <?php echo ($cat_id == 0) ? 'bg-primary' : ''; ?>">
                <a href="<?php echo site_url('coaching/courses/index/' . $coaching_id); ?>" class="d-block text-decoration-none <?php echo ($cat_id == 0) ? 'text-white' : ''; ?>">
                  <i class="fa fa-chevron-right fa-fw">
                  </i> All Courses
                </a>
              </div>
            </div>
          </li>
          <?php if (!empty($categories)): ?>
          <?php foreach ($categories as $category): ?>
          <li class="list-group-item">
            <div class="media">
              <div class="media-body p-3 <?php echo ($cat_id == $category['cat_id']) ? 'bg-primary' : ''; ?>">
                <a href="<?php echo site_url('coaching/courses/index/' . $coaching_id . '/' . $category['cat_id']); ?>" class="d-block text-decoration-none <?php echo ($cat_id == $category['cat_id']) ? 'text-white' : ''; ?>">
                  <i class="fa fa-chevron-right fa-fw">
                  </i>
                  <?php echo $category['title']; ?>
                </a>
              </div>
              <?php if($is_admin): ?>
              <div class="media-right h-100 my-auto edit-category" style="display: none;">
                <button type="button" class="btn btn-sm border-primary text-primary p-0 height-30 width-30 rounded-circle d-flex align-items-center justify-content-center edit-cat" data-toggle="modal" data-target="#editCategories" data-id="<?php echo $category['cat_id']; ?>" data-value="<?php echo $category['title']; ?>">
                  <i class="fa fa-pencil-alt"></i>
                </button>
                <a class="btn btn-sm border-primary text-primary p-0 height-30 width-30 rounded-circle d-none align-items-center justify-content-center" href="<?php echo site_url('coaching/courses/edit_category/' . $coaching_id . '/' . $category['cat_id']); ?>">
                  <i class="fa fa-pencil-alt"></i>
                </a>
              </div>
              <?php endif; ?>
            </div>
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
      <div class="card-body p-0">
        <table class="table mb-0 text-center">
          <thead>
            <tr>
              <th scope="col" class="text-left">Course Name</th>
              <th class="d-none d-md-table-cell" scope="col"><?php echo ($is_admin)?'Created ON':'Assigned ON'; ?></th>
              <th class="d-none d-md-table-cell" scope="col"><?php echo ($is_admin)?'Created By':'Assigned By'; ?></th>
              <th scope="col">Status</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($courses as $course): 
              $category_id = isset($course['cat_id']) ? $course['cat_id'] : $cat_id;
              $toggle_to = (intval($course['status']) === COURSE_STATUS_ACTIVE)?COURSE_STATUS_INACTIVE:COURSE_STATUS_ACTIVE;
            ?>
            <tr>
              <th scope="row" class="text-left align-middle">
                <strong><?php echo $course['title']; ?></strong>
              </th>
              <td class="align-middle d-none d-md-table-cell"><span><?php echo ($is_admin)?date('j<\s\up>S</\s\up> F, Y', $course['created_on']):date('j<\s\up>S</\s\up> F, Y', $course['assigned_on']); ?></span></td>
              <td class="align-middle d-none d-md-table-cell"><?php echo ($is_admin)?$course['created_by']:$course['assigned_by']; ?></td>
              <td class="align-middle">
                <div class="custom-control custom-switch custom-control-inline overflow-hiden mr-0">
                  <input
                    type="checkbox"
                    class="custom-control-input toggle-status"
                    data-href="<?php echo site_url ('coaching/courses_actions/toggle_course_status/'.$coaching_id.'/'.$cat_id.'/'.$course['course_id'].'/'.$toggle_to); ?>"
                    id="course-<?php echo $course['course_id']; ?>"
                    <?php if($is_admin): ?>
                    <?php echo (intval($course['status']) === COURSE_STATUS_ACTIVE) ? 'checked="checked"' : ''; ?>
                    <?php else: ?>
                    <?php echo (intval($course['status']) === COURSE_STATUS_ACTIVE) ? 'checked="checked" disabled="disabled"' : 'disabled="disabled"'; ?>
                    <?php endif; ?>
                  />
                  <label class="custom-control-label h-100" for="course-<?php echo $course['course_id']; ?>"
                    data-toggle="tooltip"
                    data-placement="right"
                    <?php if($is_admin): ?>
                    title="<?php echo (intval($course['status']) === COURSE_STATUS_ACTIVE) ? 'Set Inactive' : 'Set Active'; ?>"
                    <?php else: ?>
                    title="<?php echo (intval($course['status']) === COURSE_STATUS_ACTIVE) ? 'Active' : 'Inactive'; ?>"
                    <?php endif; ?>
                    style="text-indent: -99999px;"
                  >&nbsp;</label>
                </div>
                <?php // echo (intval($course['status']) === COURSE_STATUS_ACTIVE) ? '<span class="badge badge-pill badge-success">Active</span>' : '<span class="badge badge-pill badge-danger">Inactive</span>'; ?>
              </td>
              <td>
                <div class="d-flex justify-content-center">
                  <?php if($is_admin): ?>
                  <a
                    href="javascript: void(0);"
                    onclick="show_confirm('This will <?php echo (intval($course['status']) === COURSE_STATUS_ACTIVE) ? 'Inactive' : 'Active'; ?> this course, Are you sure?', '<?php echo site_url ('coaching/courses_actions/toggle_course_status/'.$coaching_id.'/'.$cat_id.'/'.$course['course_id'].'/'.$toggle_to); ?>')"
                    data-toggle="tooltip"
                    data-placement="left"
                    class="btn p-0 height-30 width-30 rounded-circle d-none align-items-center justify-content-center mr-2 <?php echo (intval($course['status']) === COURSE_STATUS_ACTIVE) ? 'btn-danger' : 'btn-success'; ?>"
                    title="<?php echo (intval($course['status']) === COURSE_STATUS_ACTIVE) ? 'Set Inactive' : 'Set Active'; ?>"
                    style="font-size: 16px"
                  >
                    <?php echo (intval($course['status']) === COURSE_STATUS_ACTIVE) ? '<i class="fa fa-ban"></i>' : '<i class="fa fa-check"></i>'; ?>
                  </a>
                  <?php endif; ?>
                  <a class="btn btn-info btn-sm" href="<?php echo site_url ('coaching/courses/manage/'.$coaching_id.'/'.$course['course_id']); ?>"><i class="fa fa-cog"></i> Manage
                  </a>
                </div>
              </td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <?php if($is_admin): ?>
        <div class="alert alert-danger" role="alert">There are no Courses in this Category. Click <a href="<?php echo site_url('coaching/courses/create/' . $coaching_id . '/' . $cat_id); ?>" class="alert-link">here</a> to create your first course.</div>
      <?php else: ?>
        <div class="alert alert-danger" role="alert">There are no Courses in this Category.</div>
      <?php endif;?>
    <?php endif;?>
  </div>
</div>
<?php if($is_admin): ?>
<div class="modal fade" id="editCategories" data-backdrop="static" data-keyboard="true" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <?php echo form_open('', array('class' => 'modal-content', 'id' => 'validate-1')); ?>
      <div class="modal-header relative">
        <h5 class="modal-title mx-auto">Edit Course Cetegory</h5>
        <button type="button" class="close m-0 absolute top right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
          <div class="col-12 form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Title of the Course Category" />
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary text-white" data-dismiss="modal" data-toggle="tooltip" data-placement="top" data-html="true" title="Click to Cancel"><i class="fa fa-times"></i> Cancel</button>        
        <button type="submit" name="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" data-html="true" title="Click to Update"><i class="fa fa-database"></i> Update</button>
        <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" data-html="true" title="Click to Delete" id="delete-cat" data-id=""><i class="fa fa-trash-alt"></i> Delete</button>
      </div>
    <?php echo form_close(); ?>
  </div>
</div>
<?php endif; ?>