<?php
    /**
     * Template Name: Toacbd Gallery
     */
    get_header(); 
?>

<!-- Gallery Section -->
<div class="container py-5">

  <h2 class="section-title">📷 Vireta Gallery</h2>

    <div class="filter-btns mb-4">
        <button class="btn btn-outline-primary active" onclick="filterItems('all')">All</button>
        <!-- <button class="btn btn-outline-success" onclick="filterItems('photo')">Photos</button> -->
        <!-- <button class="btn btn-outline-danger" onclick="filterItems('video')">Videos</button> -->
    </div>





<div class="row g-4" id="galleryGrid">
    <?php
    $args = array(
        'post_type' => 'gallery_item',
        'posts_per_page' => -1,
    );
    $query = new WP_Query($args);
    // echo '<pre>';
    // var_dump($query); // ডিবাগিংয়ের জন্য ক্যাটাগরি ক্লাস দেখানো
    // echo '</pre>';
    // die();
    if ($query->have_posts()) :

        while ($query->have_posts()) : $query->the_post();

            $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            $video_url = get_post_meta(get_the_ID(), 'video_url', true); // ভিডিও URL মেটা ফিল্ড থেকে নিয়ে আসা
            $type = $video_url ? 'video' : 'photo'; // যদি ভিডিও URL থাকে তবে ভিডিও, নাহলে ছবি

            echo '<div class="col-md-4 gallery-item video-2 ' . $type . '" data-bs-toggle="modal" data-bs-target="#photoModal" data-image="' . esc_url($image_url) . '">';
            
                echo '<img src="' . esc_url($image_url) . '" alt="' . get_the_title() . '"  class="img-fluid rounded  photo-2 ">';
            echo '</div>';

        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</div>
















<!-- 
    <div class="row g-4" id="galleryGrid">
        
        <div class="col-md-4 gallery-item photo photo-2" data-bs-toggle="modal" data-bs-target="#photoModal" data-image="https://via.placeholder.com/600x400?text=Photo+1">
            <img src="https://via.placeholder.com/600x400?text=Photo+1" alt="Photo 1">
        </div>
        <div class="col-md-4 gallery-item photo photo-2" data-bs-toggle="modal" data-bs-target="#photoModal" data-image="https://via.placeholder.com/600x400?text=Photo+2">
            <img src="https://via.placeholder.com/600x400?text=Photo+2" alt="Photo 2">
        </div>
        <div class="col-md-4 gallery-item photo photo-3" data-bs-toggle="modal" data-bs-target="#photoModal" data-image="https://via.placeholder.com/600x400?text=Photo+3">
            <img src="https://via.placeholder.com/600x400?text=Photo+3" alt="Photo 3">
        </div>

        <div class="col-md-6 gallery-item video video-2">
            <div class="ratio ratio-16x9">
                <iframe src="https://www.youtube.com/embed/tgbNymZ7vqY" title="Video 1" allowfullscreen></iframe>
            </div>
        </div>
        <div class="col-md-6 gallery-item video video-2">
            <div class="ratio ratio-16x9">
                <iframe src="https://www.youtube.com/embed/kJQP7kiw5Fk" title="Video 2" allowfullscreen></iframe>
            </div>
        </div>
    </div>
 -->
    
    


















</div>

<!-- Photo Modal -->
<div class="modal fade" id="photoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content bg-transparent border-0">
      <img id="modalImage" class="modal-img mx-auto d-block">
    </div>
  </div>
</div>


<script>
    
    // gallery.js - Image Modal Show
    document.querySelectorAll('.gallery-item.photo').forEach(item => {
        item.addEventListener('click', () => {
            const imgSrc = item.getAttribute('data-image');
            document.getElementById('modalImage').src = imgSrc;
        });
    });
    
    // Filter items function
    function filterItems(type) {
        document.querySelectorAll('.filter-btns .btn').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
        const items = document.querySelectorAll('#galleryGrid .gallery-item');
        items.forEach(item => {
            if (type === 'all') {
                item.classList.remove('hide');
            } else if (!item.classList.contains(type)) {
                item.classList.add('hide');
            } else {
                item.classList.remove('hide');
            }
        });
    }
  

</script>

<?php

// } else {
//     echo '<div class="container mt-5"><div class="alert alert-danger" role="alert">আপনাকে এডিটর হিসেবে লগইন করতে হবে পোস্ট সাবমিট করার জন্য।</div></div>';
// }

get_footer();
 
?>

