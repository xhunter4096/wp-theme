<?php
/*
Template Name: Twitter
*/
?>

<?php get_header(); ?>
<?php $options = get_option('Julie_options'); ?>

<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>

	<div class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>
		<div class="info">
			<span class="date"><?php the_modified_time(__('F jS, Y', 'Julie')); ?></span>
			<?php edit_post_link(__('Edit', 'Julie'), '<span class="editpost">', '</span>'); ?>
			<div class="fixed"></div>
		</div>
		<div class="content">
			<div class="twitter-tweedles">
				<?php
					if (function_exists('thread_twitter')) {
						thread_twitter();
					}
				?>
			</div>
		</div>
	</div>

<?php else : ?>
	<div class="errorbox">
		<?php _e('Sorry, no posts matched your criteria.', 'Julie'); ?>
	</div>
<?php endif; ?>

<?php get_footer(); ?>
