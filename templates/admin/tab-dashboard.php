<?php
/**
 * Tab - Dashboard
 */

?>

<!--
<form class="relative overflow-hidden bg-white shadow-xl w-[380px] mx-auto mt-20 border border-gray-300 rounded-lg">

     <div aria-hidden="true" class="absolute inset-0 top-8 grid grid-cols-2 -space-x-52 opacity-30">-->
    <!--        <div class="h-8 bg-gradient-to-br from-primary to-purple-400 blur-[106px]"></div>-->
    <!--        <div class="h-6 bg-gradient-to-r from-cyan-400 to-sky-300 blur-[106px]"></div>-->
    <!--    </div>

    <div class="border-b border-gray-300 w-full flex items-center justify-between p-6">
        <div class="overflow-hidden">
            <div class="flex items-center abi">
                <h3 class="text-gray-700 font-medium text-sm overflow-hidden">Cody Fisher</h3>
                <span class="py-1/2 px-2 bg-green-50 ring-1 ring-green-300 text-green-700 inline-flex items-center ml-2 rounded-full">Admin</span>
            </div>
            <p class="text-sm text-gray-400 mt-2">Product Directives Officer</p>
        </div>
        <img class="rounded-full w-12 h-12" src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">
    </div>


    <div class="flex-1 p-6 border-b border-gray-300">
        <div class="flex items-center justify-between mb-6">
            <span class="text-sm text-gray-700 font-bold">Activity log</span>
            <span class="font-normal">27 Sep, 2023 - Wednesday</span>
        </div>

        <div class="relative px-4 h-[140px] overflow-y-scroll">
            <div class="absolute h-full border border-dashed border-opacity-20 border-secondary"></div>

            <div class="flex w-full mb-6 -ml-1.5 last:mb-0">
                <div class="w-1/12 z-10">
                    <div class="w-3.5 h-3.5 bg-blue-600 rounded-full"></div>
                </div>
                <div class="w-11/12 mt-[-4px]">
                    <p class="text-sm">10:15am - Office In</p>
                    <p class="text-xs text-gray-500">Starting my day</p>
                </div>
            </div>

            <div class="flex w-full mb-6 -ml-1.5 last:mb-0">
                <div class="w-1/12 z-10">
                    <div class="w-3.5 h-3.5 bg-blue-600 rounded-full"></div>
                </div>
                <div class="w-11/12 mt-[-4px]">
                    <p class="text-sm">10:15am - Office In</p>
                    <p class="text-xs text-gray-500">Starting my day</p>
                </div>
            </div>

            <div class="flex w-full mb-6 -ml-1.5 last:mb-0">
                <div class="w-1/12 z-10">
                    <div class="w-3.5 h-3.5 bg-blue-600 rounded-full"></div>
                </div>
                <div class="w-11/12 mt-[-4px]">
                    <p class="text-sm">10:15am - Office In</p>
                    <p class="text-xs text-gray-500">Starting my day</p>
                </div>
            </div>

            <div class="flex w-full mb-6 -ml-1.5 last:mb-0">
                <div class="w-1/12 z-10">
                    <div class="w-3.5 h-3.5 bg-blue-600 rounded-full"></div>
                </div>
                <div class="w-11/12 mt-[-4px]">
                    <p class="text-sm">10:15am - Office In</p>
                    <p class="text-xs text-gray-500">Starting my day</p>
                </div>
            </div>

            <div class="flex w-full mb-6 -ml-1.5 last:mb-0">
                <div class="w-1/12 z-10">
                    <div class="w-3.5 h-3.5 bg-blue-600 rounded-full"></div>
                </div>
                <div class="w-11/12 mt-[-4px]">
                    <p class="text-sm">10:15am - Office In</p>
                    <p class="text-xs text-gray-500">Starting my day</p>
                </div>
            </div>
        </div>
    </div>


    <div class="p-0 max-w-sm">
        <div class="p-4 flex flex-col gap-4">
            <div>
                <label class="label mb-2 inline-block" for="toolkit">Message (Optional)</label>
                <input id="toolkit" type="text" class="input ~critical !normal my-1" placeholder="Coffee break...">
            </div>
        </div>
    </div>

    <div class="border-t border-gray-300 w-full">
        <div class="flex mt-[-1px]">
            <div class="flex items-center justify-center flex-grow flex-shrink flex-basis-0">
                <div href="mailto:jennywilson@example.com" class="opacity-30 cursor-pointer flex items-center py-4 text-teal-500 uppercase font-medium text-sm gap-3 justify-center relative border-r border-gray-300 flex-grow flex-shrink flex-basis-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                    </svg>
                    <span>Office In</span>
                </div>
            </div>
            <div class="flex items-center justify-center flex-grow flex-shrink flex-basis-0">
                <div href="mailto:jennywilson@example.com" class="cursor-pointer flex items-center py-4 text-red-500 uppercase font-medium text-sm gap-3 justify-center relative ml-[-1px] rounded-br-lg flex-grow flex-shrink flex-basis-0">
                    <span>Office Out</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

</form>
-->

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 my-4">
    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">2,340</span>
                <h3 class="text-base font-normal text-gray-500">New products this week</h3>
            </div>
            <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                14.6%
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
    </div>
    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">5,355</span>
                <h3 class="text-base font-normal text-gray-500">Visitors this week</h3>
            </div>
            <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                32.9%
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
    </div>
    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">385</span>
                <h3 class="text-base font-normal text-gray-500">User signups this week</h3>
            </div>
            <div class="ml-5 w-0 flex items-center justify-end flex-1 text-red-500 text-base font-bold">
                -2.7%
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 2xl:grid-cols-2 xl:gap-4 my-4">
    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
        <h3 class="text-xl leading-none font-bold text-gray-900 mb-10">Performance</h3>
        <div class="block w-full overflow-x-auto">
            <table class="items-center w-full bg-transparent border-collapse">
                <thead>
                <tr>
                    <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Top Channels</th>
                    <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Users</th>
                    <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap min-w-140-px"></th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                <tr class="text-gray-500">
                    <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Organic Search</th>
                    <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">5,649</td>
                    <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">30%</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-cyan-600 h-2 rounded-sm" style="width: 30%"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="text-gray-500">
                    <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Referral</th>
                    <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">4,025</td>
                    <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">24%</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-orange-300 h-2 rounded-sm" style="width: 24%"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="text-gray-500">
                    <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Direct</th>
                    <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">3,105</td>
                    <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">18%</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-teal-400 h-2 rounded-sm" style="width: 18%"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="text-gray-500">
                    <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Social</th>
                    <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">1251</td>
                    <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">12%</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-pink-600 h-2 rounded-sm" style="width: 12%"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="text-gray-500">
                    <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">Other</th>
                    <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">734</td>
                    <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">9%</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-indigo-600 h-2 rounded-sm" style="width: 9%"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="text-gray-500">
                    <th class="border-t-0 align-middle text-sm font-normal whitespace-nowrap p-4 pb-0 text-left">Email</th>
                    <td class="border-t-0 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4 pb-0">456</td>
                    <td class="border-t-0 align-middle text-xs whitespace-nowrap p-4 pb-0">
                        <div class="flex items-center">
                            <span class="mr-2 text-xs font-medium">7%</span>
                            <div class="relative w-full">
                                <div class="w-full bg-gray-200 rounded-sm h-2">
                                    <div class="bg-purple-500 h-2 rounded-sm" style="width: 7%"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
// include DAILYATTENDANCE_PLUGIN_DIR . 'templates/components/modal.php';

    ?>


<div class="modal hidden relative z-[99999]" id="modal-website-form" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="modal-bg-overlay"></div>
    <div class="modal-box-wrap">
        <div class="modal-box">
            <form class="modal-content-wrap website-add-form" method="post">
                <div class="modal-content">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left">
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Add Website</h3>
                        <p class="notice">Website must be in WordPress CMS. To learn more about this please <a href="#" target="_blank">watch this tutorial</a> now.</p>
                        <p class="response notice hidden"></p>
                        <div class="mt-4 space-y-6 space-y-6 bg-white">
                            <div class="form-control">
                                <label for="website_label">Website Label</label>
                                <div class="field-wrap">
                                    <input type="text" name="website_label" id="website_label" placeholder="My Personal Website" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-control">
                                <label for="website_url">Website URL</label>
                                <div class="field-wrap">
                                    <span class="input-prefix">https://</span>
                                    <input type="text" name="website_url" class="!rounded-none !rounded-r-md" autocomplete="off" id="website_url" placeholder="example.com">
                                </div>
                            </div>

                            <div class="form-control">
                                <label for="secret_key">Secret Key</label>
                                <div class="field-wrap">
                                    <input type="text" name="secret_key" id="secret_key" placeholder="c54abec4bd992901c698541fd303852e" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="ml-2"><span class="button">Submit</span></button>
                    <button type="button" class="cancel"><span class="button outlined">Cancel</span></button>
                </div>
            </form>
        </div>
    </div>
</div>
