<?php /* Template Name: Homepage Template */
get_header();
$getting_posts = get_posts(array(
    'numberposts'  => 10,
    'orderby'      => 'ID',
    'order'        => 'ASC',
    'post_type'    => 'post',
));
$getting_posts_count = get_posts(array(
    'post_type'   => 'post',
    'numberposts' => -1,
    'fields'      => 'ids'
));
$total_posts = count($getting_posts_count);
if ($total_posts > 9) {
    $pages = ceil($total_posts / 10);
} else {
    $pages = 0;
}
$args = array(
    'taxonomy' => 'category',
    'orderby' => 'name',
    'order'   => 'ASC'
);

$getting_trending_posts = get_posts(array(
    'numberposts'  => 6,
    'orderby'      => 'ID',
    'order'        => 'DESC',
    'post_type'    => 'post',
    'meta_key' => '_istrending',
    'meta_value' => 'yes',
));

$categories = get_categories($args);
$theme_options = get_option('theme-options');
?>
<div id="site-banner" style="background :<?php echo $theme_options['banner-bg-color'] ?>">
    <div class="medium-container">
        <div class="left-part">
            <h1><?php echo $theme_options['banner-title'] ?></h1>
            <h2><?php echo $theme_options['banner-describtion'] ?></h2>
            <a href="<?php echo $theme_options['banner-cta-link'] ?>"><button>Start Reading</button></a>
        </div>
        <div class="right-part">
        </div>
    </div>
</div>
<div id="trending-section">
    <div class="medium-container">
        <div class="heading">
            <h3><svg width="28" height="29" viewBox="0 0 28 29" fill="none" class="ji ah">
                    <path fill="#fff" d="M0 .8h28v28H0z"></path>
                    <g opacity="0.8" clip-path="url(#trending_svg__clip0)">
                        <path fill="#fff" d="M4 4.8h20v20H4z"></path>
                        <circle cx="14" cy="14.79" r="9.5" stroke="#000"></circle>
                        <path d="M5.46 18.36l4.47-4.48M9.97 13.87l3.67 3.66M13.67 17.53l5.1-5.09M16.62 11.6h3M19.62 11.6v3" stroke="#000" stroke-linecap="round"></path>
                    </g>
                    <defs>
                        <clipPath id="trending_svg__clip0">
                            <path fill="#fff" transform="translate(4 4.8)" d="M0 0h20v20H0z"></path>
                        </clipPath>
                    </defs>
                </svg> Trending on Medium</h3>
        </div>
        <div class="trending-posts">
            <div class="row">
                <?php
                $count = 0;
                foreach ($getting_trending_posts as $trends) {
                    ++$count;
                    $date = date_create($trends->post_date);
                    $author_id = get_post_field('post_author', $trends->ID);
                    $display_name = get_the_author_meta('display_name', $author_id);
                ?>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="single-post">
                            <span>0<?php echo $count; ?></span>
                            <div class="post-detail">
                                <h6><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                    </svg><?php echo $display_name; ?></h6>
                                <h5><?php echo $trends->post_title; ?></h5>
                                <p><?php echo date_format($date, "M d"); ?> · 6 min read</p>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<div id="posts-section" class="blog-posts">
    <div class="row">
        <div class="col-md-8 posts">
            <div id="single-posts-rendered">
                <?php
                if (empty($getting_posts)) {
                    echo '<div class="no-post-find"><h5>No Post is Published Yet!</h5></div>';
                }
                if (!empty($getting_posts) || $getting_posts != '') {
                    foreach ($getting_posts as $post_) {
                        $date = date_create($post_->post_date);
                        $category_detail = get_the_category($post_->ID);
                ?>
                        <div class="single-post-content">
                            <div class="title-desc-date">
                                <a href="<?php echo get_the_permalink($post_->ID) ?>">
                                    <h3 class="title"><?php echo $post_->post_title ?></h3>
                                </a>
                                <p class="desc">How a design director's experience with synesthesia influenced her learning in design</p>
                                <p class="date"><?php echo date_format($date, "M d, Y"); ?> · 6 min read . <span><?php echo $category_detail[0]->cat_name; ?></span></p>
                            </div>
                            <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post_->ID), 'thumbnail'); ?>" />
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <?php
            if ($pages > 1) {
            ?>
                <div id="post-loader-spinner" class="element-none">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/loader.gif'; ?>" alt="spinner" />
                </div>
                <div class="paginations">
                    <?php
                    for ($i = 1; $i <= $pages; $i++) {
                        $start = $i - 1;
                        if ($i == 1) {
                            $class = 'active';
                        } else {
                            $class = '';
                        }
                    ?>
                        <a href="javascript:void(0)" id="page-<?php echo $i; ?>" class="paginations-links <?php echo $class; ?>" onclick="paginate(<?php echo $start * 10; ?>, <?php echo $i; ?>, '<?php echo admin_url('admin-ajax.php'); ?>')" data-current-start="<?php echo $i * 10; ?>"><?php echo $i; ?></a>
                    <?php
                    }
                    ?>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="col-md-4 categories">
            <h4>Discover more of what matters to you</h4>
            <div class="post-categories">
                <?php
                foreach ($categories as $cat) {
                ?>
                    <a href="<?php echo get_category_link($cat->cat_ID); ?>">
                        <p class="single-category"><?php echo $cat->slug; ?></p>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>

    </div>
</div>

<?php
get_footer();
?>