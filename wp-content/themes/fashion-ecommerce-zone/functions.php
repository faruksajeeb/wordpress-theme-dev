<?php
/**
 * Fashion Ecommerce Zone functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fashion Ecommerce Zone
 */

function fashion_ecommerce_zone_file_setup() {
    if ( ! defined( 'FASHION_ESTORE_URL' ) ) {
        define( 'FASHION_ESTORE_URL', esc_url( 'https://www.themagnifico.net/products/fashion-portfolio-wordpress-theme', 'fashion-ecommerce-zone') );
    }
    if ( ! defined( 'FASHION_ESTORE_TEXT' ) ) {
        define( 'FASHION_ESTORE_TEXT', __( 'Fahion Ecommerce Pro','fashion-ecommerce-zone' ));
    }
    if ( ! defined( 'FASHION_ESTORE_CONTACT_SUPPORT' ) ) {
        define('FASHION_ESTORE_CONTACT_SUPPORT',__('https://wordpress.org/support/theme/fashion-ecommerce-zone','fashion-ecommerce-zone'));
    }
    if ( ! defined( 'FASHION_ESTORE_REVIEW' ) ) {
        define('FASHION_ESTORE_REVIEW',__('https://wordpress.org/support/theme/fashion-ecommerce-zone/reviews/#new-post','fashion-ecommerce-zone'));
    }
    if ( ! defined( 'FASHION_ESTORE_LIVE_DEMO' ) ) {
        define('FASHION_ESTORE_LIVE_DEMO',__('https://demo.themagnifico.net/fashion-ecommerce-zone/','fashion-ecommerce-zone'));
    }
    if ( ! defined( 'FASHION_ESTORE_GET_PREMIUM_PRO' ) ) {
        define('FASHION_ESTORE_GET_PREMIUM_PRO',__('https://www.themagnifico.net/products/fashion-portfolio-wordpress-theme','fashion-ecommerce-zone'));
    }
    if ( ! defined( 'FASHION_ESTORE_PRO_DOC' ) ) {
        define('FASHION_ESTORE_PRO_DOC',__('https://demo.themagnifico.net/eard/wathiqa/fashion-ecommerce-zone-pro-doc/','fashion-ecommerce-zone'));
    }
    if ( ! defined( 'FASHION_ESTORE_FREE_DOC' ) ) {
        define('FASHION_ESTORE_FREE_DOC',__('https://demo.themagnifico.net/eard/wathiqa/fashion-ecommerce-zone-free-doc/','fashion-ecommerce-zone'));
    }
    if ( ! defined( 'FASHION_ESTORE_BUY_TEXT' ) ) {
        define( 'FASHION_ESTORE_BUY_TEXT', __( 'Buy Fahion Ecommerce Pro','fashion-ecommerce-zone' ));
    }

    if ( ! defined( 'FASHION_ESTORE_LINK' ) ) {
        define( 'FASHION_ESTORE_LINK', esc_url( 'https://www.themagnifico.net/themes/fashion-portfolio-wordpress-theme/', 'fashion-ecommerce-zone') );
    }
}
add_action( 'after_setup_theme', 'fashion_ecommerce_zone_file_setup' );

function fashion_ecommerce_zone_enqueue_styles() {
    wp_enqueue_style( 'bootstrap-css', esc_url(get_template_directory_uri()) . '/assets/css/bootstrap.css');
    $fashion_ecommerce_zone_parentcss = 'fashion-estore-style';
    $fashion_ecommerce_zone_theme = wp_get_theme(); wp_enqueue_style( $fashion_ecommerce_zone_parentcss, get_template_directory_uri() . '/style.css', array(), $fashion_ecommerce_zone_theme->parent()->get('Version'));
    wp_enqueue_style( 'fashion-ecommerce-zone-style', get_stylesheet_uri(), array( $fashion_ecommerce_zone_parentcss ), $fashion_ecommerce_zone_theme->get('Version'));
    
    require get_theme_file_path( '/custom-option.php' );
    wp_add_inline_style( 'fashion-ecommerce-zone-style',$fashion_estore_theme_css );
    require get_parent_theme_file_path( '/custom-option.php' );
    wp_add_inline_style( 'fashion-estore-style',$fashion_estore_theme_css );

    wp_enqueue_script( 'comment-reply', '/wp-includes/js/comment-reply.min.js', array(), false, true );
}

add_action( 'wp_enqueue_scripts', 'fashion_ecommerce_zone_enqueue_styles' );

function fashion_ecommerce_zone_admin_scripts() {
    // demo CSS
    wp_enqueue_style( 'fashion-ecommerce-zone-demo-css', get_theme_file_uri( 'assets/css/demo.css' ) );
}
add_action( 'admin_enqueue_scripts', 'fashion_ecommerce_zone_admin_scripts' );

function fashion_ecommerce_zone_customize_register($wp_customize){

    // Pro Version
    class Fashion_Ecommerce_Zone_Pro_Version extends WP_Customize_Control {
        public $type = 'pro_options';

        public function render_content() {
            echo '<span>For More <strong>'. esc_html( $this->label ) .'</strong>?</span>';
            echo '<a href="'. esc_url($this->description) .'" target="_blank">';
                echo '<span class="dashicons dashicons-info"></span>';
                echo '<strong> '. esc_html( FASHION_ESTORE_BUY_TEXT,'fashion-estore' ) .'<strong></a>';
            echo '</a>';
        }
    }

    // Shop Services Section
    $wp_customize->add_section( 'fashion_ecommerce_zone_shop_services_section' , array(
        'title'      => __( 'Shop Services Settings', 'fashion-ecommerce-zone' ),
        'priority'   => 60,
    ) );

    $wp_customize->add_setting('fashion_ecommerce_zone_services_show_setting', array(
        'default' => 1,
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'fashion_ecommerce_zone_services_show_setting',array(
        'label'          => __( 'Show Hide Services', 'fashion-ecommerce-zone' ),
        'section'        => 'fashion_ecommerce_zone_shop_services_section',
        'settings'       => 'fashion_ecommerce_zone_services_show_setting',
        'type'           => 'checkbox',
    )));

    for ($i=1; $i <= 4 ; $i++) {

        $wp_customize->add_setting('fashion_ecommerce_zone_shop_services_icon'.$i,array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('fashion_ecommerce_zone_shop_services_icon'.$i,array(
            'label' => esc_html__('Icon','fashion-ecommerce-zone').$i,
            'section' => 'fashion_ecommerce_zone_shop_services_section',
            'setting' => 'fashion_ecommerce_zone_shop_services_icon'.$i,
            'type'  => 'text',
            'default' => '',
            'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fas fa-shipping-fast','fashion-ecommerce-zone')
        ));

        $wp_customize->add_setting('fashion_ecommerce_zone_shop_services_title'.$i,array(
            'default'   => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('fashion_ecommerce_zone_shop_services_title'.$i,array(
            'label' => esc_html__('Title ','fashion-ecommerce-zone').$i,
            'section'   => 'fashion_ecommerce_zone_shop_services_section',
            'type'      => 'text'
        ));

        $wp_customize->add_setting('fashion_ecommerce_zone_shop_services_text'.$i,array(
            'default'   => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('fashion_ecommerce_zone_shop_services_text'.$i,array(
            'label' => esc_html__('Text ','fashion-ecommerce-zone').$i,
            'section'   => 'fashion_ecommerce_zone_shop_services_section',
            'type'      => 'text'
        ));

        // Pro Version
        $wp_customize->add_setting( 'pro_version_shop_service_pro_option', array(
            'sanitize_callback' => 'Fashion_Fstore_sanitize_custom_control'
        ));
        $wp_customize->add_control( new Fashion_Ecommerce_Zone_Pro_Version ( $wp_customize,'pro_version_shop_service_pro_option', array(
            'section'     => 'fashion_ecommerce_zone_shop_services_section',
            'type'        => 'pro_options',
            'label'       => esc_html__( 'Customizer Options', 'fashion-ecommerce-zone' ),
            'description' => esc_url( FASHION_ESTORE_LINK ),
            'priority'    => 100
        )));
    }

    // Shop Category Section
    $wp_customize->add_section( 'fashion_ecommerce_zone_shop_category_section' , array(
        'title'      => __( 'Shop Category Settings', 'fashion-ecommerce-zone' ),
        'priority'   => 60,
    ) );

    $wp_customize->add_setting('fashion_ecommerce_zone_shop_category_show_setting', array(
        'default' => 1,
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'fashion_ecommerce_zone_shop_category_show_setting',array(
        'label'          => __( 'Show Hide Shop Category', 'fashion-ecommerce-zone' ),
        'section'        => 'fashion_ecommerce_zone_shop_category_section',
        'settings'       => 'fashion_ecommerce_zone_shop_category_show_setting',
        'type'           => 'checkbox',
    )));

    for ($i=1; $i <= 2 ; $i++) {

        $wp_customize->add_setting( 'fashion_ecommerce_zone_shop_category_image'.$i, array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        ));
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fashion_ecommerce_zone_shop_category_image'.$i, array(
            'label' => esc_html__('Category Image ','fashion-ecommerce-zone').$i,
            'section' => 'fashion_ecommerce_zone_shop_category_section',
            'settings' => 'fashion_ecommerce_zone_shop_category_image'.$i,
            'button_labels' => array(
                'select' => 'Select Logo',
                'remove' => 'Remove Logo',
                'change' => 'Change Logo',
            )
        )));

        $wp_customize->add_setting('fashion_ecommerce_zone_shop_category_title'.$i,array(
            'default'   => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('fashion_ecommerce_zone_shop_category_title'.$i,array(
            'label' => esc_html__('Title ','fashion-ecommerce-zone').$i,
            'section'   => 'fashion_ecommerce_zone_shop_category_section',
            'type'      => 'text'
        ));

        $wp_customize->add_setting('fashion_ecommerce_zone_shop_category_text'.$i,array(
            'default'   => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('fashion_ecommerce_zone_shop_category_text'.$i,array(
            'label' => esc_html__('Button Text ','fashion-ecommerce-zone').$i,
            'section'   => 'fashion_ecommerce_zone_shop_category_section',
            'type'      => 'text'
        ));

        $wp_customize->add_setting('fashion_ecommerce_zone_shop_category_url'.$i,array(
            'default'   => '',
            'sanitize_callback' => 'esc_url_raw'
        ));
        $wp_customize->add_control('fashion_ecommerce_zone_shop_category_url'.$i,array(
            'label' => esc_html__('Button URL ','fashion-ecommerce-zone').$i,
            'section'   => 'fashion_ecommerce_zone_shop_category_section',
            'type'      => 'url'
        ));

        // Pro Version
        $wp_customize->add_setting( 'pro_version_shop_category_pro_option', array(
            'sanitize_callback' => 'Fashion_Fstore_sanitize_custom_control'
        ));
        $wp_customize->add_control( new Fashion_Ecommerce_Zone_Pro_Version ( $wp_customize,'pro_version_shop_category_pro_option', array(
            'section'     => 'fashion_ecommerce_zone_shop_category_section',
            'type'        => 'pro_options',
            'label'       => esc_html__( 'Customizer Options', 'fashion-ecommerce-zone' ),
            'description' => esc_url( FASHION_ESTORE_LINK ),
            'priority'    => 100
        )));
    }
}
add_action('customize_register', 'fashion_ecommerce_zone_customize_register');

if ( ! function_exists( 'fashion_ecommerce_zone_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function fashion_ecommerce_zone_setup() {

        add_theme_support( 'responsive-embeds' );

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

        add_image_size('fashion-ecommerce-zone-featured-header-image', 2000, 660, true);

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
            'default-color' => '',
            'default-image' => '',
        ) ) );

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

        add_theme_support( 'align-wide' );

        add_theme_support( 'wp-block-styles' );
    }
endif;
add_action( 'after_setup_theme', 'fashion_ecommerce_zone_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fashion_ecommerce_zone_widgets_init() {
        register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'fashion-ecommerce-zone' ),
        'id'            => 'sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'fashion-ecommerce-zone' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ) );
}
add_action( 'widgets_init', 'fashion_ecommerce_zone_widgets_init' );


function fashion_ecommerce_zone_sanitize_select( $input, $setting ){
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}