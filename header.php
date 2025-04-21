<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>TOAC - Tour Operators Association of Cox's Bazar</title>

        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assest/fa/css/all.min.css" rel="stylesheet"  />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assest/bt/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assest/custom_css/style.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assest/custom_css/responsive.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assest/custom_css/swiper-bundle.min.css">
        <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assest/img/TOAC.png" type="image/x-icon">
        <script src="<?php echo get_template_directory_uri(); ?>/assest/custom_js/jq3.js"></script>
        <?php wp_head(); ?>
    </head>
    <body>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="<?php echo get_template_directory_uri(); ?>/assest/custom_js/fb_sdk.js"></script>

        <header>
            <div class="topHeader w-100 d-flex flex-wrap">
                <div class="row container mx-auto">
                    <div class="col-12 col-md-4 topLetastNews text-center text-md-start d-none d-md-flex">
                        <div class="topLetastNewsLeft"><p>Latest News:</p></div>
                        <div class="topLetastNewsRight">
                            <div class="news-ticker">New blog post available!</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 topsocialLinks text-center">
                        <div class="topsocialLinksLeft">
                            <a href="#"><i class="fab fa-facebook-f" alt="Facebook"></i></a>
                            <a href="#"><i class="fab fa-twitter" alt="Twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in" alt="LinkedIn"></i></a>
                            <a href="#"><i class="fab fa-youtube" alt="YouTube"></i></a>
                        </div>
                    </div>


                    <div class="col-12 col-md-4 topRegestrationLinks text-center text-md-end">


                    

                        <?php
                            if ( is_user_logged_in() ) {
                                $current_user = wp_get_current_user();
                                $user_avatar = get_avatar_url( $current_user->ID ); // ইউজারের প্রোফাইল ছবি সংগ্রহ
                                        
                                // চেক করা হচ্ছে যদি ইউজার editor রোলের অধিকারী হয়
                                if ( current_user_can( 'editor' ) ) {
                                    $post_submit_page_link = home_url( '/editor-post-submit' ); // post-submit-page লিংক তৈরি করা
                                } else {
                                    $post_submit_page_link = ''; // অন্য রোলের জন্য কোন লিঙ্ক না
                                }
                            ?>
                                <!-- Dropdown Button with user info --> 
                                <div class="dropdown user-info d-flex a">
                                    <!-- ইউজারের প্রোফাইল ছবি -->
                                    <!-- ড্রপডাউন -->
                                    <div class="btn btn-link dropdown-toggle px-1" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration:none; " >
                                        <img src="<?php echo $user_avatar; ?>" alt="User Avatar" class="user-avatar rounded-circle me-2 shadow-sm" width="45" height="45" />
                                        <span class="text-dark fw-bold fs-5 text-white"><?php echo $current_user->display_name; ?></span>
                                    
                                        <i class="bi bi-chevron-down"></i>
                                    </div>

                                    <ul class="dropdown-menu dropdown-menu-end mt-2 shadow-lg" aria-labelledby="userDropdown">
                                        <?php if ( $post_submit_page_link ) : ?>
                                            <li><a class="dropdown-item" href="<?php echo esc_url( $post_submit_page_link ); ?>">Post Submit Page</a></li>
                                        <?php endif; ?>
                                        
                                        <li><a class="dropdown-item" href="<?php echo esc_url( home_url( '/profile' ) ); ?>">Profile</a></li>
                                        <li><a class="dropdown-item" href="<?php echo wp_logout_url(); ?>">Logout</a></li>
                                    </ul>
                                </div>
                                <?php
                            } else {
                                echo '<a href="log-in.php" class="btn btn-primary rounded-pill px-4 py-2">MEMBERS LOGIN</a>';
                            }
                        ?>





                        
                    </div>
                </div>
            </div>
            <div class="container mainHeader">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">
                        <?php
                            if ( function_exists( 'the_custom_logo' ) ) {
                                the_custom_logo();
                            }
                        ?> 

                            <!-- <img src="<?php echo get_template_directory_uri(); ?>/assest/img/TOAC.png" alt="logo" width="150"> -->
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav"> 
                            <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'menu_class'     => 'navbar-nav', // মূল ul এর ক্লাস 
                                    'container'      => false, // div wrapper বাদ দিতে চাইলে
                                    'walker'         => new Custom_Walker_Nav_Menu()
                                ));
                            ?> 
                        </div> 

                    </div>
                </nav>
            </div>
        </header>