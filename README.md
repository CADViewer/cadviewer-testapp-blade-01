# CADViewer Laravel Blade Sample

🔗 **Live demo:** https://cadviewer-testapp-blade-01.cadviewer.com

This repository provides a base implementation of [CADViewer](https://cadviewer.com) inside a modern **Laravel Blade** environment.

It is designed to demonstrate how to correctly load the CADViewer interface, set up server-side handlers, and render DWG/DXF/SVG files seamlessly inside a Laravel application, mimicking a typical production setup.

## Getting Started

1. **Prerequisites:**
   - PHP 8.2+
   - Composer

2. **Installation:**
   Clone the repository **with its submodule** (the PHP handlers in `public/php`) and install dependencies:
   ```bash
   git clone --recurse-submodules https://github.com/CADViewer/cadviewer-testapp-blade-01.git
   cd cadviewer-testapp-blade-01
   composer run setup
   ```
   Already cloned without submodules? Run `git submodule update --init`.

   `composer run setup` creates `.env`, generates the application key and copies `cadviewer/CADViewer_config.php` into `public/php/` (`composer run cadviewer:setup` does only the latter).

3. **Linux only - unpack the converters:**
   ```bash
   cd converters/autoxchange/linux && tar -xJf ax2026_L64_27_06b_163d.tar.xz --strip-components=1 --skip-old-files && chmod +x ax2026_L64_27_06b_163d && cd -
   gunzip -k converters/dwgmerge/linux/*.gz converters/linklist/linux/*.gz && chmod +x converters/dwgmerge/linux/DwgMerge_* converters/linklist/linux/LinkList_*
   ```

4. **Running the Server:**
   ```bash
   php artisan serve
   ```
   Navigate to `http://localhost:8000/cadviewer` in your web browser.

## Project Structure

- **`resources/views/layouts/cadviewer.blade.php`**: Shared layout containing the CADViewer configuration, UI setup, and initialization scripts.
- **`resources/views/cadviewer.blade.php`**: Standard page (`/cadviewer`).
- **`resources/views/fixed-admin-header-test.blade.php`**: CADViewer inside a fixed header / scrolling dashboard layout (`/fixed-admin-header-test`).
- **`public/app/`**: CADViewer core JS, CSS, and UI assets (icons, XML menus).
- **`public/content/`**: Sample drawings, redlines, and space objects.
- **`public/php/`**: CADViewer PHP handlers, git submodule of [cadviewer-php-scripts](https://github.com/CADViewer/cadviewer-php-scripts).
- **`public/converters/files/`**: Conversion, print and PDF output written by the handlers.
- **`cadviewer/CADViewer_config.php`**: Handler configuration for this project (paths, URLs, executables), copied over `public/php/CADViewer_config.php`.
- **`converters/`**: AutoXchange, DwgMerge and LinkList converters (Windows and Linux), kept outside the web root.

### Handler configuration

`cadviewer/CADViewer_config.php` derives its paths from its location and the request URL (honouring `X-Forwarded-Proto` / `X-Forwarded-Host` behind a reverse proxy). They can be overridden with environment variables:

| Variable | Default |
|---|---|
| `CADVIEWER_BASE_URL` | Derived from the request, e.g. `https://viewer.example.com` |
| `CADVIEWER_HOME_DIR` | Laravel `public/` folder |
| `CADVIEWER_CONVERTERS_DIR` | `converters/` at the project root |
| `CADVIEWER_DEBUG` | `true` (writes conversion logs to `public/php/logs/`) |

## Docker

```bash
docker build --platform linux/amd64 -t cadviewer-blade .
docker run -p 8080:80 -e APP_KEY=base64:... cadviewer-blade
```

The converters are x86_64 binaries, hence `--platform linux/amd64`. The image unpacks the Linux converters, serves `public/` with Apache and denies access to the handler logs and diagnostic scripts (`docker/apache.conf`).

## Deploying on Coolify

1. New resource from this Git repository, **Build Pack: Dockerfile**, port `80`. Coolify checks out the `public/php` submodule automatically.
2. Environment variables:
   - `APP_KEY` (required, generate with `php artisan key:generate --show`)
   - `APP_URL` (the public URL)
3. Persistent storage (optional, to keep generated files across deployments):
   - `/var/www/html/public/converters/files`
   - `/var/www/html/public/content/redlines`
4. AutoXchange license: the image uses the evaluation key from `converters/autoxchange/linux/axlic.key` (CADViewer trial watermark). To use a production license, add a **File Mount** in Coolify at `/var/www/html/converters/autoxchange/linux/axlic.key` with the content of your license file.

## How to Test Custom Blade Headers
This project serves as a perfect testing ground for integrating CADViewer into complex Blade layouts (like admin dashboards or layered user interfaces). Add a view extending `layouts.cadviewer` to emulate your production layouts and test mouse interactions and responsive design.

## Support
For technical documentation, visit [CADViewer TechDocs](http://cadviewer.com/cadviewertechdocs/).
Contact support at developer@cadviewer.com.
