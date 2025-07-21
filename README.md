# WP Blank Theme

A modern, minimal WordPress theme built with Tailwind CSS and a complete template hierarchy. Perfect for developers who want a solid foundation with modern tooling and best practices.

## Features

- 🎨 **Tailwind CSS Integration** - Complete build system with PostCSS and Autoprefixer
- 📱 **Fully Responsive** - Mobile-first design with responsive navigation
- ♿ **Accessibility Ready** - WCAG compliant with proper ARIA labels and keyboard navigation
- 🔧 **Complete Template Hierarchy** - All WordPress template files included
- ⚡ **Performance Optimized** - Clean, semantic HTML with optimized assets
- 🎯 **SEO Friendly** - Proper meta tags and structured data
- 🔍 **Search Enhanced** - Custom search forms and results templates
- 💬 **Comment System** - Fully styled comment forms and display
- 🎛️ **Widget Areas** - Sidebar and footer widget support
- 🌙 **Dark Mode Ready** - Easy to implement with Tailwind utilities

## Template Hierarchy Includes

### Core Templates
- `index.php` - Main template fallback
- `header.php` - Site header
- `footer.php` - Site footer
- `sidebar.php` - Primary sidebar
- `searchform.php` - Custom search form

### Content Templates  
- `front-page.php` - Static front page
- `home.php` - Blog posts page
- `page.php` - Static pages
- `single.php` - Single posts
- `archive.php` - Archive pages
- `category.php` - Category archives
- `tag.php` - Tag archives  
- `author.php` - Author archives
- `search.php` - Search results
- `404.php` - Error page
- `comments.php` - Comments template

## Installation

1. **Download or Clone**
   ```bash
   git clone https://github.com/yourusername/wp-blank-theme.git
   ```

2. **Install Dependencies**
   ```bash
   npm install
   ```

3. **Build Assets**
   ```bash
   # For development with watch mode
   npm run dev
   
   # For production build
   npm run build
   ```

4. **Upload to WordPress**
   - Upload the theme folder to `/wp-content/themes/`
   - Activate in WordPress admin under Appearance > Themes

## Development

### Available Scripts

```bash
# Development mode (watch files for changes)
npm run dev
npm run watch

# Production build (minified assets)
npm run build

# Individual build commands
npm run build:css    # Build CSS only
npm run build:js     # Build JavaScript only
npm run watch:css    # Watch CSS files
npm run watch:js     # Watch JavaScript files

# Utilities
npm run clean        # Clean dist folder
npm run lint:css     # Lint CSS files
npm run format       # Format code with Prettier
```

### File Structure

```
wp-blank/
├── src/                    # Source files
│   ├── css/
│   │   └── main.css       # Main Tailwind CSS file
│   └── js/
│       ├── main.js        # Frontend JavaScript
│       └── admin.js       # Admin JavaScript
├── dist/                  # Built assets (generated)
│   ├── css/
│   │   └── main.css      # Compiled CSS
│   └── js/
│       ├── main.js       # Compiled JavaScript
│       └── admin.js      # Compiled admin JS
├── js/                   # Static JavaScript
│   └── skip-link-focus-fix.js
├── *.php                 # WordPress template files
├── style.css             # Theme header (required)
├── functions.php         # Theme functions
├── package.json          # Node dependencies
├── tailwind.config.js    # Tailwind configuration
├── webpack.config.js     # Webpack configuration
└── postcss.config.js     # PostCSS configuration
```

## Customization

### Colors

The theme uses a custom color palette defined in `tailwind.config.js`:

```javascript
colors: {
  primary: {
    // Blue color scale
    500: '#3b82f6',
    600: '#2563eb',
    // ... more shades
  },
  secondary: {
    // Gray color scale  
    500: '#6b7280',
    600: '#4b5563',
    // ... more shades
  }
}
```

### Typography

Enhanced typography system with the `@tailwindcss/typography` plugin:

```css
.prose {
  /* Automatic typography styling for content */
}
```

### Adding Custom Styles

1. **Add to `src/css/main.css`**:
   ```css
   @layer components {
     .my-custom-component {
       @apply bg-blue-500 text-white p-4 rounded;
     }
   }
   ```

2. **Run build process**:
   ```bash
   npm run build:css
   ```

### JavaScript Functionality

The theme includes several JavaScript features:

- **Mobile Menu** - Responsive navigation with hamburger menu
- **Smooth Scrolling** - Smooth anchor link scrolling
- **Accessibility** - Enhanced keyboard navigation and focus management
- **Search Enhancements** - Improved search form interactions
- **Comment Form** - Auto-resizing textarea and validation feedback
- **Lazy Loading** - Intersection Observer API for images

## WordPress Features

### Theme Support
- Post thumbnails
- Custom logo
- Custom background
- HTML5 markup
- Title tag management
- RSS feed links
- Wide/full alignment
- Responsive embeds
- Block editor styles

### Menus
- Primary navigation
- Footer navigation  
- Mobile-responsive menu

### Widget Areas
- Primary sidebar
- Footer widgets

### Custom Functions
- Custom excerpt length
- Breadcrumb navigation
- Post navigation helpers
- Clean head optimization

## Browser Support

- Chrome (last 2 versions)
- Firefox (last 2 versions)  
- Safari (last 2 versions)
- Edge (last 2 versions)
- iOS Safari
- Android Chrome

## Accessibility

The theme follows WCAG 2.1 AA guidelines:

- Semantic HTML structure
- Proper heading hierarchy
- ARIA labels and roles
- Keyboard navigation support
- Focus management
- Screen reader compatibility
- Color contrast compliance
- Skip links for navigation

## Performance

- Minified CSS and JavaScript in production
- Optimized font loading
- Efficient image loading with lazy loading
- Clean, semantic HTML
- Minimal HTTP requests
- Gzip-friendly assets

## SEO Features

- Clean, semantic HTML structure
- Proper meta tag management
- Schema.org microdata ready
- Open Graph meta tags support
- Breadcrumb navigation
- Optimized heading structure

## Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature-name`
3. Make your changes
4. Run tests and build: `npm run build`
5. Commit your changes: `git commit -am 'Add feature'`
6. Push to the branch: `git push origin feature-name`
7. Submit a pull request

## License

This theme is licensed under the MIT License. See LICENSE file for details.

## Support

For support, please open an issue on the GitHub repository or contact [your-email@example.com].

## Changelog

### Version 1.0.0
- Initial release
- Complete WordPress template hierarchy
- Tailwind CSS integration
- Responsive design
- Accessibility features
- Performance optimizations 