# ND Nation #
**Contributors:** [gazlab](https://profiles.wordpress.org/gazlab/), [thewebist](https://profiles.wordpress.org/thewebist/)  
**Requires at least:** 5.0  
**Tested up to:** 6.0  
**Requires PHP:** 7.0  
**License:** GPLv2 or later  
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html  

Custom theme for [ND Nation](https://ndnation.com).

## Description ##
Custom theme built based on Twitter Bootstrap and built for [ND Nation](https://ndnation.com).

### Compiling CSS ###

Be sure you're run `npm install` to install the required NPM modules. Then run `css-minify --file lib/public/css/style.css --output lib/public/css/` to compile `lib/public/css/style.css` to `lib/public/css/style.min.css`.

## Changelog ##

### 1.4.3 ###
* Adding `.top-margin .custom-html-widget` CSS for adding a Top Margin to the ad widget.

### 1.4.2 ###
* Updating theme screenshot.
* Updating theme description to use "WordPress" and not "Wordpress".

### 1.4.1 ###
* Adding bottom margin below `.row.home-hero .col-md-8` for mobile.

### 1.4.0 ###
* Setting "Latest News" to show 2 articles and one ad.

### 1.3.4 ###
* Setting `.home-hero` in `tmpl-home-2.php` to 100% width to prevent horizontal scroll.

### 1.3.3 ###
* Adding `filemtime()` version to theme style enqueuing.

### 1.3.2 ###
* Mobile CSS adjustments for `tmpl-hom-2.php` News Grid.

### 1.3.1 ###
* Compiling CSS via `css-minify --file lib/public/css/style.css --output lib/public/css/`.
* Removing `$source_name` exceptions for "Other" and "Opponent" News Source terms.

### 1.3.0 ###
* Adding "Home 2 - News Row (1/3 Width)" and "Home 2 - News Row (2/3 Width)" sidebars.
* Grid CSS layout for "Home 2 - News Row (2/3 Width)" sidebar.
* Adding "limit" attribute for `[latestnews]` shortcode.

### 1.2.0 ###
* Reworked layout for "Home 2" template.
* Adding new sidebars for `tmpl-home-2.php`: "Home 2 - Top Wide Ad Slot", "Home 2 - Top Left 2/3", "Home 2 - Top Right 1/3", and "Home 2 - News Row".
* Updating `[latestnews]` shortcode with `category` and `css_classes` attributes.
* Adding `uber_log()` for debugging.

### 1.1.3 ###
* Adding "Ad Placeholder" graphic to placeholders in `tmpl-home-2.php`.

### 1.1.2 ###
* Adjusting column classes in `tmpl-home-2.php` to maintain columns on tablets.

### 1.1.1 ###
* Adding ad placeholder CSS classes to `tmpl-home-2.php`.

### 1.1.0 ###
* New template: `tmpl-home-2.php` with a full width top section followed by a row of recent posts and ending with a widgetized three column section.
* Adding "Article Before Content" widget area for inserting widgets before post/article content.
* Added "Remove additional HTML around widget?" to the Schedule Widget.
* Moved CSS from `style.css` to `lib/public/css`.
* Added these constants: `THEME_DIR_PATH`, `THEME_DIR_URI`, and `NDNATION_DATA_DIR_PATH`.
* Various code refactors including removal of deprecated function call, properly declaring global variables, and updating array references to use brackets.
* Adding npm build for this README.

### 1.0.0 ###
* Initial release.