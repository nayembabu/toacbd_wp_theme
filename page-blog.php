<?php
/**
 * Template Name: Blog Page
 */

get_header(); ?>

<section class="py-5 bg-body-tertiary">
    <div class="container">
        <h1 class="mb-5 text-center fw-bold">📰 Our All News And Blog</h1>

        <div class="row g-4">
            <?php
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;

            $args = [
                'post_type' => 'post',
                'posts_per_page' => 6,
                'paged' => $paged
            ];

            $blog_query = new WP_Query($args);

            if ($blog_query->have_posts()) :
                while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow rounded-4 overflow-hidden border-0">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="ratio ratio-4x3">
                                    <?php the_post_thumbnail('medium', ['class' => 'object-fit-cover w-100 h-100']); ?>
                                </a>
                            <?php endif; ?>

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-2">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                        <?php the_title(); ?>
                                    </a>
                                </h5>
                                <p class="text-muted small mb-2">
                                    <?php echo get_the_date(); ?> | <?php the_author(); ?>
                                </p>
                                <p class="card-text text-secondary small">
                                    <?php echo wp_trim_words(get_the_content(), 18, '...'); ?>
                                </p>
                                <div class="mt-auto">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                        বিস্তারিত পড়ুন →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
            else : ?>
                <div class="col-12">
                    <div class="alert alert-warning text-center rounded-pill shadow-sm">
                        কোনো পোস্ট পাওয়া যায়নি।
                    </div>
                </div>
            <?php endif;
            wp_reset_postdata(); ?>
        </div>

        
        <!-- Pagination -->
        <?php
            $total_pages = $blog_query->max_num_pages;
            if ($total_pages > 1) :
                $current_page = max(1, get_query_var('paged'));

                echo '<nav class="mt-5" aria-label="Blog Pagination">';
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
                        echo '<li class="page-item active"><span class="page-link rounded-pill bg-dark border-dark">' . $i . '</span></li>';
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
