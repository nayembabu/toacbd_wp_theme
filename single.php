<?php get_header(); ?>
<style>
    /* পোস্ট কনটেইনার */
.post-container {
    width: 75%; /* পুরো পেইজটিকে আরও ভালোভাবে সাজানোর জন্য ছোট করা হয়েছে */
    margin: 0 auto;
    padding: 40px 20px;
    background-color: #f9f9f9; /* হালকা ব্যাকগ্রাউন্ড যোগ করা হয়েছে */
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

/* পোস্টের শিরোনাম */
.entry-title {
    font-size: 2.5em;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
    text-align: center; /* শিরোনাম কেন্দ্রিভূত করা হয়েছে */
}

/* পোস্টের ছবি */
.post-thumbnail {
    text-align: center;
    margin: 20px 0;
}

.post-thumbnail img {
    width: 30%; /* ছবির আকার ছোট করা হয়েছে */
    height: auto;
    border-radius: 80px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

/* পোস্টের তথ্য (তারিখ এবং লেখক) */
.entry-meta {
    font-size: 1em;
    color: #777;
    text-align: center;
    margin-bottom: 30px;
}

/* পোস্টের বিষয়বস্তু */
.entry-content {
    font-size: 1.1em;
    line-height: 1.8;
    color: #333;
    margin-bottom: 30px;
}

/* ফুটার অংশ */
.entry-footer {
    font-size: 1em;
    text-align: center;
}

.category, .tags {
    display: inline-block;
    margin-right: 15px;
    color: #007BFF;
}

.category:hover, .tags:hover {
    text-decoration: underline;
}

/* মন্তব্য অংশ */
.comments-section {
    margin-top: 40px;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

</style>
<main id="primary" class="site-main">
    <div class="post-container">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <!-- পোস্টের শিরোনাম -->
                        <h1 class="entry-title"><?php the_title(); ?></h1>

                        <!-- পোস্টের ছবি -->
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('medium'); ?> <!-- ছবির সাইজ ছোট করা হয়েছে -->
                            </div>
                        <?php endif; ?>

                        <div class="entry-meta">
                            <span class="posted-on">Date:- <?php the_date(); ?></span> |||
                            <span class="byline"> Author:- <?php the_author(); ?></span>
                        </div>
                    </header>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>

                    <footer class="entry-footer">
                        <span class="category"><?php the_category(', '); ?></span>
                        <span class="tags"><?php the_tags(); ?></span>
                    </footer>
                </article>

                <div class="comments-section">
                    <?php
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                    ?>
                </div>

            <?php endwhile;
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>
