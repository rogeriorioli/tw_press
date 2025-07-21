<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
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
                <?php if (have_posts()) : ?>
                    
                    <?php if (is_home() && !is_front_page()) : ?>
                        <header class="page-header mb-8">
                            <h1 class="page-title text-3xl font-bold text-gray-900">
                                <?php single_post_title(); ?>
                            </h1>
                        </header>
                    <?php endif; ?>

                    <div class="posts-container space-y-8">
                        <?php
                        // Start the Loop
                        while (have_posts()) :
                            the_post();
                        ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-sm border border-gray-200 p-6'); ?>>
                                <header class="entry-header mb-4">
                                    <?php
                                    if (is_singular()) :
                                        the_title('<h1 class="entry-title text-2xl font-bold text-gray-900">', '</h1>');
                                    else :
                                        the_title('<h2 class="entry-title text-xl font-semibold"><a href="' . esc_url(get_permalink()) . '" class="text-gray-900 hover:text-blue-600 transition-colors" rel="bookmark">', '</a></h2>');
                                    endif;
                                    ?>

                                    <?php if ('post' === get_post_type()) : ?>
                                        <div class="entry-meta text-sm text-gray-600 mt-2 flex flex-wrap items-center space-x-4">
                                            <time class="published" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                                <?php echo get_the_date(); ?>
                                            </time>
                                            <span class="author">
                                                <?php esc_html_e('By', 'wp-blank'); ?>
                                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="hover:text-gray-900">
                                                    <?php the_author(); ?>
                                                </a>
                                            </span>
                                            <?php if (has_category()) : ?>
                                                <span class="categories">
                                                    <?php the_category(', '); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div><!-- .entry-meta -->
                                    <?php endif; ?>
                                </header><!-- .entry-header -->

                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="entry-thumbnail mb-4">
                                        <?php
                                        if (is_singular()) :
                                            the_post_thumbnail('large', ['class' => 'w-full h-auto rounded']);
                                        else :
                                            ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('large', ['class' => 'w-full h-auto rounded hover:opacity-90 transition-opacity']); ?>
                                            </a>
                                            <?php
                                        endif;
                                        ?>
                                    </div><!-- .entry-thumbnail -->
                                <?php endif; ?>

                                <div class="entry-content prose prose-lg max-w-none">
                                    <?php
                                    if (is_singular()) :
                                        the_content(sprintf(
                                            wp_kses(
                                                __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'wp-blank'),
                                                ['span' => ['class' => []]]
                                            ),
                                            wp_kses_post(get_the_title())
                                        ));

                                        wp_link_pages([
                                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'wp-blank'),
                                            'after'  => '</div>',
                                        ]);
                                    else :
                                        the_excerpt();
                                        ?>
                                        <a href="<?php the_permalink(); ?>" class="inline-flex items-center mt-4 text-blue-600 hover:text-blue-800 font-medium">
                                            <?php esc_html_e('Read more', 'wp-blank'); ?>
                                            <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                        <?php
                                    endif;
                                    ?>
                                </div><!-- .entry-content -->

                                <?php if (is_singular() && (has_tag() || comments_open() || get_comments_number())) : ?>
                                    <footer class="entry-footer mt-6 pt-6 border-t border-gray-200">
                                        <?php if (has_tag()) : ?>
                                            <div class="tags mb-4">
                                                <span class="text-sm text-gray-600 mr-2"><?php esc_html_e('Tags:', 'wp-blank'); ?></span>
                                                <?php the_tags('', ', ', ''); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (comments_open() || get_comments_number()) : ?>
                                            <div class="comments-link">
                                                <?php comments_popup_link(
                                                    esc_html__('Leave a comment', 'wp-blank'),
                                                    esc_html__('1 Comment', 'wp-blank'),
                                                    esc_html__('% Comments', 'wp-blank'),
                                                    'text-blue-600 hover:text-blue-800 font-medium'
                                                ); ?>
                                            </div>
                                        <?php endif; ?>
                                    </footer><!-- .entry-footer -->
                                <?php endif; ?>
                            </article><!-- #post-<?php the_ID(); ?> -->
                        <?php
                        endwhile;
                        ?>
                    </div><!-- .posts-container -->

                    <?php
                    // Previous/next page navigation
                    wp_blank_post_navigation();

                else :
                    // No posts found
                    ?>
                    <section class="no-results not-found bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
                        <header class="page-header mb-6">
                            <h1 class="page-title text-2xl font-bold text-gray-900">
                                <?php esc_html_e('Nothing here', 'wp-blank'); ?>
                            </h1>
                        </header><!-- .page-header -->

                        <div class="page-content prose prose-lg mx-auto">
                            <?php
                            if (is_home() && current_user_can('publish_posts')) :

                                printf(
                                    '<p>' . wp_kses(
                                        __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wp-blank'),
                                        ['a' => ['href' => []]]
                                    ) . '</p>',
                                    esc_url(admin_url('post-new.php'))
                                );

                            elseif (is_search()) :
                                ?>
                                <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'wp-blank'); ?></p>
                                <?php
                                get_search_form();

                            else :
                                ?>
                                <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wp-blank'); ?></p>
                                <?php
                                get_search_form();

                            endif;
                            ?>
                        </div><!-- .page-content -->
                    </section><!-- .no-results -->
                <?php
                endif;
                ?>
            </div><!-- .lg:col-span-2 -->

            <?php get_sidebar(); ?>
        </div><!-- .grid -->
    </div><!-- .container -->
</main><!-- #primary -->

<?php
get_footer(); 