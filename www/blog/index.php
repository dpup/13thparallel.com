<?php 
/* Don't remove this line. */
require('./wp-blog-header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<!--
  Title:        Thirteenth Parallel (Archive / Temp Site)
  Description:  Interface for the temporary site put up to hold 13th's old content

  Creator:      Dan Pupius <http://pupius.co.uk>
  Date:         2005-01-14
  Rights:       Copyright (c)2002-2005 Daniel Pupius
-->
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Thirteenth Parallel<?php wp_title(); ?></title>
		<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
		<meta name="copyright" content="Copyright (c)2002-2005 Thirteenth Parallel, All Rights Reserved" />
		<link rel="stylesheet" type="text/css" href="/styles/13.css" />
		<script type="text/javascript" src="/js/Toolkit.js"></script>
		<script type="text/javascript" src="/js/Toolkit.Events.js"></script>
		<script type="text/javascript" src="/js/stuff.js"></script>
		
		<!-- WP Stuff -->
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<?php wp_get_archives('type=monthly&format=link'); ?>
		<?php wp_head(); ?>
	</head>
	
	<body>
		<p id="title"><em>Thirteenth Parallel</em></p>

		<div id="menu">
			<ul>
				<li><a href="/" class="active">Home</a></li>
				<li><a href="/archive/">Archive</a></li>
				<li><a href="/about/">About</a></li>
				<li><a href="/contact/">Contact</a></li>
			</ul>
		</div>

		<div id="body">

<?php if ($posts) : foreach ($posts as $post) : start_wp(); ?>
	
<div class="post">
	<h1 class="storytitle" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h1>
	<?php the_date('','<p class="author">','</p>',true); ?>

	<div class="storycontent">
		<?php the_content(); ?>
	</div>
	
	<div class="meta">
		Posted By <?php the_author() ?><!-- @ <?php the_time() ?>--> <?php edit_post_link(); ?><br />
		<?php the_category(", ") ?>
	</div>

	<div class="feedback">
            <?php wp_link_pages(); ?>
            <?php comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')); ?>
	</div>
	
	<!--
	<?php trackback_rdf(); ?>
	-->

<?php include(ABSPATH . 'wp-comments.php'); ?>
<hr />
</div>

<?php endforeach; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>


			
<!--
			<div id="more1" class="blogmore">
				<h3>Categories</h2>
				<ul>
					<?php wp_list_cats(); ?>
				</ul>
			</div>
 

			<div id="more1" class="blogmore">
				<h3>Old posts</h2>
				<ul>
					<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</div>
-->

			<p id="extralinks">
				[ <a href="<?php echo get_settings('siteurl'); ?>/wp-login.php"><?php _e('Login'); ?></a> |
				<a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr> 2.0'); ?></a> | 
				<a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr> 2.0'); ?></a> ]
			</p>

		</div>
		<div id="footer" class="copyright">Copyright&copy;2001-2005 Thirteenth Parallel<br />All Rights Reserved</div>

	</body>
</html>
