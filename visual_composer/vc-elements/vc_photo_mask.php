<?php
/*
Element Description: VC Info Box
*/
 
// Element Class 
class vcPhotoMask extends WPBakeryShortCode {
		 
		// Element Init
		function __construct() {
				add_action( 'init', array( $this, 'vc_photo_mask_mapping' ) );
				add_shortcode( 'vc_photo_mask', array( $this, 'vc_photo_mask_html' ) );
		}
		 
		// Element Mapping
		public function vc_photo_mask_mapping() {
				 
				// Stop all if VC is not enabled
				if ( !defined( 'WPB_VC_VERSION' ) ) {
						return;
				}
				 
				// Map the block with vc_map()
				vc_map( 
						array(
								'name' => __('Фото маска', 'school'),
								'base' => 'vc_photo_mask',
								'description' => __('Выберите отзыв-видео', 'school'), 
								'category' => __('Для работы с сайтом', 'school'),         
								'params' => array(

										array(
											"type" => "textfield",
											"holder" => "div",
											"class" => "",
											"heading" => __( "Дополнительный класс", "school" ),
											"param_name" => "photo_mask_class",
											"value" => __( "", "school" ),
											"description" => __( "Необязательно.", "school" )
										),

										array(
											'type' => 'attach_image',
											'holder' => 'img',
											'class' => 'title-class',
											'heading' => __( 'Выберите картинку', 'school' ),
											'param_name' => 'image_photo',
											'value' => __( '', 'school' ),
											'description' => __( 'Выберите картинку', 'school' ),
											'admin_label' => false,
											'weight' => 0
										),

										array(
											'type' => 'attach_image',
											'holder' => 'img',
											'class' => 'title-class',
											'heading' => __( 'Выберите маску', 'school' ),
											'param_name' => 'image_mask',
											'value' => __( '', 'school' ),
											'description' => __( 'Выберите маску', 'school' ),
											'admin_label' => false,
											'weight' => 0
										)
										
								),
						)
				);
				
		}
		 
		 
		// Element HTML
		public function vc_photo_mask_html( $atts, $content = null ) {
				 
				// Params extraction
				extract(
						shortcode_atts(
								array(
									'photo_mask_class' => '',
									'image_photo' => '',
									'image_mask' => ''
								), 
								$atts
						)
				);

				$image_photo_html = wp_get_attachment_image_url($image_photo, 'full');
				$image_mask_html = wp_get_attachment_image_url($image_mask, 'full');
				 

				$html = '
				<div class="photo-mask '.$photo_mask_class.'">
					<img src="'.$image_photo_html.'" alt="Photo mask" class="photo-mask__under">
					<img src="'.$image_mask_html.'" alt="Photo mask" class="photo-mask__cover">
				</div>';
				 
				return $html;
				 
		}
		 
} // End Element Class
 
 
// Element Class Init
new vcPhotoMask();
?>