<?php
/**
 * Displays main header
 *
 * @package Fashion Estore
 */
?>
<div class="main_header">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <div class="navbar-brand">
                    <?php if ( has_custom_logo() ) : ?>
                        <div class="site-logo"><?php the_custom_logo(); ?></div>
                    <?php endif; ?>
                    <?php $fashion_estore_blog_info = get_bloginfo( 'name' ); ?>
                        <?php if ( ! empty( $fashion_estore_blog_info ) ) : ?>
                            <?php if ( is_front_page() && is_home() ) : ?>
                              <?php if( get_theme_mod('fashion_estore_logo_title',true) != ''){ ?>
                                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                              <?php }?>
                            <?php else : ?>
                             <?php if( get_theme_mod('fashion_estore_logo_title',true) != ''){ ?>
                                <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                            <?php }?>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php
                            $fashion_estore_description = get_bloginfo( 'description', 'display' );
                            if ( $fashion_estore_description || is_customize_preview() ) :
                        ?>
                       <?php if( get_theme_mod('fashion_estore_theme_description',false) != ''){ ?>
                         <p class="site-description"><?php echo esc_html($fashion_estore_description); ?></p>
                      <?php }?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-5 col-md-7 position-relative">
                <?php if(class_exists('woocommerce')){ ?>
                    <div class="pro_search">
                        <?php get_product_search_form(); ?>
                    </div>
                    <button class="cat_btn"><?php esc_html_e('All Categories','fashion-estore'); ?></button>
                    <div class="product_cat">
                        <?php $fashion_estore_args = array(
                            'number'     => '',
                            'orderby'    => 'title',
                            'order'      => 'ASC',
                            'hide_empty' => '',
                            'include'    => ''
                        );
                        $fashion_estore_product_categories = get_terms( 'product_cat', $fashion_estore_args );
                        $count = count($fashion_estore_product_categories);
                        if ( $count > 0 ){
                            foreach ( $fashion_estore_product_categories as $fashion_estore_product_category ) {
                                echo '<h4><a href="' . get_term_link( $fashion_estore_product_category ) . '">' . $fashion_estore_product_category->name . '</a></h4>';
                                $fashion_estore_args = array(
                                    'posts_per_page' => -1,
                                    'tax_query' => array(
                                        'relation' => 'AND',
                                        array(
                                            'taxonomy' => 'product_cat',
                                            'field' => 'slug',
                                            'terms' => $fashion_estore_product_category->slug
                                        )
                                    ),
                                    'post_type' => 'product',
                                    'orderby' => 'title,'
                                );
                            }
                        }?>
                    </div>
                <?php }?>
            </div>
            <div class="col-lg-3 col-md-4 col-8">
                <div class="call-info">
                    <div class="row">
                        <?php if(get_theme_mod('fashion_estore_phone_number_info') != ''){ ?>
                            <div class="col-lg-2 col-md-2 col-3">
                                <i class="<?php echo esc_html( get_theme_mod('fashion_estore_phone_number_icon') ); ?>"></i>
                            </div>
                            <div class="col-lg-10 col-md-10 col-9">
                                <strong><?php echo esc_html(get_theme_mod('fashion_estore_phone_number_text','')); ?></strong>
                                <p><?php echo esc_html(get_theme_mod('fashion_estore_phone_number_info','')); ?></p>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 col-md-1 col-4">
                <?php if(class_exists('woocommerce')){ ?>
                    <div class="cart_box">
                        <?php global $woocommerce; ?>
                        <a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e( 'shopping cart','fashion-estore' ); ?>"><i class="fas fa-shopping-bag"></i><span class="cart-value"><?php echo sprintf ( esc_html( '%d', '%d', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span></a>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>