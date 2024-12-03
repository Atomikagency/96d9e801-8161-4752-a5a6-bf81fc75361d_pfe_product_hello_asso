<?php

/**
 * Plugin Name: PFE - Product Hello Asso
 * Description: Create Cpt for product & hello asso integration
 * Version: 1.0.1
 * Author: AtomikAgency
 * Author URI: https://atomikagency.fr/
 */

define('PFE_PRODUCT_HELLO_ASSO_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('PFE_PRODUCT_HELLO_ASSO_PLUGIN_URL', plugin_dir_url(__FILE__));

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

require_once PFE_PRODUCT_HELLO_ASSO_PLUGIN_DIR . 'update-checker.php';