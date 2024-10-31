<?php
/*
Plugin Name: Nofollow Internal Links
Plugin URI: https://www.pandasilk.com/wordpress-nofollow-internal-links-plugin/
Description: Nofollow internal links: read more link, tag cloud, post tags, archive links, category list, post category, post author, comments popup link
Version: 1.2
Author: pandasilk
Author URI: https://www.pandasilk.com/wordpress-nofollow-internal-links-plugin/
*/

/* 
Registering Options Page
*/	
if(!class_exists('NILPluginOptions')) :

// DEFINE PLUGIN ID
define('NILPluginOptions_ID', 'nil-plugin-options');
// DEFINE PLUGIN NICK
define('NILPluginOptions_NICK', 'Nofollow Internal Links');

    class NILPluginOptions
    {
		/** function/method
		* Usage: return absolute file path
		* Arg(1): string
		* Return: string
		*/
		public static function file_path($file)
		{
			return ABSPATH.'wp-content/plugins/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)).$file;
		}
		/** function/method
		* Usage: hooking the plugin options/settings
		* Arg(0): null
		* Return: void
		*/
		public static function register()
		{
			register_setting(NILPluginOptions_ID.'_options', 'NIL1');
			register_setting(NILPluginOptions_ID.'_options', 'NIL2');
			register_setting(NILPluginOptions_ID.'_options', 'NIL3');
			register_setting(NILPluginOptions_ID.'_options', 'NIL4');
			register_setting(NILPluginOptions_ID.'_options', 'NIL5');
			register_setting(NILPluginOptions_ID.'_options', 'NIL6');
			register_setting(NILPluginOptions_ID.'_options', 'NIL7');
			register_setting(NILPluginOptions_ID.'_options', 'NIL8');
		}
		/** function/method
		* Usage: hooking (registering) the plugin menu
		* Arg(0): null
		* Return: void
		*/
		public static function menu()
		{
			// Create menu tab
			add_options_page(NILPluginOptions_NICK.' Plugin Options', NILPluginOptions_NICK, 'manage_options', NILPluginOptions_ID.'_options', array('NILPluginOptions', 'options_page'));
		}
		/** function/method
		* Usage: show options/settings form page
		* Arg(0): null
		* Return: void
		*/
		public static function options_page()
		{ 
			if (!current_user_can('manage_options')) 
			{
				wp_die( __('You do not have sufficient permissions to access this page.') );
			}
			
			$plugin_id = NILPluginOptions_ID;
			// display options page
			include(self::file_path('options.php'));
		}
		
    }
	
	if ( is_admin() )
	{
		add_action('admin_init', array('NILPluginOptions', 'register'));
		add_action('admin_menu', array('NILPluginOptions', 'menu'));
		
	}
	
endif;

// Add settings link on plugin page
	function nil_plugin_action_links($links) { 
	  $settings_link = '<a href="options-general.php?page=nil-plugin-options_options">Settings</a>'; 
	  array_unshift($links, $settings_link); 
	  return $links; 
	}
	 
	$plugin = plugin_basename(__FILE__); 
	add_filter("plugin_action_links_$plugin", 'nil_plugin_action_links' );


	
/* 
Retrieve Options
*/		
$NIL1= (get_option('NIL1') == '1') ? true : false;	
$NIL2= (get_option('NIL2') == '1') ? true : false;	
$NIL3= (get_option('NIL3') == '1') ? true : false;	
$NIL4= (get_option('NIL4') == '1') ? true : false;	
$NIL5= (get_option('NIL5') == '1') ? true : false;	
$NIL6= (get_option('NIL6') == '1') ? true : false;	
$NIL7= (get_option('NIL7') == '1') ? true : false;	
$NIL8= (get_option('NIL8') == '1') ? true : false;	
	
//NIL1.Read More Link
if ($NIL1) {
	add_filter('the_content_more_link','add_nofollow_to_link', 0); 
	function add_nofollow_to_link($link) {
		return str_replace('<a', '<a rel="nofollow"', $link); 
	} 
}

//NIL2. Tag Cloud
if ($NIL2) {
	add_filter('wp_tag_cloud', 'cis_nofollow_tag_cloud');
	function cis_nofollow_tag_cloud($text) {
		return str_replace('<a href=', '<a rel="nofollow" href=',$text); 
	}
}

//NIL3. Post Tags
if ($NIL3) {
	add_filter('the_tags', 'cis_nofollow_the_tag');
	function cis_nofollow_the_tag($text) {
		return str_replace('rel="tag"', 'rel="tag nofollow"', $text);
	}
}

//NIL4. Archive Links
if ($NIL4) {
	add_filter( 'get_archives_link', 'nofollow_archive' );
	function nofollow_archive( $text ) {
		$text = stripslashes($text);
		$text = preg_replace_callback('|<a (.+?)>|i','wp_rel_nofollow_callback', $text);
		return $text;
	}
}
 
//NIL5. Category List
if ($NIL5) {
	add_filter( 'wp_list_categories', 'cis_nofollow_wp_list_categories' );
	function cis_nofollow_wp_list_categories( $text ) {
		$text = stripslashes($text);
		$text = preg_replace_callback('|<a (.+?)>|i','wp_rel_nofollow_callback', $text);
		return $text;
	}
}

//NIL6. Post Category
if ($NIL6) {
	add_filter( 'the_category', 'cis_nofollow_the_category' );
	function cis_nofollow_the_category( $text ) {
		$text = str_replace('rel="category tag"', "", $text);
		$text = cis_nofollow_wp_list_categories($text);
		return $text;
	}
}
 
//NIL7. Post Author
if ($NIL7) {
	add_filter('the_author_posts_link', 'cis_nofollow_the_author_posts_link');
	function cis_nofollow_the_author_posts_link ($link) {
		return str_replace('</a><a href=', '<a rel="nofollow" href=',$link); 
	}
}
 
//NIL8. Comments Popup Link
if ($NIL8) {
	add_filter('comments_popup_link_attributes', 'cis_nofollow_comments_popup_link_attributes');
	function cis_nofollow_comments_popup_link_attributes () {
		echo 'rel="nofollow"';
	}
}
