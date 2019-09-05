<?php
/**
 * Plugin Name: Maintenance Mode
 * Plugin URI:  https://github.com/rockingaryan/maintenance-mode
 * Description: A simple & lightweight maintenance mode plugin.
 * Author:      Aryan Raj
 * Author URI:  https://www.aryanraj.com/
 * Version:     1.0.0
 * License:     GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package Maintenance
 */

/**
 * If this file is called directly, abort.
 */
if (! defined('ABSPATH') ) { exit;  }

add_action('admin_notices', 'mm_admin_notices');
add_filter(
    'login_message',
    function () {
        return '<div id="login_error">' . __('<strong>Maintenance mode</strong> is <strong>active</strong>!', 'maintenance-mode') . '</div>';
    } 
);

/**
 * Alert message for admin, when active.
 */
function mm_admin_notices()
{
    echo '<div id="message" class="error fade"><p>' . __('<strong>Maintenance mode</strong> is <strong>active</strong>!', 'maintenance-mode') . ' <a href="plugins.php?s=Maintenance Mode&plugin_status=all">' . __('Deactivate it, when work is done.', 'maintenance-mode') . '</a></p></div>';
}

add_action('get_header', 'maintenance_mode');
/**
 * Maintenance message for users, when active.
 */
function maintenance_mode()
{
    if(!current_user_can('edit_themes') || !is_user_logged_in() ) { //https://wordpress.org/support/article/roles-and-capabilities/
        wp_die('<h1>' . __('Maintenance', 'maintenance-mode') . '</h1><p>' . __('Please check back soon.', 'maintenance-mode') . '</p>', __('Maintenance', 'maintenance-mode'), array('response' => '503'));
    }
}
