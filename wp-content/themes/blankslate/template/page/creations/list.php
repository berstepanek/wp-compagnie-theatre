<breadcrumb class="fixed w-full top-[80px] hidden md:block z-20" >
    <div class="container mx-auto">
        <a href="<?php echo get_page_link(51); ?>" title="Voir tous mes ouvrages">Ouvrages</a> / <?php echo the_title(); ?>
    </div>
</breadcrumb>


<section class="m-b-100 half-h p-15">

    <div class="bloc-fullsreen">
        <div class="intro">
            <div class="inner">
                <h1>
                    <?php echo the_title(); ?>
                </h1>
                <a href="" class="btn center white" data-opennav title="Contacter Sylvain Giardina">Me contacter</a>
            </div>
        </div>

        <img src="<?php echo get_template_directory_uri(); ?>/dist/images/medias/Preservation_03.jpg" class="resp-h" alt="">

        <div class="shadow"></div>

    </div>

</section>


<section class="m-b-100 m-t-n-200">
    <div class="container-fluid container-1500">
        <div class="row">

            <?php $SUB_Ouvrages = new WP_Query( array(
                'post_type' => 'ouvrages',
                'post_parent' => $ID_Post,
                'posts_per_page' => 100,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            )); ?>
            <?php $nbworks = 1; ?>
            <?php foreach( $SUB_Ouvrages->get_posts() as $post ): ?>
                <?php setup_postdata($post); ?>
                <div class="col-12 <?php if( $nbworks == 1 ): ?>col-sm-7 col-md-7 col-lg-6<?php else : ?>col-sm-6 col-md-6 col-lg-3<?php endif; ?> m-b-30">
                    <a href="<?php  echo get_the_permalink(); ?>" class="blc-v fheight" title="<?php  echo get_the_title(); ?>">
                        <div class="img">
                            <?php $image = get_field('ouvrage_medias_card'); ?>
                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                        </div>
                        <div class="inner">
                            <h3><?php  echo get_the_title(); ?></h3>
                            <p><?php echo $title; ?></p>
                        </div>
                    </a>
                </div>
                <?php $nbworks++; ?>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>

        </div>
    </div>
</section>