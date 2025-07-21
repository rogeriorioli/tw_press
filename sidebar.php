<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WP_Blank
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area">
    <div class="sidebar-content bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
</aside><!-- #secondary --> 