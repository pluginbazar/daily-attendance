<?php
/**
 * Main
 */

$users_list = dailyattendance()->get_users();
$users_list = array_map( function ( $user_data ) {

	$user_data['secret_key'] = sprintf( '<span id="user-secret-key" aria-label="Copy Code" class="hint--top hint--rounded bg-gray-100 border border-gray-300 px-2 py-2 rounded-md text-gray-700 cursor-pointer w-[280px] block text-center"><span>%s</span></span>', esc_html__($user_data['secret_key'],'daily-attendance') );

	return $user_data;
}, $users_list );
$table_data = array(
	'headers' => array(
		'id'         => esc_html__( 'ID', 'daily-attendance' ),
		'name'       => esc_html__( 'Name', 'daily-attendance' ),
		'email'      => esc_html__( 'Email Address', 'daily-attendance' ),
		'roles'      => esc_html__( 'Roles', 'daily-attendance' ),
		'secret_key' => esc_html__( 'Secret Key', 'daily-attendance' ),
		'added_on'   => esc_html__( 'Joined', 'daily-attendance' ),
	),
	'body'    => $users_list,
);


?>

<div class="grid grid-cols-1 xl:gap-4 my-4">
    <div class="dailyattendance-table-users-wrap bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">
		<?php dailyattendance_render_data_table( 'dailyattendance-table-users', 'Staffs', $table_data ); ?>
    </div>
</div>


<div class="modal add-staff-form hidden relative z-[99999] " id="modal-website-form" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="modal-bg-overlay"></div>
    <div class="modal-box-wrap">
        <div class="modal-box">
            <div class="modal-content w-full max-w-md max-h-full rounded">
                <p class="text-2xl font-bold text-left"><?php echo esc_html__('Add Staff','daily-attendance'); ?></p>
                <form class="modal-content-wrap modal-form website-add-form" method="post">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left">
                        <p class="response notice hidden"></p>
                        <div class="mt-4 space-y-6 space-y-6 bg-white">
                            <div class="form-control">
                                <label for="user_name"><?php echo esc_html__('User Name *','daily-attendance'); ?></label>
                                <div class="field-wrap mt-2">
                                    <input type="text" name="user_name" id="user_name" placeholder="User name" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-control">
                                <label for="full_name"><?php echo esc_html__('Full Name *','daily-attendance'); ?></label>
                                <div class="field-wrap mt-2">
                                    <input type="text" class="block w-full rounded-md" name="full_name" id="full_name" placeholder="Full name" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-control">
                                <label for="email"><?php echo esc_html__('Email *','daily-attendance'); ?></label>
                                <div class="field-wrap mt-2">
                                    <input type="text" name="email" id="email" placeholder="name@gmail.com" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-control">
                                <label for="password"><?php echo esc_html__('Password *','daily-attendance'); ?></label>
                                <div class="field-wrap mt-2">
                                    <input type="text" name="password" id="password" placeholder="c54a#be@c43$9%901c6*98" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer mt-3">
                        <button type="submit" name="submission" class="ml-2 button submit-form" value="yes"><?php echo esc_html__('Submit','daily-attendance'); ?></button>
                        <span class="close-popup pt-2 text-red-600 cursor-pointer mr-3 text-sm"><?php echo esc_html__('Cancel','daily-attendance'); ?></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
