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
                        <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="news-tab" data-bs-toggle="tab" data-bs-target="#news-tab-pane" type="button" role="tab" aria-controls="news-tab-pane" aria-selected="true">News</button>
                        </li>
                        <li class="nav-item" role="presentation">
                        <button class="nav-link" id="events-tab" data-bs-toggle="tab" data-bs-target="#events-tab-pane" type="button" role="tab" aria-controls="events-tab-pane" aria-selected="false">Events</button>
                        </li>
                        <li class="nav-item" role="presentation">
                        <button class="nav-link" id="activities-tab" data-bs-toggle="tab" data-bs-target="#activities-tab-pane" type="button" role="tab" aria-controls="activities-tab-pane" aria-selected="false">Activities</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="blogTabContent tab-pane fade show active" id="news-tab-pane" role="tabpanel" aria-labelledby="news-tab" tabindex="0">
                            <div class="tabContent">
                                <div class="news clearfix text-justify">
                                    <h4><a href="https://natta.org.np/news_event/natta-celebrates-60th-anniversary/">NATTA Celebrates 60th Anniversary</a>
                                        <span class="meta-group mb-2">
                                            <div class="calendar">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>March 11, 2025
                                            </div>
                                        </span>
                                    </h4>
                                    <img src="https://natta.org.np//wp-content/uploads/2025/03/OPS_9363-120x75.jpg" alt="" width="120" height="175">
                                    <p>The Nepal Association of Tour and Travel Agents (NATTA) marked its Diamond Jubilee with a grand ceremony on 27th Falgun 2081 at Hotel Manaslu, Kathmandu. The event was inaugurated by...</p>
                                </div>
                                <div class="news clearfix text-justify">
                                    <h4><a href="https://natta.org.np/news_event/strengthening-cross-border-tourism-natta-hosts-meeting-with-ehttoa-and-ntb/">Strengthening Cross-Border Tourism: NATTA Hosts Meeting with EHTTOA and NTB</a>
                                        <span class="meta-group">
                                            <div class="calendar">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>March 2, 2025
                                            </div>
                                        </span>
                                    </h4>
                                    <img src="https://natta.org.np//wp-content/uploads/2025/03/IMG_9202-120x75.jpg" alt="" width="120" height="175">
                                    <p>Under the leadership of NATTA President Mr. Kumar Mani Thapaliya and other board members, NATTA hosted a meeting with the Eastern Himalayan Tours and Travels Operators Association (EHTTOA) delegation, accompanied...</p>
                                </div>
                                <div class="news clearfix text-justify">
                                    <h4><a href="https://natta.org.np/news_event/natta-past-president-council/">NATTA Past President Council</a>
                                        <span class="meta-group">
                                            <div class="calendar">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>February 10, 2025
                                            </div>
                                        </span>
                                    </h4>
                                    <img src="https://natta.org.np//wp-content/uploads/2025/02/WhatsApp-Image-2025-02-12-at-11.10.40-3-120x75.jpeg" alt="" width="120" height="175">
                                    <p>The NATTA Past President Council (PPC) meeting was held on Sunday afternoon at the NATTA Secretariat under the chairmanship of the existing NATTA PPC Convener, Mr. R. M. Singh Pradhan....</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="events-tab-pane" role="tabpanel" aria-labelledby="events-tab" tabindex="0">Event Tab</div>
                        <div class="tab-pane fade" id="activities-tab-pane" role="tabpanel" aria-labelledby="activities-tab" tabindex="0">Activities Tab</div>
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
                        <P class="aboutQuots">Fiftynine years have elapsed since NEPAL ASSOCIATION OF TOUR & TRAVEL AGENTS (NATTA) came into existence.</P>
                        <div class="aboutDescription">
                            <p>Established on March 10, 1966 (2022/11/27 B.S.), the Nepal Association of Tour and Travel Agents (NATTA) stands as a premier organization dedicated to advancing Nepal’s tour and travel industry. Founded by a group of visionary travel agents, NATTA has been a cornerstone in promoting robust business principles and regulating the travel sector in Nepal for over five decades.</p>
                            <p>NATTA’s mission is to serve as a volunteer advocate for tour and travel companies, playing a crucial role in policy formulation to enhance tourism in Nepal. The association’s core objectives include:</p>
                                <ul class="aboutList">
                                    <li>Facilitating the healthy evolution of the tourism industry and trade.
                                    <li>Fostering goodwill among travel agents on mutual interests and safeguarding professional interests.</li>
                                    <li>Collaborating with and advising the Nepalese Government on tourism promotion.</li>
                                    <li>Inspiring coordination and professional ethics among tourism entities.</li> 
                                    <li>Undertaking research initiatives to promote tourism.</li>
                                    <li>Securing national and international recognition for the association.</li>
                                    <li>Advocating for the interests of ancillary professionals and industries.</li>
                                </ul>
                                <p>As a key economic pillar, Nepal’s tourism industry offers a rich tapestry of cultural heritage sites and breathtaking natural landscapes. The sector’s expansive scope, particularly in adventure tourism, holds immense growth potential, attracting international visitors and fueling the nation’s economic prosperity.
                                    With a legacy spanning almost sixty years, NATTA takes pride in its extensive accomplishments and its network of approximately eleven hundred travel agents and tour operators nationwide. The association has grown like a coral reef, reinforcing its values, norms, and professionalism over half a century.</p>
                        </div>
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



