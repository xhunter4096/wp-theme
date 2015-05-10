<?php get_header(); ?>
<?php
	$options = get_option('Julie_options');
	if (function_exists('wp_list_comments')) {
		add_filter('get_comments_number', 'comment_count', 0);
	}
?>

<?php if (is_search()) : ?>
	<div class="boxcaption"><h3><?php _e('Search Results', 'Julie'); ?></h3></div>
	<div class="box"><?php printf( __('Keyword: &#8216;%1$s&#8217;', 'Julie'), wp_specialchars($s, 1) ); ?></div>

<?php else : ?>
	<div class="boxcaption"><h3><?php _e('Archive', 'Julie'); ?></h3></div>
	<div class="box">
		<?php
		// If this is a category archive
		if (is_category()) {
			printf( __('Archive for the &#8216;%1$s&#8217; Category', 'Julie'), single_cat_title('', false) );
		// If this is a tag archive
		} elseif (is_tag()) {
			printf( __('Posts Tagged &#8216;%1$s&#8217;', 'Julie'), single_tag_title('', false) );
		// If this is a daily archive
		} elseif (is_day()) {
			printf( __('Archive for %1$s', 'Julie'), get_the_time(__('F jS, Y', 'Julie')) );
		// If this is a monthly archive
		} elseif (is_month()) {
			printf( __('Archive for %1$s', 'Julie'), get_the_time(__('F, Y', 'Julie')) );
		// If this is a yearly archive
		} elseif (is_year()) {
			printf( __('Archive for %1$s', 'Julie'), get_the_time(__('Y', 'Julie')) );
		// If this is an author archive
		} elseif (is_author()) {
			_e('Author Archive', 'Julie');
		// If this is a paged archive
		} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
			_e('Blog Archives', 'Julie');
		}
		?>
	</div>
<?php endif; ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); update_post_caches($posts); ?>
	<div class="post" id="post-<?php the_ID(); ?>">
		<h2><a class="title" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<div class="info">
			<span class="date"><?php the_time(__('F jS, Y', 'Julie')) ?></span>
			<?php if ($options['author']) : ?><span class="author"><?php the_author_posts_link(); ?></span><?php endif; ?>
			<?php edit_post_link(__('Edit', 'Julie'), '<span class="editpost">', '</span>'); ?>
			<div class="fixed"></div>
		</div>
		<div class="content">
			<?php the_content(__('Read more...', 'Julie')); ?>
			<div class="fixed"></div>
		</div>
		<div class="under">
			<?php if ($options['categories']) : ?><span class="categories"><?php _e('Categories: ', 'Julie'); ?></span><span><?php the_category(', '); ?></span><?php endif; ?>
			<?php if ($options['tags']) : ?><span class="tags"><?php _e('Tags: ', 'Julie'); ?></span><span><?php the_tags('', ', ', ''); ?></span><?php endif; ?>
		</div>
	</div>
<?php endwhile; else : ?>
	<div class="errorbox">
		<?php _e('Sorry, no posts matched your criteria.', 'Julie'); ?>
	</div>
<?php endif; ?>

<div id="pagenavi">
	<?php if(function_exists('wp_pagenavi')) : ?>
		<?php wp_pagenavi() ?>
	<?php else : ?>
		<span class="newer"><?php previous_posts_link(__('Newer Entries', 'Julie')); ?></span>
		<span class="older"><?php next_posts_link(__('Older Entries', 'Julie')); ?></span>
	<?php endif; ?>
	<div class="fixed"></div>
</div>

<?php get_footer(); ?>
