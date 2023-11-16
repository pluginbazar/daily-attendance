<?php
/**
 * Users Data Table
 */

?>

<div class="grid grid-cols-1 xl:gap-4 my-4">
    <div class="dailyattendance-users-wrap bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8"></div>
</div>

<div class="modal hidden relative z-[99999]" id="modal-add-user" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="modal-bg-overlay"></div>
    <div class="modal-box-wrap">
        <div class="modal-box">
            <div class="modal-content w-full max-w-md max-h-full rounded">
                <p class="text-2xl font-bold text-left"><?php echo esc_html__( 'Add New Staff', 'daily-attendance' ); ?></p>
                <form class="modal-content-wrap modal-form" method="post">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left">
                        <p class="response notice hidden"></p>
                        <div class="mt-4 space-y-6 space-y-6 bg-white">
                            <div class="form-control">
                                <label for="user_name"><?php echo esc_html__( 'User Name *', 'daily-attendance' ); ?></label>
                                <div class="field-wrap mt-2">
                                    <input type="text" name="user_name" id="user_name" placeholder="User name" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-control">
                                <label for="full_name"><?php echo esc_html__( 'Full Name *', 'daily-attendance' ); ?></label>
                                <div class="field-wrap mt-2">
                                    <input type="text" class="block w-full rounded-md" name="full_name" id="full_name" placeholder="Full name" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-control">
                                <label for="email"><?php echo esc_html__( 'Email *', 'daily-attendance' ); ?></label>
                                <div class="field-wrap mt-2">
                                    <input type="email" name="email" id="email" placeholder="name@gmail.com" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-control">
                                <label for="designation"><?php echo esc_html__( 'Designation', 'daily-attendance' ); ?></label>
                                <div class="field-wrap mt-2">
                                    <select name="designation" id="designation">
                                        <option value=""><?php echo esc_html__( 'Choose...', 'daily-attendance' ); ?></option>
										<?php $all_designations = dailyattendance()->get_designations();
                                        if ( is_array( $all_designations ) ):
											foreach ( $all_designations as $designation ):
												if ( $designation['designation_status'] == 'pending' ):
													continue;
												endif; ?>
                                                <option value="<?php echo esc_attr( $designation['designation_name'] ); ?>"><?php echo esc_html__( $designation['designation_name'], 'daily-attendance' ); ?></option>
											<?php endforeach; ?>
										<?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-control">
                                <label for="password"><?php echo esc_html__( 'Password *', 'daily-attendance' ); ?></label>
                                <div class="field-wrap mt-2">
                                    <input type="text" name="password" id="password" placeholder="c54a#be@c43$9%901c6*98" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer mt-3">
                        <button type="submit" name="submission" class="ml-2 button submit-form" value="yes"><?php echo esc_html__( 'Submit', 'daily-attendance' ); ?></button>
                        <span id="btn-close-modal" data-target="modal-add-user" class="pt-2 text-red-600 cursor-pointer mr-3 text-sm"><?php echo esc_html__( 'Cancel', 'daily-attendance' ); ?></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modal Edit User Info-->
<div class="modal hidden relative z-[99999]" id="modal-edit-user" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="modal-bg-overlay"></div>
    <div class="modal-box-wrap">
        <div class="modal-box">
            <div class="modal-content w-full max-w-md max-h-full rounded">
                <p class="text-2xl font-bold text-left"><?php echo esc_html__( 'Edit Staff', 'daily-attendance' ); ?></p>
                <form class="modal-content-wrap modal-form" method="post">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left">
                        <p class="response notice hidden"></p>
                        <div class="mt-4 space-y-6 space-y-6 bg-white">
                            <div class="form-control">
                                <label for="full_name"><?php echo esc_html__( 'Full Name *', 'daily-attendance' ); ?></label>
                                <div class="field-wrap mt-2">
                                    <input type="text" name="full_name" id="full_name" placeholder="Full name" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-control">
                                <label for="designation"><?php echo esc_html__( 'Designation *', 'daily-attendance' ); ?></label>
                                <div class="field-wrap mt-2">
                                    <select name="designation" id="designation">
                                        <option value=""><?php echo esc_html__( 'Choose...', 'daily-attendance' ); ?></option>
										<?php $all_designations = dailyattendance()->get_designations();
										if ( is_array( $all_designations ) ):
											foreach ( $all_designations as $designation ): ?>
                                                <option value="<?php echo esc_attr( $designation['designation_name'] ); ?>"><?php echo esc_html__( $designation['designation_name'], 'daily-attendance' ); ?></option>
											<?php endforeach; ?>
										<?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-control">
                                <label for="role"><?php echo esc_html__( 'Role *', 'daily-attendance' ); ?></label>
                                <div class="field-wrap mt-2">
                                    <select name="role" id="role">
                                        <option value=""><?php echo esc_html__('Choose..','daily-attendance'); ?></option>
										<?php  $roles = dailyattendance()->get_all_user_roles();
										foreach ($roles as $role): ?>
                                            <option value="<?php echo strtolower($role); ?>"><?php echo esc_html__($role,'daily-attendance'); ?></option>
										<?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-control">
                                <label for="password"><?php echo esc_html__( 'Password *', 'daily-attendance' ); ?></label>
                                <div class="field-wrap mt-2">
                                    <input type="text" name="password" id="password" placeholder="c54a#be@c43$9%901c6*98" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer mt-3">
                        <button type="submit" name="submission" class="ml-2 button submit-form" value="yes"><?php echo esc_html__( 'Update', 'daily-attendance' ); ?></button>
                        <span id="btn-close-modal" data-target="modal-edit-user" class="pt-2 text-red-600 cursor-pointer mr-3 text-sm"><?php echo esc_html__( 'Cancel', 'daily-attendance' ); ?></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

