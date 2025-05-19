<?php
/**
 * Fashion Estore Theme Customizer
 *
 * @link: https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @package Fashion Estore
 */

if ( ! defined( 'FASHION_ESTORE_URL' ) ) {
    define( 'FASHION_ESTORE_URL', esc_url( 'https://www.themagnifico.net/products/fashion-store-wordpress-theme', 'fashion-estore') );
}
if ( ! defined( 'FASHION_ESTORE_TEXT' ) ) {
    define( 'FASHION_ESTORE_TEXT', __( 'Fashion Estore Pro','fashion-estore' ));
}

if ( ! defined( 'FASHION_ESTORE_LINK' ) ) {
    define( 'FASHION_ESTORE_LINK', esc_url( 'https://www.themagnifico.net/themes/fashion-store-wordpress-theme/','fashion-estore' ));
}

if ( ! defined( 'FASHION_ESTORE_BUY_TEXT' ) ) {
    define( 'FASHION_ESTORE_BUY_TEXT', __( 'Buy Fashion Estore PRO','fashion-estore' ));
}

use WPTRT\Customize\Section\Fashion_Estore_Button;

add_action( 'customize_register', function( $manager ) {

    $manager->register_section_type( Fashion_Estore_Button::class );

    $manager->add_section(
        new Fashion_Estore_Button( $manager, 'fashion_estore_pro', [
            'title'       => esc_html( FASHION_ESTORE_TEXT,'fashion-estore' ),
            'priority'    => 0,
            'button_text' => __( 'GET PREMIUM', 'fashion-estore' ),
            'button_url'  => esc_url( FASHION_ESTORE_URL )
        ] )
    );

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'fashion-estore-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
        [ 'customize-controls' ],
        $version,
        true
    );

    wp_enqueue_style(
        'fashion-estore-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
        [ 'customize-controls' ],
        $version
    );

} );

 
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function fashion_estore_customize_register($wp_customize){

    // Pro Version
    class Fashion_Fstore_Customize_Pro_Version extends WP_Customize_Control {
        public $type = 'pro_options';

        public function render_content() {
            echo '<span>For More <strong>'. esc_html( $this->label ) .'</strong>?</span>';
            echo '<a href="'. esc_url($this->description) .'" target="_blank">';
                echo '<span class="dashicons dashicons-info"></span>';
                echo '<strong> '. esc_html( FASHION_ESTORE_BUY_TEXT,'fashion-estore' ) .'<strong></a>';
            echo '</a>';
        }
    }

    // Custom Controls
    function Fashion_Fstore_sanitize_custom_control( $input ) {
        return $input;
    }



    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    //Logo
    $wp_customize->add_setting('fashion_estore_logo_max_height',array(
        'default'   => '24',
        'sanitize_callback' => 'fashion_estore_sanitize_number_absint'
    ));
    $wp_customize->add_control('fashion_estore_logo_max_height',array(
        'label' => esc_html__('Logo Width','fashion-estore'),
        'section'   => 'title_tagline',
        'type'      => 'number'
    ));
    
    $wp_customize->add_setting('fashion_estore_logo_title', array(
        'default' => true,
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'fashion_estore_logo_title',array(
        'label'          => __( 'Enable Disable Title', 'fashion-estore' ),
        'section'        => 'title_tagline',
        'settings'       => 'fashion_estore_logo_title',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('fashion_estore_theme_description', array(
        'default' => false,
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'fashion_estore_theme_description',array(
        'label'          => __( 'Enable Disable Tagline', 'fashion-estore' ),
        'section'        => 'title_tagline',
        'settings'       => 'fashion_estore_theme_description',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('fashion_estore_logo_title_color', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'fashion_estore_logo_title_color', array(
        'label'    => __('Site Title Color', 'fashion-estore'),
        'section'  => 'title_tagline'
    )));

    $wp_customize->add_setting('fashion_estore_logo_tagline_color', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'fashion_estore_logo_tagline_color', array(
        'label'    => __('Site Tagline Color', 'fashion-estore'),
        'section'  => 'title_tagline'
    )));

    if (isset($wp_customize->selective_refresh)) {
        // Site title
        $wp_customize->selective_refresh->add_partial('blogname', array(
            'selector' => '.site-title',
            'render_callback' => 'fashion_estore_customize_partial_blogname',
        ));
    }

    // Pro Version
    $wp_customize->add_setting( 'pro_version_logo', array(
        'sanitize_callback' => 'Fashion_Fstore_sanitize_custom_control'
    ) );
    $wp_customize->add_control( new Fashion_Fstore_Customize_Pro_Version ( $wp_customize,
            'pro_version_logo', array(
                'section'     => 'title_tagline',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Customizer Options', 'fashion-estore' ),
                'description' => esc_url( FASHION_ESTORE_LINK ),
                'priority'    => 100
            )
        )
    );

    // Theme Color
    $wp_customize->add_section('fashion_estore_color_option',array(
        'title' => esc_html__('Theme Color','fashion-estore'),
        'priority'   => 10,
    ));

    $wp_customize->add_setting( 'fashion_estore_theme_color', array(
        'default' => '#ff5353',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fashion_estore_theme_color', array(
        'label' => esc_html__('First Color Option','fashion-estore'),
        'section' => 'fashion_estore_color_option',
        'settings' => 'fashion_estore_theme_color'
    )));

    $wp_customize->add_setting( 'fashion_estore_theme_color_2', array(
        'default' => '#0f1114',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fashion_estore_theme_color_2', array(
        'label' => esc_html__('Second Color Option','fashion-estore'),
        'section' => 'fashion_estore_color_option',
        'settings' => 'fashion_estore_theme_color_2'
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_theme_color', array(
        'sanitize_callback' => 'Fashion_Fstore_sanitize_custom_control'
    ) );
    $wp_customize->add_control( new Fashion_Fstore_Customize_Pro_Version ( $wp_customize,
            'pro_version_theme_color', array(
                'section'     => 'fashion_estore_color_option',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Customizer Options', 'fashion-estore' ),
                'description' => esc_url( FASHION_ESTORE_LINK ),
                'priority'    => 100
            )
        )
    );

    // Top Header
    $wp_customize->add_section('fashion_estore_top_header',array(
        'title' => esc_html__('Top Header','fashion-estore'),
        'priority'   => 20,
    ));

    $wp_customize->add_setting('fashion_estore_phone_number_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('fashion_estore_phone_number_text',array(
        'label' => esc_html__('Text','fashion-estore'),
        'section' => 'fashion_estore_top_header',
        'setting' => 'fashion_estore_phone_number_text',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('fashion_estore_phone_number_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('fashion_estore_phone_number_icon',array(
        'label' => esc_html__('Add Phone Icon','fashion-estore'),
        'section' => 'fashion_estore_top_header',
        'setting' => 'fashion_estore_phone_number_icon',
        'type'  => 'text',
        'default' => 'fas fa-phone',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fas fa-phone','fashion-estore')
    ));

    $wp_customize->add_setting('fashion_estore_phone_number_info',array(
        'default' => '',
        'sanitize_callback' => 'fashion_estore_sanitize_phone_number'
    ));
    $wp_customize->add_control('fashion_estore_phone_number_info',array(
        'label' => esc_html__('Phone Number','fashion-estore'),
        'section' => 'fashion_estore_top_header',
        'setting' => 'fashion_estore_phone_number_info',
        'type'  => 'text'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_topheader_setting', array(
        'sanitize_callback' => 'Fashion_Fstore_sanitize_custom_control'
    ) );
    $wp_customize->add_control( new Fashion_Fstore_Customize_Pro_Version ( $wp_customize,
            'pro_version_topheader_setting', array(
                'section'     => 'fashion_estore_top_header',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Customizer Options', 'fashion-estore' ),
                'description' => esc_url( FASHION_ESTORE_LINK ),
                'priority'    => 100
            )
        )
    );

    // General Settings
     $wp_customize->add_section('fashion_estore_general_settings',array(
        'title' => esc_html__('General Settings','fashion-estore'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('fashion_estore_preloader_hide', array(
        'default' => false,
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'fashion_estore_preloader_hide',array(
        'label'          => __( 'Show Theme Preloader', 'fashion-estore' ),
        'section'        => 'fashion_estore_general_settings',
        'settings'       => 'fashion_estore_preloader_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('fashion_estore_preloader_type',array(
        'default' => 'Preloader 1',
        'sanitize_callback' => 'fashion_estore_sanitize_choices'
    ));
    $wp_customize->add_control('fashion_estore_preloader_type',array(
        'type' => 'radio',
        'label' => esc_html__('Preloader Type','fashion-estore'),
        'section' => 'fashion_estore_general_settings',
        'choices' => array(
            'Preloader 1' => __('Preloader 1','fashion-estore'),
            'Preloader 2' => __('Preloader 2','fashion-estore'),
        ),
    ) );

    $wp_customize->add_setting( 'fashion_estore_preloader_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fashion_estore_preloader_bg_color', array(
        'label' => esc_html__('Preloader Background Color','fashion-estore'),
        'section' => 'fashion_estore_general_settings',
        'settings' => 'fashion_estore_preloader_bg_color'
    )));

    $wp_customize->add_setting( 'fashion_estore_preloader_dot_1_color', array(
        'default' => '#fff',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fashion_estore_preloader_dot_1_color', array(
        'label' => esc_html__('Preloader First Dot Color','fashion-estore'),
        'section' => 'fashion_estore_general_settings',
        'settings' => 'fashion_estore_preloader_dot_1_color',
        'active_callback' => 'fashion_estore_preloader1'
    )));

    $wp_customize->add_setting( 'fashion_estore_preloader_dot_2_color', array(
        'default' => '#f10026',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fashion_estore_preloader_dot_2_color', array(
        'label' => esc_html__('Preloader Second Dot Color','fashion-estore'),
        'section' => 'fashion_estore_general_settings',
        'settings' => 'fashion_estore_preloader_dot_2_color',
        'active_callback' => 'fashion_estore_preloader1'
    )));

    $wp_customize->add_setting( 'fashion_estore_preloader2_dot_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fashion_estore_preloader2_dot_color', array(
        'label' => esc_html__('Preloader Dot Color','fashion-estore'),
        'section' => 'fashion_estore_general_settings',
        'settings' => 'fashion_estore_preloader2_dot_color',
        'active_callback' => 'fashion_estore_preloader2'
    )));

    $wp_customize->add_setting('fashion_estore_sticky_header', array(
        'default' => false,
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'fashion_estore_sticky_header',array(
        'label'          => __( 'Show Sticky Header', 'fashion-estore' ),
        'section'        => 'fashion_estore_general_settings',
        'settings'       => 'fashion_estore_sticky_header',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('fashion_estore_scroll_hide', array(
        'default' => false,
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'fashion_estore_scroll_hide',array(
        'label'          => __( 'Show Theme Scroll To Top', 'fashion-estore' ),
        'section'        => 'fashion_estore_general_settings',
        'settings'       => 'fashion_estore_scroll_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('fashion_estore_scroll_top_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'fashion_estore_sanitize_choices'
    ));
    $wp_customize->add_control('fashion_estore_scroll_top_position',array(
        'label'       => esc_html__( 'Scroll To Top Positions','fashion-estore' ),
        'type' => 'radio',
        'section' => 'fashion_estore_general_settings',
        'choices' => array(
            'Right' => __('Right','fashion-estore'),
            'Left' => __('Left','fashion-estore'),
            'Center' => __('Center','fashion-estore')
        ),
    ) );

    $wp_customize->add_setting( 'fashion_estore_scroll_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fashion_estore_scroll_bg_color', array(
        'label' => esc_html__('Scroll Top Background Color','fashion-estore'),
        'section' => 'fashion_estore_general_settings',
        'settings' => 'fashion_estore_scroll_bg_color'
    )));

    $wp_customize->add_setting( 'fashion_estore_scroll_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'fashion_estore_scroll_color', array(
        'label' => esc_html__('Scroll Top Color','fashion-estore'),
        'section' => 'fashion_estore_general_settings',
        'settings' => 'fashion_estore_scroll_color'
    )));

    $wp_customize->add_setting('fashion_estore_scroll_font_size',array(
        'default'   => '16',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('fashion_estore_scroll_font_size',array(
        'label' => __('Scroll Top Font Size','fashion-estore'),
        'description' => __('Put in px','fashion-estore'),
        'section'   => 'fashion_estore_general_settings',
        'type'      => 'number'
    ));

    $wp_customize->add_setting( 'fashion_estore_scroll_to_top_border_radius', array(
        'default'              => '',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'fashion_estore_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'fashion_estore_scroll_to_top_border_radius', array(
        'label'       => esc_html__( 'Scroll To Top Border Radius','fashion-estore' ),
        'section'     => 'fashion_estore_general_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

     // Product Columns
    $wp_customize->add_setting( 'fashion_estore_products_per_row' , array(
        'default'           => '3',
        'transport'         => 'refresh',
        'sanitize_callback' => 'fashion_estore_sanitize_select',
    ) );

    $wp_customize->add_control('fashion_estore_products_per_row', array(
        'label' => __( 'Product per row', 'fashion-estore' ),
        'section'  => 'fashion_estore_general_settings',
        'type'     => 'select',
        'choices'  => array(
            '2' => '2',
            '3' => '3',
            '4' => '4',
        ),
    ) );

    $wp_customize->add_setting('fashion_estore_product_per_page',array(
        'default'   => '9',
        'sanitize_callback' => 'fashion_estore_sanitize_float'
    ));
    $wp_customize->add_control('fashion_estore_product_per_page',array(
        'label' => __('Product per page','fashion-estore'),
        'section'   => 'fashion_estore_general_settings',
        'type'      => 'number'
    ));

    //Woocommerce shop page Sidebar
    $wp_customize->add_setting('fashion_estore_woocommerce_shop_page_sidebar', array(
        'default' => true,
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'fashion_estore_woocommerce_shop_page_sidebar',array(
        'label'          => __( 'Hide Shop Page Sidebar', 'fashion-estore' ),
        'section'        => 'fashion_estore_general_settings',
        'settings'       => 'fashion_estore_woocommerce_shop_page_sidebar',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('fashion_estore_shop_page_sidebar_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'fashion_estore_sanitize_choices'
    ));
    $wp_customize->add_control('fashion_estore_shop_page_sidebar_layout',array(
        'type' => 'select',
        'label' => __('Woocommerce Shop Page Sidebar','fashion-estore'),
        'section' => 'fashion_estore_general_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','fashion-estore'),
            'Right Sidebar' => __('Right Sidebar','fashion-estore'),
        ),
    ) );

    //Woocommerce Single Product page Sidebar
    $wp_customize->add_setting('fashion_estore_woocommerce_single_product_page_sidebar', array(
        'default' => true,
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'fashion_estore_woocommerce_single_product_page_sidebar',array(
        'label'          => __( 'Hide Single Product Page Sidebar', 'fashion-estore' ),
        'section'        => 'fashion_estore_general_settings',
        'settings'       => 'fashion_estore_woocommerce_single_product_page_sidebar',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('fashion_estore_single_product_sidebar_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'fashion_estore_sanitize_choices'
    ));
    $wp_customize->add_control('fashion_estore_single_product_sidebar_layout',array(
        'type' => 'select',
        'label' => __('Woocommerce Single Product Page Sidebar','fashion-estore'),
        'section' => 'fashion_estore_general_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','fashion-estore'),
            'Right Sidebar' => __('Right Sidebar','fashion-estore'),
        ),
    ) );

    $wp_customize->add_setting( 'fashion_estore_woo_product_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'fashion_estore_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'fashion_estore_woo_product_image_box_shadow', array(
        'label'       => esc_html__( 'Product Image Box Shadow','fashion-estore' ),
        'section'     => 'fashion_estore_general_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting('fashion_estore_woocommerce_product_sale',array(
        'default' => 'Left',
        'sanitize_callback' => 'fashion_estore_sanitize_choices'
    ));
    $wp_customize->add_control('fashion_estore_woocommerce_product_sale',array(
        'label'       => esc_html__( 'Woocommerce Product Sale Positions','fashion-estore' ),
        'type' => 'radio',
        'section' => 'fashion_estore_general_settings',
        'choices' => array(
            'Right' => __('Right','fashion-estore'),
            'Left' => __('Left','fashion-estore'),
            'Center' => __('Center','fashion-estore')
        ),
    ) );

    $wp_customize->add_setting( 'fashion_estore_woo_product_sale_border_radius', array(
        'default'              => '',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'fashion_estore_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'fashion_estore_woo_product_sale_border_radius', array(
        'label'       => esc_html__( 'Woocommerce Product Sale Border Radius','fashion-estore' ),
        'section'     => 'fashion_estore_general_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    // Related Product
    $wp_customize->add_setting('fashion_estore_woocommerce_related_product_show_hide', array(
        'default' => true,
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'fashion_estore_woocommerce_related_product_show_hide',array(
        'label'          => __( 'Show / Hide Related product', 'fashion-estore' ),
        'section'        => 'fashion_estore_general_settings',
        'settings'       => 'fashion_estore_woocommerce_related_product_show_hide',
        'type'           => 'checkbox',
    )));

   // Pro Version
    $wp_customize->add_setting( 'pro_version_general_layouts', array(
        'sanitize_callback' => 'Fashion_Fstore_sanitize_custom_control'
    ) );
    $wp_customize->add_control( new Fashion_Fstore_Customize_Pro_Version ( $wp_customize,
            'pro_version_general_layouts', array(
                'section'     => 'fashion_estore_general_settings',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Customizer Options', 'fashion-estore' ),
                'description' => esc_url( FASHION_ESTORE_LINK ),
                'priority'    => 100
            )
        )
    );

    // Post Settings
     $wp_customize->add_section('fashion_estore_post_settings',array(
        'title' => esc_html__('Post Settings','fashion-estore'),
        'priority'   =>40,
    ));

    $wp_customize->add_setting('fashion_estore_post_page_title',array(
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('fashion_estore_post_page_title',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Title', 'fashion-estore'),
        'section'     => 'fashion_estore_post_settings',
        'description' => esc_html__('Check this box to enable title on post page.', 'fashion-estore'),
    ));

    $wp_customize->add_setting('fashion_estore_post_page_meta',array(
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('fashion_estore_post_page_meta',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Meta', 'fashion-estore'),
        'section'     => 'fashion_estore_post_settings',
        'description' => esc_html__('Check this box to enable meta on post page.', 'fashion-estore'),
    ));

    $wp_customize->add_setting('fashion_estore_post_page_thumb',array(
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('fashion_estore_post_page_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Thumbnail', 'fashion-estore'),
        'section'     => 'fashion_estore_post_settings',
        'description' => esc_html__('Check this box to enable thumbnail on post page.', 'fashion-estore'),
    ));

    $wp_customize->add_setting( 'fashion_estore_post_page_image_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'fashion_estore_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'fashion_estore_post_page_image_border_radius', array(
        'label'       => esc_html__( 'Post Page Image Border Radius','fashion-estore' ),
        'section'     => 'fashion_estore_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting( 'fashion_estore_post_page_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'fashion_estore_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'fashion_estore_post_page_image_box_shadow', array(
        'label'       => esc_html__( 'Post Page Image Box Shadow','fashion-estore' ),
        'section'     => 'fashion_estore_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting('fashion_estore_post_page_content',array(
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('fashion_estore_post_page_content',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Content', 'fashion-estore'),
        'section'     => 'fashion_estore_post_settings',
        'description' => esc_html__('Check this box to enable content on post page.', 'fashion-estore'),
    ));

    $wp_customize->add_setting('fashion_estore_post_page_cat',array(
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('fashion_estore_post_page_cat',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Category and Tags', 'fashion-estore'),
        'section'     => 'fashion_estore_post_settings',
        'description' => esc_html__('Check this box to enable category and tags on post page.', 'fashion-estore'),
    ));

    $wp_customize->add_setting( 'fashion_estore_blog_post_columns', array(
        'default'  => 'Two',
        'sanitize_callback' => 'fashion_estore_sanitize_choices'
    ));
    $wp_customize->add_control( 'fashion_estore_blog_post_columns', array(
        'section' => 'fashion_estore_post_settings',
        'type' => 'select',
        'label' => __( 'No. of Posts per row', 'fashion-estore' ),
        'choices' => array(
            'One'  => __( 'One', 'fashion-estore' ),
            'Two' => __( 'Two', 'fashion-estore' ),
            'Three' => __( 'Three', 'fashion-estore' ),
        )
    ));

    $wp_customize->add_setting( 'fashion_estore_blog_pagination_type', array(
        'default'           => 'blog-nav-numbers',
        'sanitize_callback' => 'fashion_estore_sanitize_choices'
    ));
    $wp_customize->add_control( 'fashion_estore_blog_pagination_type', array(
        'section' => 'fashion_estore_post_settings',
        'type' => 'select',
        'label' => __( 'Post Pagination Type', 'fashion-estore' ),
        'choices' => array(
            'blog-nav-numbers'  => __( 'Numeric', 'fashion-estore' ),
            'next-prev' => __( 'Older/Newer Posts', 'fashion-estore' ),
        )
    ));

    $wp_customize->add_setting( 'fashion_estore_blog_sidebar_position', array(
        'default'           => 'Right Side',
        'sanitize_callback' => 'fashion_estore_sanitize_choices'
    ));
    $wp_customize->add_control( 'fashion_estore_blog_sidebar_position', array(
        'section' => 'fashion_estore_post_settings',
        'type' => 'select',
        'label' => __( 'Post Page Sidebar Position', 'fashion-estore' ),
        'choices' => array(
            'Right Side' => __( 'Right Side', 'fashion-estore' ),
            'Left Side' => __( 'Left Side', 'fashion-estore' ),
        )
    ));

    $wp_customize->add_setting('fashion_estore_single_post_thumb',array(
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('fashion_estore_single_post_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Thumbnail', 'fashion-estore'),
        'section'     => 'fashion_estore_post_settings',
        'description' => esc_html__('Check this box to enable post thumbnail on single post.', 'fashion-estore'),
    ));

    // Single Post Page Settings
    $wp_customize->add_setting( 'fashion_estore_single_post_page_image_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'fashion_estore_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'fashion_estore_single_post_page_image_border_radius', array(
        'label'       => esc_html__( 'Single Post Page Image Border Radius','fashion-estore' ),
        'section'     => 'fashion_estore_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting( 'fashion_estore_single_post_page_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'fashion_estore_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'fashion_estore_single_post_page_image_box_shadow', array(
        'label'       => esc_html__( 'Single Post Page Image Box Shadow','fashion-estore' ),
        'section'     => 'fashion_estore_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting('fashion_estore_single_post_meta',array(
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('fashion_estore_single_post_meta',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Meta', 'fashion-estore'),
        'section'     => 'fashion_estore_post_settings',
        'description' => esc_html__('Check this box to enable single post meta such as post date, author, category, comment etc.', 'fashion-estore'),
    ));

    $wp_customize->add_setting('fashion_estore_single_post_title',array(
            'sanitize_callback' => 'fashion_estore_sanitize_checkbox',
            'default'           => 1,
    ));
    $wp_customize->add_control('fashion_estore_single_post_title',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Title', 'fashion-estore'),
        'section'     => 'fashion_estore_post_settings',
        'description' => esc_html__('Check this box to enable title on single post.', 'fashion-estore'),
    ));

    $wp_customize->add_setting('fashion_estore_single_post_page_content',array(
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('fashion_estore_single_post_page_content',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Page Content', 'fashion-estore'),
        'section'     => 'fashion_estore_post_settings',
        'description' => esc_html__('Check this box to enable content on single post page.', 'fashion-estore'),
    ));

    $wp_customize->add_setting('fashion_estore_single_post_cat',array(
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('fashion_estore_single_post_cat',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Category and Tags', 'fashion-estore'),
        'section'     => 'fashion_estore_post_settings',
        'description' => esc_html__('Check this box to enable post category and tags on single post.', 'fashion-estore'),
    ));

    $wp_customize->add_setting( 'fashion_estore_single_post_sidebar_position', array(
        'default'           => 'Right Side',
        'sanitize_callback' => 'fashion_estore_sanitize_choices'
    ));
    $wp_customize->add_control( 'fashion_estore_single_post_sidebar_position', array(
        'section' => 'fashion_estore_post_settings',
        'type' => 'select',
        'label' => __( 'Single Post Sidebar Position', 'fashion-estore' ),
        'choices' => array(
            'Right Side' => __( 'Right Side', 'fashion-estore' ),
            'Left Side' => __( 'Left Side', 'fashion-estore' ),
        )
    ));

    $wp_customize->add_setting('fashion_estore_single_post_navigation_show_hide',array(
        'default' => true,
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox'
    ));
    $wp_customize->add_control('fashion_estore_single_post_navigation_show_hide',array(
        'type' => 'checkbox',
        'label' => __('Show / Hide Post Navigation','fashion-estore'),
        'section' => 'fashion_estore_post_settings',
    ));

    $wp_customize->add_setting('fashion_estore_single_post_comment_title',array(
        'default'=> 'Leave a Reply',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('fashion_estore_single_post_comment_title',array(
        'label' => __('Add Comment Title','fashion-estore'),
        'input_attrs' => array(
        'placeholder' => __( 'Leave a Reply', 'fashion-estore' ),
        ),
        'section'=> 'fashion_estore_post_settings',
        'type'=> 'text'
    ));

    $wp_customize->add_setting('fashion_estore_single_post_comment_btn_text',array(
        'default'=> 'Post Comment',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('fashion_estore_single_post_comment_btn_text',array(
        'label' => __('Add Comment Button Text','fashion-estore'),
        'input_attrs' => array(
            'placeholder' => __( 'Post Comment', 'fashion-estore' ),
        ),
        'section'=> 'fashion_estore_post_settings',
        'type'=> 'text'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_post_setting', array(
        'sanitize_callback' => 'Fashion_Fstore_sanitize_custom_control'
    ) );
    $wp_customize->add_control( new Fashion_Fstore_Customize_Pro_Version ( $wp_customize,
            'pro_version_post_setting', array(
                'section'     => 'fashion_estore_post_settings',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Customizer Options', 'fashion-estore' ),
                'description' => esc_url( FASHION_ESTORE_LINK ),
                'priority'    => 100
            )
        )
    );

    // Page Settings
    $wp_customize->add_section('fashion_estore_page_settings',array(
        'title' => esc_html__('Page Settings','fashion-estore'),
        'priority'   =>50,
    ));

    $wp_customize->add_setting('fashion_estore_single_page_title',array(
            'sanitize_callback' => 'fashion_estore_sanitize_checkbox',
            'default'           => 1,
    ));
    $wp_customize->add_control('fashion_estore_single_page_title',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Page Title', 'fashion-estore'),
        'section'     => 'fashion_estore_page_settings',
        'description' => esc_html__('Check this box to enable title on single page.', 'fashion-estore'),
    ));

    $wp_customize->add_setting('fashion_estore_single_page_thumb',array(
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('fashion_estore_single_page_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Page Thumbnail', 'fashion-estore'),
        'section'     => 'fashion_estore_page_settings',
        'description' => esc_html__('Check this box to enable page thumbnail on single page.', 'fashion-estore'),
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_single_page_setting', array(
        'sanitize_callback' => 'Fashion_Fstore_sanitize_custom_control'
    ) );
    $wp_customize->add_control( new Fashion_Fstore_Customize_Pro_Version ( $wp_customize,
            'pro_version_single_page_setting', array(
                'section'     => 'fashion_estore_page_settings',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Customizer Options', 'fashion-estore' ),
                'description' => esc_url( FASHION_ESTORE_LINK ),
                'priority'    => 100
            )
        )
    );

    // Social Link
    $wp_customize->add_section('fashion_estore_social_link',array(
        'title' => esc_html__('Social Links','fashion-estore'),
        'priority'   => 50,
    ));

    $wp_customize->add_setting('fashion_estore_social_on_of_setting', array(
        'default' => 1,
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'fashion_estore_social_on_of_setting',array(
        'label'          => __( 'Show Hide Topbar', 'fashion-estore' ),
        'section'        => 'fashion_estore_social_link',
        'settings'       => 'fashion_estore_social_on_of_setting',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('fashion_estore_facebook_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('fashion_estore_facebook_icon',array(
        'label' => esc_html__('Add Facebook Icon','fashion-estore'),
        'section' => 'fashion_estore_social_link',
        'setting' => 'fashion_estore_facebook_icon',
        'type'  => 'text',
        'default' => 'fab fa-facebook-f',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-facebook-f','fashion-estore')
    ));

    $wp_customize->add_setting('fashion_estore_facebook_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('fashion_estore_facebook_url',array(
        'label' => esc_html__('Facebook Link','fashion-estore'),
        'section' => 'fashion_estore_social_link',
        'setting' => 'fashion_estore_facebook_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('fashion_estore_twitter_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('fashion_estore_twitter_icon',array(
        'label' => esc_html__('Add Twitter Icon','fashion-estore'),
        'section' => 'fashion_estore_social_link',
        'setting' => 'fashion_estore_twitter_icon',
        'type'  => 'text',
        'default' => 'fab fa-twitter',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-twitter','fashion-estore')
    ));

    $wp_customize->add_setting('fashion_estore_twitter_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('fashion_estore_twitter_url',array(
        'label' => esc_html__('Twitter Link','fashion-estore'),
        'section' => 'fashion_estore_social_link',
        'setting' => 'fashion_estore_twitter_url',
        'type'  => 'url'
    ));

     $wp_customize->add_setting('fashion_estore_intagram_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('fashion_estore_intagram_icon',array(
        'label' => esc_html__('Add Intagram Icon','fashion-estore'),
        'section' => 'fashion_estore_social_link',
        'setting' => 'fashion_estore_intagram_icon',
        'type'  => 'text',
        'default' => 'fab fa-instagram',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-instagram','fashion-estore')
    ));

    $wp_customize->add_setting('fashion_estore_intagram_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('fashion_estore_intagram_url',array(
        'label' => esc_html__('Intagram Link','fashion-estore'),
        'section' => 'fashion_estore_social_link',
        'setting' => 'fashion_estore_intagram_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('fashion_estore_linkedin_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('fashion_estore_linkedin_icon',array(
        'label' => esc_html__('Add Linkedin Icon','fashion-estore'),
        'section' => 'fashion_estore_social_link',
        'setting' => 'fashion_estore_linkedin_icon',
        'type'  => 'text',
        'default' => 'fab fa-linkedin-in',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-linkedin-in','fashion-estore')
    ));

    $wp_customize->add_setting('fashion_estore_linkedin_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('fashion_estore_linkedin_url',array(
        'label' => esc_html__('Linkedin Link','fashion-estore'),
        'section' => 'fashion_estore_social_link',
        'setting' => 'fashion_estore_linkedin_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('fashion_estore_pintrest_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('fashion_estore_pintrest_icon',array(
        'label' => esc_html__('Add Pinterest Icon','fashion-estore'),
        'section' => 'fashion_estore_social_link',
        'setting' => 'fashion_estore_pintrest_icon',
        'type'  => 'text',
        'default' => 'fab fa-pinterest-p',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-pinterest-p','fashion-estore')
    ));

    $wp_customize->add_setting('fashion_estore_pintrest_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('fashion_estore_pintrest_url',array(
        'label' => esc_html__('Pinterest Link','fashion-estore'),
        'section' => 'fashion_estore_social_link',
        'setting' => 'fashion_estore_pintrest_url',
        'type'  => 'url'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_social_pro_option', array(
        'sanitize_callback' => 'Fashion_Fstore_sanitize_custom_control'
    ) );
    $wp_customize->add_control( new Fashion_Fstore_Customize_Pro_Version ( $wp_customize,
            'pro_version_social_pro_option', array(
                'section'     => 'fashion_estore_social_link',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Customizer Options', 'fashion-estore' ),
                'description' => esc_url( FASHION_ESTORE_LINK ),
                'priority'    => 100
            )
        )
    );//Menu Settings
    $wp_customize->add_section('fashion_estore_menu_settings',array(
        'title' => esc_html__('Menus Settings','fashion-estore'),
        'priority'   => 60,
    ));

    $wp_customize->add_setting('fashion_estore_menu_font_size',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('fashion_estore_menu_font_size',array(
        'label' => esc_html__('Menu Font Size','fashion-estore'),
        'section' => 'fashion_estore_menu_settings',
        'type'  => 'number'
    ));

    $wp_customize->add_setting('fashion_estore_nav_menu_text_transform',array(
        'default'=> 'Uppercase',
        'sanitize_callback' => 'fashion_estore_sanitize_choices'
    ));
    $wp_customize->add_control('fashion_estore_nav_menu_text_transform',array(
        'type' => 'radio',
        'label' => esc_html__('Menu Text Transform','fashion-estore'),
        'choices' => array(
            'Uppercase' => __('Uppercase','fashion-estore'),
            'Capitalize' => __('Capitalize','fashion-estore'),
            'Lowercase' => __('Lowercase','fashion-estore'),
        ),
        'section'=> 'fashion_estore_menu_settings',
    ));

    $wp_customize->add_setting('fashion_estore_nav_menu_font_weight',array(
        'default'=> '500',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('fashion_estore_nav_menu_font_weight',array(
        'type' => 'number',
        'label' => esc_html__('Menu Font Weight','fashion-estore'),
        'input_attrs' => array(
            'step'             => 100,
            'min'              => 100,
            'max'              => 1000,
        ),
        'section'=> 'fashion_estore_menu_settings',
    ));

    //Slider
    $wp_customize->add_section('fashion_estore_top_slider',array(
        'title' => esc_html__('Slider Settings','fashion-estore'),
        'description' => esc_html__('Here you have to add 3 different pages in below dropdown. Note: Image Dimensions 830px x 300 px','fashion-estore'),
        'priority'   => 60,
    ));

    $wp_customize->add_setting('fashion_estore_slider_show_setting', array(
        'default' => 1,
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'fashion_estore_slider_show_setting',array(
        'label'          => __( 'Show Slider', 'fashion-estore' ),
        'section'        => 'fashion_estore_top_slider',
        'settings'       => 'fashion_estore_slider_show_setting',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('fashion_estore_slider_loop', array(
        'default' => 1,
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'fashion_estore_slider_loop',array(
        'label'          => __( 'Enable Disable Slider Loop', 'fashion-estore' ),
        'section'        => 'fashion_estore_top_slider',
        'settings'       => 'fashion_estore_slider_loop',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('fashion_estore_slider_title_setting', array(
        'default' => 1,
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'fashion_estore_slider_title_setting',array(
        'label'          => __( 'Enable Disable Slider Title', 'fashion-estore' ),
        'section'        => 'fashion_estore_top_slider',
        'settings'       => 'fashion_estore_slider_title_setting',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('fashion_estore_slider_button_setting', array(
        'default' => 1,
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'fashion_estore_slider_button_setting',array(
        'label'          => __( 'Enable Disable Slider Button', 'fashion-estore' ),
        'section'        => 'fashion_estore_top_slider',
        'settings'       => 'fashion_estore_slider_button_setting',
        'type'           => 'checkbox',
    )));

    for ( $count = 1; $count <= 3; $count++ ) {
        $wp_customize->add_setting( 'fashion_estore_top_slider_page' . $count, array(
            'default'           => '',
            'sanitize_callback' => 'fashion_estore_sanitize_dropdown_pages'
        ) );
        $wp_customize->add_control( 'fashion_estore_top_slider_page' . $count, array(
            'label'    => __( 'Select Slide Page', 'fashion-estore' ),
            'section'  => 'fashion_estore_top_slider',
            'type'     => 'dropdown-pages'
        ) );
    }

    //Slider button text
    $wp_customize->add_setting('fashion_estore_slider_button_text',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('fashion_estore_slider_button_text',array(
        'label' => __('Slider Button Text','fashion-estore'),
        'section'=> 'fashion_estore_top_slider',
        'type'=> 'text'
    ));

    //Slider Image Opacity
    $wp_customize->add_setting('fashion_estore_slider_opacity_color',array(
      'default' => '0.9',
      'sanitize_callback' => 'fashion_estore_sanitize_choices'
    ));

    $wp_customize->add_control( 'fashion_estore_slider_opacity_color', array(
    'label'       => esc_html__( 'Slider Image Opacity','fashion-estore' ),
    'section'     => 'fashion_estore_top_slider',
    'type'        => 'select',
    'choices' => array(
      '0' =>  esc_attr('0','fashion-estore'),
      '0.1' =>  esc_attr('0.1','fashion-estore'),
      '0.2' =>  esc_attr('0.2','fashion-estore'),
      '0.3' =>  esc_attr('0.3','fashion-estore'),
      '0.4' =>  esc_attr('0.4','fashion-estore'),
      '0.5' =>  esc_attr('0.5','fashion-estore'),
      '0.6' =>  esc_attr('0.6','fashion-estore'),
      '0.7' =>  esc_attr('0.7','fashion-estore'),
      '0.8' =>  esc_attr('0.8','fashion-estore'),
      '0.9' =>  esc_attr('0.9','fashion-estore')
    ),
    ));

    //Slider height
    $wp_customize->add_setting('fashion_estore_slider_img_height',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('fashion_estore_slider_img_height',array(
        'label' => __('Slider Height','fashion-estore'),
        'description'   => __('Add the slider height in px(eg. 500px).','fashion-estore'),
        'input_attrs' => array(
            'placeholder' => __( '500px', 'fashion-estore' ),
        ),
        'section'=> 'fashion_estore_top_slider',
        'type'=> 'text'
    ));

    $wp_customize->add_setting('fashion_estore_slider_content_layout',array(
        'default'=> 'Center',
        'sanitize_callback' => 'fashion_estore_sanitize_choices'
    ));
    $wp_customize->add_control('fashion_estore_slider_content_layout',array(
        'type' => 'radio',
        'label' => esc_html__('Slider Content Layout','fashion-estore'),
        'choices' => array(
            'Left' => __('Left','fashion-estore'),
            'Center' => __('Center','fashion-estore'),
            'Right' => __('Right','fashion-estore'),
        ),
        'section'=> 'fashion_estore_top_slider',
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_slider_pro_option', array(
        'sanitize_callback' => 'Fashion_Fstore_sanitize_custom_control'
    ) );
    $wp_customize->add_control( new Fashion_Fstore_Customize_Pro_Version ( $wp_customize,
            'pro_version_slider_pro_option', array(
                'section'     => 'fashion_estore_top_slider',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Customizer Options', 'fashion-estore' ),
                'description' => esc_url( FASHION_ESTORE_LINK ),
                'priority'    => 100
            )
        )
    );

    //Product
    $wp_customize->add_section('fashion_estore_product',array(
        'title' => esc_html__('Product Settings','fashion-estore'),
        'priority'   => 60,
    ));

    $wp_customize->add_setting('fashion_estore_product_show_setting', array(
        'default' => 1,
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'fashion_estore_product_show_setting',array(
        'label'          => __( 'Show Product', 'fashion-estore' ),
        'section'        => 'fashion_estore_product',
        'settings'       => 'fashion_estore_product_show_setting',
        'type'           => 'checkbox',
    )));

    if(class_exists('woocommerce')){
        
        $fashion_estore_args = array(
           'type'                     => 'product',
            'child_of'                 => 0,
            'parent'                   => '',
            'orderby'                  => 'term_group',
            'order'                    => 'ASC',
            'hide_empty'               => false,
            'hierarchical'             => 1,
            'number'                   => '',
            'taxonomy'                 => 'product_cat',
            'pad_counts'               => false
        );
        $categories = get_categories( $fashion_estore_args );
        $cats = array();
        $i = 0;
        foreach($categories as $category){
            if($i==0){
                $default = $category->slug;
                $i++;
            }
            $cats[$category->slug] = $category->name;
        }
        $wp_customize->add_setting('fashion_estore_home_product',array(
            'sanitize_callback' => 'fashion_estore_sanitize_select',
        ));
        $wp_customize->add_control('fashion_estore_home_product',array(
            'type'    => 'select',
            'choices' => $cats,
            'label' => __('Select Product Category','fashion-estore'),
            'section' => 'fashion_estore_product',
        ));
    }

    // Pro Version
    $wp_customize->add_setting( 'pro_version_product_pro_option', array(
        'sanitize_callback' => 'Fashion_Fstore_sanitize_custom_control'
    ) );
    $wp_customize->add_control( new Fashion_Fstore_Customize_Pro_Version ( $wp_customize,
            'pro_version_slider_pro_option', array(
                'section'     => 'fashion_estore_product',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Customizer Options', 'fashion-estore' ),
                'description' => esc_url( FASHION_ESTORE_LINK ),
                'priority'    => 100
            )
        )
    );

    // Footer
    $wp_customize->add_section('fashion_estore_site_footer_section', array(
        'title' => esc_html__('Footer', 'fashion-estore'),
        'priority'   => 70,
    ));

    $wp_customize->add_setting('fashion_estore_show_hide_footer',array(
        'default' => true,
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox'
    ));
    $wp_customize->add_control('fashion_estore_show_hide_footer',array(
        'type' => 'checkbox',
        'label' => __('Show / Hide Footer','fashion-estore'),
        'section' => 'fashion_estore_site_footer_section',
        'priority' => 1,
    ));

    $wp_customize->add_setting('fashion_estore_footer_background_color', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'fashion_estore_footer_background_color', array(
        'label'    => __('Footer Background Color', 'fashion-estore'),
        'section'  => 'fashion_estore_site_footer_section',
    )));

    $wp_customize->add_setting('fashion_estore_footer_bg_image',array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'fashion_estore_footer_bg_image',array(
        'label' => __('Footer Background Image','fashion-estore'),
        'section' => 'fashion_estore_site_footer_section',
    )));

    $wp_customize->add_setting('fashion_estore_footer_bg_image_position',array(
        'default'=> 'scroll',
        'sanitize_callback' => 'fashion_estore_sanitize_choices'
    ));
    $wp_customize->add_control('fashion_estore_footer_bg_image_position',array(
        'type' => 'select',
        'label' => __('Footer Background Image Position','fashion-estore'),
        'choices' => array(
            'fixed' => __('fixed','fashion-estore'),
            'scroll' => __('scroll','fashion-estore'),
        ),
        'section'=> 'fashion_estore_site_footer_section',
    ));

    $wp_customize->add_setting('fashion_estore_footer_widget_heading_alignment',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'fashion_estore_sanitize_choices'
    ));
    $wp_customize->add_control('fashion_estore_footer_widget_heading_alignment',array(
        'type' => 'select',
        'label' => __('Footer Widget Heading Alignment','fashion-estore'),
        'section' => 'fashion_estore_site_footer_section',
        'choices' => array(
            'Left' => __('Left','fashion-estore'),
            'Center' => __('Center','fashion-estore'),
            'Right' => __('Right','fashion-estore')
        ),
    ) );

    $wp_customize->add_setting('fashion_estore_footer_widget_content_alignment',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'fashion_estore_sanitize_choices'
    ));
    $wp_customize->add_control('fashion_estore_footer_widget_content_alignment',array(
        'type' => 'select',
        'label' => __('Footer Widget Content Alignment','fashion-estore'),
        'section' => 'fashion_estore_site_footer_section',
        'choices' => array(
            'Left' => __('Left','fashion-estore'),
            'Center' => __('Center','fashion-estore'),
            'Right' => __('Right','fashion-estore')
        ),
    ) );

    $wp_customize->add_setting('fashion_estore_show_hide_copyright',array(
        'default' => true,
        'sanitize_callback' => 'fashion_estore_sanitize_checkbox'
    ));
    $wp_customize->add_control('fashion_estore_show_hide_copyright',array(
        'type' => 'checkbox',
        'label' => __('Show / Hide Copyright','fashion-estore'),
        'section' => 'fashion_estore_site_footer_section',
    ));

     $wp_customize->add_setting('fashion_estore_footer_text_setting', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('fashion_estore_footer_text_setting', array(
        'label' => __('Replace the footer text', 'fashion-estore'),
        'section' => 'fashion_estore_site_footer_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('fashion_estore_copyright_content_alignment',array(
        'default' => 'Center',
        'transport' => 'refresh',
        'sanitize_callback' => 'fashion_estore_sanitize_choices'
    ));
    $wp_customize->add_control('fashion_estore_copyright_content_alignment',array(
        'type' => 'select',
        'label' => __('Copyright Content Alignment','fashion-estore'),
        'section' => 'fashion_estore_site_footer_section',
        'choices' => array(
            'Left' => __('Left','fashion-estore'),
            'Center' => __('Center','fashion-estore'),
            'Right' => __('Right','fashion-estore')
        ),
    ) );

    $wp_customize->add_setting('fashion_estore_copyright_background_color', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'fashion_estore_copyright_background_color', array(
        'label'    => __('Copyright Background Color', 'fashion-estore'),
        'section'  => 'fashion_estore_site_footer_section',
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_footer_pro_option', array(
        'sanitize_callback' => 'Fashion_Fstore_sanitize_custom_control'
    ) );
    $wp_customize->add_control( new Fashion_Fstore_Customize_Pro_Version ( $wp_customize,
            'pro_version_footer_pro_option', array(
                'section'     => 'fashion_estore_site_footer_section',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Customizer Options', 'fashion-estore' ),
                'description' => esc_url( FASHION_ESTORE_LINK ),
                'priority'    => 100
            )
        )
    );
}
add_action('customize_register', 'fashion_estore_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function fashion_estore_customize_partial_blogname(){
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function fashion_estore_customize_partial_blogdescription(){
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fashion_estore_customize_preview_js(){
    wp_enqueue_script('fashion-estore-customizer', esc_url(get_template_directory_uri()) . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'fashion_estore_customize_preview_js');

/*
** Load dynamic logic for the customizer controls area.
*/
function fashion_estore_panels_js() {
    wp_enqueue_style( 'fashion-estore-customizer-layout-css', get_theme_file_uri( '/assets/css/customizer-layout.css' ) );
    wp_enqueue_script( 'fashion-estore-customize-layout', get_theme_file_uri( '/assets/js/customize-layout.js' ), array(), '1.2', true );
}
add_action( 'customize_controls_enqueue_scripts', 'fashion_estore_panels_js' );
