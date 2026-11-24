<?php

add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup()
{
    load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
    global $content_width;
    if ( ! isset( $content_width ) ) $content_width = 640;
    register_nav_menus(
        array( 'main-menu' => __( 'Main Menu', 'blankslate' ) )
    );
}

add_action( 'wp_enqueue_scripts', 'blankslate_load_scripts' );
function blankslate_load_scripts()
{
    /*wp_enqueue_script( 'jquery' );*/
    wp_enqueue_style( 'style', get_template_directory_uri() . '/dist/main.css', array(), '0.0.44' );
}

add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script()
{
    if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}

add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
    if ( $title == '' ) {
        return '&rarr;';
    } else {
        return $title;
    }
}

add_filter( 'wp_title', 'blankslate_filter_wp_title' );
function blankslate_filter_wp_title( $title )
{
    return $title . esc_attr( get_bloginfo( 'name' ) );
}

add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init()
{
    register_sidebar( array (
        'name' => __( 'Sidebar Widget Area', 'blankslate' ),
        'id' => 'primary-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => "</li>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}

function blankslate_custom_pings( $comment )
{
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
    <?php
}

add_filter( 'get_comments_number', 'blankslate_comments_number' );
function blankslate_comments_number( $count )
{
    if ( !is_admin() ) {
        global $id;
        $comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
        return count( $comments_by_type['comment'] );
    } else {
        return $count;
    }
}



/*************/
add_action( 'init', 'disable_wp_register' );
function disable_wp_register() {

    // all actions related to emojis
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_head','wp_oembed_add_host_js' );

    // filter to remove TinyMCE emojis
    //add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}




/*************/
add_action('init', 'create_post_type');
function create_post_type()
{

    // members
    register_post_type(
        'members',
        array(
            'label' => 'members',
            'show_in_rest' => true,
            'show_in_graphql' => true, 
            'graphql_single_name' => 'Member', 
            'graphql_plural_name' => 'Members',
            'labels' => array(
                'name' => 'Members',
                'singular_name' => 'members',
                'all_items' => 'Afficher les members',
                'add_new_item' => 'Ajouter un member',
                'edit_item' => 'Éditer un member',
                'new_item' => 'Créer un nouvel member',
                'view_item' => 'Voir l\'member',
                'search_items' => 'Rechercher parmi les members',
                'not_found' => 'Aucun member n\'a été trouvée',
                'not_found_in_trash' => 'Il n\'y a pas d\'member dans la corbeille'
            ),
            'hierarchical' => false,
            'public' => true,
            'capability_type' => 'post',
            'supports'       => array( 'title','author', 'page-attributes' ),
            'has_archive' => false,
            'rewrite'=> array( 'slug' => 'members' )
        )
    );

    // creations
    register_post_type(
        'creations',
        array(
            'label' => 'creations',
            'show_in_rest' => true,
            'show_in_graphql' => true, 
            'graphql_single_name' => 'Creation', 
            'graphql_plural_name' => 'Creations',
            'labels' => array(
                'name' => 'Creations',
                'singular_name' => 'creations',
                'all_items' => 'Afficher les creations',
                'add_new_item' => 'Ajouter un creation',
                'edit_item' => 'Éditer un creation',
                'new_item' => 'Créer un nouvel creation',
                'view_item' => 'Voir l\'creation',
                'search_items' => 'Rechercher parmi les creations',
                'not_found' => 'Aucun creation n\'a été trouvée',
                'not_found_in_trash' => 'Il n\'y a pas de creation dans la corbeille'
            ),
            'hierarchical' => false,
            'public' => true,
            'capability_type' => 'post',
            'supports'       => array( 'title','author', 'page-attributes' ),
            'has_archive' => false,
            'rewrite'=> array( 'slug' => 'creations' )
        )
    );

    // Theatre
    register_post_type(
        'theatres',
        array(
            'label' => 'theatres',
            'show_in_rest' => true,
            'show_in_graphql' => true, 
            'graphql_single_name' => 'Theatre', 
            'graphql_plural_name' => 'Theatres',
            'labels' => array(
                'name' => 'Theatres',
                'singular_name' => 'theatres',
                'all_items' => 'Afficher les theatres',
                'add_new_item' => 'Ajouter un theatre',
                'edit_item' => 'Éditer un theatre',
                'new_item' => 'Créer un nouvel theatre',
                'view_item' => 'Voir l\'theatre',
                'search_items' => 'Rechercher parmi les theatres',
                'not_found' => 'Aucun theatre n\'a été trouvée',
                'not_found_in_trash' => 'Il n\'y a pas de theatre dans la corbeille'
            ),
            'hierarchical' => false,
            'public' => true,
            'capability_type' => 'post',
            'supports'       => array( 'title','author', 'page-attributes' ),
            'has_archive' => false,
            'rewrite'=> array( 'slug' => 'theatres' )
        )
    );

}




/***********/
class loadpage_nav_menu extends Walker_Nav_Menu {
    function start_el( &$output, $item, $depth, $args ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
        // depth dependent classes
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

        // passed classes
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        // build html
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

        // link attributes
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="'.$args->menu_class.' menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
        $attributes .= ! empty( $item->url )        ? ' data-load="'   . esc_attr( $item->url        ) .'"' : '';


        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );

        // build html
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
