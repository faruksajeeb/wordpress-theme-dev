<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Fashion Estore
 */
?>

<footer id="colophon" class="site-footer border-top">
		    <div class="container">
		    	<div class="footer-column">
		    		<div class="row">
				        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
				          	<?php if (is_active_sidebar('fashion-estore-footer1')) : ?>
		                        <?php dynamic_sidebar('fashion-estore-footer1'); ?>
		                    <?php else : ?>
		                        <aside id="search" class="widget" role="complementary" aria-label="firstsidebar">
		                            <h5 class="widget-title"><?php esc_html_e( 'About Us', 'fashion-estore' ); ?></h5>
		                            <div class="textwidget">
		                            	<p><?php esc_html_e( 'Nam malesuada nulla nisi, ut faucibus magna congue nec. Ut libero tortor, tempus at auctor in, molestie at nisi. In enim ligula, consequat eu feugiat a.', 'fashion-estore' ); ?></p>
		                            </div>
		                        </aside>
		                    <?php endif; ?>
				        </div>
				        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
				            <?php if (is_active_sidebar('fashion-estore-footer2')) : ?>
		                        <?php dynamic_sidebar('fashion-estore-footer2'); ?>
		                    <?php else : ?>
		                        <aside id="pages" class="widget">
		                            <h5 class="widget-title"><?php esc_html_e( 'Useful Links', 'fashion-estore' ); ?></h5>
		                            <ul class="mt-4">
		                            	<li><?php esc_html_e( 'Home', 'fashion-estore' ); ?></li>
		                            	<li><?php esc_html_e( 'services', 'fashion-estore' ); ?></li>
		                            	<li><?php esc_html_e( 'Reviews', 'fashion-estore' ); ?></li>
		                            	<li><?php esc_html_e( 'About Us', 'fashion-estore' ); ?></li>
		                            </ul>
		                        </aside>
		                    <?php endif; ?>
				        </div>
				        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
				            <?php if (is_active_sidebar('fashion-estore-footer3')) : ?>
		                        <?php dynamic_sidebar('fashion-estore-footer3'); ?>
		                    <?php else : ?>
		                        <aside id="pages" class="widget">
		                            <h5 class="widget-title"><?php esc_html_e( 'Information', 'fashion-estore' ); ?></h5>
		                            <ul class="mt-4">
		                            	<li><?php esc_html_e( 'FAQ', 'fashion-estore' ); ?></li>
		                            	<li><?php esc_html_e( 'Site Maps', 'fashion-estore' ); ?></li>
		                            	<li><?php esc_html_e( 'Privacy Policy', 'fashion-estore' ); ?></li>
		                            	<li><?php esc_html_e( 'Contact Us', 'fashion-estore' ); ?></li>
		                            </ul>
		                        </aside>
		                    <?php endif; ?>
				        </div>
				        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
				            <?php if (is_active_sidebar('fashion-estore-footer4')) : ?>
		                        <?php dynamic_sidebar('fashion-estore-footer4'); ?>
		                    <?php else : ?>
		                        <aside id="pages" class="widget">
		                            <h5 class="widget-title"><?php esc_html_e( 'Get In Touch', 'fashion-estore' ); ?></h5>
		                            <ul class="mt-4">
		                            	<li><?php esc_html_e( 'Via Carlo Montù 78', 'fashion-estore' ); ?><br><?php esc_html_e( '22021 Bellagio CO, Italy', 'fashion-estore' ); ?></li>
		                            	<li><?php esc_html_e( '+11 6254 7855', 'fashion-estore' ); ?></li>
		                            	<li><?php esc_html_e( 'support@example.com', 'fashion-estore' ); ?></li>
		                            </ul>
		                        </aside>
		                    <?php endif; ?>
				        </div>
			      	</div>
				</div>
		    	<?php if (get_theme_mod('fashion_estore_show_hide_copyright', true)) {?>
				        <div class="site-info text-center">
				            <div class="footer-menu-left">
				            	<?php  if( ! get_theme_mod('fashion_estore_footer_text_setting') ){ ?>
								    <a target="_blank" href="<?php echo esc_url('https://wordpress.org/', 'fashion-estore' ); ?>">
										<?php
										/* translators: %s: CMS name, i.e. WordPress. */
										printf( esc_html__( 'Proudly powered by %s', 'fashion-estore' ), 'WordPress' );
										?>
								    </a>
								    <span class="sep mr-1"> | </span>

								    <span>
								    	<a target="_blank" href="<?php echo esc_url( 'https://www.themagnifico.net/products/free-fashion-wordpress-theme'); ?>">
							              	<?php
							                /* translators: 1: Theme name,  */
							                printf( esc_html__( ' %1$s ', 'fashion-estore' ),'Fashion Store WordPress Theme' );
							              	?>
						              	</a>
							          	<?php
							              /* translators: 1: Theme author. */
							              printf( esc_html__( 'by %1$s.', 'fashion-estore' ),'TheMagnifico'  );
							            ?>
				        			</span>
								<?php }?>
								<?php echo esc_html(get_theme_mod('fashion_estore_footer_text_setting')); ?>
				            </div>
				        </div>
				<?php } ?>
			    <?php if(get_theme_mod('fashion_estore_scroll_hide','')){ ?>
			    	<a id="button"><?php esc_html_e('TOP','fashion-estore'); ?></a>
			    <?php } ?>
		    </div>
		</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
