<?php
/* Template Name: Member Directory */
get_header();
?>

<div class="container">
    <?php
    // প্লাগইনের শোর্টকোড রান করিয়ে মেম্বার ডিরেক্টরি দেখানো
    echo do_shortcode('[toacbd_member_directory]');
    ?>
</div>

<?php get_footer(); ?>
