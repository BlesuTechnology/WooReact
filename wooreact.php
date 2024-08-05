<?php

/**
 *
 * @link              https://WooReact.in
 * @since             1.0.0
 * @package           WooReact
 *
 * @wordpress-plugin
 * Plugin Name: WooReact
 * Plugin URI:       
 * Description: WooReact application st 
 * Version:           1.0.18 
 * Author:            WooReact.IN Sp. z o.o.
 * Author URI:        https://WooReact.in
 * License:           https://joinup.ec.europa.eu/software/page/eupl
 * Domain Path:       /languages
 */


if (!defined('WPINC')) {
	die;
}

define('CONTENT_TYPE_JSON', 'Content-Type: application/json');

require_once plugin_dir_path(__FILE__) . 'includes/class-wooreact.php';




function run_wooreact()
{
	$plugin = new WooReact();
	$plugin->run();
}


run_wooreact(); {
	$fields['billing']['billing_email'] = array(
		'label' => __('Email', 'woocommerce'),
		'placeholder' => _x('Wprowadź swój email', 'placeholder', 'woocommerce'),
		'required' => true,
		'clear' => false,
		'type' => 'text',
		'id' => 'billing_email',
		'class' => array('my-css'),
		'priority' => 1,
	);
	return $fields;

}


add_action('wp_enqueue_scripts', 'register_react_and_reactdom');

add_action('woocommerce_blocks_enqueue_checkout_block_scripts_after', 'load_WooReact_React_App');


function load_WooReact_React_App()
{
	wp_enqueue_script(
		'AppData',
		plugin_dir_url(__FILE__) . 'public/dist/bundle.js',
		['jquery', 'wp-element', 'react', "react-dom"],
		wp_rand(),
		true
	);





}






function get_plugin_version()
{
	$plugin_data = get_plugin_data(__FILE__);
	return $plugin_data['Version'];
}





