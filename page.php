<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package WP_Blank
 */

get_header();
?>

<main id="primary" class="site-main flex-1">
    <div class="container py-8">
        <?php wp_blank_breadcrumbs(); ?>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <?php
                while (have_posts()) :
                    the_post();
                ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-sm border border-gray-200 p-8'); ?>>
                        <header class="entry-header mb-6">
                            <?php the_title('<h1 class="entry-title text-3xl font-bold text-gray-900">', '</h1>'); ?>
                        </header><!-- .entry-header -->

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="entry-thumbnail mb-6">
                                <?php the_post_thumbnail('large', ['class' => 'w-full h-auto rounded']); ?>
                            </div><!-- .entry-thumbnail -->
                        <?php endif; ?>

                        <div class="entry-content prose prose-lg max-w-none">
                            <?php
                            the_content();

                            wp_link_pages([
                                'before' => '<div class="page-links bg-gray-50 p-4 rounded mt-6">' . esc_html__('Pages:', 'wp-blank'),
                                'after'  => '</div>',
                            ]);
                            ?>
                        </div><!-- .entry-content -->

                        <?php if (get_edit_post_link()) : ?>
                            <footer class="entry-footer mt-6 pt-6 border-t border-gray-200">
                                <?php
                                edit_post_link(
                                    sprintf(
                                        wp_kses(
                                            __('Edit <span class="screen-reader-text">"%s"</span>', 'wp-blank'),
                                            ['span' => ['class' => []]]
                                        ),
                                        wp_kses_post(get_the_title())
                                    ),
                                    '<span class="edit-link text-blue-600 hover:text-blue-800">',
                                    '</span>'
                                );
                                ?>
                            </footer><!-- .entry-footer -->
                        <?php endif; ?>
                    </article><!-- #post-<?php the_ID(); ?> -->

                    <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if (comments_open() || get_comments_number()) :
                        ?>
                        <div class="comments-section mt-8">
                            <?php comments_template(); ?>
                        </div>
                        <?php
                    endif;
                    ?>
                <?php
                endwhile; // End of the loop.
                ?>
            </div><!-- .lg:col-span-2 -->

            <?php get_sidebar(); ?>
        </div><!-- .grid -->
    </div><!-- .container -->
</main><!-- #primary -->

<?php
get_footer(); 