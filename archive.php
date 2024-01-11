<?php

/**
 * The template for displaying archive pages
 */

get_header();

$category = get_category(get_query_var('cat'));
$cat_id = $category->cat_ID;

$getting_posts = get_posts(array(
	'numberposts'  => -1,
	'orderby'      => 'ID',
	'order'        => 'ASC',
	'post_type'    => 'post',
	'category' => $cat_id
));

?>
<div id="posts-section" class="rendered-posts">
	<h2>Results for <span><?php echo $category->cat_name; ?></span></h2>
	<?php
	if (empty($getting_posts)) {
		echo '<div class="no-post-find"><h5>No Result Found..!</h5></div>';
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
get_footer();
?>