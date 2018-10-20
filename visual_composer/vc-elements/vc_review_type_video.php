<?php
/*
Element Description: VC Info Box
*/
 
// Element Class 
class vcReviewTypeVideo extends WPBakeryShortCode {
		 
		// Element Init
		function __construct() {
				add_action( 'init', array( $this, 'vc_review_type_video_mapping' ) );
				add_shortcode( 'vc_review_type_video', array( $this, 'vc_review_type_video_html' ) );
		}
		 
		// Element Mapping
		public function vc_review_type_video_mapping() {
				 
				// Stop all if VC is not enabled
				if ( !defined( 'WPB_VC_VERSION' ) ) {
						return;
				}
				 
				// Map the block with vc_map()
				vc_map( 
						array(
								'name' => __('Отзыв видео', 'school'),
								'base' => 'vc_review_type_video',
								'description' => __('Выберите отзыв-видео', 'school'), 
								'category' => __('Для работы с сайтом', 'school'),         
								'params' => array(
										array(
											'type' => 'attach_image',
											'holder' => 'img',
											'class' => 'title-class',
											'heading' => __( 'Выберите картинку', 'school' ),
											'param_name' => 'video_image',
											'value' => __( '', 'school' ),
											'description' => __( 'Выберите картинку', 'school' ),
											'admin_label' => false,
											'weight' => 0
										),

										array(
											'type' => 'attach_image',
											'holder' => 'img',
											'class' => 'title-class',
											'heading' => __( 'Фото человека', 'school' ),
											'param_name' => 'image_reviewer',
											'value' => __( '', 'school' ),
											'description' => __( 'Выберите картинку', 'school' ),
											'admin_label' => false,
											'weight' => 0
										),

										array(
											'type' => 'textfield',
											'holder' => 'p',
											'class' => 'title-class',
											'heading' => __( 'Имя:', 'school' ),
											'param_name' => 'name',
											'value' => "",
											'description' => __( 'Введите имя.', 'school' ),
											'admin_label' => false,
											'weight' => 0
										),
										
								),
						)
				);
				
		}
		 
		 
		// Element HTML
		public function vc_review_type_video_html( $atts, $content = null ) {
				 
				// Params extraction
				extract(
						shortcode_atts(
								array(
									'video_image'			=> '',
									'image_reviewer'	=> '',
									'name'						=> ''
								), 
								$atts
						)
				);

				$video_image_html = wp_get_attachment_image_url($video_image, array(350,200));
				$image_reviewer_html = wp_get_attachment_image_url($image_reviewer, array(64,64));
				 

				$html = '
				<div class="review-video">
					<div class="review-video__header">
						<img src="'.$video_image_html.'" alt="'.$name.'" class="review-video__header-image">
					</div>
					<div class="review-video__body">
						<img src="'.$image_reviewer_html.'" alt="'.$name.'" class="review-video__body-image">
						<p class="review-video__body-name">'.$name.'</p>
					</div>
				</div>';
				 
				return $html;
				 
		}
		 
} // End Element Class
 
 
// Element Class Init
new vcReviewTypeVideo();
?>