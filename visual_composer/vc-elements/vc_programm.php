<?php
/*
Element Description: VC Info Box
*/
 
// Element Class 
class vcNewProgramm extends WPBakeryShortCode {
		 
		// Element Init
		function __construct() {
				add_action( 'init', array( $this, 'vc_programm_mapping' ) );
				add_shortcode( 'vc_programm', array( $this, 'vc_programm_html' ) );
		}
		 
		// Element Mapping
		public function vc_programm_mapping() {
				 
				// Stop all if VC is not enabled
				if ( !defined( 'WPB_VC_VERSION' ) ) {
						return;
				}
				 
				// Map the block with vc_map()
				vc_map( 
						array(
								'name' => __('Программа', 'school'),
								'base' => 'vc_programm',
								'description' => __('', 'school'), 
								'category' => __('Для работы с сайтом', 'school'),         
								'params' => array(
										array(
										  "type" => "colorpicker",
										  "class" => "",
										  "heading" => __( "Цвет", "school" ),
										  "param_name" => "color",
										  "value" => '', 
										  "description" => __( "Введите цвет блока программы.", "school" )
										),

										array(
											'type' => 'attach_image',
											'holder' => 'img',
											'class' => '',
											'heading' => __( 'Выберите иконку', 'school' ),
											'param_name' => 'icon',
											'value' => __( '', 'school' ),
											'description' => __( 'Выберите иконку', 'school' ),
											'admin_label' => false,
											'weight' => 0
										),

										array(
											"type" => "textarea",
											"holder" => "div",
											"class" => "",
											"heading" => __( "Заголовок", "school" ),
											"param_name" => "title",
											"value" => __( "", "school" ),
											"description" => __( "Введите Заголовок.", "school" )
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
											"type" => "textarea",
											"holder" => "div",
											"class" => "",
											"heading" => __( "Статус", "school" ),
											"param_name" => "status",
											"value" => __( "", "school" ),
											"description" => __( "Введите статус", "school" )
										),
										
										array(
											"type" => "textarea_html",
											"holder" => "div",
											"class" => "",
											"heading" => __( "Описание:", "school" ),
											"param_name" => "content",
											"value" => __( "", "school" ),
											"description" => __( "Введите описание.", "school" )
										),

										array(
											'type' => 'textarea',
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
		public function vc_programm_html( $atts, $content = null ) {
				 
				// Params extraction
				extract(
						shortcode_atts(
								array(
									"color"			=> '',
									"icon"			=> '',
									"title"			=> '',
									"excerpt"		=> '',
									"status"		=> '',
									"btn_link"	=> '',
								), 
								$atts
						)
				);
				 
				// Fill $html var with data
				$icon_url = wp_get_attachment_image_url($icon, 'full');

				$link = '<a href="'.$btn_link.'" class="btn btn_brand-1 btn_lg programm__button" target="_blank">Узнать подробности</a>';

				$html = '
				<div class="programm" style="background-color: '.$color.'">
					<div class="programm__header">
						<img src="'.$icon_url.'" alt="'.$title.'" class="programm__header-icon">
						<p class="programm__header-title">'.$title.'</p>
					</div>
					<div class="programm__body">
						<p class="programm__excerpt">'.$excerpt.'</p>
						<div class="programm__info">'.$status.'</div>
					</div>
					<div class="programm__content">'.wpautop($content).'</div>
					<div class="programm__footer">'.$link.'</div>
				</div>';

				return $html;
				 
		}
		 
} // End Element Class
 
 
// Element Class Init
new vcNewProgramm();
?>