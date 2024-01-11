<?php

/**
 * The main template file
 */

get_header(); ?>

<?php if (is_home() && !is_front_page() && !empty(single_post_title('', false))) : ?>
	<header class="page-header alignwide">
		<h1 class="page-title"><?php single_post_title(); ?></h1>
	</header><!-- .page-header -->
<?php endif; ?>

<?php
get_footer();
?>