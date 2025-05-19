<?php
/**
 * Theme Title
 */
//Theme Title
add_theme_support('title-tag');

//Theme css and js file calling
function faizaan_add_css_js_files()
{
    // Add CSS files
    wp_enqueue_style('faizaan-style', get_stylesheet_uri());
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '5.0.2');
    wp_enqueue_style('bootstrap');
    wp_register_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0');
    wp_enqueue_style('font-awesome');
    wp_register_style('custom-style', get_template_directory_uri() . '/css/custom.css', array(), '1.0.1');
    wp_enqueue_style('custom-style');

    // Add JS files
    wp_enqueue_script('jquery');
    wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery'), '5.0.2', true);
    wp_enqueue_script('bootstrap');
    wp_register_script('custom-script', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('custom-script');
    wp_register_script('font-awesome', get_template_directory_uri() . '/js/font-awesome.min.js', array(), '4.7.0', true);
    wp_enqueue_script('font-awesome');

}
add_action('wp_enqueue_scripts', 'faizaan_add_css_js_files');

// Add Fonts
function faizaan_add_google_fonts()
{
    wp_enqueue_style(
        'faizaan-google-fonts',
        'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap',
        false
    );
}
add_action('wp_enqueue_scripts', 'faizaan_add_google_fonts');

// Theme Functions
function faizaan_customizer_register($wp_customize)
{
    $wp_customize->add_section(
        'faizaan_header_area',
        array(
            'title' => __('Header Area', 'faizaan'),
            'priority' => 30,
            'description' => __('Customize the header area of the theme.', 'faizaan'),
        )
    );
    $wp_customize->add_setting(
        'faizaan_logo',
        array(
            'default' => get_bloginfo('template_directory') . '/img/logo.png',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'faizaan_logo',
            array(
                'label' => __('Logo', 'faizaan_logo'),
                'section' => 'faizaan_header_area',
                'settings' => 'faizaan_logo',
            )
        )
    );

    // Menu Position Options
    $wp_customize->add_section(
        'faizaan_menu_position',
        array(
            'title' => __('Menu Position', 'faizaan'),

            'description' => __('Customize the menu position of the theme.', 'faizaan'),
        )
    );
    $wp_customize->add_setting(
        'faizaan_menu_position',
        array(
            'default' => 'left',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'faizaan_menu_position',
        array(
            'label' => __('Menu Position', 'faizaan'),
            'section' => 'faizaan_header_area',
            'settings' => 'faizaan_menu_position',
            'type' => 'radio',
            'choices' => array(
                'left' => __('Left', 'faizaan'),
                'right' => __('Right', 'faizaan'),
                'center' => __('Center', 'faizaan'),
            ),
        )
    );


}
add_action('customize_register', 'faizaan_customizer_register');

// Register menus
register_nav_menu('main_menu', __('Main Menu', 'faizaan'));