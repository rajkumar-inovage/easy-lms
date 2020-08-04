<div class="row ">
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
