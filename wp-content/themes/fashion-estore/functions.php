<?php
/**
 * Fashion Estore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fashion Estore
 */

include get_theme_file_path( 'vendor/wptrt/autoload/src/Fashion_Estore_Loader.php' );

$fashion_estore_loader = new \WPTRT\Autoload\Fashion_Estore_Loader();

$fashion_estore_loader->fashion_estore_add( 'WPTRT\\Customize\\Section', get_theme_file_path( 'vendor/wptrt/customize-section-button/src' ) );

$fashion_estore_loader->fashion_estore_register();

if ( ! function_exists( 'fashion_estore_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fashion_estore_setup() {

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		*/
		add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

		add_theme_support( 'responsive-embeds' );

		add_theme_support( 'woocommerce' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
 		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

        add_image_size('fashion-estore-featured-header-image', 2000, 660, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary','fashion-estore' ),
	        'footer'=> esc_html__( 'Footer Menu','fashion-estore' ),
        ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'fashion_estore_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 50,
			'width'       => 50,
			'flex-width'  => true,
		) );

		add_editor_style( array( '/editor-style.css' ) );
		add_action('wp_ajax_fashion_estore_dismissable_notice', 'fashion_estore_dismissable_notice');

		add_theme_support( 'wp-block-styles' );

		add_theme_support( 'align-wide' );
	}
endif;
add_action( 'after_setup_theme', 'fashion_estore_setup' );

if ( ! function_exists( 'fashion_estore_file_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fashion_estore_file_setup() {

		// Customizer
		require get_parent_theme_file_path('/inc/customizer.php');

		require get_parent_theme_file_path( '/inc/get-started.php' );
	}
endif;
add_action( 'after_setup_theme', 'fashion_estore_file_setup' );

require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/* TGM. */
require get_parent_theme_file_path( '/inc/tgm.php' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fashion_estore_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fashion_estore_content_width', 1170 );
}
add_action( 'after_setup_theme', 'fashion_estore_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fashion_estore_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'fashion-estore' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'fashion-estore' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Woocommerce Shop Page Sidebar', 'fashion-estore' ),
		'id'            => 'woocommerce-shop-page-sidebar',
		'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Woocommerce Single Product Page Sidebar', 'fashion-estore' ),
		'id'            => 'woocommerce-single-product-page-sidebar',
		'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'fashion-estore' ),
		'id'            => 'fashion-estore-footer1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'fashion-estore' ),
		'id'            => 'fashion-estore-footer2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'fashion-estore' ),
		'id'            => 'fashion-estore-footer3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 4', 'fashion-estore' ),
		'id'            => 'fashion-estore-footer4',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'fashion_estore_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fashion_estore_scripts() {

	wp_enqueue_style(
		'montserrat',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' ),
		array(),
		'1.0'
	);

	wp_enqueue_style( 'fashion-estore-block-editor-style', get_theme_file_uri('/assets/css/block-editor-style.css') );

	// load bootstrap css
    wp_enqueue_style( 'bootstrap-css', esc_url(get_template_directory_uri()) . '/assets/css/bootstrap.css');

	wp_enqueue_style( 'fashion-estore-style', get_stylesheet_uri() );
	require get_parent_theme_file_path( '/custom-option.php' );
	wp_add_inline_style( 'fashion-estore-style',$fashion_estore_theme_css );

	wp_style_add_data('fashion-estore-basic-style', 'rtl', 'replace');

	// fontawesome
	wp_enqueue_style( 'fontawesome-css', esc_url(get_template_directory_uri()).'/assets/css/fontawesome/css/all.css' );

	wp_enqueue_style( 'owl.carousel-css', esc_url(get_template_directory_uri()).'/assets/css/owl.carousel.css' );

    wp_enqueue_script('owl.carousel-js', esc_url(get_template_directory_uri()) . '/assets/js/owl.carousel.js', array('jquery'), '', true );

    wp_enqueue_script('fashion-estore-theme-js', esc_url(get_template_directory_uri()) . '/assets/js/theme-script.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'fashion_estore_scripts' );

/**
 * Enqueue theme color style.
 */
function fashion_estore_theme_color() {

    $theme_color_css = '';
    $fashion_estore_theme_color = get_theme_mod('fashion_estore_theme_color');
     $fashion_estore_theme_color_2 = get_theme_mod('fashion_estore_theme_color_2');
    $fashion_estore_preloader_bg_color = get_theme_mod('fashion_estore_preloader_bg_color');
    $fashion_estore_preloader_dot_1_color = get_theme_mod('fashion_estore_preloader_dot_1_color');
    $fashion_estore_preloader_dot_2_color = get_theme_mod('fashion_estore_preloader_dot_2_color');
  	$fashion_estore_preloader2_dot_color = get_theme_mod('fashion_estore_preloader2_dot_color');
    $fashion_estore_logo_max_height = get_theme_mod('fashion_estore_logo_max_height');

	if(get_theme_mod('fashion_estore_logo_max_height') == '') {
		$fashion_estore_logo_max_height = '24';
	}

	if(get_theme_mod('fashion_estore_preloader_dot_1_color') == '') {
		$fashion_estore_preloader_dot_1_color = '#fff';
	}
	if(get_theme_mod('fashion_estore_preloader_dot_2_color') == '') {
		$fashion_estore_preloader_dot_2_color = '#f10026';
	}

	$theme_color_css = '
	.custom-logo-link img{
			max-height: '.esc_attr($fashion_estore_logo_max_height).'px;
		 }
		.sidebar h5,span.cart-value,.sticky .entry-title::before,#button,.sidebar input[type="submit"], .sidebar button[type="submit"],.comment-respond input#submit,.post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover, .posts-navigation .nav-previous a:hover, .posts-navigation .nav-next a:hover,.pro-button a, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.woocommerce .woocommerce-ordering select,.woocommerce-account .woocommerce-MyAccount-navigation ul li,.toggle-nav i,.wp-block-button__link,.menu_cat,.slider-inner-box,.sidebar .tagcloud a:hover,a.added_to_cart.wc-forward{
			background: '.esc_attr($fashion_estore_theme_color).';
		}
		a,#colophon a:hover, #colophon a:focus,.sidebar ul li a:hover,p.price, .woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price,.woocommerce-message::before, .woocommerce-info::before,.call-info i,.social-link i{
			color: '.esc_attr($fashion_estore_theme_color).';
		}
		.woocommerce-message, .woocommerce-info,.wp-block-pullquote,.wp-block-quote, .wp-block-quote:not(.is-large):not(.is-style-large), .wp-block-pullquote,.btn-primary,.post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover, .posts-navigation .nav-previous a:hover, .posts-navigation .nav-next a:hover{
			border-color: '.esc_attr($fashion_estore_theme_color).';
		}
		.main-navigation .sub-menu > li > a:hover, .main-navigation .sub-menu > li > a:focus,#button:hover,#button:active,.slide-btn a,.pro-button a:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.woocommerce-account .woocommerce-MyAccount-navigation ul li:hover,.menu_cat i,a.added_to_cart.wc-forward:hover{
			background: '.esc_attr($fashion_estore_theme_color_2).';
		}
		a:hover,h1,h2,h3,h4,h5,h6,.navbar-brand a,.navbar-brand p,a.cart-customlocation i,button.cat_btn,.product_cat h4 a,.home_product_cat h4 a,.slide-btn a:hover,.woocommerce ul.products li.product .onsale,.woocommerce span.onsale,.main-navigation .sub-menu,.sidebar li,.sidebar ul li,.sidebar select,.sidebar .tagcloud a,.call-info p,.social-link i:hover,.woocommerce ul.products li.product .star-rating, .woocommerce .star-rating{
			color: '.esc_attr($fashion_estore_theme_color_2).';
		}
		.loading, .loading2{
			background-color: '.esc_attr($fashion_estore_preloader_bg_color).';
		 }
		 @keyframes loading {
		  0%,
		  100% {
		  	transform: translatey(-2.5rem);
		    background-color: '.esc_attr($fashion_estore_preloader_dot_1_color).';
		  }
		  50% {
		  	transform: translatey(2.5rem);
		    background-color: '.esc_attr($fashion_estore_preloader_dot_2_color).';
		  }
		}
		.load hr {
			background-color: '.esc_attr($fashion_estore_preloader2_dot_color).';
		}
	';
    wp_add_inline_style( 'fashion-estore-style',$theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'fashion_estore_theme_color' );

/**
 * Enqueue S Header.
 */
function fashion_estore_sticky_header() {

	$fashion_estore_sticky_header = get_theme_mod('fashion_estore_sticky_header');

	$fashion_estore_custom_style= "";

	if($fashion_estore_sticky_header != true){

		$fashion_estore_custom_style .='.stick_header{';

			$fashion_estore_custom_style .='position: static;';

		$fashion_estore_custom_style .='}';
	}

	wp_add_inline_style( 'fashion-estore-style',$fashion_estore_custom_style );

}
add_action( 'wp_enqueue_scripts', 'fashion_estore_sticky_header' );

/** * Posts pagination. */
if ( ! function_exists( 'fashion_estore_blog_posts_pagination' ) ) {
	function fashion_estore_blog_posts_pagination() {
		$pagination_type = get_theme_mod( 'fashion_estore_blog_pagination_type', 'blog-nav-numbers' );
		if ( $pagination_type == 'blog-nav-numbers' ) {
			the_posts_pagination();
		} else {
			the_posts_navigation();
		}
	}
}

/*dropdown page sanitization*/
function fashion_estore_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function fashion_estore_preloader1(){
	if(get_theme_mod('fashion_estore_preloader_type', 'Preloader 1') == 'Preloader 1' ) {
		return true;
	}
	return false;
}

function fashion_estore_preloader2(){
	if(get_theme_mod('fashion_estore_preloader_type', 'Preloader 1') == 'Preloader 2' ) {
		return true;
	}
	return false;
}

function fashion_estore_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

function fashion_estore_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}

/*radio button sanitization*/
function fashion_estore_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function fashion_estore_sanitize_select( $input, $setting ){
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function fashion_estore_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

function fashion_estore_sanitize_checkbox( $input ) {
	// Boolean check
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

 //Float
function fashion_estore_sanitize_float( $input ) {
    return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}

function fashion_estore_sanitize_number_range( $number, $setting ) {
	
	// Ensure input is an absolute integer.
	$number = absint( $number );
	
	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;
	
	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );
	
	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );
	
	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );
	
	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'fashion_estore_shop_per_page', 9 );
function fashion_estore_shop_per_page( $cols ) {
  	$cols = get_theme_mod( 'fashion_estore_product_per_page', 9 );
	return $cols;
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'fashion_estore_loop_columns');
if (!function_exists('fashion_estore_loop_columns')) {
	function fashion_estore_loop_columns() {
		$columns = get_theme_mod( 'fashion_estore_products_per_row', 3 );
		return $columns; // 3 products per row
	}
}

add_action( 'wp_ajax_fashion-estore-check-plugin-exists', 'fashion_estore_check_plugin_exists' );
add_action( 'wp_ajax_fashion_estore_install_and_activate_plugin', 'fashion_estore_install_and_activate_plugin' );

require_once get_parent_theme_file_path( '/inc/class-tm-helper.php' );

function fashion_estore_check_plugin_exists() {
	$plugin_text_domain = $_POST['plugin_text_domain'];
	$main_plugin_file 	= $_POST['main_plugin_file'];
	$plugin_path = $plugin_text_domain . '/' . $main_plugin_file;

	$get_plugins					= get_plugins();
	$is_plugin_installed	= false;
	$activation_status 		= false;
	if ( isset( $get_plugins[$plugin_path] ) ) {
		$is_plugin_installed = true;

		$activation_status = is_plugin_active( $plugin_path );
	}
	wp_send_json_success(
		array(
			'install_status'  =>	$is_plugin_installed,
			'active_status'		=>	$activation_status,
			'plugin_path'			=>	$plugin_path,
			'plugin_slug'			=>	$plugin_text_domain
		)
	);
}

function fashion_estore_install_and_activate_plugin() {
	$post_plugin_details = $_POST['plugin_details'];
	$plugin_text_domain = $post_plugin_details['plugin_text_domain'];
	$plugin_main_file		=	$post_plugin_details['plugin_main_file'];
	$plugin_url					=	$post_plugin_details['plugin_url'];

	$plugin = array(
		'text_domain'	=> $plugin_text_domain,
		'path' 				=> $plugin_url,
		'install' 		=> $plugin_text_domain . '/' . $plugin_main_file
	);

	$is_installed = fashion_estore_get_plugins( $plugin );

	$msg = '';
	if ( $is_installed ) {
		$is_installed = true;
		$msg = 'Plugin Installed Successfully!';
	} else {
		$is_installed = false;
		$msg = 'Something Went Wrong!';
	}
	$response = array( 'status' => $is_installed, 'msg' => $msg );
	wp_send_json( $response );
	exit;
}
function fashion_estore_get_plugins( $plugin ) {
	$args = array(
		'path'					=>	ABSPATH . 'wp-content/plugins/',
		'preserve_zip'	=>	false
	);

	$get_plugins = get_plugins();
	if ( !isset( $get_plugins[ trim( $plugin['install'] ) ] ) ) {
		fashion_estore_plugin_download( $plugin['path'], $args['path'] . $plugin['text_domain'] . '.zip' );
		fashion_estore_plugin_unpack( $args, $args['path'] . $plugin['text_domain'] . '.zip' );
		// sleep( 3 );
	}
	$is_activated = fashion_estore_plugin_activate( $plugin['install'] );
	return $is_activated;
}

function fashion_estore_plugin_download($url, $path) {
    $response = wp_safe_remote_get($url);

    if (is_wp_error($response)) {
        return false; // Error occurred during HTTP request
    }

    $body = wp_remote_retrieve_body($response);

    if (file_put_contents($path, $body)) {
        return true;
    } else {
        return false;
    }
}

function fashion_estore_plugin_unpack( $args, $target ) {

	$file_system = Fashion_Estore_Helper::get_instance()->get_filesystem();

	$plugin_path = WP_PLUGIN_DIR . '/';

	/* Acceptable way to use the function */
	$file	=	$target;
	$to		=	$plugin_path;

	$result = unzip_file( $file, $to );

	if( $result !== true ) {
		return false;
	} else {
		wp_delete_file( $file );
		return true;
	}
}

function fashion_estore_plugin_activate( $installer ) {
	wp_cache_flush();

	$plugin = plugin_basename( trim( $installer ) );
	$activate_plugin = activate_plugin( $plugin );
	return true;
}

// Demo Content Code

// Ensure WordPress is loaded
if (!defined('ABSPATH')) {
    exit;
}



// Add admin menu page to trigger theme import
add_action('admin_menu', 'fashion_estore_demo_importer_admin_page');

function fashion_estore_demo_importer_admin_page() {
    add_theme_page(
        'Demo Theme Importer',     // Page title
        'Theme Importer',          // Menu title
        'manage_options',          // Capability
        'theme-importer',          // Menu slug
        'fashion_estore_demo_importer_page',      // Callback function
    );
}

// Display the page content with the button
function fashion_estore_demo_importer_page() {
    ?>
    <div class="wrap-main-box">
        <div class="main-box">
            <h2><?php echo esc_html('Welcome to Fashion Estore','fashion-estore'); ?></h2>
            <h3><?php echo esc_html('Create your website in just one click','fashion-estore'); ?></h3>
            <hr>
            <p><?php echo esc_html('The "Begin Installation" helps you quickly set up your website by importing sample content that mirrors the demo version of the theme. This tool provides you with a ready-made layout and structure, so you can easily see how your site will look and start customizing it right away. It\'s a straightforward way to get your site up and running with minimal effort.','fashion-estore'); ?></p>
            <p><?php echo esc_html('Click the button below to install the demo content.','fashion-estore'); ?></p>
            <hr>
            <button id="import-theme-mods" class="button button-primary"><?php echo esc_html('Begin Installation','fashion-estore'); ?></button>
            <div id="import-response"></div>
        </div>
    </div>
    <?php
}

// Add the AJAX action to trigger theme mods import
add_action('wp_ajax_import_theme_mods', 'demo_importer_ajax_handler');

// Handle the AJAX request
function demo_importer_ajax_handler() {
    // Sample data to import
    $theme_mods_data = array(
        'header_textcolor' => '000000',  // Example: change header text color
        'background_color' => 'ffffff',  // Example: change background color
        'custom_logo'      => 123,       // Example: set a custom logo by attachment ID
        'footer_text'      => 'Custom Footer Text', // Example: custom footer text
    );

    // Call the function to import theme mods
    if (fashion_estore_demo_theme_importer($theme_mods_data)) {
        // After importing theme mods, create the menu
        fashion_estore_create_demo_menu();
        wp_send_json_success(array(
        	'msg' => 'Theme mods imported successfully.',
        	'redirect' => home_url()
        ));
    } else {
        wp_send_json_error('Failed to import theme mods.');
    }

    wp_die();
}

// Function to set theme mods
function fashion_estore_demo_theme_importer($import_data) {
    if (is_array($import_data)) {
        foreach ($import_data as $mod_name => $mod_value) {
            set_theme_mod($mod_name, $mod_value);
        }
        return true;
    } else {
        return false;
    }
}

// Function to create demo menu
function fashion_estore_create_demo_menu() {
    // Page import process
	$pages_to_create = array(
	    array(
	        'title'    => 'Home',
	        'slug'     => 'home',
	        'template' => 'page-template/home-template.php',
	    ),
	    array(
	        'title'    => 'About',
	        'slug'     => 'about',
	        'template' => '',
	    ),
	    array(
	        'title'    => 'Services',
	        'slug'     => 'services',
	        'template' => '',
	    ),
	    array(
	        'title'    => 'Blog',
	        'slug'     => 'blog',
	        'template' => '',
	    ),
	    array(
	        'title'    => 'Contact',
	        'slug'     => 'contact',
	        'template' => '',
	    ),
	);

	// Loop through each page data to create pages
	foreach ($pages_to_create as $page_data) {
	    $page_check = get_page_by_title($page_data['title']);
	    
	    // Check if the page doesn't exist already
	    if (!$page_check) {
	        $page = array(
	            'post_type'    => 'page',
	            'post_title'   => $page_data['title'],
	            'post_status'  => 'publish',
	            'post_author'  => 1,
	            'post_name'    => $page_data['slug'],
	        );
	        
	        // Insert the page and get the inserted page ID
	        $page_id = wp_insert_post($page);
	        
	        // Set the page template
	        if ($page_id && !empty($page_data['template'])) {
	            add_post_meta($page_id, '_wp_page_template', $page_data['template']);
	        }
	    }
	}

	// Set 'Home' as the front page
	$home_page = get_page_by_title('Home');
	if ($home_page) {
	    update_option('page_on_front', $home_page->ID);
	    update_option('show_on_front', 'page');
	}

	// Set 'Blog' as the posts page
	$blog_page = get_page_by_title('Blog');
	if ($blog_page) {
	    update_option('page_for_posts', $blog_page->ID);
	}

	// ------- Create Primary Menu --------
	$menuname = 'Primary Menu';
	$bpmenulocation = 'primary';
	$menu_exists = wp_get_nav_menu_object($menuname);

	if (!$menu_exists) {
	    $menu_id = wp_create_nav_menu($menuname);
	    
	    wp_update_nav_menu_item($menu_id, 0, array(
	        'menu-item-title' => __('HOME', 'fashion-estore'),
	        'menu-item-classes' => 'home',
	        'menu-item-url' => home_url('/'),
	        'menu-item-status' => 'publish'
	    ));
	    wp_update_nav_menu_item($menu_id, 0, array(
	        'menu-item-title' => __('SHOP', 'fashion-estore'),
	        'menu-item-classes' => 'shop',
	        'menu-item-url' => home_url('/shop'),
	        'menu-item-status' => 'publish'
	    ));
	    wp_update_nav_menu_item($menu_id, 0, array(
	        'menu-item-title' => __('FEATURES ', 'fashion-estore'),
	        'menu-item-classes' => 'features',
	        'menu-item-url' => home_url('/features'),
	        'menu-item-status' => 'publish'
	    ));
	    wp_update_nav_menu_item($menu_id, 0, array(
	        'menu-item-title' => __('PAGES', 'fashion-estore'),
	        'menu-item-classes' => 'pages',
	        'menu-item-url' => home_url('/pages'),
	        'menu-item-status' => 'publish'
	    ));
	    wp_update_nav_menu_item($menu_id, 0, array(
	        'menu-item-title' => __('BLOG', 'fashion-estore'),
	        'menu-item-classes' => 'blog',
	        'menu-item-url' => home_url('/blog'),
	        'menu-item-status' => 'publish'
	    ));

	    // Assign the menu to the location
	    if (!has_nav_menu($bpmenulocation)) {
	        $locations = get_theme_mod('nav_menu_locations');
	        $locations[$bpmenulocation] = $menu_id;
	        set_theme_mod('nav_menu_locations', $locations);
	    }
	}

    
    //Top Header
    set_theme_mod( 'fashion_estore_facebook_icon', 'fab fa-facebook-f' );
    set_theme_mod( 'fashion_estore_facebook_url', '#' );
    set_theme_mod( 'fashion_estore_twitter_icon', 'fab fa-twitter' );
    set_theme_mod( 'fashion_estore_twitter_url', '#' );
    set_theme_mod( 'fashion_estore_intagram_icon', 'fab fa-instagram' );
    set_theme_mod( 'fashion_estore_intagram_url', '#' );
    set_theme_mod( 'fashion_estore_linkedin_icon', 'fab fa-linkedin-in' );
    set_theme_mod( 'fashion_estore_linkedin_url', '#' );
    set_theme_mod( 'fashion_estore_pintrest_icon', 'fab fa-pinterest-p' );
    set_theme_mod( 'fashion_estore_pintrest_url', '#' );

    set_theme_mod( 'fashion_estore_phone_number_icon', 'fas fa-phone' );
    set_theme_mod( 'fashion_estore_phone_number_text', 'FOR SALES & SERVICES' );
    set_theme_mod( 'fashion_estore_phone_number_info', '1234567890' );

    //Slider

   	for($i=1;$i<=3;$i++){
         $title = 'NEW ARRIVALS JUST FOR YOU';
         $content = 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin.';
            // Create post object
         $my_post = array(
         'post_title'    => wp_strip_all_tags( $title ),
         'post_content'  => $content,
         'post_status'   => 'publish',
         'post_type'     => 'page',
         );

         // Insert the post into the database
         $post_id = wp_insert_post( $my_post );

         if ($post_id) {
	        // Set the theme mod for the slider page
	        set_theme_mod('fashion_estore_top_slider_page' . $i, $post_id);

	        $image_url = get_template_directory_uri().'/assets/img/slider.png';

			$image_id = media_sideload_image($image_url, $post_id, null, 'id');

		        if (!is_wp_error($image_id)) {
		            // Set the downloaded image as the post's featured image
		            set_post_thumbnail($post_id, $image_id);
		        }
      	}
    }

    set_theme_mod( 'fashion_estore_slider_button_text', 'SHOP NOW' );

    // Products

	if ( class_exists( 'WooCommerce' ) ) {

		$review_text = array(
			'Nice product',
			'Good Quality Product',
			'Nice Product. Must buy It.',
			'I like this Product',
			'Nice Product',
		);
		// Define 10 product categories
		$category_names = array(
			'MEN', 'WOMEN', 'ELECTRONICS', 'JEWELLERY', 'SHOES','KIDS WEAR', 'SPORTS', 'TOY', 'GIFT CORNRER');

		// Ensure all categories exist
		foreach ( $category_names as $cat_name ) {
			if ( ! term_exists( $cat_name, 'product_cat' ) ) {
				wp_insert_term( $cat_name, 'product_cat' );
			}
		}

		for($i=1;$i<=4;$i++){
	        $title = 'Simple Dummy Text';
	        $content = 'Lorem Ipsum has been the industrys standard dummy text ever since the 1500 when an unknown printer took a galley of type and scrambled it to make a type specimen book Lorem Ipsum has been the industrys standard dummy text ever since the 1500 when an unknown printer took a galley of type and scrambled it to make a type specimen book.';
	        $excerpt = 'Lorem Ipsum has been the industrys standard dummy text ever since the 1500 when an unknown printer took a galley of type and scrambled it to make a type specimen book Lorem Ipsum has been the industrys standard dummy text ever since the 1500 when an unknown printer took a galley of type and scrambled it to make a type specimen book.';
	        // Create post object
	        $my_post = array(
	            'post_title'    => wp_strip_all_tags( $title ),
	            'post_content'  => $content,
	            'post_status'   => 'publish',
	            'post_type'     => 'product',
	            'post_excerpt'	=> $excerpt
	        );
	     
	        // Insert the post into the database
	        $post_id = wp_insert_post( $my_post );
	        // array_push( $_product_ids, $post_id );

			for ( $c=0; $c <= 5; $c++ ) {
				$comment_id = wp_insert_comment( array(
					'comment_post_ID'      => $post_id,
					'comment_author'       => get_the_author_meta( 'display_name' ),
					'comment_author_email' => get_the_author_meta( 'user_email' ),
					'comment_content'      => $review_text[$c],
					'comment_parent'       => 0,
					'user_id'              => get_current_user_id(), // <== Important
					'comment_date'         => date('Y-m-d H:i:s'),
					'comment_approved'     => 1,
				) );

				update_comment_meta( $comment_id, 'rating', 
				3 );
			}

			update_post_meta( $post_id, '_regular_price', "120" );
	        update_post_meta( $post_id, '_sale_price', "80" );
	        update_post_meta( $post_id, '_price', "80" );

	        update_post_meta($post_id, 'total_sales', '120');
	        update_post_meta($post_id, '_manage_stock', 'true');
	        update_post_meta($post_id, '_stock', '100');

	        $image_url = get_template_directory_uri().'/assets/img/product'.$i.'.png';

	        wp_set_object_terms($post_id, array('Featured'), 'product_cat');

	        $image_name= 'product'.$i.'.png';
	        $upload_dir       = wp_upload_dir(); 
	        // Set upload folder
	        $image_data= file_get_contents($image_url); 
	        // Get image data
	        $unique_file_name = wp_unique_filename( $upload_dir['path'], $image_name ); 
	        // Generate unique name
	        $filename= basename( $unique_file_name ); 
	        // Create image file name

	        // Check folder permission and define file location
	        if( wp_mkdir_p( $upload_dir['path'] ) ) {
	        	$file = $upload_dir['path'] . '/' . $filename;
	        } else {
	        	$file = $upload_dir['basedir'] . '/' . $filename;
	    	}

	        // Create the image  file on the server
	        file_put_contents( $file, $image_data );

	        // Check image file type
	        $wp_filetype = wp_check_filetype( $filename, null );

	        // Set attachment data
	        $attachment = array(
	        'post_mime_type' => $wp_filetype['type'],
	        'post_title'     => sanitize_file_name( $filename ),
	        'post_content'   => '',
	        'post_type'     => 'product',
	        'post_status'    => 'inherit'
	        );

	        // Create the attachment
	        $attach_id = wp_insert_attachment( $attachment, $file, $post_id );

	        // Include image.php
	        require_once(ABSPATH . 'wp-admin/includes/image.php');

	        // Define attachment metadata
	        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

	        // Assign metadata to attachment
	        wp_update_attachment_metadata( $attach_id, $attach_data );

	        // And finally assign featured image to post
	        set_post_thumbnail( $post_id, $attach_id );
	    }
		}

	
}
// Enqueue necessary scripts
add_action('admin_enqueue_scripts', 'demo_importer_enqueue_scripts');

function demo_importer_enqueue_scripts() {
    wp_enqueue_script(
        'demo-theme-importer',
        get_template_directory_uri() . '/assets/js/theme-importer.js', // Path to your JS file
        array('jquery'),
        null,
        true
    );

    	wp_enqueue_style('demo-importer-style', get_template_directory_uri() . '/assets/css/importer.css', array(), '');

    // Localize script to pass AJAX URL to JS
    wp_localize_script(
        'demo-theme-importer',
        'demoImporter',
        array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('theme_importer_nonce')
        )
    );
}

//woocommerce plugin skip 
add_filter( 'woocommerce_prevent_automatic_wizard_redirect', '__return_true' );