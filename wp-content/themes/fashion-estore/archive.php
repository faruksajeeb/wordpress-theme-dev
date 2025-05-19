<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Fashion Estore
 */

get_header(); ?>

    <div id="skip-content" class="container">
        <div class="row mb-5">
            <?php if (get_theme_mod('fashion_estore_blog_sidebar_position','Right Side') == 'Left Side'){?>
                <?php get_sidebar(); ?>
            <?php }?>
            <div id="primary" class="content-area col-lg-9 col-lg-8">
                <main id="main" class="site-main module-border-wrap">
                    <div class="row">
                        <?php if (have_posts()) : ?>

                            <header class="page-header">
                                <?php
                                the_archive_title('<h2 class="page-title">', '</h2>');
                                the_archive_description('<div class="archive-description">', '</div>');
                                ?>
                            </header>

                            <?php
                            /* Start the Loop */
                            while (have_posts()) :
                                the_post();

                                /*
                                 * Include the Post-Type-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                                 */
                                get_template_part( 'template-parts/content',get_post_format());

                            endwhile;

                            fashion_estore_blog_posts_pagination(); 

                        else :

                            get_template_part('template-parts/content', 'none');

                        endif;
                        ?>
                    </div>
                </main>
            </div>
            <?php if (get_theme_mod('fashion_estore_blog_sidebar_position','Right Side') == 'Right Side'){?>
                <?php get_sidebar(); ?>
            <?php }?>
        </div>
    </div>

<?php get_footer();