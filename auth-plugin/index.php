<?php
/*
Plugin Name:       logSign_plugin
Description:       Authenticates users
Version:           1.0
Author:            sarah
*/

include 'includes/install.php';
register_activation_hook(__FILE__, 'logSign_plugin_activation');

require('C:\Users\Sarah Fouda\Local Sites\fromthemes2\app\public\wp-content\plugins\auth-plugin\API\enterpage.php');
require('C:\Users\Sarah Fouda\Local Sites\fromthemes2\app\public\wp-content\plugins\auth-plugin\API\registerpage.php');

class AuthenticationClass
{
public function __construct()
{
    add_action("admin_menu", array($this, "addToMenu"));
}

function addToMenu()
{
    $mainHook = add_menu_page('Authentication', 'Authentication', 'manage_options', 'authentication', array($this, 'authPage'), 'dashicons-text', 10);
    $authHook = add_submenu_page('authentication', 'Authentication', 'Authentication', 'manage_options', 'authentication', array($this, 'authPage'));
    $enterHook = add_submenu_page('authentication', 'Enter', 'Enter', 'manage_options', 'enter', array($this, 'enterPage'));
    $registerHook = add_submenu_page('authentication', 'Register', 'Register', 'manage_options', 'register', array($this, 'registerPage'));
    add_action("load-{$mainHook}", array($this, "pluginFiles"));
    add_action("load-{$authHook}", array($this, "pluginFiles"));
    add_action("load-{$enterHook}", array($this, "pluginFiles"));
    add_action("load-{$registerHook}", array($this, "pluginFiles"));
}

function pluginFiles()
{
    wp_enqueue_style('style', plugin_dir_url(__FILE__) . 'style.css');
 //   wp_enqueue_script('script', plugin_dir_url(__FILE__) . 'assets/enter.js');
   // wp_enqueue_script('script', plugin_dir_url(__FILE__) . 'assets/register.js');
}

function authPage()
{
    include 'pages/authpage.php';
}
function enterPage()
{
    include 'templates/enter.php'; 
}
function registerPage()
{
    include 'templates/register.php';
}
}
new AuthenticationClass();

