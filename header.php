<!DOCTYLE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class('BodyColor'); ?>>
	<header class="HeaderColor">

		<div class="HeaderContainer HeaderContainerColor">
			<ul>
				<?php wp_register('<li style="float:right" class="Button ButtonColor">', '</li>'); ?>
				<li style="float:right" class="Button ButtonColor"><?php wp_loginout(); ?></li>
			</ul>
			<div class="group">
				<div id="site-logo">
					<?php the_custom_logo(); ?>
				</div>
				<div id="header_text">
					<h1 id="primary_header" class="PrimaryHeaderColor"><?php bloginfo('name'); ?></h1>
				</div>
				<div id="header-subtext" style="display:inline-block" class="HeaderDescritionText">
					<?php bloginfo('description'); ?>
				</div>
			</div>
			<div>

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
