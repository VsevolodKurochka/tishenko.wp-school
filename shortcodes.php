<?php
	
	add_shortcode('loop', 'fb_custom_query_shortcode');
	function fb_custom_query_shortcode( $atts ) {
		 
		 // Defaults
		 extract( shortcode_atts( array(
				'posts_per_page' 	=> '3',
				'class'						=> 'post_small col-12 col-sm-4',
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

				$output .= Timber::compile( 
					'partial/post.twig', 
					array( 
						'title' 				=> get_the_title( $temp_id ),
						'link' 					=> get_permalink( $temp_id ),
						'thumbnail'			=> get_the_post_thumbnail_url($temp_id),
						'excerpt'				=> excerpt($temp_id, 20),
						'category'			=> $temp_category[0]->cat_name,
						'class'					=> $class
					) 
				);
			 }
		 $output .= '</div>';
		 return $output;
		 wp_reset_postdata();
	}
		 
?>