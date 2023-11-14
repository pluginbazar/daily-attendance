<?php
/**
 * Class Functions
 *
 * @author Pluginbazar
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'DAILYATTENDANCE_Functions' ) ) {
	/**
	 * Class DAILYATTENDANCE_Functions
	 */
	class DAILYATTENDANCE_Functions {

		/**
		 * @return string[]
		 */
		function get_all_user_roles() {
			global $wp_roles;

			if ( ! isset( $wp_roles ) ) {
				$wp_roles = new WP_Roles();
			}

			return $wp_roles->get_names();
		}

		/**
		 * Return signature key
		 *
		 * @return string
		 */
		function get_signature_key() {

			$signature_key = $this->get_option( 'signature_key' );

			if ( empty( $signature_key ) ) {
				$signature_key = hash( 'sha512', site_url() . current_time( 'U' ) );
				update_option( 'signature_key', $signature_key );
			}

			return $signature_key;
		}

		/**
		 * @return array
		 * @throws Exception
		 */
		function get_holidays() {
			global $wpdb;

			$all_holidays       = $wpdb->get_results( 'SELECT * FROM ' . DAILYATTENDANCE_HOLIDAYS_TABLE, ARRAY_A );
			$all_leave_requests = [];

			foreach ( $all_holidays as $data ) {
				$all_leave_requests[] = array(
					'id'          => $data['id'] ?? '',
					'title'       => $data['title'] ?? '',
					'description' => $data['description'] ?? '',
					'status'      => $data['status'] ?? '',
					'dates'       => $this->formatted_date( $data['date_from'], $data['date_to'] ),
					'datetime'    => $data['datetime'] ?? '',
					'action'      => sprintf('<button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold mr-2 py-2 px-4 border border-gray-400 rounded shadow" data-user-id="%s">%s</button><button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" data-user-id="%s">%s</button>',
						$data['id'],esc_html__('Edit','daily-attendance'),$data['id'],esc_html__('Delete','daily-attendance')),
				);
			}

			return $all_leave_requests;
		}

		/**
		 * @param $start_date
		 * @param $end_date
		 *
		 * @return string
		 * @throws Exception
		 */
		function formatted_date( $start_date, $end_date ) {
			$begin     = new DateTime( $start_date );
			$end       = new DateTime( $end_date );
			$end       = $end->modify( '+1 day' );
			$interval  = new DateInterval( 'P1D' );
			$dateRange = new DatePeriod( $begin, $interval, $end );

			$dates = [];
			foreach ( $dateRange as $date ) {
				$dates[] = $date->format( 'jS M Y' );
			}

			return implode( ',', $dates );
		}

		function get_leave_request() {
			global $wpdb;

			$all_leave_requests_res = $wpdb->get_results( 'SELECT * FROM ' . DAILYATTENDANCE_LEAVE_REQUEST_TABLE, ARRAY_A );
			$all_leave_requests     = [];

			foreach ( $all_leave_requests_res as $data ) {
				$all_leave_requests[] = array(
					'user_id'     => $data['user_id'] ?? '',
					'title'       => $data['title'] ?? '',
					'description' => $data['description'] ?? '',
					'status'      => $data['status'] ?? '',
					'dates'       => $this->formatted_date( $data['date_from'], $data['date_to'] ),
					'datetime'    => $data['datetime'] ?? '',
					'action'      => sprintf('<button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold mr-2 py-2 px-4 border border-gray-400 rounded shadow" data-user-id="%s">%s</button><button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" data-user-id="%s">%s</button>',
						$data['id'],esc_html__('Edit','daily-attendance'),$data['id'],esc_html__('Delete','daily-attendance')),
				);
			}

			return $all_leave_requests;
		}

		/**
		 * @return array|object|stdClass[]|null
		 */
		function get_designations() {
			global $wpdb;

			$designations = $wpdb->get_results( 'SELECT * FROM ' . DAILYATTENDANCE_DESIGNATIONS_TABLE, ARRAY_A );

			$all_designations = [];
			foreach ( $designations as $data ) {
				$all_designations[] = array(
					'id'                 => $data['id'],
					'designation_name'   => $data['designation_name'],
					'designation_status' => $data['designation_status'],
					'action'             => sprintf('<button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold mr-2 py-2 px-4 border border-gray-400 rounded shadow" data-user-id="%s">%s</button><button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" data-user-id="%s">%s</button>',
											$data['id'],esc_html__('Edit','daily-attendance'),$data['id'],esc_html__('Delete','daily-attendance')),
				);
			}

			return $all_designations;
		}


		/**
		 * Return users as array
		 *
		 * @param $args
		 *
		 * @return array
		 */
		function get_users( $args = array() ) {

			$all_users = array();

			foreach ( get_users( $args ) as $wp_user ) {

				if ( ! $wp_user instanceof WP_User ) {
					continue;
				}

//				delete_user_meta( $wp_user->ID, 'secret_key' );

				$user_secret_key = get_user_meta( $wp_user->ID, 'secret_key', true );
				$designation     = get_user_meta( $wp_user->ID, 'designation', true );
				$user_secret_key = empty( $user_secret_key ) ? hash( 'md5', $wp_user->user_email . current_time( 'U' ) ) : $user_secret_key;
				$all_users[]     = array(
					'id'          => $wp_user->ID,
					'name'        => sprintf( '<a class="font-medium underline focus:outline-none focus:shadow-none focus:ring-0" href="%s" target="_blank">#%s - %s</a>', admin_url( 'user-edit.php?user_id=' . $wp_user->ID ), $wp_user->ID, $wp_user->display_name ),
					'email'       => $wp_user->user_email,
					'roles'       => dailyattendance_get_user_roles_formatted( $wp_user->roles ),
					'designation' => $designation,
					'secret_key'  => $user_secret_key,
					'added_on'    => date( 'jS M Y, g:ia', strtotime( $wp_user->user_registered ) ),
					'action'      => sprintf( '<button id="update-user" type="button" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold mr-2 py-2 px-4 border border-gray-400 rounded shadow" data-user-id="%s">%s</button>', $wp_user->ID, esc_html__( 'Edit', 'daily-attendance' ) ),
				);

				update_user_meta( $wp_user->ID, 'secret_key', $user_secret_key );
			}

			return $all_users;
		}


		function get_panel_menu_items() {
			return array(
				'dashboard'    => array(
					'label'    => esc_html__( 'Dashboard', 'daily-attendance' ),
					'icon'     => '<svg class="w-6 h-6 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                	<path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                               </svg>',
					'template' => DAILYATTENDANCE_PLUGIN_DIR . 'templates/admin/tab-dashboard.php',
				),
				'users'        => array(
					'label'    => esc_html__( 'Users', 'daily-attendance' ),
					'icon'     => '<svg class="w-6 h-6 text-gray-500 flex-shrink-0 group-hover:text-gray-900 transition duration-75" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                           		</svg>',
					'template' => DAILYATTENDANCE_PLUGIN_DIR . 'templates/admin/tab-users.php',
				),
				'designations' => array(
					'label'    => esc_html__( 'Designations', 'daily-attendance' ),
					'icon'     => '<svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                      <path d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z"/>
                                </svg>',
					'template' => DAILYATTENDANCE_PLUGIN_DIR . 'templates/admin/tab-designations.php',
				),

				'leave_request' => array(
					'label'    => esc_html__( 'Leave Request', 'daily-attendance' ),
					'icon'     => '<svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h11m0 0-4-4m4 4-4 4m-5 3H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h3"/>
                                 </svg>',
					'template' => DAILYATTENDANCE_PLUGIN_DIR . 'templates/admin/tab-leave_request.php',
				),
				'holidays'      => array(
					'label'    => esc_html__( 'Holidays', 'daily-attendance' ),
					'icon'     => '<svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1v3m5-3v3m5-3v3M1 7h18M5 11h10M2 3h16a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z"/>
                                </svg>',
					'template' => DAILYATTENDANCE_PLUGIN_DIR . 'templates/admin/tab-holidays.php',
				),
				'settings'      => array(
					'label'    => esc_html__( 'Settings', 'daily-attendance' ),
					'icon'     => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
	                                <path stroke-linecap="round" stroke-linejoin="round"
	                                      d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z"/>
	                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
	                            </svg>',
					'template' => DAILYATTENDANCE_PLUGIN_DIR . 'templates/admin/tab-settings.php',
				),
			);
		}


		/**
		 * Return Post Meta Value
		 *
		 * @param bool $meta_key
		 * @param bool $post_id
		 * @param string $default
		 * @param bool $single
		 *
		 * @return mixed|string|void
		 */
		function get_meta( $meta_key = false, $post_id = false, $default = '', $single = true ) {

			if ( ! $meta_key ) {
				return '';
			}

			$post_id    = ! $post_id ? get_the_ID() : $post_id;
			$meta_value = get_post_meta( $post_id, $meta_key, $single );
			$meta_value = empty( $meta_value ) ? $default : $meta_value;

			return apply_filters( 'DAILYATTENDANCE/FILTERS/get_meta', $meta_value, $meta_key, $post_id, $default );
		}


		/**
		 * Return option value
		 *
		 * @param string $option_key
		 * @param string $default_val
		 *
		 * @return mixed|string|void
		 */
		function get_option( $option_key = '', $default_val = '' ) {

			if ( empty( $option_key ) ) {
				return '';
			}

			$option_val = get_option( $option_key, $default_val );
			$option_val = empty( $option_val ) ? $default_val : $option_val;

			return apply_filters( 'DAILYATTENDANCE/FILTERS/get_option', $option_val, $option_key, $default_val );
		}
	}
}

global $dailyattendance;

$dailyattendance = new DAILYATTENDANCE_Functions();