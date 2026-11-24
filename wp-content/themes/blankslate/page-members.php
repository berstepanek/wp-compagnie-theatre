<?php
/*
Template Name: Members
*/
?>

<?php get_header(); ?>
<!--
<breadcrumb class="hidden-sm-down">
    <?php echo the_title(); ?>
</breadcrumb>
-->

<section class="relative flex justify-center items-center h-screen">

    <h1 class="font-title text-center text-5xl md:text-9xl mb-12 text-red-500 -skew-y-12">
        <span>- <?php echo the_title(); ?> -</span>
        <span class="block text-4xl text-white">Acteurs / Metteurs en scene / Auteurs</span>
    </h1>

    <video class="html-video absolute top-0 left-0" kind="captions" preload="auto" playsinline="true" poster="" muted="" loop="" data-v-1f71d7dc="" autoplay="">
        <source src="<?php echo get_template_directory_uri(); ?>/dist/assets/video-pattern.mp4" type="video/mp4" data-v-1f71d7dc="">
    </video>
    <div class="gradient-bottom"></div>    
</section>

<?php
$args = array(
    'post_type' => 'members',
    'posts_per_page' => 100,
    'orderby'        => 'menu_order',
    'order' => 'DESC',
    'meta_query' => array(
        array(
            'key' => 'member_isonline',
            'compare' => '=',
            'value' => '1'
        )
    )

);
?>
<?php $posts = new WP_Query($args); ?>
<?php if( $posts->have_posts() ): ?>
    <section class="py-24 relative -mt-44">

        <div class="flex justify-center">
            <div class="max-w-screen-xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-7">
                    <?php while( $posts->have_posts() ) : $posts->the_post(); ?>
                        <?php if($post->post_parent == 0) { ?>
                            <div class="flex flex-col">
                                <div class="w-full">
                                    <?php $image = get_field('member_photo'); ?>
                                    <img class="w-full object-cover" src="<?php echo $image['sizes']['large']; ?>" alt="">
                                </div>
                                <div class="relative bg-white w-7/12 -mt-8 p-4 pb-10 text-slate-900 h-full">
                                    <h2 class="font-title">
                                        <?php 
                                            if(get_field('member_name')){
                                                $member_name = get_field('member_name');
                                            }else{
                                                $member_name = get_the_title();
                                            }
                                        ?>
                                        <?php  echo $member_name; ?>
                                    </h2>    
                                    <p>
                                        <?php


                                        $civility = get_field_object('member_civility');

                                        if($civility['value'] == "Monsieur"){
                                            $competences = get_field('member_competences_man');
                                        }else{
                                            $competences = get_field('member_competences_women');
                                        }
                                            
                                        ?>
                                        <?php if( $competences ): ?>
                                            
                                            <ul>
                                                <?php foreach( $competences as $competence ): ?>
                                                    <li><?php echo $competence; ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                        
                                    </p>   
                                    <a class="absolute bottom-[-10px] right-[10px] block font-title text-white bg-yellow-500 p-3"
                                        href="<?php  echo get_the_permalink(); ?>"
                                        title="<?php  echo $member_name; ?>"
                                    >Plus de détails</a>
                                </div>
                            </div>
                        <?php } ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>



<?php get_footer(); ?>




