<?php
/**
 * Функции шаблона (function.php)
 * @package WordPress
 * @subpackage testtheme
 */

 /** Функция для лога */
 function _log($obj) {
    error_log(print_r($obj, true));
 }

 // Localization theme
function _l($sl){
	$ul = array_search(get_user_locale(), array('ru_RU', 'en_US', 'de-DE'));
	if (gettype($sl) !== 'array')
		return $sl;
	else 
		return isset($sl[$ul]) ? $sl[$ul] : $sl[0];
}

add_theme_support( 'title-tag' ); // теперь тайтл управляется самим вп

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );
function theme_name_scripts() {
    if(is_admin()) return false;
    wp_enqueue_script('flickity_js', get_template_directory_uri() . '/libs/flickity-slider/flickity.pkgd.js', array('jquery'), null, true );
    wp_enqueue_script('fancybox_js', get_template_directory_uri() . '/libs/fancybox/jquery.fancybox.js', array('jquery'), null, true );
    wp_enqueue_script('viewportchecker_js', get_template_directory_uri() . '/libs/viewportchecker/viewportchecker.js', array('jquery'), null, true );
    wp_enqueue_script('datetimepicker_js', get_template_directory_uri() . '/libs/datetimepicker/jquery.datetimepicker.full.js', array('jquery'), null, true );

    wp_enqueue_style( 'style_normalize', get_template_directory_uri() . '/css/normalize.css', array(), null );
    wp_enqueue_style( 'style_animate', get_template_directory_uri() . '/css/animate.min.css', array(), null );
    wp_enqueue_style( 'flickity_style', get_template_directory_uri() . '/libs/flickity-slider/flickity.css', array(), null );
    wp_enqueue_style( 'fancybox_style', get_template_directory_uri() . '/libs/fancybox/jquery.fancybox.css', array(), null );
    wp_enqueue_style( 'datetimepicker_style', get_template_directory_uri() . '/libs/datetimepicker/jquery.datetimepicker.min.css', array(), null );

    wp_enqueue_style( 'style', get_template_directory_uri() . '/css/styles.css', array(), '1.0' );
    wp_enqueue_style( 'style_media', get_template_directory_uri() . '/css/media.css', array(), '1.0' );
    wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true );
}

register_nav_menus(array(
	'main'    => 'Основное меню',
));

$settings = [];

add_filter( 'template_include', 'filter_template' );
function filter_template( $template ) {
    add_settings( 'appartament_desc' );
    add_settings( 'стоимость_одноместного_размещения' );
    add_settings( 'стоимость_двухместного_размещения' );
    add_settings( 'стоимость_трехместного_размещения' );
    add_settings( 'стоимость_четырехместного_размещения' );
    add_settings( 'стоимость_пятиместного_размещения' );
    add_settings( 'стоимость_шестиместного_размещения' );
    add_settings( 'в_выходные_стоимость_размещения' );
    add_settings( 'room-type' );
    add_settings( 'картинки_слева' );
    add_settings( 'картинки_по_центру' );
    add_settings( 'картинки_справа' );
    add_settings( 'главная_картинка' );

    add_settings( 'автобусы' );
    add_settings( 'троллейбусы' );
    add_settings( 'телефон_ок' );
    add_settings( 'email_ок' );
    
    add_settings( 'описание_спец_предложения' );
    add_settings( 'поле_1_спец_предложения' );
    add_settings( 'поле_2_спец_предложения' );

    add_settings( 'описание_отеля' );
    add_settings( 'описание_отеля_2' );
    add_settings( 'картинка_описания' );

    add_settings( 'описание_страницы' );
    
    $home_post_id = get_option( 'page_on_front' );
    $home = new WP_Query( array( 'page_id' => $home_post_id ));
    if( $home->have_posts() ) while ( $home->have_posts() )
    {
        $home->the_post();
        add_settings( 'site_phone_1' );
        add_settings( 'site_phone_2' );
        add_settings( 'site_address' );
        add_settings( 'адрес_в_контактах' );
        add_settings( 'site_e-mail' );
        add_settings( 'site_copyright' );

        add_settings( 'заголовок_окна' );
        add_settings( 'содержимое_окна' );
        add_settings( 'ссылка_на_пост' );
        add_settings( 'картинка_окна' );
    }
    if( is_front_page() ){
        add_settings( 'слайды' );
    }
    return $template;
}

function get_setting( $key ) {
    global $settings;
    return isset( $settings[ $key ] ) ? $settings[ $key ] : false;
}

function print_setting( $key ) {
    _e( get_setting( $key ) ? get_setting( $key ) : '' );
}

function add_settings( $setting ) {
    global $settings;
    if ( get_field( $setting ) )
        $settings[ $setting ] = get_field( $setting );
}

add_filter( 'nav_menu_css_class', 'additioan_menu_item_css_class', 10, 4 );
function additioan_menu_item_css_class( $classes, $item, $args, $depth ){
    if ($args->container_class == 'site-footer__menu')
        $classes[] = 'site-footer__menu-item';
    else
        $classes[] = 'menu__item';
	return $classes;
}

function add_menu_a_class($ulclass) {
    if ( preg_match('/site-footer__menu-item/', $ulclass) )
        return preg_replace('/<a /', '<a class="site-footer__menu-link" ', $ulclass);
    else
        return preg_replace('/<a /', '<a class="menu__link" ', $ulclass);
 }
 add_filter('wp_nav_menu','add_menu_a_class');

// Delete admin Post
function remove_posts() {
	remove_menu_page('edit.php');
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'remove_posts');

/** Add post_variants */
function my_post_type_apartments() {
	register_post_type('apartments', array(
		'labels' => array(
			'name'           => _l(array('Апартаменты', 'Apartment'))
		),
		'hierarchical' => false,
		'public' => true,
		'rewrite' => array(
			'slug'       => 'apartments',
			'with_front' => false,
		),
		'supports' => array(
			'page-attributes', // page parents
			'title',
			'editor',
			'thumbnail',
			'something-else',
		),
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'menu_position'     => 22,
		'menu_icon'         => 'dashicons-menu',
    ) );
    register_post_type('special_offers', array(
		'labels' => array(
			'name'           => _l(array('Спец. предложения', 'Apartment'))
		),
		'hierarchical' => false,
		'public' => true,
		'rewrite' => array(
			'slug'       => 'special_offers',
			'with_front' => false,
		),
		'supports' => array(
			'page-attributes', // page parents
			'title',
			'editor',
			'thumbnail',
			'something-else',
		),
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'menu_position'     => 22,
		'menu_icon'         => 'dashicons-menu',
	) );
	flush_rewrite_rules(); // Доступность на сайте
}
add_action('init', 'my_post_type_apartments');

?>