<!-- BEGIN : themes\blankslate\template\views\workView -->
<breadcrumb class="fixed w-full top-[80px] hidden md:block z-20" >
    <div class="container mx-auto">
        <a href="<?php echo get_page_link(37); ?>" title="Voir tous les membres">Membres</a> / <?php echo the_title(); ?>
    </div>
</breadcrumb>

<a class="back inline-block md:hidden" href="<?php echo get_page_link(37); ?>" title="Voir tous les membres"><svg  class="icon icon--arrow"><use xlink:href="#icon-arrow"></use></svg></a>

<section class="py-[150px] relative">
    <div class="container">
        <div class="flex flex-col sm:flex-row items-center">
            <div class="relative w-full md:w-5/12">
                <?php $image = get_field('member_photo'); ?>
                <img class="w-full" src="<?php echo $image['sizes']['large']; ?>" alt="">
            </div>
            <div class="w-full md:w-7/12 p-8">

                <?php 
                    if(get_field('member_name')){
                        $member_name = get_field('member_name');
                    }else{
                        $member_name = get_the_title();
                    }
                ?>
                <h1 class="relative font-title text-6xl md:text-9xl ml-0 md:-ml-44 z-10">
                    <?php  echo $member_name; ?>
                </h1>    
               
                <div class="block font-title mt-4">
                    
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
                <?php if( get_field('member_description') ): ?>
                <p class="text-2xl mb-8 w-full md:w-7/12 mt-12">
                    <?php  echo get_field('member_description'); ?>
                </p> 
                <?php endif; ?>
                <div>
                    <?php if( get_field('member_origine') ): ?>
                        <div><span class="font-title text-yellow-500">Origine : </span> <?php echo get_field('member_origine'); ?>
                    <?php endif; ?>
                    <?php if( get_field('member_age') ): ?>
                        <div><span class="font-title text-yellow-500">Age : </span> <?php echo get_field('member_age'); ?></div>
                    <?php endif; ?>
                    <?php if( get_field('member_size') ): ?>
                        <div><span class="font-title text-yellow-500">Taille : </span> <?php echo get_field('member_size'); ?></div>
                    <?php endif; ?>
                    <?php if( get_field('member_weight') ): ?>
                        <div><span class="font-title text-yellow-500">Poids : </span> <?php echo get_field('member_weight'); ?></div>
                    <?php endif; ?>
                    <?php if( get_field('member_hair') ): ?>
                        <div><span class="font-title text-yellow-500">Cheveux : </span> <?php echo get_field('member_hair'); ?></div>
                    <?php endif; ?>
                    <?php if( get_field('member_shoesize') ): ?>
                        <div><span class="font-title text-yellow-500">Pointure : </span> <?php echo get_field('member_shoesize'); ?></div>
                    <?php endif; ?>
                    <?php if( get_field('member_phone') ): ?>
                        <div><span class="font-title text-yellow-500">Téléphone : </span> <?php echo get_field('member_phone'); ?></div>
                    <?php endif; ?>
                    <?php if( get_field('member_email') ): ?>
                        <div><span class="font-title text-yellow-500">Email : </span> <?php echo get_field('member_email'); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <video class="html-video absolute top-0 left-0" kind="captions" preload="auto" playsinline="true" poster="" muted="" loop="" data-v-1f71d7dc="" autoplay="">
        <source src="<?php echo get_template_directory_uri(); ?>/dist/assets/video-pattern.mp4" type="video/mp4" data-v-1f71d7dc="">
    </video>
    <div class="gradient-bottom"></div>    

</section>

            
<?php $member_spectacles = get_field('member_spectacles');?>
<?php if( $member_spectacles ): ?>
<section class="py-12">

    <h2 class="font-title text-center text-5xl md:text-8xl mb-12 text-red-500">Actualités</h2>
    <div class="flex justify-center">
        <div class="max-w-screen-xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-7">
                
                
                <?php foreach( $member_spectacles as $post): ?>
                    <?php setup_postdata($post); ?>

                    <?php $permalink = get_the_permalink(); ?>


                    <div class="relative flex flex-col">
                        <div class="w-full">
                            <?php $image = get_field('creation_affiche'); ?>
                            <img class="w-full object-cover" src="<?php echo $image['sizes']['large']; ?>" alt="">
                        </div>
                        <div class="relative bg-white w-7/12 -mt-8 p-4 pb-10 text-slate-900 h-full">
                            <h2 class="font-title"><?php  echo get_the_title(); ?></h3>    
                            <div class="block">
                                <?php echo get_field('creation_shortdescription'); ?>
                            </div>  
                            <a href="<?php echo $permalink; ?>" class="absolute bottom-[-10px] right-[10px] block font-title text-white bg-yellow-500 p-3">Plus de détails</a>
    
                        </div>
                    </div>

                    <?php wp_reset_postdata();?>
                <?php endforeach; ?>
                
                  
               
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if( have_rows('member_formation') ): ?>
<section class="py-12 px-4">

    <h2 class="font-title text-center text-5xl md:text-5xl mb-12 text-red-500">Formations</h2>
   
    <div class="flex justify-center">
        <div class="w-full max-w-screen-md">
            <table class="w-full border-collapse">

                <?php while( have_rows('member_formation') ): the_row(); ?>
                    
                    <tr class="">
                        <td class="border-b border-yellow-500 border-solid py-2">
                            <span class=""><?php echo get_sub_field('member_formation_date'); ?></span>
                            <span class="block md:hidden font-title"><?php echo get_sub_field('member_formation_intitule'); ?></span>
                        </td>
                        <td class="hidden md:table-cell border-b border-yellow-500 border-solid py-2 font-title">
                            <?php echo get_sub_field('member_formation_intitule'); ?>
                        </td>
                        <td class="border-b border-yellow-500 border-solid py-2">
                            <?php echo get_sub_field('member_formation_infos'); ?> 
                        </td>
                    <tr>

                   
                <?php endwhile; ?>
               
            </table>
        </div>
     </div>
       
</section>
<?php endif; ?>


<?php if( have_rows('member_theatre') ): ?>
<section class="py-12 px-4">

    <h2 class="font-title text-center text-5xl md:text-5xl mb-12 text-red-500">Théâtre</h2>
   
    <div class="flex justify-center">
        <div class="w-full max-w-screen-md">
            <table class="w-full border-collapse">

                <?php while( have_rows('member_theatre') ): the_row(); ?>
                    
                    <tr class="">
                        <td class="align-top border-b border-yellow-500 border-solid py-2">
                            <span class=""><?php echo get_sub_field('member_theatre_date'); ?></span>
                            <span class="block md:hidden font-title"><?php echo get_sub_field('member_theatre_intitule'); ?></span>
                            <?php if( get_sub_field('member_theatre_role') ): ?>
                                <span class="block md:hidden">Rôle : <?php echo get_sub_field('member_theatre_role'); ?></span>
                            <?php endif; ?>
                            <?php if( get_sub_field('member_theatre_author') ): ?>
                                <span class="block md:hidden">Auteur : <?php echo get_sub_field('member_theatre_author'); ?></span>
                            <?php endif; ?>
                            <?php if( get_sub_field('member_theatre_metteurenscene') ): ?>
                                <span class="block md:hidden">Metteur en scène : <?php echo get_sub_field('member_theatre_metteurenscene'); ?></span>
                            <?php endif; ?>
                            <?php if( get_sub_field('member_theatre_infos') ): ?>
                                <span class="block md:hidden"><?php echo get_sub_field('member_theatre_infos'); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="align-top hidden md:table-cell border-b border-yellow-500 border-solid py-2 font-title">
                            <?php echo get_sub_field('member_theatre_intitule'); ?>
                        </td>
                        <td class="align-top hidden md:table-cell border-b border-yellow-500 border-solid py-2">
                            <?php if( get_sub_field('member_theatre_role') ): ?>
                                <span class="block">Rôle : <?php echo get_sub_field('member_theatre_role'); ?></span>
                            <?php endif; ?>
                            <?php if( get_sub_field('member_theatre_author') ): ?>
                                <span class="block">Auteur : <?php echo get_sub_field('member_theatre_author'); ?></span>
                            <?php endif; ?>
                            <?php if( get_sub_field('member_theatre_metteurenscene') ): ?>
                                <span class="block">Metteur en scène : <?php echo get_sub_field('member_theatre_metteurenscene'); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="align-top hidden md:table-cell border-b border-yellow-500 border-solid py-2">
                            <?php echo get_sub_field('member_theatre_infos'); ?> 
                        </td>
                    <tr>

                <?php endwhile; ?>
               
            </table>
        </div>
     </div>
       
</section>
<?php endif; ?>

<?php if( have_rows('member_cinema') ): ?>
<section class="py-12 px-4">

    <h2 class="font-title text-center text-5xl md:text-5xl mb-12 text-red-500">Cinema</h2>
   
    <div class="flex justify-center">
        <div class="w-full max-w-screen-md">
            <table class="w-full border-collapse">

                <?php while( have_rows('member_cinema') ): the_row(); ?>
                    
                    <tr class="">
                        <td class="border-b border-yellow-500 border-solid py-2">
                            <span class=""><?php echo get_sub_field('member_cinema_date'); ?></span>
                            <span class="block md:hidden font-title"><?php echo get_sub_field('member_cinema_intitule'); ?></span>
                        </td>
                        <td class="hidden md:table-cell border-b border-yellow-500 border-solid py-2 font-title">
                            <?php echo get_sub_field('member_cinema_intitule'); ?>
                        </td>
                        <td class="border-b border-yellow-500 border-solid py-2">
                            <?php echo get_sub_field('member_cinema_infos'); ?> 
                        </td>
                    <tr>

                <?php endwhile; ?>
               
            </table>
        </div>
     </div>
       
</section>
<?php endif; ?>

<?php if( have_rows('member_television') ): ?>
<section class="py-12 px-4">

    <h2 class="font-title text-center text-5xl md:text-5xl mb-12 text-red-500">Télévision</h2>
   
    <div class="flex justify-center">
        <div class="w-full max-w-screen-md">
            <table class="w-full border-collapse">

                <?php while( have_rows('member_television') ): the_row(); ?>
                    
                    <tr class="">
                        <td class="border-b border-yellow-500 border-solid py-2">
                            <span class=""><?php echo get_sub_field('member_television_date'); ?></span>
                            <span class="block md:hidden font-title"><?php echo get_sub_field('member_television_intitule'); ?></span>
                        </td>
                        <td class="hidden md:table-cell border-b border-yellow-500 border-solid py-2 font-title">
                            <?php echo get_sub_field('member_television_intitule'); ?>
                        </td>
                        <td class="border-b border-yellow-500 border-solid py-2">
                            <?php echo get_sub_field('member_television_infos'); ?> 
                        </td>
                    <tr>

                <?php endwhile; ?>
               
            </table>
        </div>
     </div>
       
</section>
<?php endif; ?>

<?php if( get_field('member_langues') ): ?>
<section class="py-12 px-4">

    <h2 class="font-title text-center text-5xl md:text-5xl mb-12 text-red-500">Langues</h2>
   
    <div class="flex justify-center">
        <div class="w-full max-w-screen-md text-center">
            <?php
            $languages = get_field('member_langues');
            ?>
            <?php if( $languages ): ?>
                <ul>
                    <?php foreach( $languages as $language ): ?>
                        <li><?php echo $language; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
     </div>
       
</section>
<?php endif; ?>

<?php if( get_field('member_sports') ): ?>
<section class="py-12 px-4">

    <h2 class="font-title text-center text-5xl md:text-5xl mb-12 text-red-500">Sports</h2>
   
    <div class="flex justify-center">
        <div class="w-full max-w-screen-md text-center">
            <?php echo get_field('member_sports'); ?>
        </div>
     </div>
       
</section>
<?php endif; ?>

<?php if( get_field('member_musiques') ): ?>
<section class="py-12 px-4">

    <h2 class="font-title text-center text-5xl md:text-5xl mb-12 text-red-500">Musiques</h2>
   
    <div class="flex justify-center">
        <div class="w-full max-w-screen-md text-center">
            <?php echo get_field('member_musiques'); ?>
        </div>
     </div>
       
</section>
<?php endif; ?>



<?php $images = get_field('member_gallery');?>
<?php if( $images ): ?>
<section class="py-12 py-4">

    <h2 class="font-title text-center text-5xl md:text-5xl mb-12 text-red-500">Mise en image</h2>

    <div class="flex justify-center">
        <div class="w-full max-w-screen-xl text-center">
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
