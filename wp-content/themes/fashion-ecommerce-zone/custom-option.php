<?php

    $fashion_estore_theme_css= "";

    /*------------------ Nav Menus -------------------*/
    $fashion_estore_nav_menu_font_weight = get_theme_mod( 'fashion_estore_nav_menu_font_weight',400);
    if($fashion_estore_nav_menu_font_weight != ''){
        $fashion_estore_theme_css .='.main-navigation .menu > li > a{';
            $fashion_estore_theme_css .='font-weight: '.esc_attr($fashion_estore_nav_menu_font_weight).';';
        $fashion_estore_theme_css .='}';
    }

    /*--------------------------- Preloader color -------------------*/
    $fashion_estore_preloader2_dot_color = get_theme_mod( 'fashion_estore_preloader2_dot_color');
    if( $fashion_estore_preloader2_dot_color != '') {
        $fashion_estore_theme_css .='.load hr {';
            $fashion_estore_theme_css .='background-color: '. $fashion_estore_preloader2_dot_color. ';';
        $fashion_estore_theme_css .='}';
    }