<?php
/**
 * Class Rest API
 */

if ( ! class_exists( 'DAILYATTENDANCE_Rest_api' ) ) {
	/**
	 * Class DAILYATTENDANCE_Rest_api
	 */
	class DAILYATTENDANCE_Rest_api {

		protected static $_instance = null;


		/**
		 * DAILYATTENDANCE_Rest_api constructor.
		 */
		function __construct() {

			add_action( 'rest_api_init', array( $this, 'register_api' ) );
		}


		/**
		 * Register API endpoints
		 *
		 * @return void
		 */
		function register_api() {

			register_rest_route( 'v2/daily-attendance/', 'details', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'attendance_details' ),
			) );

			register_rest_route( 'v2/daily-attendance/', 'submit', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'attendance_submit' ),
			) );
		}


		/**
		 * Handle attendance submit API request
		 *
		 * @param WP_REST_Request $request
		 *
		 * @return WP_Error|WP_HTTP_Response|WP_REST_Response
		 */
		function attendance_submit( WP_REST_Request $request ) {

			if ( is_wp_error( $response = $this->validate_api_request( $request ) ) ) {
				return $this->throw_error( $response );
			}

			$parameters_str = json_decode( $request->get_body(), true );
			$secret_key     = $parameters_str['secret_key'] ?? '';
			$status         = $parameters_str['status'] ?? '';
			$ip_address     = $parameters_str['ip_address'] ?? '';
			$message        = $parameters_str['message'] ?? '';

			if ( empty( $secret_key ) || empty( $status ) ) {
				return $this->rest_response( [ 'message' => esc_html__( 'Empty secret key or status.', 'daily-attendance' ) ], false );
			}

			if ( ! $user_id = dailyattendance_get_user_id_by_secret_key( $secret_key ) ) {
				return $this->rest_response( [ 'message' => esc_html__( 'Invalid secret key.', 'daily-attendance' ) ], false );
			}

			$insert_response         = dailyattendance_insert_activity_entry( $user_id, $status, $message, $ip_address );
			$insert_response_status  = isset( $insert_response['status'] ) && (bool) $insert_response['status'];
			$insert_response_message = $insert_response['message'] ?? '';

			if ( ! $insert_response_status ) {
				return $this->rest_response( [ 'message' => $insert_response_message ], false );
			}

			return $this->rest_response( [ 'message' => $insert_response_message ] );
		}


		/**
		 * Handle attendance details API request
		 *
		 * @param WP_REST_Request $request
		 *
		 * @return WP_Error|WP_HTTP_Response|WP_REST_Response
		 */
		function attendance_details( WP_REST_Request $request ) {

//			if ( is_wp_error( $response = $this->validate_api_request( $request ) ) ) {
//				return $this->throw_error( $response );
//			};

			$parameters_str = json_decode( $request->get_body(), true );

			if ( ! isset( $parameters_str['secret_key'] ) || empty( $secret_key = $parameters_str['secret_key'] ) ) {
				return $this->rest_response( [ 'message' => esc_html__( 'Empty secret key.', 'daily-attendance' ) ], false );
			}

			if ( ! $user_id = dailyattendance_get_user_id_by_secret_key( $secret_key ) ) {
				return $this->rest_response( [ 'message' => esc_html__( 'Invalid secret key.', 'daily-attendance' ) ], false );
			}

			$wp_user  = get_user_by( 'ID', $user_id );
			$response = array(
				'name'       => $wp_user->display_name,
				'thumb'      => get_avatar_url( $wp_user->ID ),
				'roles'      => dailyattendance_get_user_roles_formatted( $wp_user->roles ),
				'added_on'   => date( 'jS M Y, g:ia', strtotime( $wp_user->user_registered ) ),
				'today'      => date( 'jS M Y - D' ),
				'activities' => array(
					array(
						'datetime'     => date( 'g:i A' ),
						'message'      => 'No message',
						'status_label' => 'Office In'
					),
					array(
						'datetime'     => date( 'g:i A' ),
						'message'      => 'Out for lunch',
						'status_label' => 'Office Out'
					),
					array(
						'datetime'     => date( 'g:i A' ),
						'message'      => 'After lunch',
						'status_label' => 'Office In'
					),
				),
			);

			return $this->rest_response( $response );
		}


		/**
		 * Valid api request and if invalid api key then stop executing.
		 *
		 * @param WP_REST_Request $request
		 * @param string $option
		 *
		 * @return WP_Error|bool
		 */
		public function validate_api_request( WP_REST_Request $request, $option = '' ) {

			$bearer_token  = sanitize_text_field( $request->get_header( 'authorization' ) );
			$bearer_token  = trim( str_replace( 'Bearer ', '', $bearer_token ) );
			$signature_key = dailyattendance()->get_signature_key();

			if ( empty( $bearer_token ) ) {
				return new WP_Error( 401, esc_html__( 'Empty bearer token.', 'daily-attendance' ) );
			}

			if ( ! hash_equals( $bearer_token, $signature_key ) ) {
				return new WP_Error( 403, esc_html__( 'Invalid bearer token.', 'daily-attendance' ) );
			}

			return true;
		}


		/**
		 * Return REST response
		 *
		 * @param $response
		 * @param $is_success
		 *
		 * @return WP_Error|WP_HTTP_Response|WP_REST_Response
		 */
		private function rest_response( $response = array(), $is_success = true ) {

			$response['success'] = $is_success;

			return rest_ensure_response( new WP_REST_Response( $response ) );
		}


		/**
		 * Returns error data with WP_REST_Response.
		 *
		 * @param WP_Error $error
		 *
		 * @return WP_REST_Response|WP_Error|WP_HTTP_Response
		 */
		public function throw_error( $error ) {
			$response = new WP_REST_Response( [
				'success' => false,
				'message' => $error->get_error_message(),
			] );
			$response->set_status( $error->get_error_code() );

			return rest_ensure_response( $response );
		}


		/**
		 * @return DAILYATTENDANCE_Rest_api
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}
	}
}

DAILYATTENDANCE_Rest_api::instance();

