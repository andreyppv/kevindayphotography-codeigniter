<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//--------------------------------------------------------------------
// !TEMPLATE
//--------------------------------------------------------------------

/*
|--------------------------------------------------------------------
| SITE PATH
|--------------------------------------------------------------------
| The path to the root folder that holds the application. This does
| not have to be the site root folder, or even the folder defined in
| FCPATH.
|
*/
$config['template.site_path']	= FCPATH;

/*
|---------------------------------------------------------------------
| THEME PATHS
|---------------------------------------------------------------------
| An array of folders to look in for themes. There must be at least
| one folder path at all times, to serve as the fall-back for when
| a theme isn't found. Paths are relative to the FCPATH.
*/
$config['template.theme_paths'] = array('themes');

/*
|--------------------------------------------------------------------
| DEFAULT LAYOUT
|--------------------------------------------------------------------
| This is the name of the default layout used if no others are
| specified.
|
| NOTE: do not include an ending ".php" extension.
|
*/
$config['template.default_layout'] = "index";

/*
|--------------------------------------------------------------------
| USE THEMES?
|--------------------------------------------------------------------
| When set to TRUE, Ocular will check the user agent during the
| render process, and check the UA against the template.themes (below),
| allowing you to create mobile versions of your site, and version
| targetted specifically at a single type of phone (ie, Blackberry or
| iPhone).
|
| Note, that, when rendering, if the file doesn't exist in the
| targetted theme, Ocular then checks the default site for the same file.
|
*/
$config['template.use_mobile_themes'] = FALSE;


/*
|--------------------------------------------------------------------
| DEFAULT THEME
|--------------------------------------------------------------------
| This is the folder name that contains the default theme to use
| when 'template.use_mobile_themes' is set to TRUE.
|
*/
$config['template.default_theme']	= 'default/';

/*
|--------------------------------------------------------------------
| ADMIN THEME
|--------------------------------------------------------------------
| This is the folder name that contains the default admin theme to use
|
*/
$config['template.admin_theme'] = 'admin';

/*
|--------------------------------------------------------------------
| PARSE VIEWS
|--------------------------------------------------------------------
| If set to TRUE, views will be parsed via CodeIgniter's parser.
| If FALSE, views will be considered PHP views only.
|
*/
$config['template.parse_views']		= FALSE;

/*
|--------------------------------------------------------------------
| MESSAGE TEMPLATE
|--------------------------------------------------------------------
| This is the template that Ocular will use when displaying messages
| through the message() function.
|
| To set the class for the type of message (error, success, etc),
| the {type} placeholder will be replaced. The message will replace
| the {message} placeholder.
|
*/
$config['template.message_template'] =<<<EOD
    <script>
        $.notify({
            message: '{message}',
        },
        {
            type : '{type}',
            timer: 1000,
            delay: 5000,
            placement: {
                from: "bottom",
                align: "right"
            },
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
        });
    </script>
EOD;

/*
|--------------------------------------------------------------------
| BREADCRUMB Separator
|--------------------------------------------------------------------
| The symbol displayed between elements of the breadcrumb.
|
*/
$config['template.breadcrumb_symbol']	= ' : ';


//--------------------------------------------------------------------
// !ASSETS
//--------------------------------------------------------------------
/*
	The base folder (relative to the template.site_root config setting)
	that all of the assets are stored in. This is used to generate both
	the url and the relative file path.

	This should NOT include the trailing slash.
*/
$config['assets.base_folder'] = 'assets';

/*
	The names of the folders for the various assets.
	These default to 'js', 'css', and 'images'. These folders
	are expected to be found directly under the 'assets.base_folder'.

	While searching through themes, these names are also used to
	build alternate folders to look into, under the theme folders.
*/
$config['assets.asset_folders'] = array(
	'css'	=> 'css',
	'js'	=> 'js',
	'image'	=> 'images'
);

/*
	The 'assets.js_opener' and 'assets.js_closer' strings are used
	to wrap all of your inline scripts into. By default, it is
	setup to work with jQuery.
*/
$config['assets.js_opener'] = '$(document).ready(function(){'. "\n";
$config['assets.js_closer'] = '});'. "\n";

/*
	The 'assets.js_combine' and 'assets.css_combine' settings tell the Asset library whether
	js and css files, respectively, should be combined or not.
*/
$config['assets.js_combine'] = FALSE;
$config['assets.css_combine'] = FALSE;

/*
	The 'assets.encrypt' setting will mask the app structure
	by encrypting the filename of the combined files.

	If false the filename would be in the format...
		theme_module_controller_method
	If true, it would be an md5 hash of the above filename.
*/
$config['assets.encrypt_name'] = FALSE;

/*
	The 'assets.js_minify' and 'assets.css_minify' settings are used to
	tell the ui loader to minify the combined assets or not
*/
$config['assets.js_minify'] = FALSE;
$config['assets.css_minify'] = FALSE;

/*
	The 'assets.encode' setting is used to specify whether the assets should
	be encoded based on the HTTP_ACCEPT_ENCODING value.
*/
$config['assets.encode'] = FALSE;

//--------------------------------------------------------------------
// !Emailer
//--------------------------------------------------------------------
/*
    Setting this option to true writes email content to a local file in the log path for debugging
    using 'development' environments without sendmail such as Windows Desktop servers like WAMP.
*/
$config['emailer.write_to_file'] = false;