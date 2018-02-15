<div class="archive_single_post <?php echo get_post_type(); ?>">
	<?php
   if( has_post_thumbnail() ) :
   	$image = get_the_post_thumbnail_url();
   	$thumb_link =  Get_most_recent_permalink();
   	echo "<a href=$thumb_link><img src=$image></a>";
   	
   	endif; ?>
</div>
   	
