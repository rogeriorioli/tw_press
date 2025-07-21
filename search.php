<?php
/**
 * The template for displaying search results pages
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
                <header class="page-header bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-8">
                    <h1 class="page-title text-3xl font-bold text-gray-900">
                        <?php
                        printf(
                            esc_html__('Search Results for: %s', 'wp-blank'),
                            '<span class="text-blue-600">"' . get_search_query() . '"</span>'
                        );
                        ?>
                    </h1>
                    <?php if (have_posts()) : ?>
                        <p class="text-gray-600 mt-2">
                            <?php
                            global $wp_query;
                            printf(
                                esc_html(_n('Found %d result', 'Found %d results', $wp_query->found_posts, 'wp-blank')),
                                $wp_query->found_posts
                            );
                            ?>
                        </p>
                    <?php endif; ?>
                </header><!-- .page-header -->

                <?php if (have_posts()) : ?>
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
                                        <span class="post-type bg-gray-100 px-2 py-1 rounded text-xs font-medium">
                                            <?php echo esc_html(get_post_type()); ?>
                                        </span>
                                        <time class="published" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                            <?php echo get_the_date(); ?>
                                        </time>
                                        <?php if ('post' === get_post_type()) : ?>
                                            <span class="author">
                                                <?php esc_html_e('By', 'wp-blank'); ?>
                                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="hover:text-gray-900">
                                                    <?php the_author(); ?>
                                                </a>
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
                            </article><!-- #post-<?php the_ID(); ?> -->
                        <?php
                        endwhile;
                        ?>
                    </div><!-- .posts-container -->

                    <?php
                    // Previous/next page navigation
                    wp_blank_post_navigation();

                else :
                    // No search results found
                    ?>
                    <section class="no-results not-found bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
                        <header class="page-header mb-6">
                            <h2 class="page-title text-2xl font-bold text-gray-900">
                                <?php esc_html_e('No results found', 'wp-blank'); ?>
                            </h2>
                        </header><!-- .page-header -->

                        <div class="page-content prose prose-lg mx-auto">
                            <p class="mb-6">
                                <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'wp-blank'); ?>
                            </p>
                            
                            <!-- Search form -->
                            <div class="search-again mb-8">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                    <?php esc_html_e('Try searching again:', 'wp-blank'); ?>
                                </h3>
                                <?php get_search_form(); ?>
                            </div>

                            <!-- Suggestions -->
                            <div class="suggestions text-left">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                    <?php esc_html_e('Suggestions:', 'wp-blank'); ?>
                                </h3>
                                <ul class="list-disc list-inside space-y-2 text-gray-600">
                                    <li><?php esc_html_e('Check your spelling and try again', 'wp-blank'); ?></li>
                                    <li><?php esc_html_e('Try using fewer or different keywords', 'wp-blank'); ?></li>
                                    <li><?php esc_html_e('Browse our categories or recent posts', 'wp-blank'); ?></li>
                                </ul>
                            </div>
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