<!-- All Customer Enquiries Section -->
<div id="enquirySection" class="page-content ">
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900">All Customer Enquiries</h2>
                <div class="flex space-x-2">
                    <button onclick="filterEnquiries('all')"
                        class="filter-btn px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded hover:bg-blue-200">All</button>
                    <button onclick="filterEnquiries('unread')"
                        class="filter-btn px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded hover:bg-gray-200">Unread</button>
                    <button onclick="filterEnquiries('resolved')"
                        class="filter-btn px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded hover:bg-gray-200">Resolved</button>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="space-y-6" id="enquiryList">
                <!-- Enquiry Item -->
                <div class="enquiry border border-gray-200 rounded-lg p-6" data-status="unread">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="font-semibold text-gray-900">John Doe</h3>
                            <p class="text-sm text-gray-600">johndoe@example.com</p>
                        </div>
                        <span class="text-sm text-gray-500">15 mins ago</span>
                    </div>
                    <div class="mb-4">
                        <h4 class="font-medium text-gray-900 mb-2">Subject: Need Help with Setup</h4>
                        <p class="text-gray-700">I'm having issues setting up the software. Can someone assist?</p>
                    </div>
                    <div class="flex space-x-3">
                        <button
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm">Reply</button>
                        <button
                            class="border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">Mark
                            as Resolved</button>
                    </div>
                </div>

                <!-- Example: Resolved Enquiry -->
                <div class="enquiry border border-gray-200 rounded-lg p-6" data-status="resolved">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="font-semibold text-gray-900">Mary Smith</h3>
                            <p class="text-sm text-gray-600">mary@example.com</p>
                        </div>
                        <span class="text-sm text-gray-500">30 mins ago</span>
                    </div>
                    <div class="mb-4">
                        <h4 class="font-medium text-gray-900 mb-2">Subject: Billing Issue</h4>
                        <p class="text-gray-700">I was double charged this month. Please review.</p>
                    </div>
                    <div class="flex space-x-3">
                        <button
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm">Reply</button>
                        <button
                            class="border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 text-sm">Mark
                            as Resolved</button>
                    </div>
                </div>

                <!-- More .enquiry items can be added here -->
            </div>
        </div>
    </div>
</div>