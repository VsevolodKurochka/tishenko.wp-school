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

				$output .= Timber::compile( 
					'partial/post.twig', 
					array( 
						'title' 												=> get_the_title( $temp_id ),
						'link' 													=> get_permalink( $temp_id ),
						'thumbnail'											=> get_the_post_thumbnail_url($temp_id),
						'preview_without_formatting'		=> true,
						'preview'												=> custom_get_excerpt($temp_id, 15),
						'class'													=> $class
					) 
				);
			 }
		 $output .= '</div>';
		 return $output;
		 wp_reset_postdata();
	}


	add_shortcode('custom_image', 'custom_image_shortcode');
	function custom_image_shortcode($atts){

		// Defaults
		extract( shortcode_atts( array(
			'class'						=> '',
			'src'							=> ''
		), $atts ) );

		$output = Timber::compile( 
			'partial/image.twig', 
			array(
				'class'			=> $class,
				'site_url'	=> get_site_url(),
				'site_name' => get_bloginfo('name'),
				'src'				=> $src
			)
		);

		return $output;

	}
		 
?>