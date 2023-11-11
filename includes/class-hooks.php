<?php
/**
 * Class Hooks
 */

if ( ! class_exists( 'DAILYATTENDANCE_Hooks' ) ) {
	/**
	 * Class DAILYATTENDANCE_Hooks
	 */
	class DAILYATTENDANCE_Hooks {

		protected static $_instance = null;

		/**
		 * DAILYATTENDANCE_Hooks constructor.
		 */
		function __construct() {

			add_action( 'init', array( $this, 'create_db_tables' ) );
			add_action( 'admin_menu', array( $this, 'add_plugin_menu_page' ) );
			add_filter( 'admin_footer_text', '__return_empty_string' );
			add_filter( 'update_footer', '__return_empty_string', 99999 );
		}


		/**
		 * Render plugin main menu page
		 *
		 * @return void
		 */
		function render_plugin_menu_page() {
			include DAILYATTENDANCE_PLUGIN_DIR . 'templates/admin/main.php';
		}


		/**
		 * Add plugin menu page
		 *
		 * @return void
		 */
		function add_plugin_menu_page() {
			add_menu_page(
				esc_html__( 'Daily Attendance', 'daily-attendance' ),
				esc_html__( 'Daily Attendance', 'daily-attendance' ),
				'manage_options', 'daily-attendance',
				array( $this, 'render_plugin_menu_page' ),
				( DAILYATTENDANCE_PLUGIN_URL . 'assets/images/menu-icon.svg' ), 1
			);
		}


		/**
		 * Create database tables
		 *
		 * @return void
		 */
		function create_db_tables() {

			if ( ! function_exists( 'maybe_create_table' ) ) {
				require_once ABSPATH . 'wp-admin/includes/upgrade.php';
			}

			$sql_create_table = "CREATE TABLE IF NOT EXISTS " . DAILYATTENDANCE_DB_TABLE . " (
				id int(20) NOT NULL AUTO_INCREMENT,
				user_id varchar(128) NOT NULL,
				status ENUM ('in','out','undefined') DEFAULT 'undefined',
				message varchar(256) NOT NULL,
				ip_address varchar(256),
				datetime datetime NOT NULL,
				PRIMARY KEY (id)
	        ) ";

			$sql_designations = "CREATE TABLE IF NOT EXISTS " . DAILYATTENDANCE_DESIGNATIONS_TABLE . " (
				id int(20) NOT NULL AUTO_INCREMENT,
				designation_name varchar(128) NOT NULL,
				designation_status  varchar(256) NOT NULL,
				datetime datetime NOT NULL,
				PRIMARY KEY (id)
	        ) ";


			$sql_leave_request = "CREATE TABLE IF NOT EXISTS " . DAILYATTENDANCE_LEAVE_REQUEST_TABLE . " (
				id int(20) NOT NULL AUTO_INCREMENT,
				user_id  varchar(128) NOT NULL,
				title   varchar(256) NOT NULL,
				description    varchar(256) NOT NULL,
				status    varchar(256) NOT NULL,
				date_from  date NOT NULL,
				date_to  date NOT NULL,
				datetime datetime NOT NULL,
				PRIMARY KEY (id)
	        ) ";


			$sql_holidays = "CREATE TABLE IF NOT EXISTS " . DAILYATTENDANCE_HOLIDAYS_TABLE . " (
				id int(20) NOT NULL AUTO_INCREMENT,
				title   varchar(256) NOT NULL,
				description    varchar(256) NOT NULL,
				status    varchar(256) NOT NULL,
				date_from  date NOT NULL,
				date_to  date NOT NULL,
				datetime datetime NOT NULL,
				PRIMARY KEY (id)
	        ) ";

			maybe_create_table( DAILYATTENDANCE_DB_TABLE, $sql_create_table );
			maybe_create_table( DAILYATTENDANCE_DESIGNATIONS_TABLE, $sql_designations );
			maybe_create_table( DAILYATTENDANCE_LEAVE_REQUEST_TABLE, $sql_leave_request );
			maybe_create_table( DAILYATTENDANCE_HOLIDAYS_TABLE, $sql_holidays );
		}


		/**
		 * @return DAILYATTENDANCE_Hooks
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}
	}
}

DAILYATTENDANCE_Hooks::instance();