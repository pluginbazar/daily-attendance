<?php
/**
 * Class Ajax
 */

if ( ! class_exists( 'DAILYATTENDANCE_Ajax' ) ) {
	class DAILYATTENDANCE_Ajax {

		protected static $_instance = null;

		/**
		 * DAILYATTENDANCE_Ajax constructor.
		 */
		function __construct() {
			add_action( 'wp_ajax_create_user', array( $this, 'create_user' ) );
			add_action( 'wp_ajax_load_users_table', array( $this, 'load_users_table' ) );
			add_action( 'wp_ajax_add_designations', array( $this, 'add_designations' ) );
			add_action( 'wp_ajax_load_designations_table', array( $this, 'load_designations_table' ) );
			add_action( 'wp_ajax_load_leave_request_table', array( $this, 'load_leave_request_table' ) );
		}

		function load_leave_request_table() {
			$leave_request = dailyattendance()->get_leave_request();
			$table_data    = array(
				'headers' => array(
					'user_id'     => esc_html__( 'User ID', 'daily-attendance' ),
					'title'       => esc_html__( 'Title', 'daily-attendance' ),
					'description' => esc_html__( 'Description', 'daily-attendance' ),
					'status'      => esc_html__( 'Status', 'daily-attendance' ),
					'dates'       => esc_html__( 'Dates', 'daily-attendance' ),
					'datetime'    => esc_html__( 'Submitted', 'daily-attendance' ),
				),
				'body'    => $leave_request,
			);

			ob_start();
			dailyattendance_render_data_table( 'dailyattendance-leave-request', 'Leave Request', $table_data );
			$table_content = ob_get_clean();

			wp_send_json_success( $table_content );

		}

		/**
		 * @return void
		 */
		function load_designations_table() {
			$designations = dailyattendance()->get_designations();
			$table_data   = array(
				'headers' => array(
					'id'                 => esc_html__( 'ID', 'daily-attendance' ),
					'designation_name'   => esc_html__( 'Designation Name', 'daily-attendance' ),
					'designation_status' => esc_html__( 'Status', 'daily-attendance' ),
				),
				'body'    => $designations,
			);

			ob_start();
			dailyattendance_render_data_table( 'dailyattendance-designations', 'Designation', $table_data );
			$table_content = ob_get_clean();

			wp_send_json_success( $table_content );
		}

		/**
		 * @return void
		 */
		function add_designations() {

			global $wpdb;

			$_form_data = $_POST['designation'] ?? '';
			parse_str( $_form_data, $form_data );

			$designation = $form_data['designation'] ?? '';

			if ( empty( $designation ) ) {
				wp_send_json_error( [ 'message' => esc_html__( 'Missing required data.', 'daily-attendance' ) ] );
			}

			$insert = $wpdb->insert( DAILYATTENDANCE_DESIGNATIONS_TABLE, array(
				'designation_name'   => $designation,
				'designation_status' => 'active',
			) );

			if ( ! $insert ) {
				wp_send_json_error( [ 'message' => $wpdb->last_error ] );
			}

			wp_send_json_success( $insert );
		}

		/**
		 * @return void
		 */
		function load_users_table() {
			$users_list = dailyattendance()->get_users();
			$users_list = array_map( function ( $user_data ) {

				$user_data['secret_key'] = sprintf( '<span id="user-secret-key" aria-label="Copy Code" class="hint--top hint--rounded bg-gray-100 border border-gray-300 px-2 py-2 rounded-md text-gray-700 cursor-pointer w-[280px] block text-center"><span>%s</span></span>', esc_html__( $user_data['secret_key'], 'daily-attendance' ) );

				return $user_data;
			}, $users_list );
			$table_data = array(
				'headers' => array(
					'id'          => esc_html__( 'ID', 'daily-attendance' ),
					'name'        => esc_html__( 'Name', 'daily-attendance' ),
					'email'       => esc_html__( 'Email Address', 'daily-attendance' ),
					'roles'       => esc_html__( 'Roles', 'daily-attendance' ),
					'designation' => esc_html__( 'Designation', 'daily-attendance' ),
					'secret_key'  => esc_html__( 'Secret Key', 'daily-attendance' ),
					'added_on'    => esc_html__( 'Joined', 'daily-attendance' ),
				),
				'body'    => $users_list,
			);

			ob_start();
			dailyattendance_render_data_table( 'dailyattendance-users', 'Staffs', $table_data );
			$table_content = ob_get_clean();

			wp_send_json_success( $table_content );
		}

		/**
		 * @return void
		 */
		function create_user() {

			$_form_data = $_POST['form_data'] ?? '';
			parse_str( $_form_data, $form_data );

			$user_name     = $form_data['user_name'] ?? '';
			$full_name     = $form_data['full_name'] ?? '';
			$email         = $form_data['email'] ?? '';
			$designation   = $form_data['designation'] ?? '';
			$password      = $form_data['password'] ?? '';
			$full_name_arr = explode( ' ', trim( $full_name ) );
			$lastname      = $full_name_arr[ count( $full_name_arr ) - 1 ] ?? '';
			$firstname     = str_replace( $lastname, '', $full_name );

			if ( empty( $user_name ) || empty( $email ) || empty( $firstname ) || empty( $lastname ) || empty( $designation ) || empty( $password ) ) {
				wp_send_json_error( [ 'message' => esc_html__( 'Missing required data.', 'daily-attendance' ) ] );
			}

			if ( username_exists( $user_name ) ) {
				wp_send_json_error( [ 'message' => esc_html__( 'Username already exists.', 'daily-attendance' ) ] );
			}

			if ( email_exists( $email ) ) {
				wp_send_json_error( [ 'message' => esc_html__( 'Email address already exists.', 'daily-attendance' ) ] );
			}

			$user_id = wp_create_user( $user_name, $password, $email );

			if ( is_wp_error( $user_id ) ) {
				wp_send_json_error( [ 'message' => $user_id->get_error_message() ] );
			}

			$update_user = wp_update_user(
				array(
					'ID'         => $user_id,
					'first_name' => $firstname,
					'last_name'  => $lastname,
				)
			);

			update_user_meta( $user_id, 'designation', $designation );

			if ( is_wp_error( $update_user ) ) {
				wp_send_json_error( [ 'message' => $update_user->get_error_message() ] );
			}

			wp_send_json_success( $user_id );
		}


		/**
		 * @return DAILYATTENDANCE_Ajax
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}
	}
}

DAILYATTENDANCE_Ajax::instance();