<?php
/*
Template Name: Maintenance
 *
 * @package Blankslate
 */

/*get_header();*/ ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="maintenance">
        <div class="inner">
            <?php the_content(); ?>
        </div>
    </div>
<?php endwhile; endif; ?>

<?php /*get_footer(); */?>