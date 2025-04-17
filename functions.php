<?php 

  

    // Disable WordPress login page and admin access
    // This function will block access to wp-login.php and wp-admin for all users except admins || strpos($_SERVER['REQUEST_URI'], 'wp-admin')
    function disable_wp_login() {
        if( strpos($_SERVER['REQUEST_URI'], 'wp-login.php')  ) {
            wp_redirect(home_url('/'));
        }
        // if( !current_user_can('administrator') ) {
        //     wp_redirect(home_url());
        //     exit;
        // }
        // if( strpos($_SERVER['REQUEST_URI'], 'wp-login.php') && !is_user_logged_in() ) {
        //     wp_redirect(home_url());
        //     exit;
        // }
        // if( strpos($_SERVER['REQUEST_URI'], 'wp-admin') && !is_user_logged_in() ) {
        //     wp_redirect(home_url());
        //     exit;
        // }
        // if( strpos($_SERVER['REQUEST_URI'], 'wp-login.php') && is_user_logged_in() ) {
        //     wp_redirect(home_url('/dashboard'));
        //     exit;
        // }
        // if( strpos($_SERVER['REQUEST_URI'], 'wp-admin') && is_user_logged_in() ) {
        //     wp_redirect(home_url('/dashboard'));
        //     exit;
        // }
        // if( strpos($_SERVER['REQUEST_URI'], 'wp-login.php') && current_user_can('administrator') ) {
        //     wp_redirect(home_url('/admin'));
        //     exit;
        // }
        // if( strpos($_SERVER['REQUEST_URI'], 'wp-admin') && current_user_can('administrator') ) {
        //     wp_redirect(home_url('/admin'));
        //     exit;
        // }
        // if( strpos($_SERVER['REQUEST_URI'], 'wp-login.php') && current_user_can('editor') ) {
        //     wp_redirect(home_url('/editor'));
        //     exit;
        // }
        // if( strpos($_SERVER['REQUEST_URI'], 'wp-admin') && current_user_can('editor') ) {
        //     wp_redirect(home_url('/editor'));
        //     exit;
        // }
    }
    add_action('init', 'disable_wp_login');

    add_action('init', 'block_direct_wp_admin_access');
    function block_direct_wp_admin_access() {
        // logged-in user বাদে wp-admin access বন্ধ
        if (strpos($_SERVER['REQUEST_URI'], 'wp-admin') !== false && 
        strpos($_SERVER['REQUEST_URI'], 'dashboard') === false && 
        !current_user_can('manage_options')) {
            wp_redirect(home_url('/'));
            exit;
        }
    }
    
    add_action('wp_logout', 'redirect_after_logout');
    function redirect_after_logout() {
        wp_redirect(site_url('/log-in.php'));
        exit; 
    }
    
    function remove_update_menu_admin() {
        remove_submenu_page('index.php', 'update-core.php');
    }
    add_action('admin_menu', 'remove_update_menu_admin');
    

    function custom_login_logo() {
        ?>
        <style type="text/css">
            body.login div#login h1 a {
                background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assest/img/short-logo.png');
                height: 80px;
                width: 320px;
                background-size: contain;
                background-repeat: no-repeat;
                padding-bottom: 30px;
            }
        </style>
        <?php
    }
    add_action('login_enqueue_scripts', 'custom_login_logo');

    function my_theme_setup() {
        add_theme_support( 'custom-logo' );

        register_nav_menus( 
            array(
                'primary' => __( 'Primary Menu', 'toacbd' ),  
                'footer'  => __( 'Footer Menu', 'toacbd' ),   
            )
        );  
    }
    add_action( 'after_setup_theme', 'my_theme_setup' ); 

    class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {

        // Submenu UL (dropdown) এর জন্য
        function start_lvl( &$output, $depth = 0, $args = null ) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class=\"my-custom-submenu\">\n";
        }
    
        // LI এবং A এর জন্য
        function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            // li class
            $li_classes = 'nav-item';
            $output .= $indent . '<li class="' . esc_attr($li_classes) . '">';

            // a tag
            $attributes  = !empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';
            $attributes .= ' class="nav-link"'; 

            $title = apply_filters( 'the_title', $item->title, $item->ID );

            $item_output  = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . $title . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        } 
    } 

    function create_slider_post_type() {
        register_post_type('slider', 
            array(
                'labels' => array(
                    'name' => __('Sliders'),
                    'singular_name' => __('Slider')
                ),
                'public' => true,
                'has_archive' => false,
                'supports' => array('title', 'thumbnail'),
                'menu_icon' => 'dashicons-images-alt2', // Slider icon for the admin menu
                'show_in_rest' => true, // Enable Gutenberg editor
                'rewrite' => array('slug' => 'sliders'),
            )
        );
    }
    add_action('init', 'create_slider_post_type');
    add_theme_support('post-thumbnails'); // Featured image support
    





 ?>