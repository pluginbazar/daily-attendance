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

defined( 'ABSPATH' ) || exit;
defined( 'DAILYATTENDANCE_PLUGIN_URL' ) || define( 'DAILYATTENDANCE_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );
defined( 'DAILYATTENDANCE_PLUGIN_DIR' ) || define( 'DAILYATTENDANCE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
defined( 'DAILYATTENDANCE_PLUGIN_FILE' ) || define( 'DAILYATTENDANCE_PLUGIN_FILE', plugin_basename( __FILE__ ) );

if ( ! class_exists( 'DAILYATTENDANCE_Main' ) ) {
	class DAILYATTENDANCE_Main {

		protected static $_instance = null;

		/**
		 * DAILYATTENDANCE_Main constructor.
		 */
		function __construct() {

			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );

			$this->define_classes_functions();
		}


		/**
		 * Loading classes and functions
		 */
		function define_classes_functions() {

			require_once( DAILYATTENDANCE_PLUGIN_DIR . 'includes/functions.php' );
			require_once( DAILYATTENDANCE_PLUGIN_DIR . 'includes/class-functions.php' );
			require_once( DAILYATTENDANCE_PLUGIN_DIR . 'includes/class-hooks.php' );
		}


		/**
		 * Loading scripts to backend
		 */
		function admin_scripts() {

			wp_enqueue_style( 'tooltip', DAILYATTENDANCE_PLUGIN_URL . 'assets/tool-tip.min.css' );
			wp_enqueue_style( 'icofont', DAILYATTENDANCE_PLUGIN_URL . 'assets/fonts/icofont.min.css' );
			wp_enqueue_style( 'pbda_admin_style', DAILYATTENDANCE_PLUGIN_URL . 'assets/admin/css/style.css' );
		}


		/**
		 * @return DAILYATTENDANCE_Main
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}
	}
}

add_action( 'plugins_loaded', array( 'DAILYATTENDANCE_Main', 'instance' ), 100 );