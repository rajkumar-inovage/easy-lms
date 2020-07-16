<div class="sidebar sidebar-skin-white" id="sidebar-right">
  <?php
  $i = 1;
  if (! empty ($lessons)) {
    foreach ($lessons as $lesson) {
      ?>
        <div>Chapter <?php echo $i; ?></div>
        <a class="text-grey-900" href="<?php echo site_url ('coaching/courses/preview/'.$coaching_id.'/'.$course_id.'/'.$lesson['lesson_id']); ?>" >
          <h4><?php echo $lesson['title']; ?></h4>
        </a>
        <ul class="list-group list-group-menu list-group-minimal">
            <?php
            if ($lesson_id == $lesson['lesson_id'] && ! empty($pages)) {
              foreach ($pages as $page) {
                ?>
                <li class="list-group-item ml-4">
                  <a class="text-grey-900" href="<?php echo site_url ('coaching/courses/preview/'.$coaching_id.'/'.$course_id.'/'.$lesson_id.'/'.$page['page_id']); ?>" >
                      <?php echo $page['title']; ?>
                  </a>
                </li>
                <?php
              }
            }
            ?>
        </ul>
        <hr>
      <?php
      $i++;
    }
  }
  ?>
  <h4 class="category">Category</h4>
</div>