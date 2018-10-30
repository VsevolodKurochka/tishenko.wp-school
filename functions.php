<?php

/**
 * Plugins connect
 */
require get_template_directory() . '/tgm/connect.php';

/**
 * Visual Composer Init
 */
require get_template_directory() . '/visual_composer/visual_composer_init.php';

/**
 * Custom functions
 */
require get_template_directory() . '/functions-custom.php';

/**
 * Shortcodes
 */
require get_template_directory() . '/shortcodes.php';


if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
	});
	
	add_filter('template_include', function($template) {
		return get_stylesheet_directory() . '/no-timber.html';
	});
	
	return;
}

Timber::$dirname = array('templates', 'views');

class StarterSite extends TimberSite {

	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'custom-logo' );

		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_action( 'widgets_init', array( $this, 'generate_widgets' ) );


		add_action( 'wp_footer', array( $this, 'register_scripts' ) );
		add_filter('upload_mimes', array($this, 'cc_mime_types'), 1, 1);

		//add_action( 'after_setup_theme', array($this, 'mytheme_add_woocommerce_support') );


		$this->add_options_page();
		$this->generate_menu();


		parent::__construct();
	}

	function register_post_types() {
		//this is where you can register custom post types
		register_post_type('master-classes', array(
			'label'  => null,
			'labels' => array(
				'name'               => 'Мастер классы', // основное название для типа записи
				'singular_name'      => 'Мастер классы', // название для одной записи этого типа
				'add_new'            => 'Добавить мастер класс', // для добавления новой записи
				'add_new_item'       => 'Добавление мастер класса', // заголовка у вновь создаваемой записи в админ-панели.
				'edit_item'          => 'Редактирование мастер класса', // для редактирования типа записи
				'new_item'           => 'Новый мастер класс', // текст новой записи
				'view_item'          => 'Смотреть мастер класс', // для просмотра записи этого типа.
				'search_items'       => 'Искать мастер класс', // для поиска по этим типам записи
				'not_found'          => 'Не найдено мастер классов', // если в результате поиска ничего не было найдено
				'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
				'parent_item_colon'  => '', // для родителей (у древовидных типов)
				'menu_name'          => 'Мастер классы', // название меню
			),
			'description'         => '',
			'public'              => true,
			'hierarchical'        => false,
			'supports'            => array('title', 'thumbnail', 'editor'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
			'taxonomies'          => array('mc-category', 'mc-tag'),
			'has_archive'         => true,
			'rewrite'             => true,
			'query_var'           => true
		) );
	}

	function register_taxonomies() {
		//this is where you can register custom taxonomies
		register_taxonomy('mc-category', array('master-classes'), array(
			'label'                 => '', // определяется параметром $labels->name
			'labels'                => array(
				'name'              => 'Категории мастер-классов',
				'singular_name'     => 'Категории мастер-классов',
				'search_items'      => 'Искать категории мастер-классов',
				'all_items'         => 'Все категории мастер-классов',
				'view_item '        => 'Смотреть категорию мастер-классов',
				'parent_item'       => 'Родительская категория мастер-классов',
				'parent_item_colon' => 'Родительская категория мастер-классов:',
				'edit_item'         => 'Редактировать категорию мастер-классов',
				'update_item'       => 'Обновить категория мастер-классов',
				'add_new_item'      => 'Добавить категорию мастер-классов',
				'new_item_name'     => 'Добавить новую категорию мастер-классов',
				'menu_name'         => 'Категории',
			),
			'description'           => 'Категории для мастер-классов', // описание таксономии
			'public'                => true,
			'hierarchical'          => false,
			'rewrite' 							=> true,
			'query_var' 						=> true,
		) );

		// Метки
		register_taxonomy('mc-tag', array('master-classes'), array(
			'label'                 => '', // определяется параметром $labels->name
			'labels'                => array(
				'name'              => 'Метки мастер-классов',
				'singular_name'     => 'Метки мастер-классов',
				'search_items'      => 'Искать Метки мастер-классов',
				'all_items'         => 'Все Метки мастер-классов',
				'view_item '        => 'Смотреть метку мастер-классов',
				'parent_item'       => 'Родительская метка мастер-классов',
				'parent_item_colon' => 'Родительская метка мастер-классов:',
				'edit_item'         => 'Редактировать метку мастер-классов',
				'update_item'       => 'Обновить метка мастер-классов',
				'add_new_item'      => 'Добавить метку мастер-классов',
				'new_item_name'     => 'Добавить новую метку мастер-классов',
				'menu_name'         => 'Метки',
			),
			'description'           => 'Категории для мастер-классов', // описание таксономии
			'public'                => true,
			'hierarchical'          => false,
			'rewrite' 							=> true,
			'query_var' 						=> true,
		) );
	}

	function register_scripts() {
		wp_enqueue_style( 'css-style', get_stylesheet_uri() );

		
		wp_enqueue_style( 'css-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=cyrillic' );

		wp_enqueue_style( 'css-main', get_template_directory_uri() . '/static/build/css/style.min.css' );

		wp_enqueue_script( 'js-libs', get_template_directory_uri() . '/static/build/js/scripts.min.js', array(), '20151215', true );
	}

	function generate_menu() {
		
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Меню в шапке', 'school' ),
			'menu-footer' => esc_html__( 'Меню в футере', 'school' ),
			'menu-footer-1' => esc_html__( 'Меню в футере(компания)', 'school' ),
			'menu-footer-2' => esc_html__( 'Меню в футере(программы)', 'school' ),
		) );
	}

	function generate_widgets(){
		register_sidebar( array(
			'name' => 'Сайдбар для блога',
			'id' => 'blog_sidebar',
			'before_widget' => '<div class="sidebar__item">',
			'after_widget' => '</div>',
			'before_title' => '<p class="sidebar__title">',
			'after_title' => '</p>',
		));

		register_sidebar( array(
			'name' => 'Сайдбар для магазина',
			'id' => 'shop_sidebar',
			'before_widget' => '<div class="sidebar__item">',
			'after_widget' => '</div>',
			'before_title' => '<p class="sidebar__title">',
			'after_title' => '</p>',
		));

		register_sidebar( array(
			'name' => 'Сайдбар для мастер-классов',
			'id' => 'mc_sidebar',
			'before_widget' => '<div>',
			'after_widget' => '</div>',
			'before_title' => '<p>',
			'after_title' => '</p>',
		));
	}

	function mytheme_add_woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}

	function add_options_page() {
		acf_add_options_page();
	}

	function cc_mime_types($mimes) {
		$mimes['svg'] = 'image/svg+xml';
		$mimes['pdf'] = 'application/pdf';
		return $mimes;
	}


	function add_to_context( $context ) {
		$context['menu'] = new TimberMenu('menu-1');
		$context['menu_footer'] = new TimberMenu('menu-footer');
		$context['menu_footer_1'] = new TimberMenu('menu-footer-1');
		$context['menu_footer_2'] = new TimberMenu('menu-footer-2');
		$context['options'] = get_fields('option');
		$context['theme_url'] = get_template_directory_uri();
		$context['site'] = $this;
		return $context;
	}


	function add_to_twig( $twig ) {
		/* this is where you can add your own functions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter('myfoo', new Twig_SimpleFilter('myfoo', array($this, 'myfoo')));
		return $twig;
	}

}

new StarterSite();
