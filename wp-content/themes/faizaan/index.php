<?php
/**
 * This template for displaying header
 */
?>
<!DOCTYPE html>
<html lang="<?= language_attributes(); ?>" class="no-js">

<head>
    <meta charset="<?= bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class() ?>>
    <div id="header_area">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <a href="">
                        <img src="<?= get_theme_mod('faizaan_logo'); ?>" width="100" alt="">
                    </a>
                </div>
                <div class="col-md-9 text-right">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'main_menu',
                        'menu_id' => 'nav',
                    )) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-content text-center p-5">
        <h1>Welcome to Faizaan Theme</h1>
        <p>Your one-stop solution for all your WordPress needs.</p>
        <a href="#" class="btn btn-primary">Get Started</a>
    </div>
    <?php wp_footer(); ?>
</body>

</html>