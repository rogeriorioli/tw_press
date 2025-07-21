    <footer id="colophon" class="site-footer bg-gray-900 text-white mt-auto">
        <?php if (is_active_sidebar('footer-1')) : ?>
            <div class="footer-widgets py-12">
                <div class="container">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <?php dynamic_sidebar('footer-1'); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="footer-info border-t border-gray-800 py-8">
            <div class="container">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <div class="site-info text-gray-400">
                        <p>&copy; <?php echo date('Y'); ?> 
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white transition-colors">
                                <?php bloginfo('name'); ?>
                            </a>. 
                            <?php esc_html_e('All rights reserved.', 'wp-blank'); ?>
                        </p>
                        <?php
                        printf(
                            esc_html__('Powered by %1$s and %2$s', 'wp-blank'),
                            '<a href="' . esc_url(__('https://wordpress.org/')) . '" class="hover:text-white transition-colors">WordPress</a>',
                            '<a href="https://tailwindcss.com/" class="hover:text-white transition-colors">Tailwind CSS</a>'
                        );
                        ?>
                    </div><!-- .site-info -->

                    <?php if (has_nav_menu('footer')) : ?>
                        <nav class="footer-navigation" role="navigation" aria-label="<?php esc_attr_e('Footer Navigation', 'wp-blank'); ?>">
                            <?php
                            wp_nav_menu([
                                'theme_location' => 'footer',
                                'menu_id'        => 'footer-menu',
                                'container'      => false,
                                'menu_class'     => 'flex space-x-6 text-gray-400',
                                'fallback_cb'    => false,
                            ]);
                            ?>
                        </nav><!-- .footer-navigation -->
                    <?php endif; ?>
                </div>
            </div>
        </div><!-- .footer-info -->
    </footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

<!-- Mobile menu toggle script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            const isExpanded = mobileMenuToggle.getAttribute('aria-expanded') === 'true';
            
            // Toggle aria-expanded
            mobileMenuToggle.setAttribute('aria-expanded', !isExpanded);
            
            // Toggle menu visibility
            mobileMenu.classList.toggle('hidden');
            
            // Toggle hamburger/close icons
            const hamburgerIcon = mobileMenuToggle.querySelector('svg:first-of-type');
            const closeIcon = mobileMenuToggle.querySelector('svg:last-of-type');
            
            if (hamburgerIcon && closeIcon) {
                hamburgerIcon.classList.toggle('hidden');
                hamburgerIcon.classList.toggle('block');
                closeIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('block');
            }
        });
    }
});
</script>

</body>
</html> 