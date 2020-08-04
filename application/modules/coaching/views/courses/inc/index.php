<div class="app-menu">
            <div class="p-4 h-100">
                <div class="scroll">
                    <div class="border-0 card-default mb-2">
                      <div class="card-header px-0 pb-3 d-flex">
                        <div class="media w-100">
                          <div class="media-body my-auto">
                            <h4 class="card-title mb-0">Categories</h4>
                          </div>
                          <?php if($is_admin): ?>
                          <div class="media-right p-1 float-right">
                            <a href="javascript:void(0);" class="btn btn-sm text-primary p-0 d-flex align-items-center justify-content-center" data-toggle="tooltip" data-placement="top" title="Click to Edit Category" id="edit-categories" style="font-size:1rem;">
                              <i class="fa fa-pencil-alt"></i>
                            </a>
                          </div>
                          <?php endif; ?>
                        </div>
                      </div>
                      <div>
                      <ul class="list-unstyled mb-5">
                        <li class="<?php echo ($cat_id == 0) ? 'text-primary' : ''; ?>">
                            <a href="<?php echo site_url('coaching/courses/index/' . $coaching_id); ?>" class="d-block text-decoration-none <?php echo ($cat_id == 0) ? 'text-primary' : ''; ?>">
                            <i class="iconsminds-right <?php echo ($cat_id == 0) ? 'text-primary' : ''; ?>"></i> All Courses
                            </a>
                        </li>
                          <?php if (!empty($categories)): ?>
                          <?php foreach ($categories as $category): ?>
                            <li class="d-flex">
                              <div style="border-right:0 !important;" class="w-90 <?php echo ($cat_id == $category['cat_id']) ? 'text-primary' : ''; ?>">
                                <a href="<?php echo site_url('coaching/courses/index/' . $coaching_id . '/' . $category['cat_id']); ?>" class="d-block text-decoration-none <?php echo ($cat_id == $category['cat_id']) ? 'text-primary' : ''; ?>">
                                <i class="iconsminds-right <?php echo ($cat_id == $category['cat_id']) ? 'text-primary' : ''; ?>"></i>
                                  <?php echo $category['title']; ?>
                                </a>
                              </div>
                              <?php if($is_admin): ?>
                              <div class="h-100 w-10 my-auto edit-category float-right" style="display: none;">
                                <button type="button" class="edit-cat" style="background-color:transparent; border:none;" data-toggle="modal" data-target="#editCategories" data-id="<?php echo $category['cat_id']; ?>" data-value="<?php echo $category['title']; ?>">
                                  <i class="simple-icon-pencil text-primary"></i>
                                </button>
                                <a class="btn btn-sm border-primary text-primary p-0 height-30 width-30 rounded-circle d-none align-items-center justify-content-center" href="<?php echo site_url('coaching/courses/edit_category/' . $coaching_id . '/' . $category['cat_id']); ?>">
                                  <i class="simple-icon-pencil"></i>
                                </a>
                              </div>
                              <?php endif; ?>
                          </li>
                          <?php endforeach;?>
                          <?php endif;?>
                        </ul>
                      </div>
                    </div>

                </div>
            </div>
            <a class="app-menu-button d-inline-block d-xl-none" href="#">
                <i class="simple-icon-options"></i>
            </a>
        </div>