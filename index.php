<?php
    get_header();
?>
        <main class="bg-light">
            <section class="banner container">
                <div class="title"><h3>Welcome</h3></div>
                <div class="banner">
                    <!-- <img src="<?php echo get_template_directory_uri(); ?>/assest/img/banner.png" alt="banner" width="100%"> -->

                    <?php
                        $args = array(
                            'post_type' => 'slider',
                            'posts_per_page' => 1, // Number of slides to show
                        );
                        $slider_query = new WP_Query($args);
                        if($slider_query->have_posts()) :
                            echo '<div class="custom-slider">';
                            while($slider_query->have_posts()) : $slider_query->the_post();
                                if(has_post_thumbnail()) :
                                    echo '<div class="slide">';
                                    the_post_thumbnail('full');
                                    echo '</div>';
                                endif;
                            endwhile;
                            echo '</div>';
                        else:
                            echo 'No slides found.';
                        endif;

                        wp_reset_postdata();
                    ?>

                </div>
            </section>  
            <section class="homeContent container row mx-auto my-5">
                <div class="col-6">
                    <div class="title"><h3>News</h3></div>
                    <ul class="nav nav-tabs blogTab" id="myTab" role="tablist">

                        <?php
                            $categories = get_categories([
                                'orderby' => 'name',
                                'order'   => 'ASC',
                                'hide_empty' => true // true রাখলে যেসব ক্যাটাগরিতে পোস্ট নেই সেগুলো দেখাবে না
                            ]);
                            
                            foreach ($categories as $category) {
                                echo '<li class="nav-item" role="presentation">
                                        <button class="nav-link " id="'.esc_html($category->name).'-tab" data-bs-toggle="tab" data-bs-target="#'.esc_html($category->name).'-tab-pane" type="button" role="tab" aria-controls="'.esc_html($category->name).'-tab-pane" aria-selected="true">'.esc_html($category->name).'</button>
                                    </li>';
                            }
                        ?>
                    </ul>

                    <div class="tab-content" id="myTabContent"> 

                        <?php
                            $args = [
                                'post_type'      => 'post',
                                'posts_per_page' => -1, // সব পোস্ট আনবে
                                'orderby'        => 'date',
                                'order'          => 'DESC',
                            ];

                            $query = new WP_Query($args);

                            if ($query->have_posts()) :

                                $previous_category = ''; // আগের পোস্টের ক্যাটাগরি স্টোর করার জন্য ভেরিয়েবল
                                $first_post = true; // প্রথম পোস্ট চিহ্নিত করার জন্য ভেরিয়েবল 

                                while ($query->have_posts()) : $query->the_post(); 

                                    $categories = get_the_category();
                                    $current_category = $categories[0]->name; 

                                    if ($current_category == $previous_category) {  
                                ?>
                                
                                    <div class="<?php echo $current_category; ?> clearfix text-justify">
                                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            <span class="meta-group mb-2">
                                                <div class="calendar">
                                                    <i class="fa fa-calendar" aria-hidden="true"></i><?php echo get_the_date(); ?>
                                                </div>
                                            </span>
                                        </h4>
                                        
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="post-thumb"><?php the_post_thumbnail('custom-size', ['width' => 120, 'height' => 175]); ?></div>
                                        <?php endif; ?>
                                        <p><?php echo wp_trim_words(get_the_excerpt(), 30); ?></p>
                                    </div>
                                <?php }else { 
                                    if ($first_post) { ?>
                                        <div class="<?php echo $current_category; ?>TabContent tab-pane fade show active" id="<?php echo $current_category; ?>-tab-pane" role="tabpanel" aria-labelledby="<?php echo $current_category; ?>-tab" tabindex="0">
                                            <div class="tabContent">
                                                <div class="<?php echo $current_category; ?> clearfix text-justify">
                                                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                        <span class="meta-group mb-2">
                                                            <div class="calendar">
                                                                <i class="fa fa-calendar" aria-hidden="true"></i><?php echo get_the_date(); ?>
                                                            </div>
                                                        </span>
                                                    </h4>
                                                            
                                                    <?php if (has_post_thumbnail()) : ?>
                                                        <div class="post-thumb"><?php the_post_thumbnail('custom-size', ['width' => 120, 'height' => 175]); ?></div>
                                                    <?php endif; ?>
                                                    <p><?php echo wp_trim_words(get_the_excerpt(), 30); ?></p>
                                                </div>
                                        
                                    <?php $first_post = false; } else { ?>

                                            </div>
                                        </div>
                                        <div class="<?php echo $current_category; ?>TabContent tab-pane fade show " id="<?php echo $current_category; ?>-tab-pane" role="tabpanel" aria-labelledby="<?php echo $current_category; ?>-tab" tabindex="0">
                                            <div class="tabContent">
                                                <div class="<?php echo $current_category; ?> clearfix text-justify">
                                                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                        <span class="meta-group mb-2">
                                                            <div class="calendar">
                                                                <i class="fa fa-calendar" aria-hidden="true"></i><?php echo get_the_date(); ?>
                                                            </div>
                                                        </span>
                                                    </h4>
                                                            
                                                    <?php if (has_post_thumbnail()) : ?>
                                                        <div class="post-thumb"><?php the_post_thumbnail('custom-size', ['width' => 120, 'height' => 175]); ?></div>
                                                    <?php endif; ?>
                                                    <p><?php echo wp_trim_words(get_the_excerpt(), 30); ?></p>
                                                </div>
                                <?php } } ?>

                                <?php 
                                    $previous_category = $current_category;
                                endwhile;
                                wp_reset_postdata();
                            else :
                                echo '<div class="text-center p-5 border rounded shadow">
                                        <h2>কোনো  পোস্ট পাওয়া যায়নি।</h2>
                                      </div>';
                            endif;
                        ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 pl-2">
                    <!-- <div class="updateHm bg-white">
                        <div class="fullTitle"><h3>Updates</h3></div>
                        <div class="updateBlogList">
                            <ul>
                                <li>Update Blog 1</li>
                                <li>Update Blog 2</li>
                                <li>Update Blog 3</li>
                                <li>Update Blog 4</li>
                                <li>Update Blog 5</li>
                                <li>Update Blog 6</li>
                                <li>Update Blog 7</li>
                                <li>Update Blog 8</li>
                                <li>Update Blog 9</li>
                                <li>Update Blog 10</li>
                                <li>Update Blog 11</li>
                                <li>Update Blog 12</li> 
                            </ul>
                        </div>
                    </div> -->
                    <div class="aboutSec mt-5">
                        <div class="aboutTitle">
                            <h3>About TOAC</h3>
                            <h6 class="aboutSubTitle">Tour Operators Association of Cox's Bazar  </h6>
                        </div>
                        <p class="text-justify aboutText mb-5 mt-2 " style="text-align: justify;">
                            The Tour Operators Association of Cox's Bazar (TOAC) is a non-profit organization that has been working tirelessly to promote and develop the tourism industry in Cox's Bazar, Bangladesh. With a mission to enhance the tourism experience for both local and international visitors, TOAC has become a key player in the region's tourism landscape. <br>

                            Founded in 2003, TOAC has grown to become the largest and most influential tourism association in Cox's Bazar, representing a diverse range of stakeholders, including tour operators, travel agencies, hotels, and other tourism-related businesses. The association is dedicated to fostering collaboration among its members and advocating for the interests of the tourism industry at both local and national levels. <br>

                            A group of visionary young individuals united under an idealistic and philosophical stance, planting the seed of a dream that later became known as TOAC, the Tour Operators Association of Cox's Bazar (TOAC), which is officially recognized. At that time, it was truly a tourism revolution that never went astray, thanks to the dedicated efforts of our predecessors. Through their progressive endeavors, TOAC today stands as the vanguard of the tourism industry with 112 members, and it is the only officially recognized tourism organization in Cox's Bazar. <br>

                            The philosophy and activities of TOAC  are, in reality, difficult to express in mere words. Its scope and impact have consistently expanded, moving from the local level to the national and international stages. Whenever any obstacles have arisen in Cox's Bazar tourism, TOAC  has always taken a leadership role in overcoming them. To cross the barriers for sustainable and contemporary tourism industry development, we have intellectual giants from both the grassroots level and the decision-making echelons of our founders and advisors. <br>

                            Providing safe services to tourists, the association has long been committed to offering safe food, comfortable travel, lodging, tourism spot visits, or any personal recreational activity. TOAC 's members continue to provide one-stop service with cost-effective transactions at every step. Every member of TOAC  is trained and acts as an ambassador of tourism with expertise. <br>

                            Like any developing nation, there are various challenges; however, the structural framework of tourism, from civil aviation and tourism ministries, the Bangladesh Tourism Corporation, the Bangladesh Tourism Board, the district administration of Cox's Bazar, and the various NGOs and stakeholders involved, is well-maintained. TOAC  organizes various programs, seminars, symposiums, and training sessions throughout the year. It also participates in promotional activities for the country's tourism, such as Beach Carnival, Tourism Fair, and Tourism Day. <br>

                            In addition to its tourism efforts, TOAC  plays an important role in social development, raising awareness about natural disasters, and distributing relief during events like COVID-19, floods, cyclones, and other critical situations in the country. TOAC  has earned accolades by working alongside the district administration during these times. <br>

                            The structural organization of TOAC  is exemplary and democratic, operating on a 70/20 model. Every two years, an executive committee is formed through a mandate from the general members. The elected committee forms an advisory board with the organization's experienced and respected members. Both committees work together to implement the planned activities of the organization. The heart and soul of this organization, built on the collective spirit of our founding members, has led to the success of TOAC . <br>

                            Our predecessors’ sense of taste, their vision, and their positive attitude towards tourism, alongside the promising capacity of the current generation, will, God willing, shape TOAC  into the most premium and glorified tourism organization in Bangladesh.
                        </p>
                    </div>
                </div>
            </section>
            <section class="perFooter bg-white pt-2">
                <div class="associates row container mx-auto my-5">
                    <div class="col-md-2 associatesTitle d-flex align-items-center justify-content-center">
                        <h3>ASSOCIATES</h3>
                    </div>
                    <div class="col-md-10 associatesImg d-flex flex-wrap justify-content-center">
                        <img src="https://natta.org.np/wp-content/themes/nata/assets/images/nepalgov.jpg" alt="AssociatesImg1" width="100" height="100">
                        <img src="https://natta.org.np/wp-content/themes/nata/assets/images/nepalgov.jpg" alt="AssociatesImg1" width="100" height="100">
                        <img src="https://natta.org.np/wp-content/themes/nata/assets/images/nepalgov.jpg" alt="AssociatesImg1" width="100" height="100">
                        <img src="https://natta.org.np/wp-content/themes/nata/assets/images/nepalgov.jpg" alt="AssociatesImg1" width="100" height="100">
                        <img src="https://natta.org.np/wp-content/themes/nata/assets/images/nepalgov.jpg" alt="AssociatesImg1" width="100" height="100">
                        <img src="https://natta.org.np/wp-content/themes/nata/assets/images/nepalgov.jpg" alt="AssociatesImg1" width="100" height="100">
                        <img src="https://natta.org.np/wp-content/themes/nata/assets/images/nepalgov.jpg" alt="AssociatesImg1" width="100" height="100">
                        <img src="https://natta.org.np/wp-content/themes/nata/assets/images/nepalgov.jpg" alt="AssociatesImg1" width="100" height="100">
                    </div>
                </div>
            </section>
        </main>

<?php
    get_footer(); 
?>



