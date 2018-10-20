<?php
/*
Element Description: VC Info Box
*/
 
// Element Class 
class vcInfoBox extends WPBakeryShortCode {
		 
		// Element Init
		function __construct() {
				add_action( 'init', array( $this, 'vc_infobox_mapping' ) );
				add_shortcode( 'vc_infobox', array( $this, 'vc_infobox_html' ) );
		}
		 
		// Element Mapping
		public function vc_infobox_mapping() {
				 
				// Stop all if VC is not enabled
				if ( !defined( 'WPB_VC_VERSION' ) ) {
						return;
				}
				 
				// Map the block with vc_map()
				vc_map( 
						array(
								'name' => __('Заголовок', 'visotskiy'),
								'base' => 'vc_infobox',
								'description' => __('Заголовок', 'visotskiy'), 
								'category' => __('Для работы с сайтом', 'visotskiy'),         
								'params' => array(
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
											"type" => "textfield",
											"class" => "",
											"heading" => __( "Очередность заголовка", "visotskiy" ),
											"param_name" => "title_status",
											"value" => __( "", "visotskiy" ),
											"description" => __( "1,2,3,4,5,6", "visotskiy" )
										),
										array(
											"type" => "textfield",
											"holder" => "div",
											"class" => "",
											"heading" => __( "Дополнительный класс", "visotskiy" ),
											"param_name" => "title_class",
											"value" => __( "", "visotskiy" ),
											"description" => __( "Необязательно.", "visotskiy" )
										),
										array(
											"type" => "textarea",
											"holder" => "div",
											"class" => "",
											"heading" => __( "Подзаголовок", "visotskiy" ),
											"param_name" => "subtitle",
											"value" => __( "", "visotskiy" ),
											"description" => __( "Введите Заголовок.", "visotskiy" )
										),
										array(
											"type" => "textfield",
											"holder" => "div",
											"class" => "",
											"heading" => __( "Дополнительный класс", "visotskiy" ),
											"param_name" => "subtitle_class",
											"value" => __( "", "visotskiy" ),
											"description" => __( "Необязательно.", "visotskiy" )
										)
								),
						)
				);
				
		}
		 
		 
		// Element HTML
		public function vc_infobox_html( $atts, $content = null ) {
				 
				// Params extraction
				extract(
						shortcode_atts(
								array(
									'title'								=> '',
									'title_class' 				=> '',
									'title_status'				=> '3',
									'subtitle'						=> '',
									'subtitle_class' 			=> '',
								), 
								$atts
						)
				);
				 
				// Fill $html var with data
				$html = '<div class="section__header">';
					$html .= '<h'.$title_status.' class="section__title '.$title_class.'">' . $title . '</h'.$title_status.'>';
					if(isset($subtitle) && $subtitle != ""){
						$html .= '<p'.$subtitle_status.' class="section__subtitle '.$subtitle_class.'">' . $subtitle . '</h'.$subtitle_status.'>';
					}
				$html .= '</div>';
				 
				return $html;
				 
		}
		 
} // End Element Class
 
 
// Element Class Init
new vcInfoBox();
?>