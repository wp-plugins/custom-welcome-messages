<?php
/**
 * @package Custom Welcome Messages
 * @version 1.1
 */
/*
Plugin Name: Custom Welcome Messages
Plugin URI: http://www.joshlobe.com/2012/01/wordpress-custom-welcome-messages/
Description: Add welcome messages to your register, login, and logout pages.
Author: Josh Lobe
Version: 1.1
Author URI: http://joshlobe.com

*/

/*  Copyright 2011  Josh Lobe  (email : joshlobe@joshlobe.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



// Set our language localization folder (used for adding translations)
function jwl_custom_welcome() {
 load_plugin_textdomain('jwl-custom-welcome', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'jwl_custom_welcome' );


//  Add settings link to plugins page menu
//  This can be duplicated to add multiple links
function add_customwelcome_settings_link($links, $file) {
	static $this_plugin;
	if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);
 
		if ($file == $this_plugin){
		$settings_link = '<a href="admin.php?page=custom-welcome">'.__("Settings",'jwl-custom-welcome').'</a>';
		$settings_link2 = '<a href="http://forum.joshlobe.com/member.php?action=register&referrer=1">'.__("Support Forum",'jwl-ultimate-tinymce').'</a>';
		array_unshift($links, $settings_link, $settings_link2);
		}
	return $links;
}
add_filter('plugin_action_links', 'add_customwelcome_settings_link', 10, 2 );

// Donate link on manage plugin page
function jwl_customwelcome_donate_link($links, $file) { if ($file == plugin_basename(__FILE__)) { $donate_link = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=A9E5VNRBMVBCS" target="_blank">Donate</a>'; $links[] = $donate_link; } return $links; } add_filter('plugin_row_meta', 'jwl_customwelcome_donate_link', 10, 2);

// Call our external stylesheet used in the admin panel for customizing the "postbox" and "inside" classes.
function jwl_customwelcome_register_head() {
    $url = plugin_dir_url( __FILE__ ) . 'css/admin_panel.css';  // Added for admin panel css styles
    echo "<link rel='stylesheet' type='text/css' href='$url' />\n";  // Added for admin panel css styles
}
add_action('admin_head', 'jwl_customwelcome_register_head');

// Add the admin options page.  This creates the basic admin settings page wrap
function jwl_customwelcome_add_page() {
		add_options_page('Custom Welcome Messages Plugin Page', __('Custom Welcome Messages','jwl-custom-welcome'), 'manage_options', 'custom-welcome', 'jwl_customwelcome_options_page');	
}
add_action('admin_menu', 'jwl_customwelcome_add_page');

// Display the admin options page
	function jwl_customwelcome_options_page() {
	?>
	<div class="wrap">
		<h2><?php _e('Custom Welcome Messages Plugin Menu','jwl-custom-welcome'); ?></h2>

            <div class="metabox-holder" style="width:65%; float:left; margin-right:10px;">
            <form action="options.php" method="post">
                <div class="postbox">
                <!-- <div class="inside" style="padding:0px 0px 0px 0px;"> -->
                	
					<?php do_settings_sections('custom-welcome'); ?>
                    <?php settings_fields('jwl_customwelcome_options_group'); ?><br /><br />  
                   
                   <br /><br />     
                <!-- </div> -->
                </div>
                <center><input class="button-primary" type="submit" name="Save" value="<?php _e('Save your Selection','jwl-custom-welcome'); ?>" id="submitbutton" /></center><br /> <br />
                
                <div class="postbox">
                <!-- <div class="inside" style="padding:0px 0px 0px 0px;"> -->
                	
					<?php do_settings_sections('custom-welcome2'); ?>
                    <?php settings_fields('jwl_customwelcome_options_group'); ?><br /><br />  
                   
                   <br /><br />     
                <!-- </div> -->
                </div>
                <center><input class="button-primary" type="submit" name="Save" value="<?php _e('Save your Selection','jwl-custom-welcome'); ?>" id="submitbutton" /></center><br /> <br />
                
                <div class="postbox">
                <!-- <div class="inside" style="padding:0px 0px 0px 0px;"> -->
                	
					<?php do_settings_sections('custom-welcome3'); ?>
                    <?php settings_fields('jwl_customwelcome_options_group'); ?><br /><br />  
                   
                   <br /><br />     
                <!-- </div> -->
                </div>
                <center><input class="button-primary" type="submit" name="Save" value="<?php _e('Save your Selection','jwl-custom-welcome'); ?>" id="submitbutton" /></center><br /> <br />
                
                </form>
            </div>
              
            
 
    		<div class="metabox-holder" style="width:30%; float:left;">
 
            
            <div class="postbox2donate">
                <h3 style="cursor:default;"><?php _e('Donations','jwl-custom-welcome'); ?></h3>
                <div class="inside2donate" style="padding:12px 12px 12px 12px;">
                <p><strong><?php _e('Even the smallest donations are gratefully accepted.','jwl-custom-welcome'); ?></strong></p>
                        
                <!--  Donate Button -->
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="A9E5VNRBMVBCS">
                <center><input type="image" src="http://www.joshlobe.com/images/donate.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"></center>
                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
                </div>
            </div>
            
            <div class="postbox2resources">
                <h3 style="cursor:default;"><?php _e('Additional Resources','jwl-ultimate-tinymce'); ?></h3>
                <div class="inside2resources" style="padding:12px 12px 12px 12px;">
                <img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/support.png" style="margin-bottom: -8px;" />
                <a href="http://forum.joshlobe.com/member.php?action=register&referrer=1" target="_blank"><?php _e('Visit my Support Forum <strong>NEW</strong>.','jwl-custom-welcome'); ?></a><br /><br />
                <img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/help.png" style="margin-bottom: -8px;" />
                <a href="http://www.joshlobe.com/2012/01/wordpress-custom-welcome-messages/" target="_blank"><?php _e('Get help from my personal blog.','jwl-jwl-custom-welcome'); ?></a><br /><br />
                <img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/email.png" style="margin-bottom: -8px;" />
                <a href="http://www.joshlobe.com/contact-me/" target="_blank"><?php _e('Email me directly using my contact form.','jwl-custom-welcome'); ?></a><br /><br />
                <img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/rss.png" style="margin-bottom: -8px;" />
                <a href="http://www.joshlobe.com/feed/" target="_blank"><?php _e('Subscribe to my RSS Feed.','jwl-custom-welcome'); ?></a><br /><br />
                <img src="<?php echo plugin_dir_url( __FILE__ ) ?>img/follow.png" style="margin-bottom: -8px;" />
                <?php _e('Follow me on ','jwl-ultimate-tinymce'); ?><a target="_blank" href="http://www.facebook.com/joshlobe"><?php _e('Facebook','jwl-ultimate-tinymce'); ?></a><?php _e(' and ','jwl-ultimate-tinymce'); ?><a target="_blank" href="http://twitter.com/#!/joshlobe"><?php _e('Twitter','jwl-custom-welcome'); ?></a>.<br />
                               
                </div>
            </div>
            
           
    	</div>            
	</div>
	<?php 
	}


// Add ALL our settings
function jwl_customwelcome_settings_api_init() {	
	// Creates our individual box content section
 	add_settings_section('jwl_login_setting_section', __('Custom Login/Register Welcome Message','jwl-custom-welcome'), 'jwl_login_setting_section_callback_function', 'custom-welcome');
	add_settings_section('jwl_logout_setting_section', __('Custom Logout Message','jwl-custom-welcome'), 'jwl_logout_setting_section_callback_function', 'custom-welcome2');
	add_settings_section('jwl_misc_setting_section', __('Miscellaneous Features','jwl-custom-welcome'), 'jwl_misc_setting_section_callback_function', 'custom-welcome3');
	
	// Creates our settings
	add_settings_field('jwl_enable1_id', __('Enable/Disable Message','jwl-custom-welcome'), 'jwl_enable1_callback_function', 'custom-welcome', 'jwl_login_setting_section');
	add_settings_field('jwl_login_message_id', __('Custom Login/Register Message','jwl-custom-welcome'), 'jwl_login_message_callback_function', 'custom-welcome', 'jwl_login_setting_section');
	add_settings_field('jwl_enable3_id', __('Enable/Disable Message','jwl-custom-welcome'), 'jwl_enable3_callback_function', 'custom-welcome2', 'jwl_logout_setting_section');
	add_settings_field('jwl_logout_message_id', __('Custom Logout Message','jwl-custom-welcome'), 'jwl_logout_message_callback_function', 'custom-welcome2', 'jwl_logout_setting_section');
	add_settings_field('jwl_login_css_id', __('Enter Custom CSS','jwl-custom-welcome'), 'jwl_login_css_callback_function', 'custom-welcome', 'jwl_login_setting_section');
	add_settings_field('jwl_logout_css_id', __('Enter Custom CSS','jwl-custom-welcome'), 'jwl_logout_css_callback_function', 'custom-welcome2', 'jwl_logout_setting_section');
	//add_settings_field('jwl_enable5_id', __('Enable/Disable Background Image','jwl-custom-welcome'), 'jwl_enable5_callback_function', 'custom-welcome3', 'jwl_misc_setting_section');
	//add_settings_field('jwl_background_id', __('Add a custom background image', 'jwl-custom-welcome'), 'jwl_background_callback_function', 'custom-welcome3', 'jwl_misc_setting_section');
	add_settings_field('jwl_enable6_id', __('Enable/Disable Logo Image','jwl-custom-welcome'), 'jwl_enable6_callback_function', 'custom-welcome3', 'jwl_misc_setting_section');
	add_settings_field('jwl_logo_id', __('Add a custom logo image', 'jwl-custom-welcome'), 'jwl_logo_callback_function', 'custom-welcome3', 'jwl_misc_setting_section');
	add_settings_field('jwl_enable7_id', __('Enable/Disable Logo Link','jwl-custom-welcome'), 'jwl_enable7_callback_function', 'custom-welcome3', 'jwl_misc_setting_section');
	add_settings_field('jwl_headerurl_id', __('Change the logo image link', 'jwl-custom-welcome'), 'jwl_headerurl_callback_function', 'custom-welcome3', 'jwl_misc_setting_section');
	add_settings_field('jwl_enable8_id', __('Enable/Disable Logo Title','jwl-custom-welcome'), 'jwl_enable8_callback_function', 'custom-welcome3', 'jwl_misc_setting_section');
	add_settings_field('jwl_headertitle_id', __('Change the logo title text', 'jwl-custom-welcome'), 'jwl_headertitle_callback_function', 'custom-welcome3', 'jwl_misc_setting_section');

	
	// Registers our settings
	register_setting('jwl_customwelcome_options_group','jwl_login_message_id');
	register_setting('jwl_customwelcome_options_group','jwl_logout_message_id');
	register_setting('jwl_customwelcome_options_group','jwl_login_css_id');
	register_setting('jwl_customwelcome_options_group','jwl_logout_css_id');
	//register_setting('jwl_customwelcome_options_group','jwl_background_id');
	register_setting('jwl_customwelcome_options_group','jwl_logo_id');
	register_setting('jwl_customwelcome_options_group','jwl_headerurl_id');
	register_setting('jwl_customwelcome_options_group','jwl_headertitle_id');
	
	register_setting('jwl_customwelcome_options_group','jwl_enable1_id');
	register_setting('jwl_customwelcome_options_group','jwl_enable3_id');
	//register_setting('jwl_customwelcome_options_group','jwl_enable5_id');
	register_setting('jwl_customwelcome_options_group','jwl_enable6_id');
	register_setting('jwl_customwelcome_options_group','jwl_enable7_id');
	register_setting('jwl_customwelcome_options_group','jwl_enable8_id');
}
add_action('admin_init', 'jwl_customwelcome_settings_api_init');  

 // These are our callback functions for each settings option GROUP described above.
 function jwl_login_setting_section_callback_function() {
 	_e('<p><strong>&nbsp;&nbsp;&nbsp;&nbsp;Write an HTML message to display on your Login/Register Page.</strong></p>','jwl-custom-welcome');
 }
 
 function jwl_logout_setting_section_callback_function() {
 	_e('<p><strong>&nbsp;&nbsp;&nbsp;&nbsp;Write an HTML message to display on your Logout Page.</strong></p>','jwl-custom-welcome');
 }
 
 function jwl_misc_setting_section_callback_function() {
 	_e('<p><strong>&nbsp;&nbsp;&nbsp;&nbsp;Other options.</strong></p>','jwl-custom-welcome');
 }
 
 // Our callbacks for displaying in the admin area
 function jwl_login_message_callback_function() {
	echo '<textarea name="jwl_login_message_id" id="login_message" rows="15" class="long-text" style="width:460px; height:100px;">';
	echo get_option('jwl_login_message_id');
	echo '</textarea><br />'; _e('You may enter any custom valid html code to display in your message box.  This includes font styles and properties, image tags, iframes, embeds, and more.','jwl-custom-welcome');
 }
 
 function jwl_logout_message_callback_function() {
	echo '<textarea name="jwl_logout_message_id" id="logout_message" rows="15" class="long-text" style="width:460px; height:100px;">';
	echo get_option('jwl_logout_message_id');
	echo '</textarea><br />'; _e('You may enter any custom valid html code to display in your message box.  This includes font styles and properties, image tags, iframes, embeds, and more.','jwl-custom-welcome');
 }
 
 function jwl_login_css_callback_function() {
	echo '<textarea name="jwl_login_css_id" id="login_css_message" rows="15" class="long-text" style="width:460px; height:100px;">';
	echo get_option('jwl_login_css_id');
	echo '</textarea><br />'; _e('You may enter any custom css properties to design your message box by using the following syntax format as an example: <i>background-color:#333333;border:1px solid black;color:#FF0000; ...</i>','jwl-custom-welcome');
 }
 
 function jwl_logout_css_callback_function() {
	echo '<textarea name="jwl_logout_css_id" id="logout_css_message" rows="15" class="long-text" style="width:460px; height:100px;">';
	echo get_option('jwl_logout_css_id');
	echo '</textarea><br />'; _e('You may enter any custom css properties to design your message box by using the following syntax format as an example: <i>background-color:#333333;border:1px solid black;color:#FF0000; ...</i>','jwl-custom-welcome');
 }
 
 //function jwl_background_callback_function() {
	//echo '<textarea name="jwl_background_id" id="background" rows="1" class="long-text" style="width:460px; height:60px;">';
	//echo get_option('jwl_background_id');
	//echo '</textarea><br />'; _e('Enter a complete url to a custom background image.','jwl-custom-welcome');
 //}
 
 function jwl_logo_callback_function() {
	echo '<textarea name="jwl_logo_id" id="logo" rows="1" class="long-text" style="width:460px; height:60px;">';
	echo get_option('jwl_logo_id');
	echo '</textarea><br />'; _e('Enter a complete url to a custom logo image. <i>Max height is 67px. Max width is 326px.</i>','jwl-custom-welcome');
 }
 
 function jwl_headerurl_callback_function() {
	echo '<textarea name="jwl_headerurl_id" id="headerurl" rows="1" class="long-text" style="width:460px; height:60px;">';
	echo get_option('jwl_headerurl_id');
	echo '</textarea><br />'; _e('Enter a new complete URL for the logo image link.</i>','jwl-custom-welcome');
 }
 
 function jwl_headertitle_callback_function() {
	echo '<textarea name="jwl_headertitle_id" id="headertitle" rows="1" class="long-text" style="width:460px; height:60px;">';
	echo get_option('jwl_headertitle_id');
	echo '</textarea><br />'; _e('Enter a new message for the mouseover logo title.','jwl-custom-welcome');
 }
 
 function jwl_enable1_callback_function() {
    echo '<input name="jwl_enable1_id" id="enable1" type="checkbox" value="1" class="code" ' . checked( 1, get_option('jwl_enable1_id'), false ) . ' /> '; }
 function jwl_enable3_callback_function() {
    echo '<input name="jwl_enable3_id" id="enable3" type="checkbox" value="1" class="code" ' . checked( 1, get_option('jwl_enable3_id'), false ) . ' /> '; }
 //function jwl_enable5_callback_function() {
    //echo '<input name="jwl_enable5_id" id="enable5" type="checkbox" value="1" class="code" ' . checked( 1, get_option('jwl_enable5_id'), false ) . ' /> '; }
 function jwl_enable6_callback_function() {
    echo '<input name="jwl_enable6_id" id="enable6" type="checkbox" value="1" class="code" ' . checked( 1, get_option('jwl_enable6_id'), false ) . ' /> '; }
 function jwl_enable7_callback_function() {
    echo '<input name="jwl_enable7_id" id="enable7" type="checkbox" value="1" class="code" ' . checked( 1, get_option('jwl_enable7_id'), false ) . ' /> '; }
 function jwl_enable8_callback_function() {
    echo '<input name="jwl_enable8_id" id="enable8" type="checkbox" value="1" class="code" ' . checked( 1, get_option('jwl_enable8_id'), false ) . ' /> '; }
 
//outputs the CSS needed to blend custom-message with the normal message

 $jwl_login = get_option('jwl_enable1_id');
 if ($jwl_login == "1") {
 function jwl_custom_login_head() {
 ?>
	<style type="text/css">
    .login .custom-message {
    background-color:#FFFFE0;
	-moz-border-radius:3px 3px 3px 3px;
    border-color:#E6DB55;
	padding:12px;
	margin:10px 0 16px 8px;
	<?php echo get_option('jwl_login_css_id'); ?>
    }
    </STYLE>
 <?php
 }
 add_action('login_head','jwl_custom_login_head');
 }


 $jwl_logout = get_option('jwl_enable3_id');
 if ($jwl_logout == "1") {
 function jwl_custom_logout_head() {
 ?>
	<style type="text/css">
    #login_error, .message { display:none; }
    .custom-message2 {
	background-color:#FFFFE0;
    -moz-border-radius:3px 3px 3px 3px;
    border-style:solid;
    border-width:1px;
    margin:10px 0 16px 8px;
    padding:12px;
	<?php echo get_option('jwl_logout_css_id'); ?>
    }
	</STYLE>
 <?php
 }
 add_action('login_head','jwl_custom_logout_head');
 }
 
 
// Display our custom messages for login/logout on the front end
function jwl_custom_login_logout_message() {
if ( isset($_GET['loggedout']) && TRUE == $_GET['loggedout'] ) //check to see if it's the logout screen
{
 $jwl_logout2 = get_option('jwl_enable3_id');
 if ($jwl_logout2 == "1") {
 $message = "<p class='custom-message2'>" . get_option('jwl_logout_message_id') . "</p><br />";
 } else {
 $message = "";
 }
}
else //they are logged in
{
 $jwl_login2 = get_option('jwl_enable1_id');
 if ($jwl_login2 == "1") {
 $message = "<p class='custom-message'>" . get_option('jwl_login_message_id') . "</p><br />";
 } else {
 $message = "";
 }
}
 
return $message;
}
add_filter('login_message', 'jwl_custom_login_logout_message');

// Custom Background Function
/*
$jwl_background = get_option('jwl_enable5_id');
if ($jwl_background == "1") {
function jwl_custom_background(){
?> <style type="text/css">
body.login { background: #000 url("<?php echo get_option('jwl_background_id'); ?>") 50% -250px no-repeat fixed !important; }
</style><?php
}
add_action('login_head', 'jwl_custom_background');
}
*/

// Custom Logo Function
$jwl_logo = get_option('jwl_enable6_id');
if ($jwl_logo == "1") {
function jwl_custom_logo(){
?> <style type="text/css">
body.login h1 a { background: url("<?php echo get_option('jwl_logo_id'); ?>") no-repeat top center; }
</style><?php
}
add_action('login_head', 'jwl_custom_logo');
}

// Customize login header link
$jwl_headerurl = get_option('jwl_enable7_id');
if ($jwl_headerurl == "1") {
function jwl_headerurl_function(){
    return get_option('jwl_headerurl_id');
} add_action('login_headerurl', 'jwl_headerurl_function');
}

$jwl_title = get_option('jwl_enable8_id');
if ($jwl_title == "1") {
function jwl_headertitle_function(){
    echo get_option('jwl_headertitle_id');
} add_action('login_headertitle', 'jwl_headertitle_function');
}
?>