<?php
/**
 * Template for displaying search forms
 *
 * @package WP_Blank
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="flex">
        <label for="search-field-<?php echo uniqid(); ?>" class="sr-only">
            <?php esc_html_e('Search for:', 'wp-blank'); ?>
        </label>
        <input 
            type="search" 
            id="search-field-<?php echo uniqid(); ?>" 
            class="search-field flex-1 px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
            placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'wp-blank'); ?>" 
            value="<?php echo get_search_query(); ?>" 
            name="s" 
        />
        <button 
            type="submit" 
            class="search-submit bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-r-md transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            <span class="sr-only"><?php echo _x('Search', 'submit button', 'wp-blank'); ?></span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </button>
    </div>
</form> 