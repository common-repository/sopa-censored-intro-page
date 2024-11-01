<?php
/**
 * @package SOPA censured intro page
 * @version 1.0
 */
/*
Plugin Name: SOPA censured intro page
Plugin URI: http://socialblogsitewebdesign.com/wordpress_plugins/sopa-censored-intro-page 
Description: SOPA censured intro page will help will show your support, with a touch of humor, with a "Censured" splash page for 10 seconds before to reveal your site.

Author: Sergio Zambrano
Version: 1.1
Author URI: http://SocialBlogsiteWebDesign.com/about
*/

function sopa_print_scripts() {
	$options = get_option('plugin_options');
	$sopa_delay = ($options['sopa_delay']) ? $options['sopa_delay']*1000 : 10000;
				 
				 
if ( !is_admin() ) {
	echo"<script type='text/javascript'>

function sopa_hideIt() {
	document.body.style.overflow = '';
	document.getElementById('sopa_container').style.visibility = 'hidden';
	document.getElementById('sopa_mask').style.visibility = 'hidden';
}
window.onload = function (){
	window.scroll(0,0);
	document.body.style.overflow = 'hidden';
	setTimeout('sopa_hideIt()', $sopa_delay);
}
</script>
<style type='text/css'>
#sopa_mask {
	font: 100% Verdana, Arial, Helvetica, sans-serif;
	margin: 0;
	padding: 0;
	background-color: #7E0405;
	width: 100%;
	z-index: 9998;
	position: absolute;
	top: 0;
	left: 0;
	height: 300%;
}
#sopa_container {
	height: 100%;
	width: 100%;
	position: absolute;
	top: 0;
	left: 0;
	z-index: 9999;
}
#sopa_container #sopa_inner {
	width: 46em;
	margin: 0 auto;
	text-align: center;
	position: absolute;
	top: 50%;
	left: 50%;
	}
#sopa_container #sopa_content {
	margin-top: -17em;
	margin-left: -20em;
	width: 40em;
	height: 700px;
	font-size: 1.4em;
	color: #FFF;
	text-shadow: 0px 2px 0px #000, 
	2px 0px 0px #000, 0px -2px 0px #000, 
	-2px 0px 0px #000, 4px 0px 0px #000,
	4px 4px 0px #000, 3px 3px 0px #000,
	-2px -2px 0px #000, 2px -2px 0px #000;
	line-height: 1.4em;
}
#sopa_container #sopa_content .legend {
	font-size: 12px;
	color: #F90;
	text-shadow: none;
}
#sopa_container #sopa_content a {
	color: #FFF;
	text-shadow: none;
}
.stop-sopa-ribbon {
	position: fixed;
	top: 0; right:
	0; z-index: 9998;
	cursor: pointer;'
}
.sopa_continue {
	display: block;
	margin-top: 20px;
	font-size: 14px;
	colodr: #fff;
}
</style>";
}
}
add_action('wp_print_scripts', 'sopa_print_scripts');

// some definition we will use
define( 'EPT_PUGIN_NAME', 'SOPA Support censured intro page');
define( 'PLUGIN_SLUG', 'sopa-censured-intro-page');
define( 'EPT_CURRENT_VERSION', '1.0' );
define( 'EPT_CURRENT_BUILD', '1' );

function sopa_fullscreen() {
$options = get_option('plugin_options');
	if( $options['sopa_switch'] == 1 ) {
	
		if (!is_admin() ) {
			$sopa_message = ( $options['sopa_message'] ) ? $options['sopa_message'] : 'This website has been temporarily censored until a human scrutiny be scheduled to review it by the department of Information Control and Compliance. 

We review the sites in the order they were reported by our sponsors and we can&rsquo;t guarantee an ETA. If you want to speed up the process, please bring us copies of your GBC (government bitching credits) or your certificate of information control community hours, as well as your complete bank and personal information so one of our anonymous representatives will file your petition.

No. Not seriously. But it could be so soon, if the power is not given to the people, but given to companies who use people&rsquo;s intelectual property to take the money from the rest of us.
If we do, there&rsquo;s no way to protect 99% of people from the 1%.';

			include( 'social-blogsite-web-design.php' );		
		}
	}
}
				 

add_action( 'wp_footer', 'sopa_fullscreen' );





// Plugin SETTINGS ******************************


// add the admin options page
add_action('admin_menu', 'plugin_admin_add_page');
function plugin_admin_add_page() {
add_options_page('SOPA intro page Settings', 'SOPA intro page', 'manage_options', PLUGIN_SLUG, 'plugin_options_page');
}

// display the admin options page
function plugin_options_page() {
?>
<div>
<h2>SOPA intro page Settings</h2>
Options relating to the Custom Plugin.
<form action="options.php" method="post">
<?php settings_fields('plugin_options'); ?>
<?php do_settings_sections(PLUGIN_SLUG); ?>

<p class="submit">
<input type="submit" name="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>
</form></div>

<?php }

// add the admin settings and such
add_action('admin_init', 'plugin_admin_init');
function plugin_admin_init(){
register_setting( 'plugin_options', 'plugin_options', 'plugin_options_validate' );
add_settings_section('tab_main', 'Main Settings', 'plugin_section_text', PLUGIN_SLUG);
add_settings_field('sopa_switch', 'Turn SOPA splash page on/off', 'pf_field_checkbox', PLUGIN_SLUG, 'tab_main');
add_settings_field('sopa_delay', 'Duration (in seconds)', 'pf_field_delay', PLUGIN_SLUG, 'tab_main');
add_settings_field('sopa_message', 'Your custom message (leave empty for default)', 'pf_field_message', PLUGIN_SLUG, 'tab_main');
}


function plugin_section_text() {
echo '<p>Not much to setup. Easy!</p>';
} 


function pf_field_delay() {
$options = get_option('plugin_options');
echo "<input name='plugin_options[sopa_delay]' size='40' type='text' value='{$options['sopa_delay']}' />";
}

function pf_field_checkbox() {
	$options = get_option('plugin_options');
	$checked = ($options['sopa_switch'] == 1) ? 'checked' : '';
	echo "<input name='plugin_options[sopa_switch]' type='checkbox' value='1' $checked />";
}

function pf_field_message() {
	$options = get_option('plugin_options');
	echo "<textarea name='plugin_options[sopa_message]' cols='50' rows='20'/>{$options['sopa_message']}</textarea>";
}



// validate our options
function plugin_options_validate($input) {
$options = get_option('plugin_options');
$options['sopa_delay'] = trim($input['sopa_delay']);
if(!preg_match('/^[0-9]{1,2}$/i', $options['sopa_delay'])) {
$options['sopa_delay'] = '';
}
$options['sopa_switch'] = $input['sopa_switch'] == 1 ? 1 : '0'; 
$options['sopa_message'] = $input['sopa_message'];
return $options;
}

?>