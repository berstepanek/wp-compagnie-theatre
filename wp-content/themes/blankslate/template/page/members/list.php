<breadcrumb class="fixed w-full top-[80px] hidden md:block z-20" >
    <div class="container mx-auto">
        <a href="<?php echo get_page_link(51); ?>" title="Voir tous mes ouvrages">Mes ouvrages</a> / <?php echo the_title(); ?>
    </div>
</breadcrumb>

<section class="m-b-100 half-h p-15">

    <div class="bloc-fullsreen">
        <div class="intro">
            <div class="inner">
                <h1>
                    <?php echo the_title(); ?>
                </h1>
            </div>
        </div>

        <img src="<?php echo get_template_directory_uri(); ?>/dist/images/medias/Preservation_03.jpg" class="resp-h" alt="">

        <div class="shadow"></div>

    </div>

</section>

<section class="m-b-100">
    <div class="container-fluid container-1500">
        <div class="row">

            <?php $sub_ouvrages = new WP_Query( array(
                'post_type' => 'ouvrages',
                'post_parent' => $ID_Post,
                'posts_per_page' => 100,
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                        'key' => 'ouvrage_informations_actif',
                        'compare' => '=',
                        'value' => '1'
                    )
                )
            )); ?>

            <div class="col-12col-sm-7 col-md-7 col-lg-6 m-b-30">
                <div class="blc-title mgt-30">
                    <div class="inner">
                        <h2>
                            Toutes mes compétences dans le domaine de la<strong> <?php echo the_title(); ?></strong>
                        </h2>
                        <!--<p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut ullamco laboris nisi ut
                        </p>-->
                        <ul>
                            <?php foreach( $sub_ouvrages->get_posts() as $post ): ?>
                                <li><a href="<?php  echo get_the_permalink(); ?>" title="<?php  echo get_the_title(); ?>"><?php  echo get_the_title(); ?></a></li>
                            <?php endforeach; ?>
                            <?php wp_reset_postdata();?>
                        </ul>
                    </div>
                </div>
            </div>

            <?php $nbworks = 1; ?>
            <?php foreach( $sub_ouvrages->get_posts() as $post ): ?>
                <?php setup_postdata($post); ?>
                <div class="col-12 <?php if( $nbworks == 1 ): ?>col-sm-7 col-md-7 col-lg-6<?php else : ?>col-sm-6 col-md-6 col-lg-3<?php endif; ?> m-b-30">
                    <a href="<?php  echo get_the_permalink(); ?>" class="blc-v fheight" title="<?php  echo get_the_title(); ?>">
                        <div class="img">
                            <?php $image = get_field('ouvrage_medias_card'); ?>

                            <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>">
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