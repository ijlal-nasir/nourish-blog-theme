<?php

/**
 * The template for displaying all single posts
 */

get_header();
$id =  get_the_ID();
$content = apply_filters('the_content', get_post_field('post_content', $id));
$author_id = get_post_field('post_author', $id);
$display_name = get_the_author_meta('display_name', $author_id);
$category_detail = get_the_category($id);
$getting_posts = get_posts(array(
    'numberposts'  => -1,
    'orderby'      => 'ID',
    'order'        => 'ASC',
    'post_type'    => 'post',
    'category' => $category_detail[0]->cat_ID
));

// $getting_posts = array();
/* Start the Loop */
?>
<div id="single-post">
    <div class="medium-container">
        <h2><?php echo get_the_title($id) ?></h2>
        <div class="single-post-detail">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
            </svg>
            <div>
                <h5><?php echo $display_name; ?> . <a href="#">Follow</a>
                </h5>
                <p>6 min read . Sep 25</p>
            </div>
        </div>
        <div class="single-post-describtion">
            <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($id), 'thumbnail'); ?>" />
            <p><?php echo $content; ?></p>
        </div>
    </div>
    <div class="recommended-posts">
        <div class="medium-container">
            <div class="author-detail">
                <div class="recommend-post-auhor-detail">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                    <div>
                        <h5>Written by <?php echo $display_name; ?></h5>
                        <p>415 Followers</p>
                    </div>
                </div>
                <div class="author-buttons">
                    <button>Follow</button>
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-plus" viewBox="0 0 16 16">
                            <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z" />
                            <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5Z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="recommended-posts">
                <h2>Recommended from Medium</h2>
                <div class="row"> <?php
                                    if (empty($getting_posts)) {
                                        echo '<div class="no-post-find"><h5>No Recommended Post Found..!</h5></div>';
                                    }
                                    if (!empty($getting_posts) || $getting_posts != '') {
                                        foreach ($getting_posts as $post_) {
                                            if ($post_->ID != $id) {
                                                $date = date_create($post_->post_date);
                                                $category_detail = get_the_category($post_->ID);
                                                $author_id = get_post_field('post_author', $id);
                                                $display_name = get_the_author_meta('display_name', $author_id);
                                    ?>
                                <div class="col-md-6 rec-single-post">
                                    <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post_->ID), 'thumbnail'); ?>" />
                                    <h4><svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                        </svg><?php echo $display_name; ?></h4>
                                    <a href="<?php echo get_the_permalink($post_->ID) ?>">
                                        <h5><?php echo $post_->post_title; ?></h5>
                                    </a>
                                    <h6>It's August in Northern Virginia, hot and humid. I still haven't showered from my...</h6>
                                    <p>⭐ · 4 min read · <?php echo date_format($date, "M d, Y"); ?></p>
                                </div>
                    <?php
                                            }
                                        }
                                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

get_footer();
