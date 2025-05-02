<?php
/**
 * Template for displaying all posts in a specific category.
 */

get_header(); ?>

<section class="py-5 bg-light mb-5">
    <div class="bg-primary position-relative overflow-hidden mb-5">
        <div class="container py-5 text-center text-white">
            <h1 class="display-4 fw-bold">Category: "<?php single_cat_title(); ?>"</h1>
            <p class="lead">Explore the latest posts in this category.</p>
        </div>
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-25"></div>
    </div>
    <div class="container">
        <h1 class="mb-5 text-center text-primary fw-bold"> Post for "<?php single_cat_title(); ?>" Category </h1>

        <div class="row g-4">
            <?php
            // Pagination জন্য পেজ নম্বর ক্যালকুলেশন
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;

            // ক্যাটাগরি স্লাগ
            $category_slug = get_queried_object()->slug;

            // ক্যাটাগরি কোয়েরি
            $args = [
                'post_type' => 'post',
                'posts_per_page' => 6,
                'paged' => $paged,
                'category_name' => $category_slug  // ক্যাটাগরি স্লাগ দিয়ে কোয়েরি
            ];

            $category_query = new WP_Query($args);

            if ($category_query->have_posts()) :
                while ($category_query->have_posts()) : $category_query->the_post(); ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm rounded-3 overflow-hidden border-0 bg-white">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="ratio ratio-4x3">
                                    <?php the_post_thumbnail('medium', ['class' => 'object-fit-cover w-100 h-100']); ?>
                                </a>
                            <?php else : ?>
                                <a href="<?php the_permalink(); ?>" class="ratio ratio-4x3">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assest/img/no-image.jpg" alt="No Image" class="object-fit-cover w-100 h-100">
                                </a>
                            <?php endif; ?>

                            <div class="card-body d-flex flex-column p-4">
                                <h5 class="card-title mb-2">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark fw-bold">
                                        <?php the_title(); ?>
                                    </a>
                                </h5>
                                <p class="text-muted small mb-2">
                                    <?php echo get_the_date(); ?> | <?php the_author(); ?>
                                </p>
                                <p class="card-text text-secondary small mb-3">
                                    <?php echo wp_trim_words(get_the_content(), 18, '...'); ?>
                                </p>
                                <div class="mt-auto">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        See More &rarr; 
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
            else : ?>
                <div class="col-12">
                    <div class="alert alert-warning text-center rounded-pill shadow-sm">
                        No posts found in this category.
                    </div>
                </div>
            <?php endif;
            wp_reset_postdata(); ?>
        </div>

        <!-- Pagination -->
        <?php
        $total_pages = $category_query->max_num_pages;
        if ($total_pages > 1) :
            $current_page = max(1, get_query_var('paged'));

            echo '<nav aria-label="Category Pagination">';
            echo '<ul class="pagination justify-content-center">';

            // Previous button
            if ($current_page > 1) {
                echo '<li class="page-item">';
                echo '<a class="page-link rounded-pill" href="' . get_pagenum_link($current_page - 1) . '" aria-label="Previous">';
                echo '<span aria-hidden="true">&laquo;</span>';
                echo '</a></li>';
            }

            // Page numbers
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $current_page) {
                    echo '<li class="page-item active"><span class="page-link rounded-pill bg-dark border-dark text-white">' . $i . '</span></li>';
                } else {
                    echo '<li class="page-item"><a class="page-link rounded-pill" href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
                }
            }

            // Next button
            if ($current_page < $total_pages) {
                echo '<li class="page-item">';
                echo '<a class="page-link rounded-pill" href="' . get_pagenum_link($current_page + 1) . '" aria-label="Next">';
                echo '<span aria-hidden="true">&raquo;</span>';
                echo '</a></li>';
            }

            echo '</ul>';
            echo '</nav>';
        endif;
        ?>
    </div>
</section>

<?php get_footer(); ?>



