<?php
/* Template Name: Editor Post Submit */
get_header();

// চেক করুন যে ইউজারটি এডিটর রোলের কিনা
if (current_user_can('editor')) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_title']) && isset($_POST['post_content']) && isset($_POST['category']) && isset($_FILES['post_image'])) {
        // পোস্ট ডেটা গ্রহন করুন
        $post_title = sanitize_text_field($_POST['post_title']);
        $post_content = sanitize_textarea_field($_POST['post_content']);
        $category = intval($_POST['category']); // ক্যাটাগরি সিলেক্ট করুন
        $post_image = $_FILES['post_image']; // ছবি আপলোড 

        
        if (isset($upload['url'])) {
            $image_url = $upload['url'];
        } else {
            $image_url = '';   
        }

        // নতুন পোস্ট তৈরি করুন
        $new_post = array(
            'post_title'   => $post_title,
            'post_content' => $post_content,
            'post_status'  => 'pending',  // 'pending' দিয়ে পোস্টটা মডারেশনের জন্য পাঠানো হবে
            'post_author'  => get_current_user_id(),
            'post_type'    => 'post',
            'post_category' => array($category),  // ক্যাটাগরি অ্যারে
            'meta_input'   => array(
                'post_image' => $image_url // ছবির URL মেটা হিসাবে সংরক্ষণ
            ),
        );
        
        // পোস্ট ইনসার্ট করুন
        $post_id = wp_insert_post($new_post);

        // WordPress media uploader
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');


        // $upload = wp_handle_upload($post_image, array('test_form' => false));

        $upload_dir = wp_upload_dir();
        $upload_path = $upload_dir['path'] . '/' . basename($post_image['name']);
        $upload_url = $upload_dir['url'] . '/' . basename($post_image['name']);
        move_uploaded_file($post_image['tmp_name'], $upload_path);
        $attachment = array(
            'guid'           => $upload_url, 
            'post_mime_type' => $post_image['type'],
            'post_title'     => sanitize_file_name($post_image['name']),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );
        $attachment_id = media_handle_upload('post_image', $post_id); 
        $attachment_id = wp_insert_attachment($attachment, $upload_path);


        if (is_wp_error($attachment_id)) {
            echo '<div class="alert alert-danger" role="alert">ছবি আপলোড হয় নাই। </div>';
        } else {
            set_post_thumbnail($post_id, $attachment_id);
        }

        if ($post_id) {
            echo '<div class="alert alert-success" role="alert">পোস্ট সফলভাবে সাবমিট হয়েছে এবং মডারেশনের জন্য পাঠানো হয়েছে।</div>';
        }
    }
?>

    <div class="container mt-5">
        <h2 class="text-center mb-4">নতুন পোস্ট সাবমিট করুন</h2>
        <div class="card shadow-lg">
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" >

                

                    <!-- ক্যাটাগরি -->
                    <div class="mb-4">
                        <label for="category" class="form-label fs-5">ক্যাটাগরি:</label>
                        <div class="input-group input-group-lg">
                            <?php
                                wp_dropdown_categories(array(
                                    'name' => 'category',
                                    'show_option_none' => 'ক্যাটাগরি নির্বাচন করুন',
                                    'selected' => 0,
                                    'taxonomy' => 'category', // নিশ্চিত করুন taxonomy সঠিক
                                    'hide_empty' => false, // এমন ক্যাটাগরি দেখান যেগুলিতে পোস্ট নেই
                                    'class' => 'form-select shadow-sm', // Bootstrap স্টাইল 
                                    'required' => 'required' // ক্যাটাগরি ফিল্ডকে required করুন 
                                ));
                            ?>
                        </div>
                    </div> 

                    <!-- পোস্টের শিরোনাম -->
                    <div class="mb-4">
                        <label for="post_title" class="form-label fs-5">পোস্টের শিরোনাম:</label>
                        <input type="text" class="form-control form-control-lg shadow-sm" id="post_title" name="post_title" placeholder="পোস্টের শিরোনাম লিখুন" required>
                    </div>
                    
                    <!-- পোস্টের বিষয়বস্তু -->
                    <div class="mb-4">
                        <label for="post_content" class="form-label fs-5">পোস্টের বিষয়বস্তু:</label>
                        <textarea class="form-control shadow-sm" id="post_content" name="post_content" rows="5" placeholder="পোস্টের বিষয়বস্তু লিখুন" required></textarea>
                    </div>


                    <!-- পোস্টের ছবি আপলোড -->
                    <div class="mb-4">
                        <label for="post_image" class="form-label fs-5">পোস্টের ছবি আপলোড করুন:</label>
                        <input type="file" class="form-control shadow-sm" id="post_image" name="post_image" accept="image/*" required>
                    </div>

                    <!-- ছবি প্রিভিউ -->
                    <div class="mb-4" id="imagePreviewContainer" style="display: none;">
                        <label class="form-label fs-5">আপলোড করা ছবি:</label>
                        <img id="previewImage" src="" alt="Uploaded Image Preview" class="img-fluid shadow-sm"  style="max-width: 200px; height: auto;" >
                    </div>

                    <!-- সাবমিট বাটন -->
                    <button type="submit" class="btn btn-primary w-100 py-3 shadow-sm">পোস্ট সাবমিট করুন</button>
                </form>

            </div>
        </div>
    </div>

<?php
} else {
    echo '<div class="container mt-5"><div class="alert alert-danger" role="alert">আপনাকে এডিটর হিসেবে লগইন করতে হবে পোস্ট সাবমিট করার জন্য।</div></div>';
}

get_footer();
 
?>