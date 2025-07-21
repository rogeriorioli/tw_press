<?php
/**
 * The template for displaying the posts page (blog home)
 *
 * This template is used when the posts page is set in Reading Settings.
 *
 * @package WP_Blank
 */

get_header();
?>

<main id="primary" class="site-main flex-1">
    <div class="container py-8">
        <?php wp_blank_breadcrumbs(); ?>
        
        <!-- Blog Header -->
        <header class="blog-header text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                <?php
                if (is_home() && get_option('page_for_posts')) {
                    echo get_the_title(get_option('page_for_posts'));
                } else {
                    esc_html_e('Blog', 'wp-blank');
                }
                ?>
            </h1>
            <?php if (get_option('page_for_posts') && get_post_field('post_content', get_option('page_for_posts'))) : ?>
                <div class="blog-description text-lg text-gray-600 max-w-3xl mx-auto">
                    <?php echo wp_kses_post(get_post_field('post_content', get_option('page_for_posts'))); ?>
                </div>
            <?php endif; ?>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
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
                                        <time class="published flex items-center" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <?php echo get_the_date(); ?>
                                        </time>
                                        <span class="author flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <?php esc_html_e('By', 'wp-blank'); ?>
                                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="ml-1 hover:text-gray-900">
                                                <?php the_author(); ?>
                                            </a>
                                        </span>
                                        <?php if (has_category()) : ?>
                                            <span class="categories flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                </svg>
                                                <?php the_category(', '); ?>
                                            </span>
                                        <?php endif; ?>
                                        <?php if (comments_open() || get_comments_number()) : ?>
                                            <span class="comments-link flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                </svg>
                                                <?php comments_popup_link(
                                                    esc_html__('0 Comments', 'wp-blank'),
                                                    esc_html__('1 Comment', 'wp-blank'),
                                                    esc_html__('% Comments', 'wp-blank'),
                                                    'hover:text-gray-900'
                                                ); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div><!-- .entry-meta -->
                                </header><!-- .entry-header -->

                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="entry-thumbnail mb-4">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('large', ['class' => 'w-full h-auto rounded hover:opacity-90 transition-opacity']); ?>
                                        </a>
                                    </div><!-- .entry-thumbnail -->
                                <?php endif; ?>

                                <div class="entry-content prose max-w-none">
                                    <?php the_excerpt(); ?>
                                    <a href="<?php the_permalink(); ?>" class="inline-flex items-center mt-4 text-blue-600 hover:text-blue-800 font-medium">
                                        <?php esc_html_e('Read more', 'wp-blank'); ?>
                                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div><!-- .entry-content -->
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
                            <h2 class="page-title text-2xl font-bold text-gray-900">
                                <?php esc_html_e('Nothing here', 'wp-blank'); ?>
                            </h2>
                        </header><!-- .page-header -->

                        <div class="page-content prose prose-lg mx-auto">
                            <?php
                            if (current_user_can('publish_posts')) :
                                printf(
                                    '<p>' . wp_kses(
                                        __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wp-blank'),
                                        ['a' => ['href' => []]]
                                    ) . '</p>',
                                    esc_url(admin_url('post-new.php'))
                                );
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