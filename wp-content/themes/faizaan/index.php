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
    <header id="header_area" class="<?= get_theme_mod('faizaan_menu_position'); ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <a href="<?= home_url(); ?>">
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
    </header>
    <section class="hero-content text-center p-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>
    <?php wp_footer(); ?>
</body>

</html>