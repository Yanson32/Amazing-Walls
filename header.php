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

		<div class="HeaderContainer HeaderContainerColor">
				<ul id="aw_header_login_menu">
					<?php wp_register('<li class="Button ButtonColor">', '</li>'); ?>
					<li class="Button ButtonColor"><?php wp_loginout(); ?></li>
				</ul>
			<div class="aw_group">
				<div id="aw_site_logo">
					<?php the_custom_logo(); ?>
				</div>
				<div id="aw_header_text">
					<h1 id="aw_primary_header" class="PrimaryHeaderColor"><?php bloginfo('name'); ?></h1>
				</div>
			</div>
			<div id="aw_header_subtext" class="HeaderDescritionText">
				<?php bloginfo('description'); ?>
			</div>
		<?php
			$args = array(	'theme_location' => 'main-menu',
							'container' => 'div',
							'container_class' => 'main_nav',
							'menu_class' => 'MainMenu',
						);
			wp_nav_menu($args);
		?>
		</div>
	</header>
	<br>
	<br>
