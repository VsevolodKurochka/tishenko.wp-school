<?php
/*
Element Description: VC Info Box
*/
 
// Element Class 
class vcNewMasterClass extends WPBakeryShortCode {
		 
		// Element Init
		function __construct() {
				add_action( 'init', array( $this, 'vc_master_class_mapping' ) );
				add_shortcode( 'vc_master_class', array( $this, 'vc_master_class_html' ) );
		}
		 
		// Element Mapping
		public function vc_master_class_mapping() {
				 
				// Stop all if VC is not enabled
				if ( !defined( 'WPB_VC_VERSION' ) ) {
						return;
				}
				 
				// Map the block with vc_map()
				vc_map( 
						array(
								'name' => __('Мастер-класс', 'school'),
								'base' => 'vc_master_class',
								'description' => __('', 'school'), 
								'category' => __('Для работы с сайтом', 'school'),         
								'params' => array(

										array(
											"type" => "textfield",
											"holder" => "div",
											"class" => "",
											"heading" => __( "Заголовок", "school" ),
											"param_name" => "title",
											"value" => __( "", "school" ),
											"description" => __( "Введите Заголовок.", "school" )
										),

										array(
											"type" => "textfield",
											"holder" => "div",
											"class" => "",
											"heading" => __( "Подзаголовок", "school" ),
											"param_name" => "subtitle",
											"value" => __( "", "school" ),
											"description" => __( "Введите подзаголовок.", "school" )
										),

										array(
											'type' => 'attach_image',
											'holder' => 'img',
											'class' => '',
											'heading' => __( 'Выберите картинку', 'school' ),
											'param_name' => 'image',
											'value' => __( '', 'school' ),
											'description' => __( 'Выберите картинку', 'school' ),
											'admin_label' => false,
											'weight' => 0
										),

										array(
											"type" => "textarea",
											"holder" => "div",
											"class" => "",
											"heading" => __( "Краткое описание", "school" ),
											"param_name" => "excerpt",
											"value" => __( "", "school" ),
											"description" => __( "Введите краткое описание.", "school" )
										),

										array(
											"type" => "textfield",
											"holder" => "div",
											"class" => "",
											"heading" => __( "Цена", "school" ),
											"param_name" => "price",
											"value" => __( "", "school" ),
											"description" => __( "Введите цену", "school" )
										),

										array(
											'type' => 'vc_link',
											'holder' => 'p',
											'class' => 'title-class',
											'heading' => __( 'Ссылка кнопки:', 'visotskiy' ),
											'param_name' => 'btn_link',
											'value' => "",
											'description' => __( 'Введите ссылку кнопки.', 'visotskiy' ),
											'admin_label' => false,
											'weight' => 0
										),

								),
						)
				);
				
		}
		 
		 
		// Element HTML
		public function vc_master_class_html( $atts, $content = null ) {
				 
				// Params extraction
				extract(
						shortcode_atts(
								array(
									'title' => '',
									'subtitle' => '',
									'image' => '',
									'excerpt' => '',
									'price' => '',
									'btn_link' => '',
								), 
								$atts
						)
				);
				 
				// Fill $html var with data
				$image_url 	= wp_get_attachment_image_url($image, 'full');

				$btn_href 	= vc_build_link($btn_link);

				$html = Timber::compile( 
					'partial/master-class.twig', 
					array(
						'title'					=> $title,
						'subtitle'			=> $subtitle,
						'image'					=> $image_url,
						'excerpt'				=> $excerpt,
						'price'					=> $price,
						'btn_link'			=> $btn_link,
					) 
				);

				return $html;
				 
		}
		 
} // End Element Class
 
 
// Element Class Init
new vcNewMasterClass();
?>