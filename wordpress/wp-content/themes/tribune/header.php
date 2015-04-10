<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<title><?php ui::title(); ?></title>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

 	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
	<!--[if IE 6]><link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/ie6.css" /><![endif]-->
	<!--[if IE 7 ]><link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/ie7.css" /><![endif]-->

        <meta name="google-site-verification" content="WPTTN3hsxSFMrzKo52hFkzetpUmoeHK2-SKhG6oLt5Q" />
		
	<?php if (option::get('sidebar_pos') == 'Left') { ?><style type="text/css">#sidebar{float:left;} #main {float:right;}</style><?php } ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> onload="fix()">

	<div id="wrapper">

		<div id="inner-wrapper">

			<div id="header">

				<div id="head-bar">

					<?php if (option::get('header_date_show') == 'on') { ?><div id="date"><strong><?php echo date("l"); ?></strong>, <?php echo date("F jS"); ?></div><?php } ?>

					<div id="navigation" class="dropdown">
						<?php if (has_nav_menu( 'secondary' )) {
							wp_nav_menu( array(
							'container' => '',
							'container_class' => '',
							'menu_class' => '',
							'sort_column' => 'menu_order',
							'theme_location' => 'secondary'
							) );
						} ?>
					</div>

				</div><!-- /#header-bar -->

				<div id="inner">

					<div id="logo">
						<?php if (!option::get('misc_logo_path')) { echo "<h1>"; } ?>

						<a href="<?php echo home_url(); ?>" title="<?php bloginfo('description'); ?>">
							<?php if (!option::get('misc_logo_path')) { bloginfo('name'); } else { ?>
								<img src="<?php echo ui::logo(); ?>" alt="<?php bloginfo('name'); ?>" />
							<?php } ?>
						</a><div class="clear"></div>

						<?php if (!option::get('misc_logo_path')) { echo "</h1>"; } ?>

					</div><!-- / #logo -->

					<div id="head_banner">
						<?php
						if ( option::get('ad_head_select') == 'on' ) {
							if ( option::get('ad_head_code') <> "" ) {
								echo stripslashes(option::get('ad_head_code'));
							} else {
								?><a href="<?php echo option::get('ad_head_imgurl'); ?>"><img src="<?php echo option::get('ad_head_imgpath'); ?>" alt="<?php echo option::get('ad_head_imgalt'); ?>" /></a><?php
							}
						}
						?>
					</div>

					<div id="right">

						<div id="social">
							<ul>
								<?php
								if ( option::get('head_twitter_show') == 'on' && strlen(option::get('social_twitter')) > 1 ) {?><li class="button"><a href="http://twitter.com/<?php echo option::get('social_twitter'); ?>" title="<?php echo option::get('social_twitter_title'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icons/twitter.png" alt="Twitter" /></a></li><?php }
								if ( option::get('head_facebook_show') == 'on' && strlen(option::get('social_facebook')) > 1 ) {  ?><li class="button"><a href="<?php echo option::get('social_facebook'); ?>" title="<?php echo option::get('social_facebook_title'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icons/facebook.png" alt="Facebook" /></a></li><?php }
								if ( option::get('head_rss_show') == 'on' ) { ?><li class="button"><a href="<?php ui::rss(); ?>" title="<?php echo option::get('social_rss_title'); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/icons/rss.png" alt="RSS" /></a></li><?php }
								?>
							</ul>
						</div>

						<div id="search"><?php get_template_part('searchform'); ?></div>

					</div><!-- /#right -->

				</div><!-- /#inner -->

				<!-- Main Menu -->
				<div id="menu" class="dropdown">
					<?php wp_nav_menu( array(
						'container' => '',
						'container_class' => '',
						'menu_class' => '',
						'sort_column' => 'menu_order',
						'theme_location' => 'primary' ) );
					?>
				</div> <!-- /#menu -->
				<div class="clear"></div>

				<?php if (option::get('alert_show') == 'on') { ?><div id="breakingNews"><?php echo stripslashes(option::get('alert_content')); ?></div><?php } ?>

				<div class="clear"></div>

			</div><!-- /#header -->

			<div id="content">
