<?php
	$options = get_option('Julie_options');

	if($options['feed'] && $options['feed_url']) {
		if (substr(strtoupper($options['feed_url']), 0, 7) == 'HTTP://') {
			$feed = $options['feed_url'];
		} else {
			$feed = 'http://' . $options['feed_url'];
		}
	} else {
		$feed = get_bloginfo('rss2_url');
	}
?>

<!-- sidebar START -->
<div id="sidebar">

<!-- sidebar north START -->
<div id="northsidebar" class="sidebar">

	<!-- feeds -->
	<div class="widget widget_feeds">
		<div class="content">
			<div id="subscribe">
				<a rel="external nofollow" id="feedrss" title="<?php _e('Subscribe to this blog...', 'Julie'); ?>" href="<?php echo $feed; ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>', 'Julie'); ?></a>
				<?php if($options['feed_readers']) : ?>
					<ul id="feed_readers">
						<li id="google_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', 'Julie'); _e('Google', 'Julie'); ?>" href="http://fusion.google.com/add?feedurl=<?php echo $feed; ?>"><span><?php _e('Google', 'Julie'); ?></span></a></li>
						<li id="xianguo_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', 'Julie'); _e('Xian Guo', 'Julie'); ?>" href="http://www.xianguo.com/subscribe.php?url=<?php echo $feed; ?>"><span><?php _e('Xian Guo', 'Julie'); ?></span></a></li>
						<li id="zhuaxia_reader"><a rel="external nofollow" class="reader" title="<?php _e('Subscribe with ', 'Julie'); _e('Zhua Xia', 'Julie'); ?>" href="http://www.zhuaxia.com/add_channel.php?url=<?php echo $feed; ?>"><span><?php _e('Zhua Xia', 'Julie'); ?></span></a></li>
					</ul>
				<?php endif; ?>
			</div>
			<?php if($options['feed_email'] && $options['feed_url_email']) : ?>
				<a rel="external nofollow" id="feedemail" title="<?php _e('Subscribe to this blog via email...', 'Julie'); ?>" href="<?php echo $options['feed_url_email']; ?>"><?php _e('Email feed', 'Julie'); ?></a>
			<?php endif; if($options['twitter'] && $options['twitter_username']) : ?>
				<a id="followme" title="<?php _e('Follow me!', 'Julie'); ?>" href="http://twitter.com/<?php echo $options['twitter_username']; ?>/"><?php _e('Twitter', 'Julie'); ?></a>
			<?php endif; ?>
			<div class="fixed"></div>
		</div>
	</div>

	<!-- showcase -->
	<?php if( $options['showcase_content'] && (
		($options['showcase_registered'] && $user_ID) || 
		($options['showcase_commentator'] && !$user_ID && isset($_COOKIE['comment_author_'.COOKIEHASH])) || 
		($options['showcase_visitor'] && !$user_ID && !isset($_COOKIE['comment_author_'.COOKIEHASH]))
	) ) : ?>
		<div class="widget">
			<?php if($options['showcase_caption']) : ?>
				<h3><?php if($options['showcase_title']){echo($options['showcase_title']);}else{_e('Showcase', 'Julie');} ?></h3>
			<?php endif; ?>
			<div class="content">
				<?php echo($options['showcase_content']); ?>
			</div>
		</div>
	<?php endif; ?>

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('north_sidebar') ) : ?>

	<!-- posts -->
	<?php
		if (is_single()) {
			$posts_widget_title = 'Recent Posts';
		} else {
			$posts_widget_title = 'Random Posts';
		}
	?>

	<div class="widget">
		<h3><?php echo $posts_widget_title; ?></h3>
		<ul>
			<?php
				if (is_single()) {
					$posts = get_posts('numberposts=10&orderby=post_date');
				} else {
					$posts = get_posts('numberposts=5&orderby=rand');
				}
				foreach($posts as $post) {
					setup_postdata($post);
					echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
				}
				$post = $posts[0];
			?>
		</ul>
	</div>

	<!-- recent comments -->
	<?php if( function_exists('wp_recentcomments') ) : ?>
		<div class="widget">
			<h3>Recent Comments</h3>
			<ul>
				<?php wp_recentcomments('limit=5&length=16&post=false&smilies=true'); ?>
			</ul>
		</div>
	<?php endif; ?>

	<!-- tag cloud -->
	<div id="tag_cloud" class="widget">
		<h3>Tag Cloud</h3>
		<?php wp_tag_cloud('smallest=8&largest=16'); ?>
	</div>

<?php endif; ?>
</div>
<!-- sidebar north END -->


	<!-- sidebar east START -->
	<!-- sidebar east END -->

	<!-- sidebar west START -->
	<!-- sidebar west END -->

<!-- sidebar south START -->
<!-- sidebar south END -->

</div>
<!-- sidebar END -->
