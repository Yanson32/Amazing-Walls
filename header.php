<!DOCTYLE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class('BodyColor'); ?>>
	<header class="HeaderColor">

		<div class="HeaderContainer HeaderContainerColor">

			<div class="header_text">
				<?php the_custom_logo(); ?>
				<div id="header-text">
					<?php bloginfo('name'); ?>
				</div>
			</div>

			<div id="header-subtext" class="HeaderDescritionText">
				<?php bloginfo('description'); ?>
			</div>
			<div class="HeaderSearch">
				<?php get_search_form(); ?>		
			</div>
		</div>

		<!-- <?php esc_attr(get_option('header_font')); ?> -->
	</header>

			<?php 
				$args = array(	'theme_location' => 'main-menu',
								'container' => 'div',
								'container_class' => 'main_nav',
								'menu_class' => 'MainMenu MainMenuColor',
							);
				wp_nav_menu($args); 
			?>
