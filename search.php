<?php

/**
 * The template for displaying search results pages
 */

get_header();
$search_term = $_GET['s'];
$searched_query = str_replace('-', ' ', $search_term);
global $wpdb;
$get_searched_post = $wpdb->get_results($wpdb->prepare('SELECT * from ' . $wpdb->prefix . 'posts where post_type = "post" AND post_title LIKE %s', '%' . $searched_query . '%'));

if (empty($get_searched_post)) {
	$getting_trending_posts = get_posts(array(
		'numberposts'  => 6,
		'orderby'      => 'ID',
		'order'        => 'DESC',
		'post_type'    => 'post',
		'meta_key' => '_istrending',
		'meta_value' => 'yes',
	));
}


?>

<div id="posts-section" class="rendered-posts">
	<h2>Results for <span><?php echo $searched_query; ?></span></h2>
	<?php
	if (empty($get_searched_post)) {
		echo '<div class="no-post-find"><h5>No Result Found..!</h5></div>';

		echo '<div class="rec-trendings"><h2>Recommended you our trendings</h2>';

		foreach ($getting_trending_posts as $post_) {
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
		echo '</div>';
	}
	if (!empty($get_searched_post) || $get_searched_post != '') {
		foreach ($get_searched_post as $post_) {
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
<?php get_footer(); ?>