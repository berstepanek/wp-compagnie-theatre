<?php if(get_field('creation_title_adaptation')){
        $title = get_field('creation_title_adaptation');
    }else if(get_field('creation_title')){
        $title = get_field('creation_title');
    }else{
        $title = get_the_title();
    }
?>   

<?php    
    function checkThePast($time) {
        $convertToUNIXtime = strtotime($time);
        if ($convertToUNIXtime <= time()) {
            return true;
        }
        return false;
    }
?>

<breadcrumb class="fixed w-full top-[80px] hidden md:block z-20" >
    <div class="container mx-auto">
        <a href="<?php echo get_page_link(21); ?>" title="Voir tous les membres">Créations</a> / <?php echo $title; ?>
    </div>
</breadcrumb>

<a class="back inline-block md:hidden" href="<?php echo get_page_link(21); ?>" title="Voir tous les créations"><svg  class="icon icon--arrow"><use xlink:href="#icon-arrow"></use></svg></a>

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

<?php $photo = get_field('creation_photo'); ?>
<section class="relative bg-black h-[50vh] sm:h-screen overflow-hidden">
    <?php if($photo) : ?>    
        <img class="absolute top-2/4 left-2/4 -translate-x-1/2 -translate-y-1/2 w-full h-auto object-cover" src="<?php echo $photo['sizes']['large']; ?>" alt="<?php echo the_title(); ?>">
    <?php endif; ?>
    <div class="gradient-linear-bottom"></div>
</section>

<section class="pb-24 relative z-10">
    <div class="container mx-auto">
        <div class="flex flex-col sm:flex-row">
            <div class="relative w-full md:w-4/12 mt-[-40vh] p-5 sm:p-0">
                <!--<?php if( have_rows('creation_dates') ): ?>
                    <span class="absolute top-[30px] left-0 block font-title text-white bg-yellow-500 p-3">
                        <?php echo $stack_date[0]; ?> - <?php echo $stack_date[sizeof($stack_date) - 1]; ?>
                    </span>
                <?php endif; ?>-->
                
                <?php $affiche = get_field('creation_affiche'); ?>
                <img class="w-full shadow-[0_0_100px_0_rgba(0,0,0,1)]" src="<?php echo $affiche['sizes']['large']; ?>" alt="<?php echo the_title(); ?>">
            </div>
            <div class="flex flex-col gap-y-4 w-full md:w-8/12 p-8 sm:mt-[-150px]">
                
                <h1 class="font-title text-6xl md:text-9xl">
                    <?php echo $title; ?>
                </h1>   
                
                <h4 class="font-title text-yellow-400">
                    <?php if( have_rows('creation_dates') ): ?>
                        <?php echo $stack_date[0]; ?> - <?php echo $stack_date[sizeof($stack_date) - 1]; ?>
                    <?php endif; ?>
                </h4>
                
                <?php if( get_field('creation_theatre') ): ?>
                    <div>
                        <?php foreach( get_field('creation_theatre') as $post): ?>
                            <?php setup_postdata($post); ?>

                            <address>
                                <?php echo get_field('theatre_name'); ?><br>
                                <?php echo get_field('theatre_address'); ?><br>
                                <?php echo get_field('theatre_postalcode'); ?> <?php echo get_field('theatre_city'); ?>
                            </address>

                            <?php wp_reset_postdata();?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                    
                <?php if( get_field('creation_shortdescription') ): ?>
                <div>
                    <p class="text-4xl">
                        <?php echo wp_kses_post ( get_field('creation_shortdescription') ); ?>
                    </p>
                    <?php if( get_field('creation_description') ): ?>
                        <a href="#CreationDescription" class="inline-block text-yellow-500">... en savoir plus</a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>



                <?php if( get_field('creation_booking_link') ): ?>
                <div>
                    <a href="<?php echo get_field('creation_booking_link'); ?>" class="inline-block font-title text-white bg-red-500 p-5">
                        <?php if(!checkThePast(str_replace("/", "-", $date_last))) : ?>    
                            Réserver vos places
                        <?php else : ?>        
                            Voir sur BilletReduc
                        <?php endif; ?>    
                    </a>
                </div>
                <?php endif; ?>

                <?php if( get_field('creation_displayauthor') and get_field('creation_author') ): ?>
                    <div><span class="font-title text-yellow-500">De : </span><?php echo get_field('creation_author'); ?></div>
                <?php endif; ?>

                <?php if( have_rows('creation_equipes') ): ?>
                    
                    
                    <?php while( have_rows('creation_equipes') ): the_row();
                        $equipe_function = get_sub_field('creation_equipes_function');
                        $equipe_name = get_sub_field('creation_equipes_name');
                    ?>
                        <div class="flex gap-x-4">        
                            <div class="">
                                <span class="font-title text-yellow-500"><?php echo $equipe_function; ?> : </span>
                            </div>
                            <div class="">
                                <?php echo $equipe_name; ?>
                            </div>
                        </div>    
                    <?php endwhile; ?>
                   
                <?php endif; ?>

                <?php if( have_rows('creation_roles') ): ?>
                   
                    <div class="font-title text-yellow-500 mt-4">La distribution : </div>

                    <?php while( have_rows('creation_roles') ): the_row();
                        $role_name = get_sub_field('creation_roles_name');
                        $role_member = get_sub_field('creation_roles_actor');
                    ?>
                        <?php if( $role_member ): ?>
                            <ul>
                            <?php foreach( $role_member as $post): ?>
                                <?php setup_postdata($post); ?>
                                <li class="flex gap-x-4 leading-none">
                                    <span class="font-title"><?php echo $role_name; ?></span>
                                    <span class="">
                                        <?php 
                                            if(get_field('member_name')){
                                                $member_name = get_field('member_name');
                                            }else{
                                                $member_name = get_the_title();
                                            }
                                        ?>    
                                        <?php  echo $member_name; ?>
                                    </span>
                                </li>
                                <?php wp_reset_postdata();?>
                            <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php endwhile; ?>
                            
                <?php endif; ?>

            </div>
        </div>
    </div>
    <!--<video class="html-video absolute top-0 left-0" kind="captions" preload="auto" playsinline="true" poster="" muted="" loop="" data-v-1f71d7dc="" autoplay="">
        <source src="<?php echo get_template_directory_uri(); ?>/dist/assets/video-pattern.mp4" type="video/mp4" data-v-1f71d7dc="">
    </video>
    <div class="gradient-bottom"></div>-->   

</section>


<?php if(get_field('creation_bandeannonce')) : ?>
    <section class="py-12 bg-black">
        <div class="flex justify-center">
            <div class="max-w-screen-xl px-4">
                <video class="" kind="captions" preload="auto" playsinline="true" poster="" muted="" loop="true" autoplay="true" controls>
                    <source src="<?php echo get_field('creation_bandeannonce')["url"]; ?>" type="video/mp4">
                </video>
            </div>
        </div>
    </section>
<?php endif; ?>


<?php if( have_rows('creation_dates') ): ?>
<section class="py-12">
    <h2 class="font-title text-center text-5xl md:text-6xl mb-12 text-red-500">Dates des représentations</h2>
    <div class="flex justify-center">
        <div class="w-full max-w-screen-md px-4">
            <table class="w-full border-collapse">
                <?php while( have_rows('creation_dates') ): the_row();
                    $date_day = get_sub_field('creation_dates_day');
                    $date_hour = get_sub_field('creation_dates_hour');
                    $date_lieu = get_sub_field('creation_dates_lieu');
                ?>
        
                <tr class="">
                    <td class="border-b border-yellow-500 border-solid py-2 ">
                        <span class="font-title"><?php echo $date_day; ?> à <?php echo $date_hour; ?></span>
                        <span class="block md:hidden"><?php echo $date_lieu; ?></span>
                    </td>
                    <td class="hidden md:table-cell border-b border-yellow-500 border-solid py-2">
                        <?php echo $date_lieu; ?>
                    </td>
                    <td class="border-b border-yellow-500 border-solid py-2">
                        <?php if( get_field('creation_booking_link') ): ?>
                            <div class="flex items-center gap-x-3 justify-end">
                                <a href="<?php echo get_field('creation_booking_link'); ?>" class="block font-title text-white bg-yellow-500 p-3">Réserver</a>
                            </div>  
                        <?php endif; ?>
                    </td>
                <tr>
                           
                <?php endwhile; ?>
            </table>
        </div>
     </div>
</section>
<?php endif; ?>

<?php if( get_field('creation_description') ): ?>
<section class="py-12" id="CreationDescription">

    <div class="flex justify-center">
        <div class="w-full max-w-screen-lg px-4">
            <div class="text-xl md:text-3xl">
                <?php echo wp_kses_post ( get_field('creation_description') ); ?>
            </div>    
        </div>
     </div>
       
</section>
<?php endif; ?>

<?php if( have_rows('creation_equipes') ): ?>
<section class="py-12">
    <h2 class="font-title text-center text-5xl md:text-6xl mb-12 text-red-500">ÉQUIPE ARTISTIQUE</h2>
    <div class="flex justify-center">
        <div class="w-full max-w-screen-md px-4">
            <table class="w-full border-collapse">
                <?php while( have_rows('creation_equipes') ): the_row();
                    $equipe_function = get_sub_field('creation_equipes_function');
                    $equipe_name = get_sub_field('creation_equipes_name');
                    $equipe_member = get_sub_field('creation_equipes_member');
                ?>
                            

                <tr class="">
                    <td class="border-b border-yellow-500 border-solid py-2 ">
                    <span class="font-title"><?php echo $equipe_name; ?></span>
                    <span class="block md:hidden"><?php echo $equipe_function; ?></span>
                    </td>
                    <td class="hidden md:table-cell border-b border-yellow-500 border-solid py-2">
                        <?php echo $equipe_function; ?>
                    </td>
                    <td class="border-b border-yellow-500 border-solid py-2">
                        <?php if( $equipe_member ): ?>
                            <?php foreach( $equipe_member as $post): ?>
                                <?php setup_postdata($post); ?>
                                <?php $permalink = get_the_permalink(); ?>
                                <div class="flex items-center gap-x-3 justify-end">
                                    <a href="<?php echo $permalink; ?>" class="block font-title text-yellow-500 border border-yellow-500 p-3">Découvrir</a>
                                </div>  
                                <?php wp_reset_postdata();?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </td>
                <tr>
                           
                <?php endwhile; ?>
            </table>
        </div>
     </div>
</section>
<?php endif; ?>

<?php if( have_rows('creation_roles') ): ?>
<section class="py-12">

    <h2 class="font-title text-center text-5xl md:text-8xl mb-12 text-red-500">La distribution</h2>
    <div class="flex justify-center">
        <div class="max-w-screen-xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-7">
                
                
                    <?php while( have_rows('creation_roles') ): the_row();
                        $role_name = get_sub_field('creation_roles_name');
                        $role_member = get_sub_field('creation_roles_actor');
                    ?>
                        <?php if( $role_member ): ?>
                            <?php foreach( $role_member as $post): ?>
                                <?php setup_postdata($post); ?>

                                <?php $permalink = get_the_permalink(); ?>


                                <div class="relative flex flex-col">
                                    <div class="w-full">
                                        <span class="absolute top-[-10px] left-0 block text-white bg-red-500 p-3">
                                            <span class="text-xs">Role :</span>
                                            <span class="block font-title"><?php echo $role_name; ?></span>
                                        </span>
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
                                        <a href="<?php echo $permalink; ?>" class="absolute bottom-[-10px] right-[10px] block font-title text-white bg-yellow-500 p-3">Plus de détails</a>
                
                                    </div>
                                </div>


                                <?php wp_reset_postdata();?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                

            </div>
        </div>
    </div>
</section>
<?php endif; ?>



<?php $images = get_field('creation_gallery');?>
<?php if( $images ): ?>
<section class="py-12 py-4">

    <h2 class="font-title text-center text-5xl md:text-5xl mb-12 text-red-500">Mise en image</h2>

    <div class="flex justify-center">
        <div class="w-full max-w-screen-md text-center">
            <div class="flex flex-col sm:flex-row gap-x-4">

                <?php $nb_images = count($images)/2; ?>
                <?php $indice_images = 1; ?>
                <?php $array_size = array("70","80","90","100"); ?>
                <div class="w-full sm:w-1/2 text-right ">

                    <?php foreach( $images as $image ): ?>
                        <?php $random_size = $array_size[array_rand($array_size, 1)]; ?>
                        <div class="mb-4">
                            <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" class="resp-h-100 m-b-10" />
                            <p>
                                <?php echo $image['description']; ?>
                            </p>
                        </div>
                        <?php if( count($images) != 1 && $indice_images >= $nb_images): ?>
                            </div><div class="w-full sm:w-1/2 mb-4 text-left">
                            <?php $indice_images = -100000; ?>
                        <?php endif; ?>
                        <?php $indice_images++ ?>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    
</section>


<?php endif; ?>