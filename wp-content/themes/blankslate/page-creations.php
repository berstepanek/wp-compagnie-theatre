<?php
/*
Template Name: Creations
*/
?>

<?php get_header(); ?>

<!--
<breadcrumb class="hidden-sm-down">
    <?php echo the_title(); ?>
</breadcrumb>
-->




<section class="relative flex flex-col justify-center items-center h-screen">

    <h1 class="font-title text-center text-5xl md:text-9xl mb-12 text-red-500 -skew-y-12">
        - <?php echo the_title(); ?> -
        <span class="block text-4xl text-white">Théâtrales / cinématographiques</span>
    </h1>

    <video class="html-video absolute top-0 left-0" kind="captions" preload="auto" playsinline="true" poster="" muted="" loop="" data-v-1f71d7dc="" autoplay="">
        <source src="<?php echo get_template_directory_uri(); ?>/dist/assets/video-pattern.mp4" type="video/mp4" data-v-1f71d7dc="">
    </video>
    <div class="gradient-bottom"></div>    
</section>


<?php
$posts = get_posts(array(
    'post_type' => 'creations',
    'posts_per_page' => 100,
    'orderby'        => 'menu_order',
    'order' => 'DESC',
    'meta_query' => array(
        array(
            'key' => 'creation_isonline',
            'compare' => '=',
            'value' => '1'
        )
    )

));

?>

<?php if( $posts ): ?>
    <section class="py-24 relative -mt-44">

        <div class="flex justify-center">
            <div class="max-w-screen-xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-7">
                    <?php foreach( $posts as $post ):?>
                        <?php setup_postdata( $post )?>
                    
                        <div class="flex flex-col">
                            <div class="w-full">
                                <?php $image = get_field('creation_affiche'); ?>
                                <img class="w-full object-cover" src="<?php echo $image['sizes']['large']; ?>" alt="">
                            </div>
                            <div class="relative bg-white w-7/12 p-4 pb-10 text-slate-900 h-full">
                                <h2 class="font-title text-xl">
                                    <?php 
                                        if(get_field('creation_name')){
                                            $creation_name = get_field('creation_name');
                                        }else{
                                            $creation_name = get_the_title();
                                        }
                                    ?>
                                    <?php  echo $creation_name; ?>
                                </h2>   
                                <?php if( have_rows('creation_dates') ): ?>
                                    <?php  $stack_date = array(); ?>
                                    <?php while( have_rows('creation_dates') ): the_row();
                                        $date_day = get_sub_field('creation_dates_day');
                                        $date_hour = get_sub_field('creation_dates_hour');
                                        $date_lieu = get_sub_field('creation_dates_lieu');
                                        array_push($stack_date, $date_day);
                                    ?>    
                                    <?php endwhile; ?>
                                    <div class="font-title text-yellow-500 mb-2">
                                        <?php echo $stack_date[0]; ?> > <?php echo $stack_date[sizeof($stack_date) - 1]; ?>
                                    </div>
                                <?php endif; ?> 
                                <p>
                                    <?php  echo get_field('creation_shortdescription'); ?>
                                </p>    
                                <div class="absolute bottom-[-10px] right-[10px] flex items-center gap-x-3 justify-end ">
                                
                                    <a class=" block font-title text-white bg-yellow-500 p-3"
                                        href="<?php  echo get_the_permalink(); ?>"
                                        title="<?php  echo $creation_name; ?>"
                                    >Plus de détails</a>
                                    <?php if( get_field('creation_booking_link') ): ?>
                                        <a href="<?php echo get_field('creation_booking_link'); ?>" class="block font-title text-white bg-red-500 p-3">Réserver</a>
                                    <?php endif; ?>
                                </div>
                                
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>


<?php get_footer(); ?>
