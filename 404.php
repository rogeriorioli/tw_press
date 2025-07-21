<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WP_Blank
 */

get_header();
?>

<main id="primary" class="site-main flex-1">
    <div class="container py-16">
        <section class="error-404 not-found text-center max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12">
                <div class="mb-8">
                    <div class="text-6xl font-bold text-gray-300 mb-4">404</div>
                    <h1 class="page-title text-3xl font-bold text-gray-900 mb-4">
                        <?php esc_html_e('Oops! That page can&rsquo;t be found.', 'wp-blank'); ?>
                    </h1>
                    <p class="text-gray-600 text-lg">
                        <?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'wp-blank'); ?>
                    </p>
                </div>

                <div class="page-content space-y-8">
                    <!-- Search form -->
                    <div class="search-section">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">
                            <?php esc_html_e('Search for:', 'wp-blank'); ?>
                        </h2>
                        <?php get_search_form(); ?>
                    </div>

                    <!-- Recent posts -->
                    <div class="recent-posts-section">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">
                            <?php esc_html_e('Recent Posts', 'wp-blank'); ?>
                        </h2>
                        <div class="text-left">
                            <?php
                            $recent_posts = wp_get_recent_posts([
                                'numberposts' => 5,
                                'post_status' => 'publish',
                            ]);
                            if ($recent_posts) :
                                echo '<ul class="space-y-2">';
                                foreach ($recent_posts as $recent) {
                                    printf(
                                        '<li><a href="%1$s" class="text-blue-600 hover:text-blue-800 transition-colors">%2$s</a></li>',
                                        esc_url(get_permalink($recent['ID'])),
                                        esc_html($recent['post_title'])
                                    );
                                }
                                echo '</ul>';
                            else :
                                echo '<p class="text-gray-600">' . esc_html__('No recent posts found.', 'wp-blank') . '</p>';
                            endif;
                            ?>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="categories-section">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">
                            <?php esc_html_e('Categories', 'wp-blank'); ?>
                        </h2>
                        <div class="text-left">
                            <?php
                            $categories = get_categories(['number' => 10]);
                            if ($categories) :
                                echo '<div class="flex flex-wrap gap-2">';
                                foreach ($categories as $category) {
                                    printf(
                                        '<a href="%1$s" class="inline-block bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-full text-sm text-gray-700 transition-colors">%2$s (%3$d)</a>',
                                        esc_url(get_category_link($category->term_id)),
                                        esc_html($category->name),
                                        absint($category->count)
                                    );
                                }
                                echo '</div>';
                            else :
                                echo '<p class="text-gray-600">' . esc_html__('No categories found.', 'wp-blank') . '</p>';
                            endif;
                            ?>
                        </div>
                    </div>

                    <!-- Back to home -->
                    <div class="home-link-section">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                            <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <?php esc_html_e('Back to Home', 'wp-blank'); ?>
                        </a>
                    </div>
                </div><!-- .page-content -->
            </div>
        </section><!-- .error-404 -->
    </div><!-- .container -->
</main><!-- #primary -->

<?php
get_footer(); 