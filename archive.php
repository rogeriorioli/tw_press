<?php
/**
 * The template for displaying archive pages
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
                        <?php
                        the_archive_title('<h1 class="page-title text-3xl font-bold text-gray-900">', '</h1>');
                        the_archive_description('<div class="archive-description prose prose-lg mt-4 text-gray-600">', '</div>');
                        ?>
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