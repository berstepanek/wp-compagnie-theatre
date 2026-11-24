<?php
/*
Template Name: Home Page
 *
 * @package Blankslate
 */

get_header(); ?>

<?php $home_highlighting_event = get_field('home_highlighting_event');?>
<?php if( $home_highlighting_event ): ?>
    <?php foreach( $home_highlighting_event as $post): ?>
    <?php setup_postdata($post); ?>
        <?php if( have_rows('creation_dates') ): ?>
            <?php  $stack_date = array(); ?>
            <?php while( have_rows('creation_dates') ): the_row();
                $date_day = get_sub_field('creation_dates_day');
                $date_hour = get_sub_field('creation_dates_hour');
                $date_lieu = get_sub_field('creation_dates_lieu');
                array_push($stack_date, $date_day);
            ?>    
            <?php endwhile; ?>
        <?php endif; ?>

        <?php 
            $date_first = $stack_date[0];
            $date_last = $stack_date[sizeof($stack_date) - 1];
            $date_current=date('d-m-Y');
            $date_soon = strtotime($date_last) < strtotime($date_current);
            function checkThePast($time) {
                $convertToUNIXtime = strtotime($time);
                if ($convertToUNIXtime <= time()) {
                    return true;
                }
                return false;
            }
        ?>

        <?php $bandeannonce  = get_field('creation_bandeannonce'); ?>
        <?php $photo = get_field('creation_photo'); ?>
	   
        <section class="relative bg-black hidden sm:block">
            <?php if($bandeannonce) : ?>
                <video class="ml-auto" kind="captions" preload="auto" playsinline="true" poster="" muted="" loop="true" autoplay="true" controls>
                    <source src="<?php echo $bandeannonce["url"]; ?>" type="video/mp4">
                </video>
            <?php elseif($photo) : ?>    
                <img class="h-full object-cover" src="<?php echo $photo['sizes']['large']; ?>" alt="<?php echo the_title(); ?>">
            <?php endif; ?>
            <div class="gradient-linear-bottom"></div>
        </section>

        <section class="relative bg-black h-[50vh] sm:h-screen overflow-hidden sm:hidden">
            <?php if($photo) : ?>    
                <img class="absolute top-2/4 left-2/4 -translate-x-1/2 -translate-y-1/2 w-full h-auto object-cover" src="<?php echo $photo['sizes']['large']; ?>" alt="<?php echo the_title(); ?>">
            <?php endif; ?>
            <div class="gradient-linear-bottom"></div>
        </section>

        <section class="pb-24 relative z-10">
            <div class="container mx-auto">
                <div class="flex flex-col sm:flex-row">
                    <div class="relative w-full md:w-4/12 mt-[-300px] sm:mt-[-300px] p-5 sm:p-0">
                        <?php if(!checkThePast(str_replace("/", "-", $date_last))) : ?>
                            <span class="absolute top-[10px] left-0 block font-title text-white bg-yellow-500 p-3"> 
                                Prochainement
                            </span>
                        <?php endif; ?>
                        
                        <?php if($date_soon):?><?php endif; ?>
                        <?php $affiche = get_field('creation_affiche'); ?>
                        <img class="w-full shadow-[0_0_100px_0_rgba(0,0,0,1)]" src="<?php echo $affiche['sizes']['large']; ?>" alt="<?php echo the_title(); ?>">
                    </div>
                    <div class="flex flex-col gap-y-4 w-full md:w-8/12 p-8 sm:mt-[-150px]">
                        <h1 class="font-title text-6xl md:text-9xl">
                            <?php echo the_title(); ?>
                        </h1>    

                        <h4 class="font-title text-yellow-400"> 
                            <?php echo $stack_date[0]; ?> - <?php echo $stack_date[sizeof($stack_date) - 1]; ?>
                        </h4>
                        <div>
                            <p class="text-4xl">
                                <?php echo get_field('creation_shortdescription'); ?> ...
                            </p>
                        </div>
                        <div class="flex gap-x-4">
                            <a href="<?php echo get_the_permalink(); ?>" class="inline-block font-title text-yellow-500 border border-yellow-500 border-solid p-5">Découvrir</a>
                            <?php if( get_field('creation_booking_link') ): ?>
                                <a href="<?php echo get_field('creation_booking_link'); ?>" class="inline-block font-title text-white bg-red-500 p-5">
                                    <?php if(!checkThePast(str_replace("/", "-", $date_last))) : ?>    
                                        Réserver vos places
                                    <?php else : ?>        
                                        Voir sur BilletReduc
                                    <?php endif; ?>    
                                </a>
                            <?php endif; ?>
                        </div>
                        
                        

                        <?php if( get_field('creation_displayauthor') and get_field('creation_author') ): ?>
                            <div><span class="font-title text-yellow-500">De : </span><?php echo get_field('creation_author'); ?></div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
            <!--<video class="html-video absolute top-0 left-0" kind="captions" preload="auto" playsinline="true" poster="" muted="" loop="" data-v-1f71d7dc="" autoplay="">
                <source src="<?php echo get_template_directory_uri(); ?>/dist/assets/video-pattern.mp4" type="video/mp4" data-v-1f71d7dc="">
            </video>
            <div class="gradient-bottom"></div>-->

        </section>
    <?php wp_reset_postdata();?>
    <?php endforeach; ?>
<?php endif; ?>


<?php $home_creations = get_field('home_creations');?>
<?php if( $home_creations ): ?>
<section class="py-12 px-4">

    <h2 class="font-title text-center text-5xl md:text-6xl mb-12 text-red-500">Date des prochains spectacles</h2>
   
    <div class="flex justify-center">
        <div class="w-full max-w-screen-lg">

            <div class="time-line">
                <?php foreach( $home_creations as $post): ?>
                    <?php setup_postdata($post); ?>

                    <?php  $stack_date = array(); ?>
                    <?php if( have_rows('creation_dates') ): ?>
                        
                        <?php while( have_rows('creation_dates') ): the_row();
                            $date_day = get_sub_field('creation_dates_day');
                            $date_hour = get_sub_field('creation_dates_hour');
                            $date_lieu = get_sub_field('creation_dates_lieu');
                            array_push($stack_date, $date_day);
                        ?>    
                        <?php endwhile; ?>
                    <?php endif; ?>

                    <div class="time-line-dot">
                        <div class="time-line-inner">
                            <a href="<?php echo get_the_permalink(); ?>">
                                <?php $affiche = get_field('creation_affiche'); ?>
                                <img class="w-full shadow-[0_0_100px_0_rgba(0,0,0,1)]" src="<?php echo $affiche['sizes']['large']; ?>" alt="<?php echo get_field('creation_title'); ?>">
                            </a>
                           
                            <div class="time-line-detail font-title">
                                <?php if( sizeof($stack_date) > 0 ): ?>
                                    <?php echo $stack_date[0]; ?> <?php if( sizeof($stack_date) - 1 > 0 ): ?> - <?php echo $stack_date[sizeof($stack_date) - 1]; ?><?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php wp_reset_postdata();?>
                <?php endforeach; ?>
               
            </div>
        </div>
     </div>
       
</section>
<?php endif; ?>


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
    <section class="relative overflow-hidden h-[70vh] flex items-center justify-center my-12">
        <a href="<?php echo get_page_link(21); ?>" class="font-title text-center text-5xl md:text-9xl mb-12 text-red-500 -skew-y-12 z-10">
            - Créations -
            <span class="block text-4xl text-white">Théâtrales / cinématographiques</span>
        </a>
        <div class="absolute top-[-50%] left-[-50%] width-[150vw]">
            <div class="grid grid-cols-3 md:grid-cols-5 gap-5 rotate-12 opacity-50">
                <?php foreach( $posts as $post ):?>
                    <?php setup_postdata( $post )?>
                
                        <div class="w-full">
                            <?php $image = get_field('creation_affiche'); ?>
                            <img class="w-full object-cover" src="<?php echo $image['sizes']['large']; ?>" alt="">
                        </div>
                        
            
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
                    <?php foreach( $posts as $post ):?>
                    <?php setup_postdata( $post )?>
                
                        <div class="w-full">
                            <?php $image = get_field('creation_affiche'); ?>
                            <img class="w-full object-cover" src="<?php echo $image['sizes']['large']; ?>" alt="">
                        </div>
                        
            
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
                <?php wp_reset_postdata(); ?>
                    <?php foreach( $posts as $post ):?>
                    <?php setup_postdata( $post )?>
                
                        <div class="w-full">
                            <?php $image = get_field('creation_affiche'); ?>
                            <img class="w-full object-cover" src="<?php echo $image['sizes']['large']; ?>" alt="">
                        </div>
                        
            
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </section>

<?php endif; ?>

                
<?php $home_members = get_field('home_members');?>
<?php if( $home_members ): ?>
<section class="py-12">

    <h2 class="font-title text-center text-5xl md:text-8xl mb-12 text-red-500">Les membres</h2>
    <div class="flex justify-center">
        <div class="max-w-screen-xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-7">
                
                
                <?php foreach( $home_members as $post): ?>
                    <?php setup_postdata($post); ?>


                    <?php if(get_field('member_isonline')): ?>
                        <?php $permalink = get_the_permalink(); ?>


                        <div class="relative flex flex-col">
                            <div class="w-full">
                                <?php $image = get_field('member_photo'); ?>
                                <img class="w-full object-cover" src="<?php echo $image['sizes']['large']; ?>" alt="">
                            </div>
                            <div class="relative bg-white w-7/12 -mt-8 p-4 pb-10 text-slate-900 h-full">
                                <h3 class="font-title">
                                    <?php 
                                        if(get_field('member_name')){
                                            $member_name = get_field('member_name');
                                        }else{
                                            $member_name = get_the_title();
                                        }
                                    ?>
                                    <?php  echo $member_name; ?>    
                                </h3>    
                                <div class="block">
                                    
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
                                </div>  
                                <a href="<?php echo $permalink; ?>" title=" <?php  echo $member_name; ?>" class="absolute bottom-[-10px] right-[10px] block font-title text-white bg-yellow-500 p-3">Plus de détails</a>
        
                            </div>
                        </div>

                    <?php endif; ?>

                    <?php wp_reset_postdata();?>
                <?php endforeach; ?>
                
                  
               
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
