
<?php
    /* Template Name: About Us – TOACBD */
    get_header(); 
?>

<style>
    

    .hero {
      background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://source.unsplash.com/1600x600/?team,technology') center/cover no-repeat;
      color: white;
      padding: 60px 0;
      text-align: center;
    }
    .section-title {
      margin-bottom: 40px;
      font-weight: bold;
      font-size: 2rem;
    }
    .team-member img {
      border-radius: 50%;
      transition: transform 0.3s ease;
    }
    .team-member:hover img {
      transform: scale(1.05);
    }
    .icon-box {
      font-size: 2.5rem;
      color: #0d6efd;
      margin-bottom: 15px;
    }
    .card-custom {
      border: none;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      border-radius: 1rem;
      padding: 30px;
    }
    .swiper {
      padding-top: 30px;
      padding-bottom: 30px;
    }
    .swiper-slide {
      text-align: center;
      width: auto;
    }
    .swiper-slide img {
      border-radius: 50%;
      margin-bottom: 10px;
    }
    .swiper-slide h5 {
      font-size: 1.25rem;
      margin-bottom: 5px;
    }
</style>

  <!-- Hero Section -->
  <div class="hero">
    <div class="container" >
      <h1 class="display-3 fw-bold">About Us</h1>
      <p class="lead">We are passionate about building digital solutions for the future.</p>
    </div>
  </div>

  <!-- About Section -->
  <section class="py-5">
    <div class="container">
      <h2 class="section-title text-center">Who We Are</h2>
      <div class="row justify-content-center">
        <div class="col-md-10 ">
          <p class="fs-5">The Tour Operators Association of Cox’s Bazar (TOAC) is a united platform of licensed and active tour operators dedicated to promoting responsible, sustainable, and inclusive tourism in Cox’s Bazar and its surrounding regions. Formed with a shared vision of uplifting the tourism industry, TOAC serves as the collective voice of tour operators—working collaboratively to raise service standards, ensure visitor satisfaction, and uphold professional integrity.<br>
          We bring together passionate tourism professionals who are committed to delivering authentic experiences, enhancing community engagement, and protecting the natural and cultural heritage of the region. With a strong emphasis on training, innovation, and cooperation, TOAC works closely with government bodies, local communities, and national and international partners to make Cox’s Bazar a leading global destination. <br>
          As a non-profit and democratic organization, we operate with transparency, unity, and a firm commitment to the welfare of our members, visitors, and the wider community.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Mission & Vision Section -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-6">
          <div class="card-custom text-center">
            <div class="icon-box">
              <i class="bi bi-bullseye"></i>
            </div>
            <h4>Our Mission</h4>
            <p>To unite, empower, and represent all licensed tour operators of Cox’s Bazar in building a responsible, professional, and sustainable tourism industry through collaboration, training, advocacy, and ethical practices; while promoting Cox’s Bazar as a premier destination and ensuring inclusive benefits for members, visitors, and the local community.</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card-custom text-center">
            <div class="icon-box">
              <i class="bi bi-eye"></i>
            </div>
            <h4>Our Vision</h4>
            <p>To establish Cox’s Bazar as a globally recognized, eco-friendly, and inclusive tourism destination by fostering a united community of professional tour operators committed to sustainable growth, service excellence, and social responsibility.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- Our Team Slider -->
<section class="py-5">
  <div class="container">

  </div>
</section>

  <?php get_footer(); ?>



