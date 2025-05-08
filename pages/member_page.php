<?php
/* Template Name: Member Directory */
get_header();
?>

<div class="container py-5">
    <h1 class="mb-5 text-center">Member Directory</h1>

    <div class="row">
        <?php
        $subscribers = get_users([
            'role'    => 'subscriber',
            'orderby' => 'display_name',
            'order'   => 'ASC'
        ]);

        if (!empty($subscribers)) :
            foreach ($subscribers as $user) :
                $user_id = $user->ID;
                $name = $user->display_name;
                $email = $user->user_email;
                $avatar = get_avatar_url($user_id, ['size' => 100]);
                $bio = get_user_meta($user_id, 'description', true); // From profile "Biographical Info"
        ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 text-center shadow-sm border-0">
                        <div class="p-3">
                            <img src="<?php echo esc_url($avatar); ?>" class="rounded-circle img-fluid shadow" style="width:100px; height:100px; object-fit:cover;" alt="<?php echo esc_attr($name); ?>">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo esc_html($name); ?></h5>
                            <p class="text-muted small"><?php echo esc_html($email); ?></p>
                            <?php if ($bio) : ?>
                                <p class="card-text"><?php echo wp_trim_words($bio, 20, '...'); ?></p>
                            <?php else : ?>
                                <p class="text-muted">No bio available.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
        <?php
            endforeach;
        else :
        ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <strong>No subscribers found!</strong>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
