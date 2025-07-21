<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class('antialiased'); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site min-h-screen flex flex-col">
    <a class="screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'wp-blank'); ?></a>

    <header id="masthead" class="site-header bg-white shadow-sm sticky top-0 z-40">
        <div class="container py-4">
            <div class="flex items-center justify-between">
                <div class="site-branding">
                    <?php
                    the_custom_logo();
                    if (is_front_page() && is_home()) :
                    ?>
                        <h1 class="site-title text-2xl font-bold text-gray-900">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="hover:text-gray-700 transition-colors">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                    <?php
                    else :
                    ?>
                        <p class="site-title text-xl font-semibold text-gray-900">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="hover:text-gray-700 transition-colors">
                                <?php bloginfo('name'); ?>
                            </a>
                        </p>
                    <?php
                    endif;
                    $wp_blank_description = get_bloginfo('description', 'display');
                    if ($wp_blank_description || is_customize_preview()) :
                    ?>
                        <p class="site-description text-gray-600 text-sm mt-1"><?php echo $wp_blank_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                    <?php endif; ?>
                </div><!-- .site-branding -->

                <nav id="site-navigation" class="main-navigation hidden lg:block" role="navigation" aria-label="<?php esc_attr_e('Main Navigation', 'wp-blank'); ?>">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'menu_class'     => 'flex space-x-8 items-center',
                        'fallback_cb'    => false,
                    ]);
                    ?>
                </nav><!-- #site-navigation -->

                <!-- Mobile menu button -->
                <button class="mobile-menu-toggle lg:hidden p-2 text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500" type="button" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only"><?php esc_html_e('Open main menu', 'wp-blank'); ?></span>
                    <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Mobile menu -->
            <div class="mobile-menu hidden lg:hidden" id="mobile-menu">
                <div class="pt-4 pb-2 border-t border-gray-200 mt-4">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'primary',
                        'menu_id'        => 'mobile-primary-menu',
                        'container'      => false,
                        'menu_class'     => 'space-y-2',
                        'fallback_cb'    => false,
                    ]);
                    ?>
                </div>
            </div>
        </div><!-- .container -->
    </header><!-- #masthead --> 