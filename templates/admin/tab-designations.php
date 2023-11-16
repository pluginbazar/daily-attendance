<?php
/**
 * Designations Data Table
 */

?>

<div class="grid grid-cols-1 xl:gap-4 my-4">
    <div class="dailyattendance-designations-wrap bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8"></div>
</div>

<div class="modal hidden relative z-[99999]" id="modal-add-designations" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="modal-bg-overlay"></div>
    <div class="modal-box-wrap">
        <div class="modal-box">
            <div class="modal-content w-full max-w-md max-h-full rounded">
                <p class="text-2xl font-bold text-left"><?php echo esc_html__( 'Add Designation', 'daily-attendance' ); ?></p>
                <form class="modal-content-wrap modal-form" method="post">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left">
                        <p class="response notice hidden"></p>
                        <div class="mt-4 space-y-6 space-y-6 bg-white">
                            <div class="form-control">
                                <label for="designation"><?php echo esc_html__( 'Designation', 'daily-attendance' ); ?></label>
                                <div class="field-wrap mt-2">
                                    <input type="text" name="designation" id="designation" placeholder="Designation" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="submit" name="submission" class="ml-2 button submit-form" value="yes"><?php echo esc_html__( 'Submit', 'daily-attendance' ); ?></button>
                        <span id="btn-close-modal" data-target="modal-add-users" class="pt-2 text-red-600 cursor-pointer mr-3 text-sm"><?php echo esc_html__( 'Cancel', 'daily-attendance' ); ?></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal hidden relative z-[99999]" id="modal-edit-designation" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="modal-bg-overlay"></div>
    <div class="modal-box-wrap">
        <div class="modal-box">
            <div class="modal-content w-full max-w-md max-h-full rounded">
                <p class="text-2xl font-bold text-left"><?php echo esc_html__( 'Edit Designation', 'daily-attendance' ); ?></p>
                <form class="modal-content-wrap modal-form" method="post">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left">
                        <p class="response notice hidden"></p>
                        <div class="mt-4 space-y-6 space-y-6 bg-white">
                            <div class="form-control">
                                <label for="designation"><?php echo esc_html__( 'Designation', 'daily-attendance' ); ?></label>
                                <div class="field-wrap mt-2">
                                    <input type="text" name="designation" id="designation" placeholder="Designation" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="submit" name="submission" class="ml-2 button submit-form" value="yes"><?php echo esc_html__( 'Update', 'daily-attendance' ); ?></button>
                        <span id="btn-close-modal" data-target="modal-edit-designation" class="pt-2 text-red-600 cursor-pointer mr-3 text-sm"><?php echo esc_html__( 'Cancel', 'daily-attendance' ); ?></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

