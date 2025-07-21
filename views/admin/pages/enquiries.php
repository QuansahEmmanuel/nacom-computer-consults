<!-- Enquiries Content -->
<div id="enquiries-content" class="page-content">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Customer Enquiries</h3>
            <div class="flex space-x-2">
                <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-check mr-2"></i>Mark All Read
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-50">
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">ID</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">CUSTOMER</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">SUBJECT</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">EMAIL</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">DATE</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">STATUS</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">ASSIGN TO</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-4 text-sm text-gray-700">1001</td>
                        <td class="py-3 px-4 text-sm text-gray-700">John Doe</td>
                        <td class="py-3 px-4 text-sm text-gray-700">Product Inquiry</td>
                        <td class="py-3 px-4 text-sm text-gray-700">john@example.com</td>
                        <td class="py-3 px-4 text-sm text-gray-700">2025-04-01</td>
                        <td class="py-3 px-4 text-sm">
                            <select class="w-full rounded border-gray-300 text-sm">
                                <option>Unread</option>
                                <option>In Progress</option>
                                <option>Resolved</option>
                            </select>
                        </td>
                        <td class="py-3 px-4 text-sm">
                            <select class="w-full rounded border-gray-300 text-sm">
                                <option>Select Agent</option>
                                <option>Jane Smith</option>
                                <option>Mark Lee</option>
                                <option>Support Team</option>
                            </select>
                        </td>
                        <td class="py-3 px-4 text-sm space-y-1">
                            <button class="text-blue-600 hover:underline block w-full text-left"
                                onclick="openViewModal()">View</button>
                            <button class="text-red-600 hover:underline block w-full text-left"
                                onclick="openDeleteModal()">Delete</button>
                        </td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- View Enquiry Modal -->
<dialog id="view_enquiry_modal" class="modal">
    <div class="modal-box w-11/12 max-w-3xl">
        <h3 class="text-lg font-bold mb-4">View Enquiry #1001</h3>
        <div class="space-y-4 text-sm">
            <div>
                <label class="block text-gray-600 text-xs uppercase">Customer</label>
                <p class="font-medium">John Doe</p>
            </div>
            <div>
                <label class="block text-gray-600 text-xs uppercase">Email</label>
                <p>john@example.com</p>
            </div>
            <div>
                <label class="block text-gray-600 text-xs uppercase">Subject</label>
                <p class="font-medium">Product Inquiry</p>
            </div>
            <div>
                <label class="block text-gray-600 text-xs uppercase">Message</label>
                <p class="p-2 bg-gray-100 rounded">
                    Hi, I'm interested in your product. Can you provide more details about pricing and delivery?
                </p>
            </div>
            <div class="flex justify-between">
                <select class="border rounded px-2 py-1 text-sm">
                    <option>Status: Unread</option>
                    <option>Status: In Progress</option>
                    <option>Status: Resolved</option>
                </select>
                <select class="border rounded px-2 py-1 text-sm">
                    <option>Assign to: None</option>
                    <option>Assign to: Jane Smith</option>
                    <option>Assign to: Mark Lee</option>
                </select>
            </div>
        </div>
        <div class="modal-action mt-6">
            <button type="button" class="btn btn-error btn-sm" onclick="openDeleteModal()">Delete</button>
            <button class="btn btn-sm" onclick="closeViewModal()">Close</button>
        </div>
    </div>
</dialog>

<!-- Delete Confirmation Modal -->
<dialog id="delete_enquiry_modal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Delete Enquiry</h3>
        <p class="py-4">Are you sure you want to delete this enquiry? This action cannot be undone.</p>
        <div class="modal-action">
            <button class="btn btn-error" onclick="closeDeleteModal()">Delete</button>
            <button class="btn" onclick="closeDeleteModal()">Cancel</button>
        </div>
    </div>
</dialog>

<script>
function openViewModal() {
    document.getElementById("view_enquiry_modal").showModal();
}

function closeViewModal() {
    document.getElementById("view_enquiry_modal").close();
}

function openDeleteModal() {
    document.getElementById("delete_enquiry_modal").showModal();
}

function closeDeleteModal() {
    document.getElementById("delete_enquiry_modal").close();
}
</script>