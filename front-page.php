<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this template
 * will be used to display it.
 *
 * @package WP_Blank
 */

get_header();
?>

<main id="primary" class="site-main flex-1">
    <?php
    while (have_posts()) :
        the_post();
    ?>
        <!-- Hero Section -->
        <?php if (has_post_thumbnail()) : ?>
            <section class="hero-section relative bg-gray-900 text-white">
                <div class="absolute inset-0">
                    <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover opacity-60']); ?>
                </div>
                <div class="relative container py-24 text-center">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6">
                        <?php the_title(); ?>
                    </h1>
                    <?php if (get_the_excerpt()) : ?>
                        <p class="text-xl md:text-2xl text-gray-200 mb-8 max-w-3xl mx-auto">
                            <?php the_excerpt(); ?>
                        </p>
                    <?php endif; ?>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="#content" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                            <?php esc_html_e('Learn More', 'wp-blank'); ?>
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </a>
                        <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="inline-flex items-center bg-transparent border-2 border-white hover:bg-white hover:text-gray-900 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                            <?php esc_html_e('View Posts', 'wp-blank'); ?>
                        </a>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Content Section -->
        <section id="content" class="content-section py-16">
            <div class="container">
                <?php if (!has_post_thumbnail()) : ?>
                    <div class="text-center mb-12">
                        <h1 class="text-4xl font-bold text-gray-900 mb-6">
                            <?php the_title(); ?>
                        </h1>
                    </div>
                <?php endif; ?>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    <div class="lg:col-span-2">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('prose prose-lg max-w-none'); ?>>
                            <?php
                            the_content();

                            wp_link_pages([
                                'before' => '<div class="page-links bg-gray-50 p-4 rounded mt-8">' . esc_html__('Pages:', 'wp-blank'),
                                'after'  => '</div>',
                            ]);
                            ?>
                        </article><!-- #post-<?php the_ID(); ?> -->
                    </div><!-- .lg:col-span-2 -->

                    <!-- Sidebar or additional content -->
                    <div class="space-y-8">
                        <!-- Recent Posts Widget -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">
                                <?php esc_html_e('Recent Posts', 'wp-blank'); ?>
                            </h3>
                            <?php
                            $recent_posts = wp_get_recent_posts([
                                'numberposts' => 3,
                                'post_status' => 'publish',
                            ]);
                            if ($recent_posts) :
                                echo '<div class="space-y-4">';
                                foreach ($recent_posts as $recent) {
                                    $post_id = $recent['ID'];
                                    $thumbnail = get_the_post_thumbnail($post_id, 'thumbnail', ['class' => 'w-16 h-16 object-cover rounded']);
                                    printf(
                                        '<div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0">%1$s</div>
                                            <div class="flex-1 min-w-0">
                                                <a href="%2$s" class="text-gray-900 hover:text-blue-600 font-medium transition-colors">%3$s</a>
                                                <p class="text-sm text-gray-600 mt-1">%4$s</p>
                                            </div>
                                        </div>',
                                        $thumbnail,
                                        esc_url(get_permalink($post_id)),
                                        esc_html($recent['post_title']),
                                        esc_html(get_the_date('', $post_id))
                                    );
                                }
                                echo '</div>';
                            endif;
                            ?>
                        </div>

                        <!-- Categories Widget -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">
                                <?php esc_html_e('Categories', 'wp-blank'); ?>
                            </h3>
                            <?php
                            $categories = get_categories(['number' => 6]);
                            if ($categories) :
                                echo '<div class="flex flex-wrap gap-2">';
                                foreach ($categories as $category) {
                                    printf(
                                        '<a href="%1$s" class="inline-block bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-full text-sm text-gray-700 transition-colors">%2$s</a>',
                                        esc_url(get_category_link($category->term_id)),
                                        esc_html($category->name)
                                    );
                                }
                                echo '</div>';
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div><!-- .container -->
        </section><!-- .content-section -->
    <?php
    endwhile; // End of the loop.
    ?>
</main><!-- #primary -->

<?php
get_footer(); 