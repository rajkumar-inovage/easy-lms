<div class="app-menu">
    <div class="p-4 h-100">
        <div class="scroll ps">
            <p class="text-muted text-small">Course Title</p>
            <p><?php echo $course['title']; ?></p>
            <p class="text-muted text-small">Enrolment Type</p>
            <p>
                <?php 
                    if ($course['enrolment_type'] == COURSE_ENROLMENT_DIRECT) echo 'Direct Enrolment';
                    else echo 'Batch Enrolment';
                ?>                
            </p>

            <hr>

            <p class="text-muted text-small">Quick Links</p>
            <ul class="list-unstyled mb-5">
                <li>
                    <?php echo anchor ('coaching/courses/manage/'.$coaching_id.'/'.$course_id, '<i class="fa fa-cog"></i> Manage'); ?>
                </li>
                <li>
                    <?php echo anchor ('coaching/lessons/index/'.$coaching_id.'/'.$course_id, '<i class="simple-icon-book-open heading-icon"></i> Chapters'); ?>
                </li>
                <li>
                    <?php echo anchor ('coaching/tests/index/'.$coaching_id.'/'.$course_id, '<i class="simple-icon-note heading-icon"></i> Tests'); ?>
                </li>
                <li>
                    <?php echo anchor ('coaching/courses/teachers/'.$coaching_id.'/'.$course_id, '<i class="simple-icon-people heading-icon"></i> Teachers'); ?>
                </li>
                <li>
                    <?php echo anchor ('coaching/courses/organize/'.$coaching_id.'/'.$course_id, '<i class="simple-icon-calendar heading-icon"></i> Organize'); ?>
                </li>
                <li>
                    <?php echo anchor ('coaching/courses/preview/'.$coaching_id.'/'.$course_id, '<i class="simple-icon-eye heading-icon"></i> Preview'); ?>
                </li>
            </ul>


        </div>
    </div>
    <a class="app-menu-button d-inline-block d-xl-none" href="#">
        <i class="simple-icon-options"></i>
    </a>
</div>