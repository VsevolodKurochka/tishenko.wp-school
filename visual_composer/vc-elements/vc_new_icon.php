<?php
/*
Element Description: VC Info Box
*/
 
// Element Class 
class vcNewIcon extends WPBakeryShortCode {
		 
		// Element Init
		function __construct() {
				add_action( 'init', array( $this, 'vc_new_icon_mapping' ) );
				add_shortcode( 'vc_new_icon', array( $this, 'vc_new_icon_html' ) );
		}
		 
		// Element Mapping
		public function vc_new_icon_mapping() {
				 
				// Stop all if VC is not enabled
				if ( !defined( 'WPB_VC_VERSION' ) ) {
						return;
				}
				 
				// Map the block with vc_map()
				vc_map( 
						array(
								'name' => __('Блок с иконкой', 'school'),
								'base' => 'vc_new_icon',
								'description' => __('', 'school'), 
								'category' => __('Для работы с сайтом', 'school'),         
								'params' => array(
										array(
											'type' => 'attach_image',
											'holder' => 'img',
											'class' => 'title-class',
											'heading' => __( 'Выберите картинку', 'school' ),
											'param_name' => 'image_url',
											'value' => __( '', 'school' ),
											'description' => __( 'Выберите картинку', 'school' ),
											'admin_label' => false,
											'weight' => 0
										),
										
										array(
											"type" => "textarea",
											"holder" => "div",
											"class" => "",
											"heading" => __( "Описание:", "school" ),
											"param_name" => "icon_content",
											"value" => __( "", "school" ),
											"description" => __( "Введите описание.", "school" )
										)

								),
						)
				);
				
		}
		 
		 
		// Element HTML
		public function vc_new_icon_html( $atts, $content = null ) {
				 
				// Params extraction
				extract(
						shortcode_atts(
								array(
									'image_url' 		=> '',
									'icon_content'	=> ''
								), 
								$atts
						)
				);
				 
				// Fill $html var with data
				$img = wp_get_attachment_image_url($image_url, 'full');

				$btn_href = vc_build_link($btn_link);
				$html = '
				<div class="icon">
					<div class="icon__header">
						<img src="'.$img.'" alt="'.$title.'" class="icon__header-image">
					</div>
					<div class="icon__content">
						'.wpautop($icon_content).'
					</div>
				</div>';

				return $html;
				 
		}
		 
} // End Element Class
 
 
// Element Class Init
new vcNewIcon();
?>