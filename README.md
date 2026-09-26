# CADViewer Laravel Blade Sample

This repository provides a base implementation of [CADViewer](https://cadviewer.com) inside a modern **Laravel Blade** environment.

It is designed to demonstrate how to correctly load the CADViewer interface, set up server-side handlers, and render DWG/DXF/SVG files seamlessly inside a Laravel application, mimicking a typical production setup.

## Getting Started

1. **Prerequisites:**
   - PHP 8.1+
   - Composer
   - Node.js & NPM (if building frontend assets)

2. **Installation:**
   Clone the repository and install dependencies:
   ```bash
   git clone https://github.com/CADViewer/cadviewer-testapp-blade-01.git
   cd cadviewer-testapp-blade-01
   composer install
   ```

3. **Running the Server:**
   Start the Laravel development server:
   ```bash
   php artisan serve
   ```
   Navigate to `http://localhost:8000/cadviewer` in your web browser.

## Project Structure

- **`resources/views/cadviewer.blade.php`**: The primary Blade template containing the CADViewer configuration, UI setup, and initialization scripts.
- **`public/app/`**: CADViewer core JS, CSS, and UI assets (icons, XML menus).
- **`public/content/`**: Sample drawings, redlines, and space objects.
- **`public/php/`**: CADViewer PHP backend handlers (e.g., loading files, saving redlines).
- **`public/converters/`**: The AutoXchange converter executables used for DWG to SVG conversion.

## How to Test Custom Blade Headers
This project serves as a perfect testing ground for integrating CADViewer into complex Blade layouts (like admin dashboards or layered user interfaces). You can modify the standard Blade views to emulate your production layouts and test mouse interactions and responsive design.

## Support
For technical documentation, visit [CADViewer TechDocs](http://cadviewer.com/cadviewertechdocs/).
Contact support at developer@cadviewer.com.
