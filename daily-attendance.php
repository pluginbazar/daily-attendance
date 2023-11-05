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

global $wpdb;

defined( 'ABSPATH' ) || exit;
defined( 'DAILYATTENDANCE_PLUGIN_URL' ) || define( 'DAILYATTENDANCE_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );
defined( 'DAILYATTENDANCE_PLUGIN_DIR' ) || define( 'DAILYATTENDANCE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
defined( 'DAILYATTENDANCE_PLUGIN_FILE' ) || define( 'DAILYATTENDANCE_PLUGIN_FILE', plugin_basename( __FILE__ ) );
defined( 'DAILYATTENDANCE_DB_TABLE' ) || define( 'DAILYATTENDANCE_DB_TABLE', $wpdb->prefix . 'dailyattendance_activity' );
defined( 'DAILYATTENDANCE_DESIGNATIONS_TABLE' ) || define( 'DAILYATTENDANCE_DESIGNATIONS_TABLE', $wpdb->prefix . 'dailyattendance_designations' );
defined( 'DAILYATTENDANCE_LEAVE_REQUEST_TABLE' ) || define( 'DAILYATTENDANCE_LEAVE_REQUEST_TABLE', $wpdb->prefix . 'dailyattendance_leave_request' );
defined( 'DAILYATTENDANCE_HOLIDAYS_TABLE' ) || define( 'DAILYATTENDANCE_HOLIDAYS_TABLE', $wpdb->prefix . 'dailyattendance_holidays' );

defined( 'DAILYATTENDANCE_PLUGIN_LINK' ) || define( 'DAILYATTENDANCE_PLUGIN_LINK', 'https://wordpress.org/plugins/daily-attendance/' );
defined( 'DAILYATTENDANCE_PLUGIN_DOC_LINK' ) || define( 'DAILYATTENDANCE_PLUGIN_DOC_LINK', 'https://wordpress.org/plugins/daily-attendance/' );
defined( 'DAILYATTENDANCE_PLUGIN_SUPPORT_LINK' ) || define( 'DAILYATTENDANCE_PLUGIN_SUPPORT_LINK', 'https://wordpress.org/plugins/daily-attendance/' );

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
			require_once( DAILYATTENDANCE_PLUGIN_DIR . 'includes/class-rest-api.php' );
		}


		/**
		 * Loading scripts to backend
		 */
		function admin_scripts() {

			if ( isset( $_GET['page'] ) && 'daily-attendance' === sanitize_text_field( $_GET['page'] ) ) {

				wp_enqueue_style( 'dailyattendance-hint', DAILYATTENDANCE_PLUGIN_URL . 'assets/admin/css/hint.min.css' );
				wp_enqueue_style( 'dailyattendance-tailwind', DAILYATTENDANCE_PLUGIN_URL . 'assets/admin/css/tailwind.min.css', [], time() );

				wp_enqueue_style( 'dailyattendance-datatables', DAILYATTENDANCE_PLUGIN_URL . 'assets/admin/css/datatables.min.css' );
				wp_enqueue_script( 'dailyattendance-datatables', DAILYATTENDANCE_PLUGIN_URL . 'assets/admin/js/datatables.min.js', [ 'jquery' ] );

				wp_enqueue_style( 'dailyattendance-style', DAILYATTENDANCE_PLUGIN_URL . 'assets/admin/css/style.css', [], time() );
				wp_enqueue_script( 'dailyattendance-scripts', DAILYATTENDANCE_PLUGIN_URL . 'assets/admin/js/scripts.js', [ 'jquery' ], time(), true );
				wp_localize_script( 'ajax-script', 'pluginObject', $this->localize_scripts() );
			}
		}

		function localize_scripts() {
			return apply_filters( 'daily_attendance_filters_localize_scripts', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
			) );
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

add_action( 'wp_head', function () {
	if ( isset( $_GET['debug'] ) && 'yes' == sanitize_text_field( $_GET['debug'] ) ) {

		dailyattendance_insert_activity_entry(3, 'in', 'Again in at office');

		die();
	}
}, 0 );