<?php
/*
Element Description: VC Info Box
*/
 
// Element Class 
class vcNewCard extends WPBakeryShortCode {
		 
		// Element Init
		function __construct() {
				add_action( 'init', array( $this, 'vc_new_card_mapping' ) );
				add_shortcode( 'vc_new_card', array( $this, 'vc_new_card_html' ) );
		}
		 
		// Element Mapping
		public function vc_new_card_mapping() {
				 
				// Stop all if VC is not enabled
				if ( !defined( 'WPB_VC_VERSION' ) ) {
						return;
				}
				 
				// Map the block with vc_map()
				vc_map( 
						array(
								'name' => __('Карточка', 'school'),
								'base' => 'vc_new_card',
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
											"type" => "textfield",
											"holder" => "div",
											"class" => "",
											"heading" => __( "Заголовок", "visotskiy" ),
											"param_name" => "title",
											"value" => __( "", "visotskiy" ),
											"description" => __( "Введите Заголовок.", "visotskiy" )
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
		public function vc_new_card_html( $atts, $content = null ) {
				 
				// Params extraction
				extract(
						shortcode_atts(
								array(
									'image_url' 		=> '',
									'title'					=> '',
									'icon_content'	=> ''
								), 
								$atts
						)
				);
				 
				// Fill $html var with data
				$img = wp_get_attachment_image_url($image_url, 'full');

				$html = '
				<div class="card">
					<div class="card__header">
						<img src="'.$img.'" alt="'.$title.'" class="card__header-image">
					</div>
					<div class="card__body">
						<p class="card__title">'.$title.'</p>
						<div class="card__content">'.wpautop($icon_content).'</div>
					</div>
				</div>';

				return $html;
				 
		}
		 
} // End Element Class
 
 
// Element Class Init
new vcNewCard();
?>