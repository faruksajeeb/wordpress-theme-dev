<?php 

/**
 * Get CSS
 */

function fashion_estore_getpage_css($hook) {
	wp_register_script( 'admin-notice-script', get_template_directory_uri() . '/inc/admin/js/admin-notice-script.js', array( 'jquery' ) );
    wp_localize_script('admin-notice-script','fashion_estore',
		array('admin_ajax'	=>	admin_url('admin-ajax.php'),'wpnonce'  =>	wp_create_nonce('fashion_estore_dismissed_notice_nonce')
		)
	);
	wp_enqueue_script('admin-notice-script');

    wp_localize_script( 'admin-notice-script', 'fashion_estore_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
	if ( 'appearance_page_fashion-estore-info' != $hook ) {
		return;
	}
	wp_enqueue_style( 'fashion-estore-demo-style', get_template_directory_uri() . '/assets/css/demo.css' );
}
add_action( 'admin_enqueue_scripts', 'fashion_estore_getpage_css' );

if ( ! defined( 'FASHION_ESTORE_CONTACT_SUPPORT' ) ) {
define('FASHION_ESTORE_CONTACT_SUPPORT',__('https://wordpress.org/support/theme/fashion-estore','fashion-estore'));
}
if ( ! defined( 'FASHION_ESTORE_REVIEW' ) ) {
define('FASHION_ESTORE_REVIEW',__('https://wordpress.org/support/theme/fashion-estore/reviews/#new-post','fashion-estore'));
}
if ( ! defined( 'FASHION_ESTORE_LIVE_DEMO' ) ) {
define('FASHION_ESTORE_LIVE_DEMO',__('https://demo.themagnifico.net/fashion-estore/','fashion-estore'));
}
if ( ! defined( 'FASHION_ESTORE_GET_PREMIUM_PRO' ) ) {
define('FASHION_ESTORE_GET_PREMIUM_PRO',__('https://www.themagnifico.net/products/fashion-store-wordpress-theme','fashion-estore'));
}
if ( ! defined( 'FASHION_ESTORE_PRO_DOC' ) ) {
define('FASHION_ESTORE_PRO_DOC',__('https://demo.themagnifico.net/eard/wathiqa/fashion-store-pro-doc/','fashion-estore'));
}
if ( ! defined( 'FASHION_ESTORE_FREE_DOC' ) ) {
define('FASHION_ESTORE_FREE_DOC',__('https://demo.themagnifico.net/eard/wathiqa/stylish-fashion-shop-free-doc/','fashion-estore'));
}

add_action('admin_menu', 'fashion_estore_themepage');
function fashion_estore_themepage(){

	$fashion_estore_theme_test = wp_get_theme();

	$theme_info = add_theme_page( __('Theme Options','fashion-estore'), __('Theme Options','fashion-estore'), 'manage_options', 'fashion-estore-info.php', 'fashion_estore_info_page' );
}

function fashion_estore_info_page() {
	$user = wp_get_current_user();
	$theme = wp_get_theme();
	?>
	<div class="wrap about-wrap fashion-estore-add-css">
		<div>
			<h1>
				<?php esc_html_e('Welcome To ','fashion-estore'); ?><?php echo esc_html( $theme ); ?>
			</h1>
			<div class="feature-section three-col">
				<div class="col">
					<div class="widgets-holder-wrap demo-content">
						<h3><?php esc_html_e("Instant Demo Setup", "fashion-estore"); ?></h3>
						<p><?php esc_html_e("Import your entire demo content in just one click, including pages, posts, and design elements for a quick setup.", "fashion-estore"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( admin_url( 'admin.php?page=theme-importer' )); ?>" class="button button-primary get">
							<?php esc_html_e("Start Demo Import", "fashion-estore"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Checkout Premium", "fashion-estore"); ?></h3>
						<p><?php esc_html_e("Our premium theme comes with extended features like demo content import , responsive layouts etc.", "fashion-estore"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( FASHION_ESTORE_GET_PREMIUM_PRO ); ?>" class="button button-primary get prem">
							<?php esc_html_e("Get Premium", "fashion-estore"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Contact Support", "fashion-estore"); ?></h3>
						<p><?php esc_html_e("Thank you for trying Fashion Estore , feel free to contact us for any support regarding our theme.", "fashion-estore"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( FASHION_ESTORE_CONTACT_SUPPORT ); ?>" class="button button-primary get">
							<?php esc_html_e("Contact Support", "fashion-estore"); ?>
						</a></p>
					</div>
				</div>
			</div>
			<div class="feature-section three-col">
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Review", "fashion-estore"); ?></h3>
						<p><?php esc_html_e("If You love Fashion Estore theme then we would appreciate your review about our theme.", "fashion-estore"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( FASHION_ESTORE_REVIEW ); ?>" class="button button-primary get">
							<?php esc_html_e("Review", "fashion-estore"); ?>
						</a></p>
					</div>
				</div>

				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Free Documentation", "fashion-estore"); ?></h3>
						<p><?php esc_html_e("Our guide is available if you require any help configuring and setting up the theme. Easy and quick way to setup the theme.", "fashion-estore"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( FASHION_ESTORE_FREE_DOC ); ?>" class="button button-primary get">
							<?php esc_html_e("Free Documentation", "fashion-estore"); ?>
						</a></p>
					</div>
				</div>
				
			</div>
		</div>
		<hr>
		<h2><?php esc_html_e("Free Vs Premium","fashion-estore"); ?></h2>
		<div class="fashion-estore-button-container">
			<a target="_blank" href="<?php echo esc_url( FASHION_ESTORE_PRO_DOC ); ?>" class="button button-primary get">
				<?php esc_html_e("Checkout Documentation", "fashion-estore"); ?>
			</a>
			<a target="_blank" href="<?php echo esc_url( FASHION_ESTORE_LIVE_DEMO ); ?>" class="button button-primary get">
				<?php esc_html_e("View Theme Demo", "fashion-estore"); ?>
			</a>
		</div>
		<table class="wp-list-table widefat">
			<thead class="table-book">
				<tr>
					<th><strong><?php esc_html_e("Theme Feature", "fashion-estore"); ?></strong></th>
					<th><strong><?php esc_html_e("Basic Version", "fashion-estore"); ?></strong></th>
					<th><strong><?php esc_html_e("Premium Version", "fashion-estore"); ?></strong></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php esc_html_e("Header Background Color", "fashion-estore"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Custom Navigation Logo Or Text", "fashion-estore"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Hide Logo Text", "fashion-estore"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Premium Support", "fashion-estore"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Fully SEO Optimized", "fashion-estore"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Recent Posts Widget", "fashion-estore"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>

				<tr>
					<td><?php esc_html_e("Easy Google Fonts", "fashion-estore"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Pagespeed Plugin", "fashion-estore"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Only Show Header Image On Front Page", "fashion-estore"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Show Header Everywhere", "fashion-estore"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Custom Text On Header Image", "fashion-estore"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Full Width (Hide Sidebar)", "fashion-estore"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Only Show Upper Widgets On Front Page", "fashion-estore"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Replace Copyright Text", "fashion-estore"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Upper Widgets Colors", "fashion-estore"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Navigation Color", "fashion-estore"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Post/Page Color", "fashion-estore"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Blog Feed Color", "fashion-estore"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Footer Color", "fashion-estore"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Sidebar Color", "fashion-estore"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Background Color", "fashion-estore"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Importable Demo Content	", "fashion-estore"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
			</tbody>
		</table>
		<div class="fashion-estore-button-container">
			<a target="_blank" href="<?php echo esc_url( FASHION_ESTORE_GET_PREMIUM_PRO ); ?>" class="button button-primary get prem">
				<?php esc_html_e("Go Premium", "fashion-estore"); ?>
			</a>
		</div>
	</div>
	<?php
}


//Admin Notice For Getstart
function fashion_estore_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}

function fashion_estore_deprecated_hook_admin_notice() {

    $dismissed = get_user_meta(get_current_user_id(), 'fashion_estore_dismissable_notice', true);
    if ( !$dismissed) { ?>
        <div class="updated notice notice-success is-dismissible notice-get-started-class" data-notice="get_started" style="background: #f7f9f9; padding: 20px 10px; display: flex;">
	    	<div class="tm-admin-image">
	    		<img style="width: 100%;max-width: 320px;line-height: 40px;display: inline-block;vertical-align: top;border: 2px solid #ddd;border-radius: 4px;" src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" />
	    	</div>
	    	<div class="tm-admin-content" style="padding-left: 30px; align-self: center">
	    		<h2 style="font-weight: 600;line-height: 1.3; margin: 0px;"><?php esc_html_e('Thank You For Choosing ', 'fashion-estore'); ?><?php echo wp_get_theme(); ?><h2>
	    		<p style="color: #3c434a; font-weight: 400; margin-bottom: 30px;"><?php _e('Get Started With Theme By Clicking On Getting Started.', 'fashion-estore'); ?><p>
	        	<a class="admin-notice-btn button button-primary button-hero" target="_blank" href="<?php echo esc_url( admin_url( 'admin.php?page=theme-importer' )); ?>"><?php esc_html_e( 'Start Demo Import', 'fashion-estore' ) ?></a>
	        	<a class="admin-notice-btn button button-primary button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=fashion-estore-info.php' )); ?>"><?php esc_html_e( 'Get started', 'fashion-estore' ) ?></a>
	        	<a class="admin-notice-btn button button-primary button-hero" target="_blank" href="<?php echo esc_url( FASHION_ESTORE_FREE_DOC ); ?>"><?php esc_html_e( 'Documentation', 'fashion-estore' ) ?></a>
	        	<span style="padding-top: 15px; display: inline-block; padding-left: 8px;">
	        	<span class="dashicons dashicons-admin-links"></span>
	        	<a class="admin-notice-btn"	 target="_blank" href="<?php echo esc_url( FASHION_ESTORE_LIVE_DEMO ); ?>"><?php esc_html_e( 'View Demo', 'fashion-estore' ) ?></a>
	        	</span>
	    	</div>
        </div>
    <?php }
}

add_action( 'admin_notices', 'fashion_estore_deprecated_hook_admin_notice' );

function fashion_estore_switch_theme() {
    delete_user_meta(get_current_user_id(), 'fashion_estore_dismissable_notice');
}
add_action('after_switch_theme', 'fashion_estore_switch_theme');
function fashion_estore_dismissable_notice() {
    update_user_meta(get_current_user_id(), 'fashion_estore_dismissable_notice', true);
    die();
}