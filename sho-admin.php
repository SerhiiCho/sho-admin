<?php
/*
Plugin Name: Sho Admin
Author: Serhii Cho
Author URI: https://www.linkedin.com/in/serhii-chornenkyi-573005187/
Description: Custom plugin for shobar.com.ua
Version: 0.2
License: no
License URI: https://www.linkedin.com/in/serhii-chornenkyi-573005187/
Text Domain: sho-qpr
Tags: custom-background, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready
*/

defined('ABSPATH') || exit;
define('SHO_ADMIN_PATH', plugin_dir_path(__FILE__));
define('SHO_ADMIN_URL', plugin_dir_url(__FILE__));

require_once 'vendor/autoload.php';
require_once 'ajax_endpoint.php';

(new \ShoAdmin\Hook)
    ->registerVueComponent()
    ->registerAssets();