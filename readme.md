# vost wordpress theme

Read this in [Portuguese](https://github.com/vostpt/current-website/blob/master/readme.pt.md)

Actual version: wp 5.1.1, com plugins wpml, acf, wp bakery, classic editor e acf extended forms instalados.

 - **[WPML](https://wpml.org/)** - multilingue management
 - **[ACF](https://www.advancedcustomfields.com/)** - to create custom fields for backoffice
 - **[ACF](https://www.advancedcustomfields.com/)** _extended form_ - create forms with acf
 - **[Classic Editor](https://wordpress.org/plugins/classic-editor/)** - restore previous WordPress editor (w/ guttenberg)
 - **[WP Bakery](https://wpbakery.com/)** - create posts with custom templates
 - Custom-made theme for VOST PT

## Development environment

The production environment is made to work with GULP, SASS, Babel, and image optimization. You can work without this, but the production files are minified.

Files in *[/wp-content/themes/vost/dev](https://github.com/vostpt/current-website/tree/master/wp-content/themes/vost/dev)*

## Installation

Run `npm install` and then `gulp serve`;

In folder [/wp-content/themes/vost/dev](https://github.com/vostpt/current-website/tree/master/wp-content/themes/vost/dev) there will be the production environment to minification, transpile and compilation of css and js code;

Inside */dev* folder make `npm install`, and then run gulp with `gulp serve`;

.php files are located in */src* folder, directly copied;

*/src/media* the images are optimized while gulp is starting, after that they're only copied (CPU processing issues - you can edit gulpfile if you want);

*/src/js/* concatenated, transpiled and minified;
*/src/js/* vendor copied directly without changes;
*/src/js/* unique minified and transpiled;

*/src/css/unique* copied directly without merge;
*/src/css* minified;

Inside */src* folder there will be .sql database. After import it's necessary to change in wp_options the 2 site url fields;

Update permalinks.

## Small notes

- Css files have cache buster (no header.php);
- If, for some reason wpml is disabled, you must pay attention all called instances;
- The same for acf, but you would have noticed :) ;
- jquery is only needed for slickjs in home (optimization tip - call script only in home, it's already called in functions);
- In order to improve efficiency, acf can be loaded using json, it would be more efficient;
- Menu edition in apresentação > menus;
- Footer columns edition in apresentação > widgets;
- Duplicate posts to English (and info);
- In functions.php exists a snippet that removes functions for editors;
- When uploading, don't forget to remove development environment;
- Edit wp-config with correct info about connection to database.


## TODO

- htaccess cache for imagens/static;
- Content (and contact mails in form);
- Translations;
- Mailchimp integrated newsletter;
- Archive page;
- Global header/footer info, to make less calls to database;
- Disable jquery global loading, and keep only in home for slickjs (try to optimize as much as possible).