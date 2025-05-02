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
    add_image_size('medium', 300, 300, true); // Medium size image, 300px by 300px


    









    function enqueue_bootstrap_for_dashboard() {
        // Add Bootstrap 5 CSS for Admin Dashboard
        wp_enqueue_style('bootstrap-5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css', false, '5.3.0-alpha1');
    
        // Add Bootstrap 5 JS for Admin Dashboard
        wp_enqueue_script('bootstrap-5-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js', array(), '5.3.0-alpha1', true);
    }
    
    add_action('admin_enqueue_scripts', 'enqueue_bootstrap_for_dashboard');

    

    

// Custom dashboard widgets
function custom_dashboard_widgets() {
    global $wp_meta_boxes;
    // Remove all default dashboard widgets
    $wp_meta_boxes['dashboard']['normal']['core'] = array();
    $wp_meta_boxes['dashboard']['side']['core'] = array();
    wp_add_dashboard_widget(
        'pending_posts_widget',   // Widget slug
        '🕒 Pending Posts',          // Widget title
        'pending_posts_widget_function' // Function to display the widget content
    );
}

// Display the Pending Posts widget
function pending_posts_widget_function() {
    // Query to get pending posts
    $args = array(
        'post_type' => 'post',
        'post_status' => 'pending',
        // 'posts_per_page' => 5
    );
    $pending_posts = new WP_Query($args);

    echo '<div class="container mt-3">';
    echo '<div class="" style="width: 100%; font-size: 1.2rem; height: auto; width: 100%; padding: 30px; background: #fff; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); margin-bottom: 30px;">'; // Make the widget card bigger
    echo '<div class="card-header bg-primary text-white p-3 rounded-2">';
    echo '<h5>Pending Posts</h5>';
    echo '</div>';
    echo '<div class="card-body">';
    if ($pending_posts->have_posts()) {
        echo '<table class="table table-striped">';
        echo '<thead><tr><th scope="col">#</th><th scope="col">Post Title</th><th scope="col">Author</th><th scope="col">Actions</th></tr></thead>';
        echo '<tbody>';
        $counter = 1;
        while ($pending_posts->have_posts()) {
            $pending_posts->the_post();
            
            $post_id = get_the_ID();
            // Get the post author's display name
            $author_name = get_the_author();
            // Get the post's featured image (thumbnail) 
            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium'); // Get the medium-sized thumbnail

            // If there's no thumbnail, set a default placeholder image
            if (empty($thumbnail_url)) {
                $thumbnail_url = home_url().'/wp-content/themes/toacbd/assest/img/no-image.jpg'; // Replace with your placeholder image path
            }

            echo '<tr>';
            echo '<th scope="row">' . $counter . '</th>';
            echo '<td>' . get_the_title() . '</td>';
            echo '<td>' . $author_name . '</td>';
            echo '<td>';
            echo '<a href="' . get_edit_post_link() . '" class="btn btn-sm btn-warning">Edit</a> ';
            echo '<button class="btn btn-sm btn-info view-post" data-bs-toggle="modal" data-bs-target="#viewPostModal" data-post-id="' . get_the_ID() . '" data-post-title="' . get_the_title() . '" data-post-content="' . esc_attr(get_the_content()) . '" data-post-author="' . esc_attr($author_name) . '" data-post-thumbnail="' . esc_attr($thumbnail_url) . '">View</button>'; 
            echo '<form method="post" style="display:inline;">
                    <input type="hidden" name="approve_post_id" value="' . esc_attr($post_id) . '">
                    <button type="submit" class="btn btn-sm btn-primary" style="margin-left:5px;">✅ Approve</button>
                </form>';
            echo '<button class="btn btn-sm btn-danger" style="margin-left:5px;" onclick="if(confirm(\'Are you sure you want to delete this post?\')){location.href=\'' . get_delete_post_link($post_id) . '\'}"><span style="color: white; font-weight: bold; ">⨉</span>  Delete</button>';
            echo '</td>';
            echo '</tr>';
            $counter++;
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<div class="text-center p-5 border rounded shadow">
                <h1>কোনো পেন্ডিং পোস্ট পাওয়া যায়নি।</h1>
                <p class="mt-3">দয়া করে পোস্ট করুন। </p>
              </div>';
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';

    // Modal Structure for viewing post content
    echo '<div class="modal fade" id="viewPostModal" tabindex="-1" aria-labelledby="viewPostModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                    
                    <!-- Modal Header -->
                    <div class="modal-header bg-gradient bg-primary text-white py-3">
                        <h5 class="modal-title fw-semibold" id="viewPostModalLabel">
                            <i class="bi bi-file-earmark-text-fill me-2"></i> <span id="postTitle" class="text-center text-dark fw-bold mb-3" > Post Details </span>
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body px-5 py-4">
                        <div class="text-center mb-4">
                            <img id="postThumbnail" src="" alt="Post Thumbnail" class="img-thumbnail shadow-sm" style="max-height: 300px; object-fit: cover;" />
                        </div>

                        <h3 id="postTitle" class="text-center text-dark fw-bold mb-3"></h3>
                        <p class="text-center text-muted mb-4">
                            <i class="bi bi-person-circle me-1"></i> <strong>Author:</strong> <span id="postAuthor"></span>
                        </p>

                        <div id="postContent" class="text-secondary fs-6 lh-lg border-top pt-3"></div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light py-3">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i> Close
                        </button>
                    </div>

                </div>
            </div>
        </div>';
}

add_action('wp_dashboard_setup', 'custom_dashboard_widgets', 999);

// Enqueue Bootstrap 5 CSS and JS
function custom_dashboard_enqueue_scripts() {
    // Bootstrap 5 CSS
    wp_enqueue_style('bootstrap-5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css', false, '5.3.0-alpha1');
    // Bootstrap 5 JS (for modal functionality)
    wp_enqueue_script('bootstrap-5-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js', array(), '5.3.0-alpha1', true);
}
add_action('admin_enqueue_scripts', 'custom_dashboard_enqueue_scripts');

// Hide other dashboard widgets and add custom styles
function custom_dashboard_styles() {
    remove_action( 'admin_notices', 'update_nag', 3 );
    ?>
    <style>
        /* Hide other dashboard widgets except Pending Posts */
        #dashboard_right_now,
        #dashboard_recent_comments,
        #dashboard_primary,
        #dashboard_secondary,
        #welcome-panel {
            display: none !important;
        }

        /* Make the custom dashboard widget bigger */
        #pending_posts_widget {
            width: 100% !important; /* Ensure it uses full width */
            font-size: 1.4rem !important; /* Increase font size */
        }

        /* Make the custom dashboard widget bigger */
        #postbox-container-1 {
            width: 100% !important; /* Ensure it uses full width */
            font-size: 1.4rem !important; /* Increase font size */
        }


        /* Custom card styling */
        .card {
            width: 100% !important; /* Full width for card */
            font-size: 1.2rem !important; /* Larger text */
            height: auto !important; /* Auto height to avoid clipping */
        }

        .table {
            font-size: 1rem;
        }
        .table th, .table td {
            vertical-align: middle; /* Center align text vertically */
        }
        .table th {
            background-color: #f8f9fa; /* Light background for header */
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2; /* Light gray for odd rows */
        }
        .table-striped tbody tr:nth-of-type(even) {
            background-color: #ffffff; /* White for even rows */
        }
        .table-striped tbody tr:hover {
            background-color: #e9ecef; /* Light gray on hover */
        }
        .table-striped th, .table-striped td {
            padding: 1rem; /* Padding for table cells */
        }
        #dashboard-widgets .meta-box-sortables {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
    </style>
    <script>
        // Ensure the widget takes full width and height for the admin dashboard
        jQuery(document).ready(function($) {
            $('#pending_posts_widget').closest('.postbox').css({
                'width': '100% !important',  // Force full width
                'height': 'auto !important'  // Ensure no clipping of content
            });

            // Populate modal with post content
            $('#viewPostModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var postTitle = button.data('post-title');
                var postContent = button.data('post-content');
                var postAuthor = button.data('post-author');
                var postThumbnail = button.data('post-thumbnail');
                var modal = $(this);

                modal.find('#postTitle').text(postTitle);
                modal.find('#postContent').html(postContent); // Injecting the content
                modal.find('#postAuthor').text(postAuthor); // Injecting the author
                modal.find('#postThumbnail').attr('src', postThumbnail); // Injecting the thumbnail
            });
        });
    </script>
    <?php
}

add_action('admin_head', 'custom_dashboard_styles');






add_action('admin_init', 'handle_approve_post_action');
function handle_approve_post_action() {
    if (isset($_POST['approve_post_id']) && current_user_can('edit_posts')) {
        $post_id = intval($_POST['approve_post_id']);

        if (get_post_status($post_id) === 'pending') {
            // Update status
            wp_update_post(array(
                'ID' => $post_id,
                'post_status' => 'publish'
            ));

            // Show success notice
            add_action('admin_notices', function() use ($post_id) {
                echo '<div class="notice notice-success is-dismissible">
                    <p>✅ Post <strong>' . esc_html(get_the_title($post_id)) . '</strong> has been approved!</p>
                </div>';
            });

            // Prevent form resubmission
            wp_redirect(admin_url());
            exit;
        }
    }
}

add_image_size('custom-size', 120, 175, true); // 120px x 175px এবং cropped (true) হবে


























 ?>