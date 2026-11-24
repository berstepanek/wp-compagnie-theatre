<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <?php $ID_Post =$post->ID; ?>

    <?php if($post->post_parent == 0) { ?>
        <?php include(locate_template('template/page/members/view.php')); ?>
    <?php }else{ ?>
        <?php include(locate_template('template/page/members/list.php')); ?>
    <?php } ?>

<?php endwhile; ?>

<?php get_footer(); ?>