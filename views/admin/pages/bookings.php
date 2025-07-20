<!-- Booking & Enquiry Oversight -->
<div class="page-content">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Bookings Oversight</h3>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-plus mr-2"></i>New Booking
            </button>
        </div>

        <!-- Filters -->
        <div class="bg-base-100 shadow-lg rounded-lg p-4 mb-6">
            <div class="flex flex-wrap gap-4 items-center">
                <div class="form-control">
                    <input type="text" placeholder="Search by customer..." class="input input-bordered"
                        id="searchBookingInput" />
                </div>

                <div class="form-control">
                    <select class="select select-bordered" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="Confirmed">Confirmed</option>
                        <option value="Pending">Pending</option>
                    </select>
                </div>

                <div class="form-control">
                    <select class="select select-bordered" id="agentFilter">
                        <option value="">All Agents</option>
                        <option value="Agent A">Agent A</option>
                        <option value="Agent B">Agent B</option>
                        <option value="Unassigned">Unassigned</option>
                    </select>
                </div>

                <button class="btn btn-outline" onclick="clearBookingFilters()">Clear Filters</button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">ID</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Customer</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Service/Subject</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Date</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Status</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Assigned Agent</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Resolution</th>
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-100">
                        <td class="py-3 px-4 text-sm text-gray-800">#001</td>
                        <td class="py-3 px-4 text-sm text-gray-800">John Doe</td>
                        <td class="py-3 px-4 text-sm text-gray-600">IT Support</td>
                        <td class="py-3 px-4 text-sm text-gray-600">2024-01-15</td>
                        <td class="py-3 px-4">
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Confirmed</span>
                        </td>
                        <td class="py-3 px-4 text-sm text-gray-800">Agent A</td>
                        <td class="py-3 px-4">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">In Progress</span>
                        </td>
                        <td class="py-3 px-4">
                            <button class="text-blue-600 hover:text-blue-800 mr-2" title="Edit Assign Agent"><i
                                    class="fas fa-edit"></i></button>
                            <button class="text-green-600 hover:text-green-800 mr-2" title="Assign Agent"
                                onclick="openAssignModal('#001')">
                                <i class="fas fa-user-check"></i>
                            </button>

                            <button class="text-red-600 hover:text-red-800" title="Delete"><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Assign Agent Modal -->
<dialog id="assign_agent_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">Assign Support Agent</h3>

        <form id="assignAgentForm">
            <div class="form-control mb-4">
                <label class="label"><span class="label-text">Select Agent</span></label>
                <select class="select select-bordered w-full" id="agentSelect" required>
                    <option disabled selected>Select agent</option>
                    <option value="Agent A">Agent A</option>
                    <option value="Agent B">Agent B</option>
                    <option value="Agent C">Agent C</option>
                </select>
            </div>
            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Assign</button>
                <button type="button" class="btn" onclick="assignAgentModal.close()">Cancel</button>
            </div>
        </form>
    </div>
</dialog>



<script>
const assignAgentModal = document.getElementById("assign_agent_modal");
let selectedBookingId = null;

function openAssignModal(bookingId) {
    selectedBookingId = bookingId;
    assignAgentModal.showModal();
}
</script>