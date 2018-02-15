<?php

	/******************************************************************************************************************
	*	Purpose:	Display the name of the file for debugging purposes
	*	Input:		string $name the name of the file to be printed.
	*	Other:		Defining AW_DEBUG and setting it to true will cause the file name to be printed.
	*				Otherwise the name will not be printed.
	******************************************************************************************************************/
	function aw_print_name(string $name)
	{
		if(constant('AW_DEBUG'))
		{
			echo '<p>'.$name.'</p>';
		}
	}

	/******************************************************************************************************************
	*	Purpose:	Check to see if a custom field exists.
	*	Input:		string $key the custom field to be checked.
	*	Return:		True if the field exists false otherwise.
	******************************************************************************************************************/
	function aw_has_field(string $key)
	{
		return !empty(amazing_walls_get_custom_field($key));
	}

	/******************************************************************************************************************
	*	Purpose:	Get the custom field specified by the input parameter.
	*	Input:		string $key the custom field to be retrieved.
	*	Return:		Meta data related to the custom field
	******************************************************************************************************************/
	function amazing_walls_get_custom_field(string $key)
	{
		$id = get_the_ID();
		return get_post_meta($id, $key, true);
	}


	/******************************************************************************************************************
	*	Add custom logo
	******************************************************************************************************************/
	if ( ! function_exists( 'amazing_walls_custom_logo' ) )
	{
		function amazing_walls_custom_logo() 
		{
   	
   			if ( function_exists( 'the_custom_logo' ) ) 
			{
   				the_custom_logo();
   			}
   
   		}
	}
   /******************************************************************************************************************
   *	Get the most recent permalink
   ******************************************************************************************************************/
   	if ( ! function_exists( 'Get_most_recent_permalink' ) ) :
   		function Get_most_recent_permalink(){
       			global $post;
       			$tmp_post = $post;
       			$args = array(
           			'numberposts'     => 1,
           			'offset'          => 0,
           			'orderby'         => 'post_date',
           			'order'           => 'DESC',
           			'post_type'       => 'Painting',
           			'post_status'     => 'publish' );
       			$myposts = get_posts( $args );
       			$permalink = get_permalink($myposts[0]->ID);
       			$post = $tmp_post;
       			return $permalink;
   		}
    	endif;

   /******************************************************************************************************************
   *	Add numeric pagination to page
   ******************************************************************************************************************/
   if ( ! function_exists( 'amazing_walls_numeric_posts_nav' ) ) :
   	function amazing_walls_numeric_posts_nav($query_param, string $previous = "Previous Page", string $next = "Next Page") {
    
       		if( is_singular() )
           	return;
    
       		/** Stop execution if there's only 1 page */
       		if( $query_param->max_num_pages <= 1 )         		
				return;
    
       		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
       		$max   = intval( $query_param->max_num_pages );
    
       		/** Add current page to the array */
       		if ( $paged >= 1 )
           		$links[] = $paged;
    
       		/** Add the pages around the current page to the array */
       		if ( $paged >= 3 ) {
           		$links[] = $paged - 1;
           		$links[] = $paged - 2;
       		}
    
       		if ( ( $paged + 2 ) <= $max ) {
           		$links[] = $paged + 2;
           		$links[] = $paged + 1;
       		}
    
       		echo '<div class="navigation"><ul>' . "\n";
    
       		/** Previous Post Link */
       		if ( get_previous_posts_link($previous) )
           		printf( '<li>%s</li>' . "\n", get_previous_posts_link($previous) );
    
       		/** Link to first page, plus ellipses if necessary */
       		if ( ! in_array( 1, $links ) ) {
           		$class = 1 == $paged ? ' class="active"' : '';
    
           		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
    
           		if ( ! in_array( 2, $links ) )
               			echo '<li>...</li>';
       		}
    
       		/** Link to current page, plus 2 pages in either direction if necessary */
       		sort( $links );
       		foreach ( (array) $links as $link ) {
          		 $class = $paged == $link ? ' class="active"' : '';
           		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
       		}
    
       		/** Link to last page, plus ellipses if necessary */
       		if ( ! in_array( $max, $links ) ) {
           		if ( ! in_array( $max - 1, $links ) )
               			echo '<li>...</li>' . "\n";
    
           		$class = $paged == $max ? ' class="active"' : '';
           		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
       		}
    
       		/** Next Post Link */
       		if ( get_next_posts_link($next) )
           		printf( '<li>%s</li>' . "\n", get_next_posts_link($next) );
    
       		echo '</ul></div>' . "\n";
    
   	}
   endif



?>
