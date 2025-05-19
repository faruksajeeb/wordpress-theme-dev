<?php
/**
 * Template Name: Home Template
 */

get_header(); ?>

<main id="skip-content" slider-loop="<?php echo esc_html(get_theme_mod('fashion_estore_slider_loop')); ?>">
  <section id="slide_cat">
     <?php if(get_theme_mod('fashion_estore_slider_show_setting',true) != ''){ ?>
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-4">
          <?php if(class_exists('woocommerce')){ ?>
            <div class="home_product_cat">
              <?php $fashion_estore_product_args = array(
                  'number'     => '',
                  'orderby'    => 'title',
                  'order'      => 'ASC',
                  'hide_empty' => '',
                  'include'    => ''
              );
              $fashion_estore_product_categories = get_terms( 'product_cat', $fashion_estore_product_args );
              $count = count($fashion_estore_product_categories);
                if ( $count > 0 ){
                  foreach ( $fashion_estore_product_categories as $fashion_estore_product_category ) {
                  echo '<h4><a href="' . get_term_link( $fashion_estore_product_category ) . '">' . $fashion_estore_product_category->name . '</a></h4>';
                  $fashion_estore_product_args = array(
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
        <div class="col-lg-9 col-md-8">
          <div id="top-slider">
            <?php $fashion_estore_slide_pages = array();
              for ( $count = 1; $count <= 3; $count++ ) {
                $fashion_estore_mod = intval( get_theme_mod( 'fashion_estore_top_slider_page' . $count ));
                if ( 'page-none-selected' != $fashion_estore_mod ) {
                  $fashion_estore_slide_pages[] = $fashion_estore_mod;
                }
              }
              if( !empty($fashion_estore_slide_pages) ) :
                $fashion_estore_product_args = array(
                  'post_type' => 'page',
                  'post__in' => $fashion_estore_slide_pages,
                  'orderby' => 'post__in'
                );
                $query = new WP_Query( $fashion_estore_product_args );
                if ( $query->have_posts() ) :
                  $i = 1;
            ?>
            <div class="owl-carousel" role="listbox">
              <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="slider-box">
                  <?php if(has_post_thumbnail()){
                    the_post_thumbnail();
                    } else{?>
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/slider.png" alt="" />
                  <?php } ?>
                  <div class="slider-inner-box">
                    <?php if(get_theme_mod('fashion_estore_slider_title_setting',1) == 1){ ?>
                      <h2><?php the_title(); ?></h2>
                    <?php }?>
                    <?php if(get_theme_mod('fashion_estore_slider_button_setting',1) == 1 && get_theme_mod('fashion_estore_slider_button_text','SHOP NOW') != ''){ ?>
                      <div class="slide-btn"><a href="<?php the_permalink(); ?>"><?php esc_html_e(get_theme_mod('fashion_estore_slider_button_text','SHOP NOW')); ?></a></div>
                    <?php }?>
                  </div>
                </div>
              <?php $i++; endwhile;
              wp_reset_postdata();?>
            </div>
            <?php else : ?>
              <div class="no-postfound"></div>
            <?php endif;
            endif;?>
          </div>
        </div>
      </div>
    </div>
    <?php }?>
  </section>
  <?php if (get_theme_mod('water_delivery_services_activities_section_setting', true) != '') { ?>
    <section id="product-section" class="py-5">
      <div class="container">
        <div class="owl-carousel product-home-box">
          <?php
          if ( class_exists( 'WooCommerce' ) ) {
            $fashion_estore_args = array(
              'post_type' => 'product',
              'posts_per_page' => 6,
              'product_cat' => get_theme_mod('fashion_estore_home_product'),
              'order' => 'ASC'
            );
            $loop = new WP_Query( $fashion_estore_args );
            while ( $loop->have_posts() ) : $loop->the_post(); global $product; 
              $product_cats = wc_get_product_category_list( $product->get_id(), ', ', '<span class="woo-cat">', '</span>' );
              $product_cats_array = explode( ', ', strip_tags( $product_cats ) );
              ?>
              <div class="products-box mb-4">
                <div class="product-image">
                  <a href="<?php echo esc_url(get_permalink( $loop->post->ID )); ?>"> <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); ?></a>
                </div>
                <div class="product-content mb-3 pt-3 text-center">
                  <h3 class="mb-2"><a href="<?php echo esc_url(get_permalink( $loop->post->ID )); ?>"><?php the_title(); ?></a></h3>
                  <div class="row mb-3">
                    <div class="col-xl-5 col-lg-6 col-md-4 col-sm-5 col-6 align-self-center text-end">
                      <?php if( $product->is_type( 'simple' ) ){ woocommerce_template_loop_rating( $loop->post, $product ); } ?>
                    </div>
                    <div class="col-xl-7 col-lg-6 col-md-8 col-sm-7 col-6 align-self-center text-start">
                       <div class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>">
                        <?php echo $product->get_price_html(); ?>
                      </div>
                    </div>
                  </div>
                  <div class="cart-btn"><?php if( $product->is_type( 'simple' ) ) { woocommerce_template_loop_add_to_cart(  $loop->post, $product );} ?></div>
                </div>
              </div>
            <?php endwhile; wp_reset_postdata(); ?>
          <?php } ?>
        </div>
        </div>
    </section>
  <?php }?>
  <section id="content-section" class="container mt-lg-5">
    <?php
      if ( have_posts() ) :
        while ( have_posts() ) : the_post();
          the_content();
        endwhile;
      endif;
    ?>
  </section>
</main>

<?php get_footer(); ?>
