<?php get_header(); ?>

<section class="py-5 bg-light">
    <div class="container">
        <h1 class="mb-5 text-center fw-bold">📚 আমাদের ব্লগ</h1>

        <div class="row g-4">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium_large', ['class' => 'card-img-top rounded-top']); ?>
                            </a>
                        <?php endif; ?>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                    <?php the_title(); ?>
                                </a>
                            </h5>
                            <p class="text-muted small mb-2">
                                <?php echo get_the_date(); ?> | <?php the_author(); ?>
                            </p>
                            <p class="card-text">
                                <?php echo wp_trim_words(get_the_content(), 20, '...'); ?>
                            </p>
                            <div class="mt-auto">
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm">
                                    বিস্তারিত পড়ুন
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; else : ?>
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        কোনো পোস্ট খুঁজে পাওয়া যায়নি।
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            <?php the_posts_pagination([
                'mid_size' => 2,
                'prev_text' => __('« আগের'),
                'next_text' => __('পরের »'),
                'class' => 'pagination'
            ]); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>

