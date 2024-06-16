<?php
/**
 * Plugin Name: Delete Control by Firework
 * Plugin URI: https://github.com/FireWork-Production-Private-Ltd/Delete-Control-by-FireWork
 * Description: This plugin will help you to delete the block easily.
 * Version: 1.0.0
 * Author: FireWork Production Private Ltd, up1512001
 * Author URI: https://github.com/FireWork-Production-Private-Ltd
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: delete-control-by-firework
 * Domain Path: /languages
 * Requires at least: 5.2
 * Requires PHP: 7.2
 *
 * @package Delete_Control_By_Firework
 * @category Core
 * @since 1.0.0
 */

/**
 * Exit if accessed directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define the plugin path.
if ( ! defined( 'DELETE_CONTROL_BY_FIREWORK_PATH' ) ) {
	define( 'DELETE_CONTROL_BY_FIREWORK_PATH', plugin_dir_path( __FILE__ ) );
}

// Define the plugin URL.
if ( ! defined( 'DELETE_CONTROL_BY_FIREWORK_URL' ) ) {
	define( 'DELETE_CONTROL_BY_FIREWORK_URL', plugin_dir_url( __FILE__ ) );
}


/**
 * Main Delete Control by Firework Class
 *
 * @class Delete_Control_By_Firework
 * @since 1.0.0
 */
final class Delete_Control_By_Firework {

	/**
	 * The single instance of the class
	 *
	 * @var Delete_Control_By_Firework
	 * @since 1.0.0
	 */
	protected static $instance = null;

	/**
	 * Main Delete Control by Firework Instance
	 *
	 * Ensures only one instance of Delete Block by Firework is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @return Delete_Control_By_Firework - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Delete Control by Firework Constructor
	 */
	public function __construct() {
		$this->init_hooks();
	}

	/**
	 * Hook into actions and filters
	 *
	 * @since 1.0.0
	 */
	private function init_hooks() {
		add_action( 'enqueue_block_editor_assets', array( $this, 'register_block_assets' ) );
	}

	/**
	 * Delete Block by Firework
	 *
	 * @since 1.0.0
	 */
	public function register_block_assets() {
		wp_register_script(
			'delete-control',
			DELETE_CONTROL_BY_FIREWORK_URL . 'assets/build/js/delete-control.js',
			array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-compose', 'wp-data', 'wp-hooks' ),
			filemtime( DELETE_CONTROL_BY_FIREWORK_PATH . 'assets/build/js/delete-control.js' ),
			true
		);
		wp_enqueue_script( 'delete-control' );
	}
}

Delete_Control_By_Firework::instance();
