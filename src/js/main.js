/**
 * Main theme JavaScript file
 * Handles mobile menu, smooth scrolling, and other interactive elements
 */

// DOM Content Loaded
document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize mobile menu
    initMobileMenu();
    
    // Initialize smooth scrolling
    initSmoothScrolling();
    
    // Initialize search functionality
    initSearchEnhancements();
    
    // Initialize accessibility features
    initAccessibility();
    
    // Initialize lazy loading for images
    initLazyLoading();
    
    // Initialize comment form enhancements
    initCommentForm();
});

/**
 * Mobile Menu Functionality
 */
function initMobileMenu() {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    if (!mobileMenuToggle || !mobileMenu) return;
    
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
        
        // Prevent body scroll when menu is open
        document.body.classList.toggle('overflow-hidden', !isExpanded);
    });
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        if (!mobileMenuToggle.contains(event.target) && !mobileMenu.contains(event.target)) {
            mobileMenu.classList.add('hidden');
            mobileMenuToggle.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('overflow-hidden');
            
            // Reset icons
            const hamburgerIcon = mobileMenuToggle.querySelector('svg:first-of-type');
            const closeIcon = mobileMenuToggle.querySelector('svg:last-of-type');
            
            if (hamburgerIcon && closeIcon) {
                hamburgerIcon.classList.remove('hidden');
                hamburgerIcon.classList.add('block');
                closeIcon.classList.add('hidden');
                closeIcon.classList.remove('block');
            }
        }
    });
    
    // Close mobile menu on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            mobileMenu.classList.add('hidden');
            mobileMenuToggle.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('overflow-hidden');
            mobileMenuToggle.focus();
        }
    });
}

/**
 * Smooth Scrolling for Anchor Links
 */
function initSmoothScrolling() {
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            const href = link.getAttribute('href');
            
            // Skip if href is just #
            if (href === '#') return;
            
            const target = document.querySelector(href);
            
            if (target) {
                event.preventDefault();
                
                const headerHeight = document.querySelector('.site-header')?.offsetHeight || 0;
                const targetPosition = target.offsetTop - headerHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
                
                // Update URL without causing a jump
                history.pushState(null, null, href);
                
                // Focus management for accessibility
                target.focus();
                if (document.activeElement !== target) {
                    target.setAttribute('tabindex', '-1');
                    target.focus();
                }
            }
        });
    });
}

/**
 * Search Form Enhancements
 */
function initSearchEnhancements() {
    const searchForms = document.querySelectorAll('.search-form');
    
    searchForms.forEach(function(form) {
        const searchField = form.querySelector('.search-field');
        const searchSubmit = form.querySelector('.search-submit');
        
        if (!searchField) return;
        
        // Add loading state
        form.addEventListener('submit', function() {
            searchSubmit.disabled = true;
            searchSubmit.innerHTML = '<span class="animate-spin">⟳</span>';
        });
        
        // Clear search on escape
        searchField.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                searchField.value = '';
                searchField.blur();
            }
        });
        
        // Search suggestions (if needed in future)
        // This is a placeholder for search autocomplete functionality
    });
}

/**
 * Accessibility Enhancements
 */
function initAccessibility() {
    // Skip link focus fix
    const skipLinks = document.querySelectorAll('.skip-link');
    
    skipLinks.forEach(function(skipLink) {
        skipLink.addEventListener('click', function(event) {
            const target = document.querySelector(skipLink.getAttribute('href'));
            
            if (target) {
                event.preventDefault();
                target.focus();
                
                // Ensure the target is focusable
                if (document.activeElement !== target) {
                    target.setAttribute('tabindex', '-1');
                    target.focus();
                }
            }
        });
    });
    
    // Improve focus management for dropdowns
    const dropdownToggles = document.querySelectorAll('[aria-expanded]');
    
    dropdownToggles.forEach(function(toggle) {
        toggle.addEventListener('keydown', function(event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                toggle.click();
            }
        });
    });
}

/**
 * Lazy Loading for Images
 */
function initLazyLoading() {
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    img.classList.add('fade-in');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        const lazyImages = document.querySelectorAll('img[data-src]');
        lazyImages.forEach(function(img) {
            imageObserver.observe(img);
        });
    }
}

/**
 * Comment Form Enhancements
 */
function initCommentForm() {
    const commentForm = document.getElementById('commentform');
    
    if (!commentForm) return;
    
    // Auto-resize textarea
    const commentTextarea = commentForm.querySelector('#comment');
    if (commentTextarea) {
        commentTextarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    }
    
    // Form validation feedback
    const requiredFields = commentForm.querySelectorAll('[required]');
    
    requiredFields.forEach(function(field) {
        field.addEventListener('invalid', function() {
            field.classList.add('border-red-500', 'focus:ring-red-500');
        });
        
        field.addEventListener('input', function() {
            if (field.validity.valid) {
                field.classList.remove('border-red-500', 'focus:ring-red-500');
            }
        });
    });
    
    // Character counter for comment field
    if (commentTextarea) {
        const maxLength = commentTextarea.getAttribute('maxlength');
        if (maxLength) {
            const counter = document.createElement('div');
            counter.className = 'text-sm text-gray-500 mt-1';
            counter.innerHTML = `<span id="char-count">0</span>/${maxLength} characters`;
            
            commentTextarea.parentNode.appendChild(counter);
            
            const charCount = document.getElementById('char-count');
            
            commentTextarea.addEventListener('input', function() {
                const remaining = this.value.length;
                charCount.textContent = remaining;
                
                if (remaining > maxLength * 0.9) {
                    counter.classList.add('text-yellow-600');
                } else {
                    counter.classList.remove('text-yellow-600');
                }
            });
        }
    }
}

/**
 * Utility Functions
 */

// Debounce function
function debounce(func, wait, immediate) {
    let timeout;
    return function executedFunction() {
        const context = this;
        const args = arguments;
        const later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        const callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

// Throttle function
function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// Export for potential use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        initMobileMenu,
        initSmoothScrolling,
        initSearchEnhancements,
        initAccessibility,
        initLazyLoading,
        initCommentForm,
        debounce,
        throttle
    };
} 