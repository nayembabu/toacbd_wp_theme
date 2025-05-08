<?php
    /**
     * Template Name: Toacbd Services 
     * Description: A custom page template for displaying services with a modern design. 
     */
    get_header(); 
?>

  <style>
    body {
      background: linear-gradient(120deg, #e6f0ff, #ffffff);
      font-family: 'Segoe UI', sans-serif;
      color: #333;
    }

    .thumbs_imagess { 
      max-width: 150px;
      height: auto;
    }

    .toacbd-hero {
      padding: 100px 20px 70px;
      background: linear-gradient(145deg, #0039a6, #007bff);
      color: #fff;
      text-align: center;
    }

    .toacbd-hero h1 {
      font-size: 3.5rem;
      font-weight: 700;
    }

    .toacbd-hero p {
      font-size: 1.1rem;
      opacity: 0.9;
    }

    .toacbd-section {
      padding: 80px 0;
    }

    .toacbd-title {
      text-align: center;
      margin-bottom: 60px;
    }

    .toacbd-title h2 {
      font-size: 2.8rem;
      font-weight: bold;
      position: relative;
    }

    .toacbd-service-card {
      background: rgba(255, 255, 255, 0.7);
      border-radius: 20px;
      backdrop-filter: blur(10px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
      padding: 40px 30px;
      transition: 0.4s ease;
      border: 2px solid transparent;
      height: 100%;
    }

    .toacbd-service-card:hover {
      transform: translateY(-10px);
      border-color: #007bff;
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.12);
    }

    .toacbd-icon {
      font-size: 3rem;
      color: #0056d2;
      margin-bottom: 20px;
    }

    .toacbd-service-title {
      font-size: 1.4rem;
      font-weight: 600;
      margin-bottom: 12px;
    }

    .toacbd-service-desc {
      font-size: 0.95rem;
      color: #444;
    }

    .toacbd-footer {
      background-color: #002b6f;
      color: #fff;
      padding: 30px 0;
      text-align: center;
      margin-top: 80px;
    }

    @media (max-width: 768px) {
      .toacbd-hero h1 {
        font-size: 2.5rem;
      }
      .toacbd-title h2 {
        font-size: 2.2rem;
      }
    }
  </style>

  <!-- Hero Section -->
  <section class="toacbd-hero">
    <div class="container">
      <h1>Crafting Digital Excellence</h1>
      <p>Explore our wide range of creative and technical services to elevate your brand.</p>
    </div>
  </section>

  <!-- Services Section -->
  <section class="toacbd-section">
    <div class="container">
      <div class="toacbd-title">
        <h2>Our Premium Services</h2>
      </div>
      <div class="row g-4">



    <?php
      // Custom query to fetch 'theme_service' posts
      $args = array(
          'post_type'      => 'theme_service',
          'posts_per_page' => -1, // সব সার্ভিস দেখাবে
      );
      $services = new WP_Query($args);
    ?>
    <?php
      if ($services->have_posts()) :
          $modal_id = 0; // Initialize modal ID
          while ($services->have_posts()) : $services->the_post(); 
    ?> 

          <div class="col-md-6 col-lg-4">
            <div class="toacbd-service-card text-center">
              <div class="toacbd-icon">
                  <?php if (has_post_thumbnail()) : ?>
                      <div class="thumb"><?php the_post_thumbnail('medium', ['class' => 'img-fluid rounded-circle shadow thumbs_imagess']); ?></div>
                  <?php endif; ?>
              </div>
              <div class="toacbd-service-title"><?php the_title(); ?></div>
              <div class="toacbd-service-desc">
                  <!-- 📝 Excerpt -->
                <?php echo wp_trim_words(get_the_excerpt(), 10, ' ............. '); ?>
              </div> 

              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary mt-3 " data-bs-toggle="modal" data-bs-target="#serviceModal<?php echo $modal_id; ?>">
                  Read More
              </button>

            </div>
          </div>

          
                <!-- Modal -->
                <div class="modal fade" id="serviceModal<?php echo $modal_id; ?>" tabindex="-1" aria-labelledby="serviceModalLabel<?php echo $modal_id; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="serviceModalLabel<?php echo $modal_id; ?>"><?php the_title(); ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                              <!-- 🖼️ Featured image -->
                              <?php if (has_post_thumbnail()) : ?>
                                  <div class="mb-3 text-center">
                                      <?php the_post_thumbnail('medium', ['class' => 'img-fluid rounded shadow']); ?>
                                  </div>
                              <?php endif; ?>

                              <!-- 📄 Full content -->
                              <?php the_content(); ?>

                            </div>
                        </div>
                    </div>
                </div>

          <?php $modal_id++; endwhile;
          wp_reset_postdata();
      else :
          echo '<p style="font-size: 22px; " class="alert alert-warning text-center">
                    <strong>No services found!</strong> Please check .
                </p>';
      endif;
    ?>
























        
      </div>
    </div>
  </section>

<?php get_footer(); ?>
