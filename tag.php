<?php
/**
 * The template for displaying tag archives
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
                    <header class="page-header bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-8">
                        <div class="flex items-start space-x-4">
                            <div class="bg-green-100 p-3 rounded-lg">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <?php the_archive_title('<h1 class="page-title text-3xl font-bold text-gray-900">', '</h1>'); ?>
                                <?php 
                                $description = tag_description();
                                if ($description) :
                                    echo '<div class="archive-description prose prose-lg mt-4 text-gray-600">' . $description . '</div>';
                                endif;
                                ?>
                                <div class="tag-meta text-sm text-gray-600 mt-2">
                                    <?php
                                    $tag = get_queried_object();
                                    printf(
                                        esc_html(_n('%d post tagged with this', '%d posts tagged with this', $tag->count, 'wp-blank')),
                                        $tag->count
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                    </header><!-- .page-header -->

                    <div class="posts-container space-y-8">
                        <?php
                        // Start the Loop
                        while (have_posts()) :
                            the_post();
                        ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-sm border border-gray-200 p-6'); ?>>
                                <header class="entry-header mb-4">
                                    <?php the_title('<h2 class="entry-title text-xl font-semibold"><a href="' . esc_url(get_permalink()) . '" class="text-gray-900 hover:text-blue-600 transition-colors" rel="bookmark">', '</a></h2>'); ?>

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
                                </header><!-- .entry-header -->

                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="entry-thumbnail mb-4">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium', ['class' => 'w-full h-auto rounded hover:opacity-90 transition-opacity']); ?>
                                        </a>
                                    </div><!-- .entry-thumbnail -->
                                <?php endif; ?>

                                <div class="entry-summary prose max-w-none">
                                    <?php the_excerpt(); ?>
                                    <a href="<?php the_permalink(); ?>" class="inline-flex items-center mt-4 text-blue-600 hover:text-blue-800 font-medium">
                                        <?php esc_html_e('Read more', 'wp-blank'); ?>
                                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div><!-- .entry-summary -->

                                <!-- Show other tags for this post -->
                                <?php if (has_tag()) : ?>
                                    <footer class="entry-footer mt-4 pt-4 border-t border-gray-200">
                                        <div class="tags">
                                            <span class="text-sm text-gray-600 mr-2"><?php esc_html_e('Also tagged:', 'wp-blank'); ?></span>
                                            <div class="inline-flex flex-wrap gap-2">
                                                <?php
                                                $tags = get_the_tags();
                                                $current_tag_id = get_queried_object_id();
                                                if ($tags) {
                                                    foreach ($tags as $tag) {
                                                        if ($tag->term_id !== $current_tag_id) {
                                                            echo '<a href="' . get_tag_link($tag->term_id) . '" class="inline-block bg-gray-100 hover:bg-gray-200 px-2 py-1 rounded text-xs text-gray-700 transition-colors">' . $tag->name . '</a>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </footer>
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
                            <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wp-blank'); ?></p>
                            <?php get_search_form(); ?>
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