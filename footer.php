	<footer>

			<?php 
				$args = array(	'theme_location' => 'footer-menu',
								'container' => 'div',
								'container_class' => 'footer_nav',
								'menu_class' => 'FooterMenu FooterMenuColor',
							);
				wp_nav_menu($args); 
			?>
		<?php wp_footer(); ?>
	</footer>
</body>
</html>


