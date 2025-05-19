<?php

    $fashion_estore_theme_css= "";

    /*--------------------------- Scroll To Top Positions -------------------*/

    $fashion_estore_scroll_position = get_theme_mod( 'fashion_estore_scroll_top_position','Right');
    if($fashion_estore_scroll_position == 'Right'){
        $fashion_estore_theme_css .='#button{';
            $fashion_estore_theme_css .='right: 20px;';
        $fashion_estore_theme_css .='}';
    }else if($fashion_estore_scroll_position == 'Left'){
        $fashion_estore_theme_css .='#button{';
            $fashion_estore_theme_css .='left: 20px; right: auto;';
        $fashion_estore_theme_css .='}';
    }else if($fashion_estore_scroll_position == 'Center'){
        $fashion_estore_theme_css .='#button{';
            $fashion_estore_theme_css .='right: auto;left: 50%; transform: translateX(50%);';
        $fashion_estore_theme_css .='}';
    }

    /*--------------------------- Scroll To Top Border Radius -------------------*/

    $fashion_estore_scroll_to_top_border_radius = get_theme_mod('fashion_estore_scroll_to_top_border_radius');
    $fashion_estore_scroll_bg_color = get_theme_mod('fashion_estore_scroll_bg_color');
    $fashion_estore_scroll_color = get_theme_mod('fashion_estore_scroll_color');
    $fashion_estore_scroll_font_size = get_theme_mod('fashion_estore_scroll_font_size');
    if($fashion_estore_scroll_to_top_border_radius != false || $fashion_estore_scroll_bg_color != false || $fashion_estore_scroll_color != false || $fashion_estore_scroll_font_size != false){
        $fashion_estore_theme_css .='#colophon a#button{';
            $fashion_estore_theme_css .='border-radius: '.esc_attr($fashion_estore_scroll_to_top_border_radius).'px; background-color: '.esc_attr($fashion_estore_scroll_bg_color).'; color: '.esc_attr($fashion_estore_scroll_color).' !important; font-size: '.esc_attr($fashion_estore_scroll_font_size).'px;';
        $fashion_estore_theme_css .='}';
    }

    /*--------------------------- Slider Image Opacity -------------------*/

    $fashion_estore_slider_img_opacity = get_theme_mod( 'fashion_estore_slider_opacity_color','0.9');
    if($fashion_estore_slider_img_opacity == '0'){
        $fashion_estore_theme_css .='.slider-box img{';
            $fashion_estore_theme_css .='opacity:0';
        $fashion_estore_theme_css .='}';
        }else if($fashion_estore_slider_img_opacity == '0.1'){
        $fashion_estore_theme_css .='.slider-box img{';
            $fashion_estore_theme_css .='opacity:0.1';
        $fashion_estore_theme_css .='}';
        }else if($fashion_estore_slider_img_opacity == '0.2'){
        $fashion_estore_theme_css .='.slider-box img{';
            $fashion_estore_theme_css .='opacity:0.2';
        $fashion_estore_theme_css .='}';
        }else if($fashion_estore_slider_img_opacity == '0.3'){
        $fashion_estore_theme_css .='.slider-box img{';
            $fashion_estore_theme_css .='opacity:0.3';
        $fashion_estore_theme_css .='}';
        }else if($fashion_estore_slider_img_opacity == '0.4'){
        $fashion_estore_theme_css .='.slider-box img{';
            $fashion_estore_theme_css .='opacity:0.4';
        $fashion_estore_theme_css .='}';
        }else if($fashion_estore_slider_img_opacity == '0.5'){
        $fashion_estore_theme_css .='.slider-box img{';
            $fashion_estore_theme_css .='opacity:0.5';
        $fashion_estore_theme_css .='}';
        }else if($fashion_estore_slider_img_opacity == '0.6'){
        $fashion_estore_theme_css .='.slider-box img{';
            $fashion_estore_theme_css .='opacity:0.6';
        $fashion_estore_theme_css .='}';
        }else if($fashion_estore_slider_img_opacity == '0.7'){
        $fashion_estore_theme_css .='.slider-box img{';
            $fashion_estore_theme_css .='opacity:0.7';
        $fashion_estore_theme_css .='}';
        }else if($fashion_estore_slider_img_opacity == '0.8'){
        $fashion_estore_theme_css .='.slider-box img{';
            $fashion_estore_theme_css .='opacity:0.8';
        $fashion_estore_theme_css .='}';
        }else if($fashion_estore_slider_img_opacity == '0.9'){
        $fashion_estore_theme_css .='.slider-box img{';
            $fashion_estore_theme_css .='opacity:0.9';
        $fashion_estore_theme_css .='}';
        }

    /*---------------------------Slider Height ------------*/

    $fashion_estore_slider_img_height = get_theme_mod('fashion_estore_slider_img_height');
    if($fashion_estore_slider_img_height != false){
        $fashion_estore_theme_css .='#top-slider .owl-carousel .owl-item img{';
            $fashion_estore_theme_css .='height: '.esc_attr($fashion_estore_slider_img_height).';';
        $fashion_estore_theme_css .='}';
    }

    /*--------------------------- Post Page Image Box Shadow -------------------*/

    $fashion_estore_post_page_image_box_shadow = get_theme_mod('fashion_estore_post_page_image_box_shadow',0);
    if($fashion_estore_post_page_image_box_shadow != false){
        $fashion_estore_theme_css .='.article-box img{';
            $fashion_estore_theme_css .='box-shadow: '.esc_attr($fashion_estore_post_page_image_box_shadow).'px '.esc_attr($fashion_estore_post_page_image_box_shadow).'px '.esc_attr($fashion_estore_post_page_image_box_shadow).'px #cccccc;';
        $fashion_estore_theme_css .='}';
    }

    /*---------------- Single post Settings ------------------*/

    $fashion_estore_single_post_navigation_show_hide = get_theme_mod('fashion_estore_single_post_navigation_show_hide',true);
    if($fashion_estore_single_post_navigation_show_hide != true){
        $fashion_estore_theme_css .='.nav-links{';
            $fashion_estore_theme_css .='display: none;';
        $fashion_estore_theme_css .='}';
    }

    /*--------------------------- Product Image Box Shadow -------------------*/

    $fashion_estore_woo_product_image_box_shadow = get_theme_mod('fashion_estore_woo_product_image_box_shadow',0);
    if($fashion_estore_woo_product_image_box_shadow != false){
        $fashion_estore_theme_css .='.woocommerce ul.products li.product a img{';
            $fashion_estore_theme_css .='box-shadow: '.esc_attr($fashion_estore_woo_product_image_box_shadow).'px '.esc_attr($fashion_estore_woo_product_image_box_shadow).'px '.esc_attr($fashion_estore_woo_product_image_box_shadow).'px #cccccc;';
        $fashion_estore_theme_css .='}';
    }

    /*--------------------------- Woocommerce Product Sale Positions -------------------*/

    $fashion_estore_product_sale = get_theme_mod( 'fashion_estore_woocommerce_product_sale','Right');
    if($fashion_estore_product_sale == 'Right'){
        $fashion_estore_theme_css .='.woocommerce ul.products li.product .onsale{';
            $fashion_estore_theme_css .='left: auto; right: 15px;';
        $fashion_estore_theme_css .='}';
    }else if($fashion_estore_product_sale == 'Left'){
        $fashion_estore_theme_css .='.woocommerce ul.products li.product .onsale{';
            $fashion_estore_theme_css .='left: 15px; right: auto;';
        $fashion_estore_theme_css .='}';
    }else if($fashion_estore_product_sale == 'Center'){
        $fashion_estore_theme_css .='.woocommerce ul.products li.product .onsale{';
            $fashion_estore_theme_css .='right: 50%;left: 50%;';
        $fashion_estore_theme_css .='}';
    }

    /*--------------------------- Woocommerce Product Border Radius -------------------*/

    $fashion_estore_woo_product_sale_border_radius = get_theme_mod('fashion_estore_woo_product_sale_border_radius');
    if($fashion_estore_woo_product_sale_border_radius != false){
        $fashion_estore_theme_css .='.woocommerce ul.products li.product .onsale{';
            $fashion_estore_theme_css .='border-radius: '.esc_attr($fashion_estore_woo_product_sale_border_radius).'px;';
        $fashion_estore_theme_css .='}';
    }

     /*--------------------------- Woocommerce Related Products -------------------*/

    $fashion_estore_woocommerce_related_product_show_hide = get_theme_mod('fashion_estore_woocommerce_related_product_show_hide',true);
    if($fashion_estore_woocommerce_related_product_show_hide != true){
        $fashion_estore_theme_css .='.related.products{';
            $fashion_estore_theme_css .='display: none;';
        $fashion_estore_theme_css .='}';
    }

    /*--------------------------- Footer Background Color -------------------*/

    $fashion_estore_footer_background_color = get_theme_mod('fashion_estore_footer_background_color');
    if($fashion_estore_footer_background_color != false){
        $fashion_estore_theme_css .='.footer-widgets{';
            $fashion_estore_theme_css .='background-color: '.esc_attr($fashion_estore_footer_background_color).' !important;';
        $fashion_estore_theme_css .='}';
    }

    /*--------------------------- Footer background image -------------------*/

    $fashion_estore_footer_bg_image = get_theme_mod('fashion_estore_footer_bg_image');
    if($fashion_estore_footer_bg_image != false){
        $fashion_estore_theme_css .='#colophon{';
            $fashion_estore_theme_css .='background: url('.esc_attr($fashion_estore_footer_bg_image).')!important;';
        $fashion_estore_theme_css .='}';
    }

    /*--------------------------- Single Post Page Image Box Shadow -------------------*/

    $fashion_estore_single_post_page_image_box_shadow = get_theme_mod('fashion_estore_single_post_page_image_box_shadow',0);
    if($fashion_estore_single_post_page_image_box_shadow != false){
        $fashion_estore_theme_css .='.single-post .entry-header img{';
            $fashion_estore_theme_css .='box-shadow: '.esc_attr($fashion_estore_single_post_page_image_box_shadow).'px '.esc_attr($fashion_estore_single_post_page_image_box_shadow).'px '.esc_attr($fashion_estore_single_post_page_image_box_shadow).'px #cccccc;';
        $fashion_estore_theme_css .='}';
    }

     /*--------------------------- Single Post Page Image Border Radius -------------------*/

    $fashion_estore_single_post_page_image_border_radius = get_theme_mod('fashion_estore_single_post_page_image_border_radius', 0);
    if($fashion_estore_single_post_page_image_border_radius != false){
        $fashion_estore_theme_css .='.single-post .entry-header img{';
            $fashion_estore_theme_css .='border-radius: '.esc_attr($fashion_estore_single_post_page_image_border_radius).'px;';
        $fashion_estore_theme_css .='}';
    }

    /*--------------------------- Footer Background Image Position -------------------*/

    $fashion_estore_footer_bg_image_position = get_theme_mod( 'fashion_estore_footer_bg_image_position','scroll');
    if($fashion_estore_footer_bg_image_position == 'fixed'){
        $fashion_estore_theme_css .='#colophon{';
            $fashion_estore_theme_css .='background-attachment: fixed !important; background-position: center !important;';
        $fashion_estore_theme_css .='}';
    }elseif ($fashion_estore_footer_bg_image_position == 'scroll'){
        $fashion_estore_theme_css .='#colophon{';
            $fashion_estore_theme_css .='background-attachment: scroll !important; background-position: center !important;';
        $fashion_estore_theme_css .='}';
    }

    /*--------------------------- Footer Widget Heading Alignment -------------------*/

    $fashion_estore_footer_widget_heading_alignment = get_theme_mod( 'fashion_estore_footer_widget_heading_alignment','Left');
    if($fashion_estore_footer_widget_heading_alignment == 'Left'){
        $fashion_estore_theme_css .='#colophon h5, h5.footer-column-widget-title{';
        $fashion_estore_theme_css .='text-align: left;';
        $fashion_estore_theme_css .='}';
    }else if($fashion_estore_footer_widget_heading_alignment == 'Center'){
        $fashion_estore_theme_css .='#colophon h5, h5.footer-column-widget-title{';
            $fashion_estore_theme_css .='text-align: center;';
        $fashion_estore_theme_css .='}';
    }else if($fashion_estore_footer_widget_heading_alignment == 'Right'){
        $fashion_estore_theme_css .='#colophon h5, h5.footer-column-widget-title{';
            $fashion_estore_theme_css .='text-align: right;';
        $fashion_estore_theme_css .='}';
    }

    /*--------------------------- Copyright Background Color -------------------*/

    $fashion_estore_copyright_background_color = get_theme_mod('fashion_estore_copyright_background_color');
    if($fashion_estore_copyright_background_color != false){
        $fashion_estore_theme_css .='.footer_info{';
            $fashion_estore_theme_css .='background-color: '.esc_attr($fashion_estore_copyright_background_color).' !important;';
        $fashion_estore_theme_css .='}';
    }

    /*--------------------------- Featured Image Border Radius -------------------*/

    $fashion_estore_post_page_image_border_radius = get_theme_mod('fashion_estore_post_page_image_border_radius', 0);
    if($fashion_estore_post_page_image_border_radius != false){
        $fashion_estore_theme_css .='.article-box img{';
            $fashion_estore_theme_css .='border-radius: '.esc_attr($fashion_estore_post_page_image_border_radius).'px;';
        $fashion_estore_theme_css .='}';
    }

    /*--------------------------- Site Title And Tagline Color -------------------*/

    $fashion_estore_logo_title_color = get_theme_mod('fashion_estore_logo_title_color');
    if($fashion_estore_logo_title_color != false){
        $fashion_estore_theme_css .='p.site-title a, .navbar-brand a{';
            $fashion_estore_theme_css .='color: '.esc_attr($fashion_estore_logo_title_color).' !important;';
        $fashion_estore_theme_css .='}';
    }

    $fashion_estore_logo_tagline_color = get_theme_mod('fashion_estore_logo_tagline_color');
    if($fashion_estore_logo_tagline_color != false){
        $fashion_estore_theme_css .='.logo p.site-description, .navbar-brand p{';
            $fashion_estore_theme_css .='color: '.esc_attr($fashion_estore_logo_tagline_color).'  !important;';
        $fashion_estore_theme_css .='}';
    }

    /*--------------------------- Footer Widget Content Alignment -------------------*/

    $fashion_estore_footer_widget_content_alignment = get_theme_mod( 'fashion_estore_footer_widget_content_alignment','Left');
    if($fashion_estore_footer_widget_content_alignment == 'Left'){
        $fashion_estore_theme_css .='#colophon ul, #colophon p, .tagcloud, .widget{';
        $fashion_estore_theme_css .='text-align: left;';
        $fashion_estore_theme_css .='}';
    }else if($fashion_estore_footer_widget_content_alignment == 'Center'){
        $fashion_estore_theme_css .='#colophon ul, #colophon p, .tagcloud, .widget{';
            $fashion_estore_theme_css .='text-align: center;';
        $fashion_estore_theme_css .='}';
    }else if($fashion_estore_footer_widget_content_alignment == 'Right'){
        $fashion_estore_theme_css .='#colophon ul, #colophon p, .tagcloud, .widget{';
            $fashion_estore_theme_css .='text-align: right;';
        $fashion_estore_theme_css .='}';
    }

    /*--------------------------- Copyright Content Alignment -------------------*/

    $fashion_estore_copyright_content_alignment = get_theme_mod( 'fashion_estore_copyright_content_alignment','Center');
    if($fashion_estore_copyright_content_alignment == 'Left'){
        $fashion_estore_theme_css .='.footer-menu-left{';
        $fashion_estore_theme_css .='text-align: left;';
        $fashion_estore_theme_css .='}';
    }else if($fashion_estore_copyright_content_alignment == 'Center'){
        $fashion_estore_theme_css .='.footer-menu-left{';
            $fashion_estore_theme_css .='text-align: center;';
        $fashion_estore_theme_css .='}';
    }else if($fashion_estore_copyright_content_alignment == 'Right'){
        $fashion_estore_theme_css .='.footer-menu-left{';
            $fashion_estore_theme_css .='text-align: right;';
        $fashion_estore_theme_css .='}';
    }

    /*------------------ Nav Menus -------------------*/

    $fashion_estore_nav_menu = get_theme_mod( 'fashion_estore_nav_menu_text_transform','Uppercase');
    if($fashion_estore_nav_menu == 'Capitalize'){
        $fashion_estore_theme_css .='.main-navigation .menu > li > a{';
            $fashion_estore_theme_css .='text-transform:Capitalize;';
        $fashion_estore_theme_css .='}';
    }
    if($fashion_estore_nav_menu == 'Lowercase'){
        $fashion_estore_theme_css .='.main-navigation .menu > li > a{';
            $fashion_estore_theme_css .='text-transform:Lowercase;';
        $fashion_estore_theme_css .='}';
    }
    if($fashion_estore_nav_menu == 'Uppercase'){
        $fashion_estore_theme_css .='.main-navigation .menu > li > a{';
            $fashion_estore_theme_css .='text-transform:Uppercase;';
        $fashion_estore_theme_css .='}';
    }

    $fashion_estore_menu_font_size = get_theme_mod( 'fashion_estore_menu_font_size');
    if($fashion_estore_menu_font_size != ''){
        $fashion_estore_theme_css .='.main-navigation .menu > li > a{';
            $fashion_estore_theme_css .='font-size: '.esc_attr($fashion_estore_menu_font_size).'px;';
        $fashion_estore_theme_css .='}';
    }

    $fashion_estore_nav_menu_font_weight = get_theme_mod( 'fashion_estore_nav_menu_font_weight',400);
    if($fashion_estore_menu_font_size != ''){
        $fashion_estore_theme_css .='.main-navigation .menu > li > a{';
            $fashion_estore_theme_css .='font-weight: '.esc_attr($fashion_estore_nav_menu_font_weight).';';
        $fashion_estore_theme_css .='}';
    }

    /*------------------ Slider CSS -------------------*/

    $fashion_estore_slider_content_layout = get_theme_mod( 'fashion_estore_slider_content_layout','Center');
    if($fashion_estore_slider_content_layout == 'Left'){
        $fashion_estore_theme_css .='.slider-inner-box, #top-slider .slider-inner-box p{';
            $fashion_estore_theme_css .='text-align : left;';
        $fashion_estore_theme_css .='}';
        $fashion_estore_theme_css .='.slider-inner-box{';
            $fashion_estore_theme_css .='padding-left : 13%;';
        $fashion_estore_theme_css .='}';
    }
    if($fashion_estore_slider_content_layout == 'Center'){
        $fashion_estore_theme_css .='.slider-inner-box, #top-slider .slider-inner-box p{';
            $fashion_estore_theme_css .='text-align : center;';
        $fashion_estore_theme_css .='}';
    }
    if($fashion_estore_slider_content_layout == 'Right'){
        $fashion_estore_theme_css .='.slider-inner-box, #top-slider .slider-inner-box p{';
            $fashion_estore_theme_css .='text-align : right;';
        $fashion_estore_theme_css .='}';
    }