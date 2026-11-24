<?php get_header(); ?>


<?php while ( have_posts() ) : the_post(); ?>

    <?php include(locate_template('template/page/creations/view.php')); ?>

<?php endwhile; ?>

<?php get_footer(); ?>