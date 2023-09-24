<?php
/**
 * Class Hooks
 */

if ( ! class_exists( 'DAILYATTENDANCE_Hooks' ) ) {

	/**
	 * Class DAILYATTENDANCE_Hooks
	 */
	class DAILYATTENDANCE_Hooks {

		/**
		 * DAILYATTENDANCE_Hooks constructor.
		 */
		function __construct() {

			add_action( 'init', array( $this, 'ob_start' ) );
			add_action( 'wp_footer', array( $this, 'ob_end' ) );
			add_action( 'init', array( $this, 'register_post_types' ) );
			add_action( 'init', array( $this, 'generate_monthly_report' ) );
			add_action( 'admin_menu', array( $this, 'remove_publish_box' ) );
			add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
			add_action( 'rest_api_init', array( $this, 'register_api' ) );
		}


		function serve_attendances_submit() {

			$user_name    = isset( $_POST['userName'] ) ? sanitize_text_field( $_POST['userName'] ) : '';
			$password     = isset( $_POST['passWord'] ) ? sanitize_text_field( $_POST['passWord'] ) : '';
			$current_user = wp_authenticate( $user_name, $password );

			if ( is_wp_error( $current_user ) ) {
				return new WP_REST_Response( array(
					'version' => 'V1',
					'success' => false,
					'content' => $current_user->get_error_message(),
				) );
			}

			if ( ! $current_user instanceof WP_User ) {
				return new WP_REST_Response( array(
					'version' => 'V1',
					'success' => false,
					'content' => esc_html__( 'Invalid username or password!', 'daily-attendance' ),
				) );
			}

			$response = pbda_insert_attendance( $current_user->ID );

			if ( is_wp_error( $response ) ) {
				return new WP_REST_Response( array(
					'version' => 'V1',
					'success' => false,
					'content' => $response->get_error_message(),
				) );
			}

			return new WP_REST_Response( array(
				'version' => 'V1',
				'success' => true,
				'content' => $response,
			) );
		}


		function register_api() {

			register_rest_route( 'v1', '/attendances/submit', array(
				'methods'  => 'POST',
				'callback' => array( $this, 'serve_attendances_submit' ),
			) );
		}


		/**
		 * Display attendance form
		 *
		 * @return false|string
		 */
		function display_attendance_form() {

			if ( ! is_user_logged_in() ) {
				return sprintf( '<p class="pbda-notice pbda-error">%s <a href="%s">%s</a></p>',
					esc_html__( 'You must login to access this content', 'daily-attendance' ),
					wp_login_url( get_permalink() ),
					esc_html__( 'Click here to Login', 'daily-attendance' )
				);
			}

			ob_start();

			include DAILYATTENDANCE_PLUGIN_DIR . 'templates/attendance-form.php';

			return ob_get_clean();
		}


		/**
		 * Display Reports
		 *
		 * @param $post
		 */
		public function display_reports( $post ) {

			$this_month = (int) date( 'm' );
			$this_year  = (int) date( 'Y' );
			$num_days   = cal_days_in_month( CAL_GREGORIAN, $this_month, $this_year );
			$export_url = '';

			?>
            <div class="pbda-reports-wrap">

                <div class="pbda-report-info">

                    <div class="pbda-info">
                        <span class="label"><?php esc_html_e( 'Report Month', 'daily-attendance' ); ?></span>
                        <span class="value"><?php echo date( 'F, Y' ); ?></span>
                    </div>

                    <div class="pbda-info">
                        <span class="label"><?php esc_html_e( 'Users Count', 'daily-attendance' ); ?></span>
                        <span class="value"><?php echo count( pbda()->get_users_list() ); ?></span>
                    </div>

                    <div class="pbda-info">
                        <span class="label"><?php esc_html_e( 'Export', 'daily-attendance' ); ?></span>
                        <span class="value"><a
                                    href="<?php echo esc_url( $export_url ); ?>"><?php esc_html_e( 'CSV (Upcoming Feature)', 'daily-attendance' ); ?></a></span>
                    </div>

                </div>

				<?php echo pbda_get_attendance_report( $num_days, $post->ID ); ?>
            </div>
			<?php
		}


		/**
		 * Add meta boxes
		 *
		 * @param $post_type
		 */
		public function add_meta_boxes( $post_type ) {

			if ( in_array( $post_type, array( 'da_reports' ) ) ) {

				add_meta_box( 'da_reports', esc_html__( 'Attendance Reports', 'daily-attendance' ), array(
					$this,
					'display_reports'
				), $post_type, 'normal', 'high' );
			}
		}


		/**
		 * Remove publish box for specific post type
		 */
		function remove_publish_box() {
			remove_meta_box( 'submitdiv', 'da_reports', 'side' );
		}


		/**
		 * Generate Monthly Report
		 */
		function generate_monthly_report() {

			$current_report_id = pbda_current_report_id();

			if ( empty( $current_report_id ) || ! $current_report_id ) {
				wp_insert_post( array(
					'post_type'   => 'da_reports',
					'post_title'  => sprintf( esc_html__( 'Report - %s', 'daily-attendance' ), date( 'M, Y' ) ),
					'post_status' => 'publish',
					'meta_input'  => array(
						'_month' => date( 'Ym' )
					)
				) );
			}
		}


		/**
		 * Register Post Types
		 */
		function register_post_types() {

			pbda()->PB_Settings()->register_post_type( 'da_reports', array(
				'singular'      => esc_html__( 'Daily Attendance', 'daily-attendance' ),
				'plural'        => esc_html__( 'Attendance Reports', 'daily-attendance' ),
				'menu_icon'     => 'dashicons-yes',
				'menu_position' => 20,
				'supports'      => array( '' ),
				'capabilities'  => array( 'create_posts' => 'do_not_allow' ),
				'labels'        => array(
					'edit_item' => esc_html__( 'View Attendance Reports', 'daily-attendance' ),
				),
			) );
		}


		/**
		 * Return Buffered Content
		 *
		 * @param $buffer
		 *
		 * @return mixed
		 */
		public function ob_callback( $buffer ) {
			return $buffer;
		}


		/**
		 * Start of Output Buffer
		 */
		public function ob_start() {
			ob_start( array( $this, 'ob_callback' ) );
		}


		/**
		 * End of Output Buffer
		 */
		public function ob_end() {
			if ( ob_get_length() ) {
				ob_end_flush();
			}
		}
	}

	new DAILYATTENDANCE_Hooks();
}