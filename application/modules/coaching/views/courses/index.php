<div class="row">
  <div class="col-lg-12">
    <?php if (!empty($courses)): ?>
    <div class="list disable-text-selection" data-check-all="checkAll">
      <?php foreach ($courses as $course): 
          $category_id = isset($course['cat_id']) ? $course['cat_id'] : $cat_id;
          $toggle_to = (intval($course['status']) === COURSE_STATUS_ACTIVE)?COURSE_STATUS_INACTIVE:COURSE_STATUS_ACTIVE;
        ?>
        <div class="card d-flex flex-row mb-3">
            <div class="d-flex flex-grow-1 min-width-zero">
                <div
                    class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                    <a class="list-item-heading mb-0 w-30 w-xs-100 mt-0 d-flex"
                        href="<?php echo site_url ('coaching/courses/edit/'.$coaching_id.'/'.$cat_id.'/'.$course['course_id']); ?>">
                        <i class="simple-icon-book-open heading-icon pr-2"></i>
                        <span class="align-middle d-inline-block pt-1"><?php echo $course['title']; ?></span>
                    </a>
                    <p class="mb-0 text-muted text-small w-20 w-xs-100">
                      <?php echo date('j<\s\up>S</\s\up> F, Y', $course['created_on']); ?>
                        
                    </p>
                    <p class="mb-0 text-muted text-small w-10 w-xs-100">
                      <?php echo $course['created_by']; ?>
                    </p>
                    <div class="w-10 w-xs-100 pt-2 pt-md-0">
                      <?php echo (intval($course['status']) === COURSE_STATUS_ACTIVE) ? '<span class="badge badge-pill badge-outline-success">Active</span>' : '<span class="badge badge-pill badge-outline-danger">Inactive</span>'; ?>
                    </div>
                    <div class="d-block w-md-30 w-lg-20">
                        <a href="<?php echo site_url ('coaching/courses/manage/'.$coaching_id.'/'.$course['course_id']); ?>" class="btn btn-primary btn-sm top-right-button mr-1 text-decoration-none mt-3 mt-md-0"><i class="fa fa-cog"></i>
                            MANAGE
                        </a>
                    </div>
                    
                </div>
                <label class="custom-control custom-checkbox mb-1 align-self-center mr-4">
                    <input type="checkbox" class="custom-control-input">
                    <span class="custom-control-label">&nbsp;</span>
                </label>
            </div>
        </div>
        <?php endforeach;?>
    </div>
    <?php else: ?>
      <?php if($is_admin): ?>
        <div class="alert alert-primary" role="alert">There are no Courses in this Category. Click <a href="<?php echo site_url('coaching/courses/create/' . $coaching_id . '/' . $cat_id); ?>" class="alert-link">here</a> to create your first course.</div>
      <?php else: ?>
        <div class="alert alert-primary" role="alert">There are no Courses in this Category.</div>
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