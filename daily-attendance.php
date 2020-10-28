<?php
/**
 * Plugin Name: Daily Attendance
 *
 * Plugin URI: https://www.pluginbazar.com/plugin/daily-attendance/
 * Description: Manage daily attendance of staff with this small, light-weighted and free tool.
 * Version: 1.0.0
 * Author: Pluginbazar
 * Text Domain: daily-attendance
 * Domain Path: /languages/
 * Author URI: https://pluginbazar.com/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access


define( 'PBDA_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );
define( 'PBDA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'PBDA_PLUGIN_FILE', plugin_basename( __FILE__ ) );

/**
 * Class DailyAttendance
 */
class DailyAttendance {

	/**
	 * DailyAttendance constructor.
	 */
	function __construct() {

		$this->load_scripts();
		$this->define_classes_functions();
	}


	/**
	 * Loading classes and functions
	 */
	function define_classes_functions() {

//		$settings_path = str_replace( array( 'Pluginbazar/free/', 'Pluginbazar\free/' ), '', ABSPATH );
//		include $settings_path . "PB-Settings/class-pb-settings.php";

		require_once( PBDA_PLUGIN_DIR . 'includes/class-pb-settings.php' );

		require_once( PBDA_PLUGIN_DIR . 'includes/functions.php' );
		require_once( PBDA_PLUGIN_DIR . 'includes/class-functions.php' );
		require_once( PBDA_PLUGIN_DIR . 'includes/class-hooks.php' );
	}

	/**
	 * Loading scripts to backend
	 */
	function admin_scripts() {

		wp_enqueue_style( 'tooltip', PBDA_PLUGIN_URL . 'assets/tool-tip.min.css' );
		wp_enqueue_style( 'icofont', PBDA_PLUGIN_URL . 'assets/fonts/icofont.min.css' );
		wp_enqueue_style( 'pbda_admin_style', PBDA_PLUGIN_URL . 'assets/admin/css/style.css' );
	}


	/**
	 * Loading scripts to the frontend
	 */
	function front_scripts() {

		wp_enqueue_style( 'tooltip', PBDA_PLUGIN_URL . 'assets/tool-tip.min.css' );
		wp_enqueue_style( 'icofont', PBDA_PLUGIN_URL . 'assets/fonts/icofont.min.css' );
		wp_enqueue_style( 'pbda_style', PBDA_PLUGIN_URL . 'assets/front/css/style.css' );
	}


	/**
	 * Loading scripts
	 */
	function load_scripts() {

		add_action( 'wp_enqueue_scripts', array( $this, 'front_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
	}
}

new DailyAttendance();