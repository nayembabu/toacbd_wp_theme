
<?php
    /* Template Name: About Us – TOACBD */
    get_header(); 
?>

<style>
    

    .hero {
      background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://source.unsplash.com/1600x600/?team,technology') center/cover no-repeat;
      color: white;
      padding: 120px 0;
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
    <div class="container">
      <h1 class="display-3 fw-bold">About Us</h1>
      <p class="lead">We are passionate about building digital solutions for the future.</p>
    </div>
  </div>

  <!-- About Section -->
  <section class="py-5">
    <div class="container">
      <h2 class="section-title text-center">Who We Are</h2>
      <div class="row justify-content-center">
        <div class="col-md-10 text-center">
          <p class="fs-5">Vireta is a cutting-edge software company delivering innovative web, mobile, and AI-driven solutions. Our team is a blend of visionaries and problem-solvers, constantly pushing boundaries to create digital excellence.</p>
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
            <p>To empower developers and businesses with scalable, innovative, and intuitive software that makes a difference.</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card-custom text-center">
            <div class="icon-box">
              <i class="bi bi-eye"></i>
            </div>
            <h4>Our Vision</h4>
            <p>To become a global leader in intelligent technology solutions that drive the future of digital transformation.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Team Slider -->
  <section class="py-5">
    <div class="container">
      <h2 class="section-title text-center">Meet Our Team</h2>
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <!-- Team Members -->
          <div class="swiper-slide team-member">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="img-fluid mb-3" width="120" alt="CEO">
            <h5 class="fw-semibold">নাতী</h5>
            <p class="text-muted">Founder & CEO</p>
          </div>
          <div class="swiper-slide team-member">
            <img src="https://randomuser.me/api/portraits/women/45.jpg" class="img-fluid mb-3" width="120" alt="CTO">
            <h5 class="fw-semibold">আয়েশা</h5>
            <p class="text-muted">CTO</p>
          </div>
          <div class="swiper-slide team-member">
            <img src="https://randomuser.me/api/portraits/men/55.jpg" class="img-fluid mb-3" width="120" alt="Dev Lead">
            <h5 class="fw-semibold">রাকিব</h5>
            <p class="text-muted">Lead Developer</p>
          </div>
          <div class="swiper-slide team-member">
            <img src="https://randomuser.me/api/portraits/women/68.jpg" class="img-fluid mb-3" width="120" alt="Designer">
            <h5 class="fw-semibold">সানজিদা</h5>
            <p class="text-muted">UI/UX Designer</p>
          </div>
          <div class="swiper-slide team-member">
            <img src="https://randomuser.me/api/portraits/men/61.jpg" class="img-fluid mb-3" width="120" alt="QA">
            <h5 class="fw-semibold">জাবেদ</h5>
            <p class="text-muted">Quality Analyst</p>
          </div>
          <div class="swiper-slide team-member">
            <img src="https://randomuser.me/api/portraits/women/53.jpg" class="img-fluid mb-3" width="120" alt="Marketing">
            <h5 class="fw-semibold">মুন</h5>
            <p class="text-muted">Marketing Lead</p>
          </div>
          <div class="swiper-slide team-member">
            <img src="https://randomuser.me/api/portraits/men/77.jpg" class="img-fluid mb-3" width="120" alt="Support">
            <h5 class="fw-semibold">নয়ন</h5>
            <p class="text-muted">Support Manager</p>
          </div>
          <div class="swiper-slide team-member">
            <img src="https://randomuser.me/api/portraits/women/40.jpg" class="img-fluid mb-3" width="120" alt="HR">
            <h5 class="fw-semibold">হৃদি</h5>
            <p class="text-muted">HR & Admin</p>
          </div>
        </div>
      </div>
    </div>
  </section>


  <?php get_footer(); ?>



