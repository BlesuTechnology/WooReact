<?php

class WooReact_Admin
{

	private $plugin_name;
	private $version;
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action('admin_menu', array($this, 'addPluginAdminMenu'), 9);

		add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_styles'));

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_admin_styles()
	{

		wp_enqueue_style('admincss', plugin_dir_url(__FILE__) . 'css/wooreact-admin.css', array(), $this->version, 'all');
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wooreact-admin.js', array('jquery'), $this->version, false);
	}

	public function addPluginAdminMenu()
	{
		add_menu_page($this->plugin_name, 'WooReact', 'administrator', $this->plugin_name . '-settings', array($this, 'displayPluginAdminSettings'), 'dashicons-chart-area', 26);

	}



	public function displayPluginAdminDashboard()
	{
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/' . $this->plugin_name . '-admin-display.php';
	}

	public function displayPluginAdminSettings()
	{

		if (isset($_GET['error_message'])) {
			add_action('admin_notices', array($this, 'wooreactSettingsMessages'));
			do_action('admin_notices', $_GET['error_message']);
		}
		require_once 'partials/' . $this->plugin_name . '-admin-settings-display.php';
	}

	public function wooreactSettingsMessages($error_message)
	{
		switch ($error_message) {
			case '1':
				$message = __('There was an error adding this setting. Please try again.  If this persists, shoot us an email.', 'my-text-domain');
				$err_code = esc_attr('plugin_name_example_setting');
				$setting_field = 'plugin_name_example_setting';
				break;
			default:
				$message = __('An unexpected error occurred.', 'my-text-domain');
				$err_code = esc_attr('plugin_name_unexpected_error');
				$setting_field = 'plugin_name_unexpected_error';
				break;
		}
		$type = 'error';
		add_settings_error(
			$setting_field,
			$err_code,
			$message,
			$type
		);
	}






	public $allowed_tags = array(
		'form',
		'label',
		'input',
		'textarea',
		'iframe',
		'script',
		'style',
		'strong',
		'small',
		'table',
		'span',
		'abbr',
		'code',
		'pre',
		'div',
		'img',
		'h1',
		'h2',
		'h3',
		'h4',
		'h5',
		'h6',
		'ol',
		'ul',
		'li',
		'em',
		'hr',
		'br',
		'tr',
		'td',
		'p',
		'a',
		'b',
		'i'
	);
	public $allowed_atts = array(
		'align',
		'class',
		'type',
		'id',
		'dir',
		'lang',
		'style',
		'xml:lang',
		'src',
		'alt',
		'href',
		'rel',
		'rev',
		'target',
		'novalidate',
		'value',
		'name',
		'tabindex',
		'action',
		'method',
		'for',
		'width',
		'height',
		'data',
		'title'
	);




	private function get_wp_data_value($args)
	{
		if ($args['wp_data'] == 'option') {
			return get_option($args['name']);
		} elseif ($args['wp_data'] == 'post_meta') {
			return get_post_meta($args['post_id'], $args['name'], true);
		}
		return '';
	}






}
