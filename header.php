<!DOCTYLE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class('BodyColor'); ?>>
	<header class="HeaderColor">

		<div class="HeaderContainer HeaderContainerColor">

			<div class="header-main group flex-container-header-main">
				<div id="site-logo">
					<?php the_custom_logo(); ?>
				</div>
				<div id="header-text" class="group">
					<?php bloginfo('name'); ?>
				</div>
			</div>
			<div id="flex-container-header-sub">
				<div id="header-subtext" class="HeaderDescritionText">
					<?php bloginfo('description'); ?>
				</div>
				<!-- <div class="HeaderSearch">
					<?php get_search_form(); ?>
				</div> -->
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
