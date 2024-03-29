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
			add_action( 'wp_ajax_edit_user', array( $this, 'edit_user' ) );

			add_action( 'wp_ajax_add_designations', array( $this, 'add_designations' ) );
			add_action( 'wp_ajax_load_designations_table', array( $this, 'load_designations_table' ) );
			add_action( 'wp_ajax_edit_designation', array( $this, 'edit_designation' ) );
			add_action( 'wp_ajax_delete_designation', array( $this, 'delete_designation' ) );

			add_action( 'wp_ajax_leave_request', array( $this, 'leave_request' ) );
			add_action( 'wp_ajax_load_leave_request_table', array( $this, 'load_leave_request_table' ) );
			add_action( 'wp_ajax_delete_request', array( $this, 'delete_request' ) );
			add_action( 'wp_ajax_approve_request', array( $this, 'approve_request' ) );


			add_action( 'wp_ajax_add_holidays', array( $this, 'add_holidays' ) );
			add_action( 'wp_ajax_load_holidays_table', array( $this, 'load_holidays_table' ) );
			add_action( 'wp_ajax_delete_holiday', array( $this, 'delete_holiday' ) );
		}

		function delete_holiday() {
			global $wpdb;
			$user_id = $_POST['user_id'] ?? '';

			$delete = $wpdb->delete( DAILYATTENDANCE_HOLIDAYS_TABLE, [ 'ID' => $user_id ] );
			if ( $delete ) {
				wp_send_json_success( $delete );
			}
		}

		function load_holidays_table() {
			$holidays   = dailyattendance()->get_holidays();
			$table_data = array(
				'headers' => array(
					'id'          => esc_html__( 'ID', 'daily-attendance' ),
					'title'       => esc_html__( 'Title', 'daily-attendance' ),
					'description' => esc_html__( 'Description', 'daily-attendance' ),
					'status'      => esc_html__( 'Status', 'daily-attendance' ),
					'dates'       => esc_html__( 'Dates', 'daily-attendance' ),
					'datetime'    => esc_html__( 'Submitted', 'daily-attendance' ),
					'action'      => esc_html__( 'Action', 'daily-attendance' ),
				),
				'body'    => $holidays,
			);

			ob_start();
			dailyattendance_render_data_table( 'dailyattendance-holidays', 'Holidays', $table_data );
			$table_content = ob_get_clean();

			wp_send_json_success( $table_content );
		}

		function add_holidays() {
			global $wpdb;

			$_form_data = $_POST['form_data'] ?? '';
			parse_str( $_form_data, $form_data );

			$title       = $form_data['title'] ?? '';
			$description = $form_data['description'] ?? '';
			$date_from   = $form_data['start_date'] ?? '';
			$date_to     = $form_data['end_date'] ?? '';
			$status      = $form_data['status'] ?? '';

			if ( empty( $title ) || empty( $description ) || empty( $date_from ) || empty( $date_to ) || empty( $status ) ) {
				wp_send_json_error( [ 'message' => esc_html__( 'Missing required data.', 'daily-attendance' ) ] );
			}

			$insert = $wpdb->insert( DAILYATTENDANCE_HOLIDAYS_TABLE, array(
				'title'       => $title,
				'description' => $description,
				'status'      => ucfirst( $status ),
				'date_from'   => $date_from,
				'date_to'     => $date_to,
				'datetime'    => current_time( 'mysql' )
			) );

			if ( ! $insert ) {
				wp_send_json_error( [ 'message' => $wpdb->last_error ] );
			}

			wp_send_json_success( $insert );

		}

		function approve_request() {
			global $wpdb;
			$user_id = $_POST['user_id'] ?? '';

			$update = $wpdb->update( DAILYATTENDANCE_LEAVE_REQUEST_TABLE, [ 'status' => 'approved' ], [ 'ID' => $user_id ] );
			if ( $update ) {
				wp_send_json_success( $update );
			}
		}

		function delete_request() {
			global $wpdb;
			$user_id = $_POST['user_id'] ?? '';

			$delete = $wpdb->delete( DAILYATTENDANCE_LEAVE_REQUEST_TABLE, [ 'ID' => $user_id ] );
			if ( $delete ) {
				wp_send_json_success( $delete );
			}
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
					'action'      => esc_html__( 'Action', 'daily-attendance' ),
				),
				'body'    => $leave_request,
			);

			ob_start();
			dailyattendance_render_data_table( 'dailyattendance-leave-request', 'Leave Request', $table_data );
			$table_content = ob_get_clean();

			wp_send_json_success( $table_content );
		}

		function leave_request() {
			global $wpdb;

			$_form_data = $_POST['form_data'] ?? '';
			parse_str( $_form_data, $form_data );

			$title       = $form_data['title'] ?? '';
			$description = $form_data['description'] ?? '';
			$date_from   = $form_data['date_from'] ?? '';
			$date_to     = $form_data['date_to'] ?? '';

			if ( empty( $title ) || empty( $description ) || empty( $date_from ) || empty( $date_to ) ) {
				wp_send_json_error( [ 'message' => esc_html__( 'Missing required data.', 'daily-attendance' ) ] );
			}

			$insert = $wpdb->insert( DAILYATTENDANCE_LEAVE_REQUEST_TABLE, array(
				'user_id'     => get_current_user_id(),
				'title'       => $title,
				'description' => $description,
				'status'      => 'pending',
				'date_from'   => $date_from,
				'date_to'     => $date_to,
				'datetime'    => current_time( 'mysql' )
			) );

			if ( ! $insert ) {
				wp_send_json_error( [ 'message' => $wpdb->last_error ] );
			}
			wp_send_json_success( $insert );
		}

		function delete_designation() {
			global $wpdb;
			$user_id = $_POST['user_id'] ?? '';

			$delete = $wpdb->delete( DAILYATTENDANCE_DESIGNATIONS_TABLE, [ 'ID' => $user_id ] );

			if ( $delete ) {
				wp_send_json_success( $delete );
			}
		}

		function edit_designation() {
			global $wpdb;
			$user_id    = $_POST['user_id'] ?? '';
			$_form_data = $_POST['designation'] ?? '';
			parse_str( $_form_data, $form_data );

			$designation = $form_data['designation'];
			if ( empty( $designation ) ) {
				wp_send_json_error( [ 'message' => esc_html__( 'Missing required data.', 'daily-attendance' ) ] );
			}
			$update = $wpdb->update(
				DAILYATTENDANCE_DESIGNATIONS_TABLE, [ 'designation_name' => $designation ], [ 'ID' => $user_id ],
			);

			if ( $update ) {
				wp_send_json_success( $update );
			}
		}

		function load_designations_table() {
			$designations = dailyattendance()->get_designations();
			$table_data   = array(
				'headers' => array(
					'id'                 => esc_html__( 'ID', 'daily-attendance' ),
					'designation_name'   => esc_html__( 'Designation Name', 'daily-attendance' ),
					'designation_status' => esc_html__( 'Status', 'daily-attendance' ),
					'action'             => esc_html__( 'Action', 'daily-attendance' ),
				),
				'body'    => $designations,
			);

			ob_start();
			dailyattendance_render_data_table( 'dailyattendance-designations', 'Designations', $table_data );
			$table_content = ob_get_clean();

			wp_send_json_success( $table_content );
		}

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

		function edit_user() {
			$user_id = $_POST['user_id'] ?? '';

			$_form_data = $_POST['user_data'] ?? '';
			parse_str( $_form_data, $form_data );

			$full_name   = $form_data['full_name'] ?? '';
			$designation = $form_data['designation'] ?? '';
			$role        = $form_data['role'] ?? '';
			$password    = $form_data['password'] ?? '';

			$data = [];

			if ( ! empty( $full_name ) ) {
				$data['display_name'] = esc_html__( $full_name, 'daily-attendance' );
			}
			if ( ! empty( $designation ) ) {
				$data['designation'] = esc_html__( $designation, 'daily-attendance' );
			}
			if ( ! empty( $full_name ) ) {
				$data['role'] = esc_html__( $role, 'daily-attendance' );
			}
			if ( ! empty( $full_name ) ) {
				$data['user_pass'] = esc_html__( $password, 'daily-attendance' );
			}

			if ( ! empty( $data ) ) {
				$data['ID'] = $user_id;
			}

			$user_data = wp_update_user( $data );

			if ( is_wp_error( $user_data ) ) {
				wp_send_json_error( [ 'message' => esc_html__( 'User updated unsuccessfully!', 'daily-attendance' ) ] );
			} else {
				wp_send_json_success( [ 'message' => esc_html__( 'User updated successfully!', 'daily-attendance' ) ] );
			}
		}

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
					'action'      => esc_html__( 'Action', 'daily-attendance' ),
				),
				'body'    => $users_list,
			);

			ob_start();
			dailyattendance_render_data_table( 'dailyattendance-users', 'Staffs', $table_data );
			$table_content = ob_get_clean();

			wp_send_json_success( $table_content );
		}

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