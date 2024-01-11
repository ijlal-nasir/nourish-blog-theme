<?php

/**
 * Functions and definitions
 */

function medium_scripts()
{
	wp_enqueue_style('like-medium-stylesheet', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get('Version'));
	wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), wp_get_theme()->get('Version'));
	wp_enqueue_script('like-medium-script', get_template_directory_uri() . '/assets/js/main.js', array(), wp_get_theme()->get('Version'));
}
add_action('wp_enqueue_scripts', 'medium_scripts');

if (!function_exists('mytheme_register_nav_menu')) {

	function mytheme_register_nav_menu()
	{
		register_nav_menus(array(
			'primary_menu' => __('Primary Menu', 'medium')
		));
	}
	add_action('after_setup_theme', 'mytheme_register_nav_menu', 0);
}

add_action('admin_enqueue_scripts', 'load_admin_style');
function load_admin_style()
{
	wp_enqueue_style('theme-options-page-css', get_template_directory_uri() . '/assets/css/theme-option-page.css', array(), wp_get_theme()->get('Version'));
	wp_enqueue_script('theme-options-page-js', get_template_directory_uri() . '/assets/js/admin-script.js', array(), wp_get_theme()->get('Version'));
}

add_theme_support('post-thumbnails');
add_image_size('thumbnail', 150, 150);
add_image_size('medium', 300, 300);
add_image_size('large', 768, 768);
add_image_size('full', 1080, 1080);

function paginatePosts()
{
	$getting_posts = get_posts(array(
		'posts_per_page'   => 10,
		'offset'           => $_REQUEST['start'],
		'orderby'          => 'ID',
		'order'            => 'ASC',
		'post_type'        => 'post',
	));

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
	wp_die();
}

add_action('wp_ajax_nopriv_paginatePosts', 'paginatePosts');
add_action('wp_ajax_paginatePosts', 'paginatePosts');

function add_theme_options_page()
{
	get_template_part('template-parts/theme-options');
}


function medium_theme_options()
{
	add_theme_page('Theme Options', 'Theme Options', 'administrator', 'theme-options', 'add_theme_options_page');
}
add_action('admin_menu', 'medium_theme_options');


function medium_save_meta_data($post_id, $post, $update)
{
	$_istrending = $_POST['_istrending'];
	update_post_meta($post_id, '_istrending', $_istrending);
}

add_action('save_post', 'medium_save_meta_data', 10, 3);

add_action('add_meta_boxes', 'medium_add_isTrending_metabox');
if (!function_exists('medium_add_isTrending_metabox')) {
	function medium_add_isTrending_metabox()
	{
		add_meta_box('istrending_post', __('Is this a trending post ?', 'medium'), 'medium_add_isTrending_checkbox', 'post', 'side', 'core');
	}
}
if (!function_exists('medium_add_isTrending_checkbox')) {
	function medium_add_isTrending_checkbox($post)
	{
	?>
		<div>
			<label>Trending</label>
			<input type="checkbox" style="margin-top: 1%;" name="_istrending" id="_istrending" value="yes" <?php
																											if (get_post_meta($post->ID, '_istrending', true) == 'yes') {
																												echo 'checked';
																											} ?>>
		</div>
<?php
	}
}

add_action('admin_init', 'load_media_files');

function load_media_files()
{
	if ($_GET['page'] == 'theme-options') {
		wp_enqueue_media();
	}
}
?>