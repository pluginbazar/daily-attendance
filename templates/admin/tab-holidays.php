<?php

/**
 * Holidays Data Table
 */


?>

<div class="grid grid-cols-1 xl:gap-4 my-4">
    <div class="dailyattendance-holidays-wrap bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8"></div>
</div>

<div class="modal hidden relative z-[99999]" id="modal-add-holidays" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="modal-bg-overlay"></div>
    <div class="modal-box-wrap">
        <div class="modal-box">
            <div class="modal-content w-full max-w-md max-h-full rounded">
                <p class="text-2xl font-bold text-left"><?php echo esc_html__( 'Add Holiday', 'daily-attendance' ); ?></p>
                <form class="modal-content-wrap modal-form" method="post">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left">
                        <p class="response notice hidden"></p>
                        <div class="mt-4 space-y-6 space-y-6 bg-white">
                            <div class="form-control">
                                <label for="title"><?php echo esc_html__( 'Title', 'daily-attendance' ); ?></label>
                                <div class="field-wrap mt-2">
                                    <input type="text" name="title" id="title" placeholder="Title" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-control">
                                <label for="description"><?php echo esc_html__( 'Description', 'daily-attendance' ); ?></label>
                                <div class="field-wrap mt-2">
                                    <input type="text" class="block w-full rounded-md" name="description" id="description" placeholder="Description" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-control">
                                <label for="start_date"><?php echo esc_html__( 'Date From', 'daily-attendance' ); ?></label>
                                <div class="field-wrap mt-2">
                                    <input type="text" name="start_date" class="datepicker" id="start_date" placeholder="2023-11-22">
                                </div>
                            </div>
                            <div class="form-control">
                                <label for="end_date"><?php echo esc_html__( 'Date To', 'daily-attendance' ); ?></label>
                                <div class="field-wrap mt-2">
                                    <input type="text" name="end_date" class="datepicker" id="end_date" placeholder="2023-11-22">
                                </div>
                            </div>
                            <div class="form-control">
                                <label for="status"><?php echo esc_html__( 'Status', 'daily-attendance' ); ?></label>
                                <div class="field-wrap mt-2">
                                    <select name="status" id="status">
                                        <option value=""><?php echo esc_html__( 'Choose....', 'daily-attendance' ); ?></option>
                                        <option value="active"><?php echo esc_html__( 'Active', 'daily-attendance' ); ?></option>
                                        <option value="inactive"><?php echo esc_html__( 'Inactive', 'daily-attendance' ); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer mt-3">
                        <button type="submit" name="submission" class="ml-2 button submit-form" value="yes"><?php echo esc_html__( 'Submit', 'daily-attendance' ); ?></button>
                        <span id="btn-close-modal" data-target="modal-add-leave-request" class="pt-2 text-red-600 cursor-pointer mr-3 text-sm"><?php echo esc_html__( 'Cancel', 'daily-attendance' ); ?></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
