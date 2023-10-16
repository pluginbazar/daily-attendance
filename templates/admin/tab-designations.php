<?php
/**
 * Designations
 */

?>

<div class="grid grid-cols-1 2xl:grid-cols-2 xl:gap-4 my-4">
    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">
        <h3 class="text-xl leading-none font-bold text-gray-900 mb-8">Designations</h3>
        <div class="block w-full overflow-x-auto">
            <table class="hidden items-center w-full bg-transparent border-collapse">
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


            <table id="dailyattendance-users" class="w-full stripe" style="width:100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Roles</th>
                    <th>Secret Key</th>
                    <th>Joined</th>
                </tr>
                </thead>
                <tbody>
				<?php foreach ( dailyattendance()->get_users() as $user_info ) : ?>
                    <tr>
                        <td><?= $user_info['name'] ?? '' ?></td>
                        <td><?= $user_info['email'] ?? '' ?></td>
                        <td><?= $user_info['roles'] ?? '' ?></td>
                        <td>
                            <span id="user-secret-key" aria-label="Copy Code" class="hint--top hint--rounded bg-gray-100 border border-gray-300 px-2 py-2 rounded-md text-gray-700 cursor-pointer w-[280px] block text-center">
                                <span><?= $user_info['secret_key'] ?? '' ?></span>
                            </span>
                        </td>
                        <td><?= $user_info['added_on'] ?? '' ?></td>
                    </tr>
				<?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
