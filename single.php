<?php
/**
 * The template for displaying all single posts
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

                            <div class="entry-meta text-gray-600 mt-4 flex flex-wrap items-center space-x-6">
                                <time class="published flex items-center" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <?php echo get_the_date(); ?>
                                </time>
                                <span class="author flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <?php esc_html_e('By', 'wp-blank'); ?>
                                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="ml-1 hover:text-blue-600 transition-colors">
                                        <?php the_author(); ?>
                                    </a>
                                </span>
                                <?php if (has_category()) : ?>
                                    <span class="categories flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        <?php the_category(', '); ?>
                                    </span>
                                <?php endif; ?>
                            </div><!-- .entry-meta -->
                        </header><!-- .entry-header -->

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="entry-thumbnail mb-6">
                                <?php the_post_thumbnail('large', ['class' => 'w-full h-auto rounded']); ?>
                            </div><!-- .entry-thumbnail -->
                        <?php endif; ?>

                        <div class="entry-content prose prose-lg max-w-none">
                            <?php
                            the_content(sprintf(
                                wp_kses(
                                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'wp-blank'),
                                    ['span' => ['class' => []]]
                                ),
                                wp_kses_post(get_the_title())
                            ));

                            wp_link_pages([
                                'before' => '<div class="page-links bg-gray-50 p-4 rounded mt-6">' . esc_html__('Pages:', 'wp-blank'),
                                'after'  => '</div>',
                            ]);
                            ?>
                        </div><!-- .entry-content -->

                        <footer class="entry-footer mt-8 pt-6 border-t border-gray-200">
                            <?php if (has_tag()) : ?>
                                <div class="tags mb-6">
                                    <h3 class="text-sm font-semibold text-gray-700 mb-2"><?php esc_html_e('Tags:', 'wp-blank'); ?></h3>
                                    <div class="flex flex-wrap gap-2">
                                        <?php
                                        $tags = get_the_tags();
                                        if ($tags) {
                                            foreach ($tags as $tag) {
                                                echo '<a href="' . get_tag_link($tag->term_id) . '" class="inline-block bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-full text-sm text-gray-700 transition-colors">' . $tag->name . '</a>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php endif; ?>

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
                    </article><!-- #post-<?php the_ID(); ?> -->

                    <?php
                    // Previous and next post navigation
                    the_post_navigation([
                        'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'wp-blank') . '</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'wp-blank') . '</span> <span class="nav-title">%title</span>',
                        'class'     => 'post-navigation bg-gray-50 rounded-lg p-6 mt-8',
                    ]);

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