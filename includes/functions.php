<?php
/**
 * All Functions
 *
 * @author Pluginbazar
 */

defined( 'ABSPATH' ) || exit;


if ( ! function_exists( 'dailyattendance' ) ) {
	/**
	 * Return global $dailyattendance
	 *
	 * @return DAILYATTENDANCE_Functions
	 */
	function dailyattendance() {
		global $dailyattendance;

		if ( empty( $dailyattendance ) ) {
			$dailyattendance = new DAILYATTENDANCE_Functions();
		}

		return $dailyattendance;
	}
}


if ( ! function_exists( 'dailyattendance_get_user_id_by_secret_key' ) ) {
	/**
	 * Search users by secret key and return user id.
	 *
	 * @param $secret_key
	 *
	 * @return false|WP_User
	 */
	function dailyattendance_get_user_id_by_secret_key( $secret_key = '' ) {

		$user_id_to_find = false;
		$users           = get_users(
			array(
				'number'     => 1,
				'fields'     => 'ids',
				'meta_query' => array(
					array(
						'key'     => 'secret_key',
						'value'   => $secret_key,
						'compare' => '='
					),
				)
			)
		);

		foreach ( $users as $wp_user_id ) {
			$user_id_to_find = $wp_user_id;
		}

		return $user_id_to_find;
	}
}


if ( ! function_exists( 'dailyattendance_insert_activity_entry' ) ) {
	/**
	 * insert entry on activity table
	 *
	 * @param $user_id
	 * @param $status
	 * @param $message
	 * @param $ip_address
	 *
	 * @return array
	 */
	function dailyattendance_insert_activity_entry( $user_id = 0, $status = 'undefined', $message = '', $ip_address = '' ) {

		if ( ! in_array( $status, [ 'in', 'out', 'undefined' ] ) ) {
			return array( 'status' => false, 'message' => esc_html__( 'Invalid status: ' . $status . '.', 'daily-attendance' ) );
		}

		if ( ! $wp_user = get_user_by( 'id', $user_id ) ) {
			return array( 'status' => false, 'message' => esc_html__( 'Invalid user.', 'daily-attendance' ) );
		}

		global $wpdb;

		// get last entry for this user in the same day
		$this_date_start = current_time( 'Y-m-d' ) . ' 00:00:01';
		$this_date_end   = current_time( 'mysql' );
		$last_entries    = $wpdb->get_results( "SELECT * FROM " . DAILYATTENDANCE_DB_TABLE . " WHERE user_id = '{$user_id}' AND datetime BETWEEN '{$this_date_start}' AND '{$this_date_end}' ORDER BY datetime DESC LIMIT 1", ARRAY_A );

		if ( ! empty( $last_entries ) ) {
			$last_entry          = $last_entries[0] ?? array();
			$last_entry_status   = $last_entry['status'] ?? '';
			$last_entry_datetime = $last_entry['datetime'] ?? '';

			if ( $status === $last_entry_status ) {
				return array( 'status' => false, 'message' => esc_html__( "Duplicate entry type. Your last entry with status:{$last_entry_status} at {$last_entry_datetime}.", 'daily-attendance' ) );
			}
		}

		// insert new entry
		$inserted = $wpdb->insert( DAILYATTENDANCE_DB_TABLE,
			array(
				'user_id'    => $wp_user->ID,
				'status'     => $status,
				'message'    => $message,
				'ip_address' => $ip_address,
				'datetime'   => current_time( 'mysql' ),
			)
		);

		if ( ! $inserted ) {
			return array( 'status' => false, 'message' => esc_html__( 'Database insertion failed.', 'daily-attendance' ) );
		}

		return array( 'status' => true, 'message' => esc_html__( 'Database insertion successful.', 'daily-attendance' ) );
	}
}


if ( ! function_exists( 'dailyattendance_get_user_roles_formatted' ) ) {
	/**
	 * Return formatted users roles
	 *
	 * @param $this_user_roles
	 * @param $glue
	 *
	 * @return mixed|null
	 */
	function dailyattendance_get_user_roles_formatted( $this_user_roles = [], $glue = ', ' ) {

		$user_roles = array_map( function ( $role_string ) {
			$wp_role = get_role( $role_string );

			return ucwords( $wp_role->name );
		}, $this_user_roles );
		$user_roles = implode( $glue, $user_roles );

		return apply_filters( 'DAILYATTENDANCE/FILTERS/get_user_roles_formatted', $user_roles, $this_user_roles, $glue );
	}
}
