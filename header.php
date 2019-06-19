<!DOCTYLE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title(); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class('BodyColor'); ?>>
	<header class="HeaderColor">
		<?php
			$args = array(	'theme_location' => 'header-menu',
							'container' => 'nav',
							'container_class' => 'header_nav',
							'menu_class' => 'HeaderMenu clearfix',
						);
			wp_nav_menu($args);
		?>
			<div class="clearfix">
				<?php if(has_custom_logo()): ?>
					<div id="aw_site_logo">
						<?php the_custom_logo(); ?>
					</div>
				<?php endif; ?>
				<div id="aw_header_text">
					<h1 id="aw_primary_header" class="PrimaryHeaderColor"><?php bloginfo('name'); ?></h1>
				</div>
				<div id="aw_header_subtext" class="HeaderDescritionText">
					<?php bloginfo('description'); ?>
				</div>
			</div>

		<?php
			$args = array(	'theme_location' => 'main-menu',
							'container' => 'div',
							'container_class' => 'main_nav',
							'menu_class' => 'MainMenu',
						);
			wp_nav_menu($args);
		?>
	</header>
	<?php
		$args = array(	'theme_location' => 'header-menu',
						'container' => 'nav',
						'container_class' => 'header_nav',
						'menu_class' => 'HeaderMenuPhone',
					);
		wp_nav_menu($args);
	?>
	<br>
	<br>
