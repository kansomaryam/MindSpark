<?php
/**
 * Page template
 *
 * @package Aquila
 */

get_header();

?>

<div class="container">
    <div class="main-content">
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </div>
</div>

<?php
get_footer();
