<?php
	
	add_shortcode('loop', 'fb_custom_query_shortcode');
	function fb_custom_query_shortcode( $atts ) {
		 
		 // Defaults
		 extract( shortcode_atts( array(
				'posts_per_page' 	=> '3',
				'class'						=> 'col-12 col-sm-4',
				'before'					=> 'class="row"'
		 ), $atts ) );

		 	$lastposts = get_posts( array(
				'posts_per_page'	=> $posts_per_page,
				'post_type'				=> 'post',
				'post_status'			=> 'publish'
			));
		 
		 // Reset and setup variables
		 $output = '';
		 
		 // the loop
		 $output .= '<div '.$before.'>';
			 foreach( $lastposts as $post ){ 
				setup_postdata($post);
				$temp_id 						= $post->ID;
				$temp_category 			= get_the_category($temp_id);
				$temp_title 				= get_the_title( $temp_id );
				$temp_link 					= get_permalink( $temp_id );
				$temp_thumbnails 		= get_the_post_thumbnail_url($temp_id);

				$temp_excerpt 			= excerpt($temp_id, 20);

				$output .= Timber::compile( 
					'partial/post.twig', 
					array( 
						'title' 		=> $temp_title,
						'link' 			=> $temp_link,
						'thumbnail'			=> $temp_thumbnails,
						'excerpt'		=> $temp_excerpt,
						'category'	=> $temp_category[0]->cat_name,
						'class'			=> $class
					) 
				);	
			 }
		 $output .= '</div>';
		 return $output;
		 wp_reset_postdata();
	}
		 
?>