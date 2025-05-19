<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fashion Ecommerce Zone
 */
?>

	<footer id="colophon" class="site-footer border-top">
		<?php if (get_theme_mod('fashion_estore_show_hide_footer', true)) {?>
			<div class="footer-widgets">
			    <div class="container">
			    	<div class="footer-column">
				    	<div class="row">
					        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
					          	<?php if (is_active_sidebar('fashion-estore-footer1')) : ?>
			                        <?php dynamic_sidebar('fashion-estore-footer1'); ?>
			                    <?php else : ?>
			                        <aside id="search" class="widget" role="complementary" aria-label="firstsidebar">
			                            <h5 class="widget-title"><?php esc_html_e( 'About Us', 'fashion-ecommerce-zone' ); ?></h5>
			                            <div class="textwidget">
			                            	<p><?php esc_html_e( 'Nam malesuada nulla nisi, ut faucibus magna congue nec. Ut libero tortor, tempus at auctor in, molestie at nisi. In enim ligula, consequat eu feugiat a.', 'fashion-ecommerce-zone' ); ?></p>
			                            </div>
			                        </aside>
			                    <?php endif; ?>
					        </div>
					        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
					            <?php if (is_active_sidebar('fashion-estore-footer2')) : ?>
			                        <?php dynamic_sidebar('fashion-estore-footer2'); ?>
			                    <?php else : ?>
			                        <aside id="pages" class="widget">
			                            <h5 class="widget-title"><?php esc_html_e( 'Useful Links', 'fashion-ecommerce-zone' ); ?></h5>
			                            <ul class="mt-4">
			                            	<li><?php esc_html_e( 'Home', 'fashion-ecommerce-zone' ); ?></li>
			                            	<li><?php esc_html_e( 'services', 'fashion-ecommerce-zone' ); ?></li>
			                            	<li><?php esc_html_e( 'Reviews', 'fashion-ecommerce-zone' ); ?></li>
			                            	<li><?php esc_html_e( 'About Us', 'fashion-ecommerce-zone' ); ?></li>
			                            </ul>
			                        </aside>
			                    <?php endif; ?>
					        </div>
					        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
					            <?php if (is_active_sidebar('fashion-estore-footer3')) : ?>
			                        <?php dynamic_sidebar('fashion-estore-footer3'); ?>
			                    <?php else : ?>
			                        <aside id="pages" class="widget">
			                            <h5 class="widget-title"><?php esc_html_e( 'Information', 'fashion-ecommerce-zone' ); ?></h5>
			                            <ul class="mt-4">
			                            	<li><?php esc_html_e( 'FAQ', 'fashion-ecommerce-zone' ); ?></li>
			                            	<li><?php esc_html_e( 'Site Maps', 'fashion-ecommerce-zone' ); ?></li>
			                            	<li><?php esc_html_e( 'Privacy Policy', 'fashion-ecommerce-zone' ); ?></li>
			                            	<li><?php esc_html_e( 'Contact Us', 'fashion-ecommerce-zone' ); ?></li>
			                            </ul>
			                        </aside>
			                    <?php endif; ?>
					        </div>
					        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
					            <?php if (is_active_sidebar('fashion-estore-footer4')) : ?>
			                        <?php dynamic_sidebar('fashion-estore-footer4'); ?>
			                    <?php else : ?>
			                        <aside id="pages" class="widget">
			                            <h5 class="widget-title"><?php esc_html_e( 'Get In Touch', 'fashion-ecommerce-zone' ); ?></h5>
			                            <ul class="mt-4">
			                            	<li><?php esc_html_e( 'Via Carlo Montù 78', 'fashion-ecommerce-zone' ); ?><br><?php esc_html_e( '22021 Bellagio CO, Italy', 'fashion-ecommerce-zone' ); ?></li>
			                            	<li><?php esc_html_e( '+11 6254 7855', 'fashion-ecommerce-zone' ); ?></li>
			                            	<li><?php esc_html_e( 'support@example.com', 'fashion-ecommerce-zone' ); ?></li>
			                            </ul>
			                        </aside>
			                    <?php endif; ?>
					        </div>
				      	</div>
			    	</div>
			    </div>
			</div>
		<?php } ?>

		<?php if (get_theme_mod('fashion_estore_show_hide_copyright', true)) {?>
			<div class="footer_info">
				<div class="container">
			    	<div class="row m-0">
			    		<div class="col-lg-5 col-md-5 col-12">
							<?php if ( has_nav_menu( 'footer' ) ): ?>
					            <nav class="navbar footer-menu">
									<?php
										wp_nav_menu( array(
											'theme_location' => 'footer',
											'container'      => 'div',
											'container_id'   => 'main-nav',
											'menu_id'        => false,
											'depth'          => 1,
										) );
									?>
					            </nav>
							<?php endif ?>
						</div>
				        <div class="site-info col-lg-7 col-md-7 col-12">
				        	<div class="footer-menu-left">
				            	<?php if(! get_theme_mod('fashion_estore_footer_text_setting') != ''){ ?>
								    <a target="_blank" href="<?php echo esc_url( __( 'https://wordpress.org/', 'fashion-ecommerce-zone' ) ); ?>">
										<?php
										/* translators: %s: CMS name, i.e. WordPress. */
										printf( esc_html__( 'Proudly powered by %s', 'fashion-ecommerce-zone' ), 'WordPress' );
										?>
								    </a>
								    <span class="sep mr-1"> | </span>
								    <span>
								       <a target="_blank" href="<?php echo esc_url( 'https://www.themagnifico.net/products/fashion-ecommerce-wordpress-theme', 'fashion-ecommerce-zone'); ?>">
								           	<?php
								            	/* translators: 1: Theme name,  */
								            	printf( esc_html__( ' %1$s ', 'fashion-ecommerce-zone' ),'Fashion Ecommerce WordPress Theme' );
								            ?>
								    	</a>
								        <?php
								        	/* translators: 1: Theme author. */
								        	printf( esc_html__( 'by %1$s.', 'fashion-ecommerce-zone' ),'TheMagnifico'  );
								        ?>
								    </span>
								<?php }?>
								<?php echo esc_html(get_theme_mod('fashion_estore_footer_text_setting','')); ?>
				            </div>
				        </div>
				    </div>
				</div>
			</div>
		<?php } ?>
	  	<?php if(get_theme_mod('fashion_estore_scroll_hide','')){ ?>
	       <a id="button"><?php esc_html_e('TOP','fashion-ecommerce-zone'); ?></a>
	  	<?php } ?>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
