<!-- Main Content -->
<div class="bg-gray-100 ">
    <!-- Dashboard Grid Content -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Upcoming Bookings -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">My Upcoming Bookings</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Customer</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Service</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date & Time</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4 text-sm font-medium text-gray-900">John Doe</td>
                            <td class="px-4 py-4 text-sm text-gray-600">Website Audit</td>
                            <td class="px-4 py-4 text-sm text-gray-600">
                                2025-07-14<br>
                                <span class="text-xs text-gray-500">10:00 AM</span>
                            </td>
                            <td class="px-4 py-4">
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Scheduled</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4 text-sm font-medium text-gray-900">Jane Smith</td>
                            <td class="px-4 py-4 text-sm text-gray-600">Network Support</td>
                            <td class="px-4 py-4 text-sm text-gray-600">
                                2025-07-15<br>
                                <span class="text-xs text-gray-500">2:00 PM</span>
                            </td>
                            <td class="px-4 py-4">
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4 text-sm font-medium text-gray-900">Client Name</td>
                            <td class="px-4 py-4 text-sm text-gray-600">Service</td>
                            <td class="px-4 py-4 text-sm text-gray-600">
                                Date<br>
                                <span class="text-xs text-gray-500">Time</span>
                            </td>
                            <td class="px-4 py-4">
                                <span
                                    class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Dashboard Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Stat Card 1 -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 hover:shadow transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Upcoming Bookings</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">248</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-calendar-days text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Stat Card 2 -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 hover:shadow transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Unresolved Enquiries</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">35</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-exclamation-circle text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Stat Card 3 -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 hover:shadow transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Active Services</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">187</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-tools text-white text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Enquiries -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden lg:col-span-2">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Recent Enquiries</h2>
            </div>
            <div class="p-6 space-y-4">
                <!-- Enquiry Item -->
                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 cursor-pointer transition-colors">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="font-medium text-gray-900">John Doe</h3>
                        <span class="text-xs text-gray-500">10 mins ago</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-2">Need help with installation</p>
                    <p class="text-sm text-gray-500 truncate">
                        Hello, I’m having trouble installing the software. Can someone assist me?
                    </p>
                    <div class="mt-3 flex space-x-2">
                        <button
                            class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded hover:bg-blue-200 transition-colors">Reply</button>
                        <button
                            class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded hover:bg-gray-200 transition-colors">Mark
                            as Read</button>
                    </div>
                </div>

                <!-- Enquiry Item -->
                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 cursor-pointer transition-colors">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="font-medium text-gray-900">Mary Smith</h3>
                        <span class="text-xs text-gray-500">30 mins ago</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-2">Billing issue</p>
                    <p class="text-sm text-gray-500 truncate">
                        I was billed twice this month. Please check and refund the extra charge.
                    </p>
                    <div class="mt-3 flex space-x-2">
                        <button
                            class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded hover:bg-blue-200 transition-colors">Reply</button>
                        <button
                            class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded hover:bg-gray-200 transition-colors">Mark
                            as Read</button>
                    </div>
                </div>

                <!-- Enquiry Item -->
                <div class="border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="font-medium text-gray-900">Client Name</h3>
                        <span class="text-xs text-gray-500">Time sent</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-2">Service</p>
                    <p class="text-sm text-gray-500 truncate">
                        Message
                    </p>
                    <div class="mt-3 flex space-x-2">
                        <button
                            class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded hover:bg-blue-200 transition-colors">Reply</button>
                        <button
                            class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded hover:bg-gray-200 transition-colors">Mark
                            as Read</button>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- End Grid -->
</div> <!-- End Main Content -->