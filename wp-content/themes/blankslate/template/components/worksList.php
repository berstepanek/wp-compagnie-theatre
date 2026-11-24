<?php if( have_rows('components_workslist_repetear') ): ?>

    <?php while( have_rows('components_workslist_repetear') ): the_row();

        $title = get_sub_field('title');
        $works = get_sub_field('work');

    ?>
    <section class="m-b-100">
        <div class="container-fluid container-1500 ">
            <div class="row align-items-top row-col-marg">


            <?php if( $works ): ?>

                <?php foreach( $works as $post): ?>
                    <?php setup_postdata($post); ?>

                    <?php $permalink = get_the_permalink(); ?>

                    <?php $sub_works = new WP_Query( array(
                        'post_type' => 'ouvrages',
                        'post_parent' => $post->ID,
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

                    <div class="col-12 col-sm-5 col-md-5 col-lg-3 text-right">
                        <div class="blc-title mgt-30">
                            <div class="inner">
                                <h2>
                                    <?php echo $title; ?>
                                </h2>
                                <ul>
                                <?php foreach( $sub_works->get_posts() as $post ): ?>
                                    <li><a href="<?php  echo get_the_permalink(); ?>" title="<?php  echo get_the_title(); ?>"><?php  echo get_the_title(); ?></a></li>
                                <?php endforeach; ?>
                                <?php wp_reset_postdata();?>
                                </ul>
                                <a href="<?php echo $permalink; ?>" class="btn right" title="Voir tous les ouvrages <?php echo $title; ?>">Tout voir</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>

                <?php $nbworks = 1; ?>
                <?php foreach( $sub_works->get_posts() as $post ): ?>
                    <?php setup_postdata($post); ?>
                    <div class="col-12 <?php if( $nbworks == 1 ): ?>col-sm-7 col-md-7 col-lg-6<?php else : ?>col-sm-6 col-md-6 col-lg-3<?php endif; ?>">
                        <a href="<?php  echo get_the_permalink(); ?>" class="blc-v fheight" title="<?php  echo get_the_title(); ?>">
                            <div class="img">
                                <?php $image = get_field('ouvrage_medias_card'); ?>
                                <img src="<?php echo $image['sizes']['medium_large']; ?>" alt="<?php echo $image['alt']; ?>">
                            </div>
                            <div class="inner">
                                <h3><?php  echo get_the_title(); ?></h3>
                                <p><?php echo get_field('ouvrage_informations_shortdescription'); ?></p>
                            </div>
                        </a>
                    </div>
                    <?php $nbworks++; ?>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>

            <?php endif; ?>


            </div>
        </div>
    </section>


    <?php endwhile; ?>



<?php endif; ?>