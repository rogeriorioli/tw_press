/**
 * Admin JavaScript file
 * Enhancements for WordPress admin area
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize customizer enhancements
    if (window.wp && window.wp.customize) {
        initCustomizerEnhancements();
    }
    
    // Initialize theme admin features
    initThemeAdminFeatures();
});

/**
 * WordPress Customizer Enhancements
 */
function initCustomizerEnhancements() {
    // Add real-time preview updates for theme options
    wp.customize('blogname', function(value) {
        value.bind(function(newval) {
            document.querySelector('.site-title a').textContent = newval;
        });
    });
    
    wp.customize('blogdescription', function(value) {
        value.bind(function(newval) {
            document.querySelector('.site-description').textContent = newval;
        });
    });
    
    // Custom color scheme updates
    wp.customize('primary_color', function(value) {
        value.bind(function(newval) {
            updateCustomProperty('--primary-color', newval);
        });
    });
    
    wp.customize('secondary_color', function(value) {
        value.bind(function(newval) {
            updateCustomProperty('--secondary-color', newval);
        });
    });
}

/**
 * Theme Admin Features
 */
function initThemeAdminFeatures() {
    // Add theme-specific admin styles
    addThemeAdminStyles();
    
    // Enhance media uploader
    enhanceMediaUploader();
    
    // Add helpful admin notices
    addAdminNotices();
}

/**
 * Update CSS Custom Properties
 */
function updateCustomProperty(property, value) {
    document.documentElement.style.setProperty(property, value);
}

/**
 * Add Theme Admin Styles
 */
function addThemeAdminStyles() {
    const style = document.createElement('style');
    style.textContent = `
        /* Theme-specific admin styles */
        .wp-blank-theme-notice {
            padding: 12px;
            border-left: 4px solid #3b82f6;
            background: #eff6ff;
            margin: 16px 0;
        }
        
        .wp-blank-theme-settings {
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 20px;
            margin: 20px 0;
        }
        
        .wp-blank-theme-settings h3 {
            margin-top: 0;
            color: #1f2937;
        }
        
        /* Customizer enhancements */
        .customize-control-wp-blank {
            margin-bottom: 20px;
        }
        
        .wp-blank-color-picker {
            width: 100%;
            height: 40px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    `;
    
    document.head.appendChild(style);
}

/**
 * Enhance Media Uploader
 */
function enhanceMediaUploader() {
    // Add custom media frame handling if needed
    if (window.wp && window.wp.media) {
        // Custom media uploader enhancements can be added here
        console.log('WP Blank Theme: Media uploader enhancements loaded');
    }
}

/**
 * Add Admin Notices
 */
function addAdminNotices() {
    // Check if we're on the theme customizer or appearance page
    const currentPage = window.location.pathname;
    const isThemePage = currentPage.includes('themes.php') || currentPage.includes('customize.php');
    
    if (isThemePage) {
        // Add helpful theme setup notice
        const notice = document.createElement('div');
        notice.className = 'wp-blank-theme-notice';
        notice.innerHTML = `
            <h4>WP Blank Theme Setup</h4>
            <p>Welcome to WP Blank Theme! For the best experience:</p>
            <ul style="margin-left: 20px;">
                <li>• Set up your navigation menus in <strong>Appearance → Menus</strong></li>
                <li>• Configure your homepage in <strong>Settings → Reading</strong></li>
                <li>• Customize colors and fonts in the <strong>Customizer</strong></li>
            </ul>
        `;
        
        // Insert the notice at the top of the content area
        const contentArea = document.querySelector('.wrap');
        if (contentArea) {
            contentArea.insertBefore(notice, contentArea.firstChild);
        }
    }
}

// Export for potential use
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        initCustomizerEnhancements,
        initThemeAdminFeatures,
        updateCustomProperty
    };
} 