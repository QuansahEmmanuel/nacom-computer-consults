<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Customer Enquiries</h2>
            <div class="flex space-x-2">
                <button id="refresh_btn"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                    <i class="fas fa-refresh mr-2"></i>Refresh
                </button>
                <!-- Status filter options updated to match database enum -->
                <select id="status_filter" class="border border-gray-300 rounded-lg px-3 py-2">
                    <option value="">All Status</option>
                    <option value="unassigned">Unassigned</option>
                    <option value="assigned">Assigned</option>
                    <option value="resolved">Resolved</option>
                </select>
            </div>
        </div>
        <!-- Loading indicator -->
        <div id="loading" class="hidden flex justify-center items-center py-8">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
            <span class="ml-2 text-gray-600">Loading...</span>
        </div>
        <!-- Error message -->
        <div id="error_message" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <span id="error_text"></span>
        </div>
        <!-- Success message -->
        <div id="success_message"
            class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <span id="success_text"></span>
        </div>
        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Customer</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Subject</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Assigned To</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody id="enquiry_table_body" class="bg-white divide-y divide-gray-200">
                    <!-- Enquiries will load here -->
                </tbody>
            </table>
        </div>
        <!-- Empty state -->
        <div id="empty_state" class="hidden text-center py-12">
            <i class="fas fa-inbox text-4xl text-gray-400 mb-4"></i>
            <p class="text-gray-500 text-lg">No enquiries found</p>
        </div>
    </div>
</div>
<!-- View Modal -->
<div id="view_modal" class="fixed inset-0 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-90vh overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">Enquiry Details</h3>
                    <button id="close_view_modal" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Customer:</label>
                        <p id="modal_customer_name" class="mt-1 text-gray-900"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email:</label>
                        <p id="modal_customer_email" class="mt-1 text-gray-900"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Subject:</label>
                        <p id="modal_subject" class="mt-1 text-gray-900"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Message:</label>
                        <div id="modal_message"
                            class="mt-1 p-3 bg-gray-50 rounded-lg border text-gray-900 whitespace-pre-wrap"></div>
                        <!-- Use pre-wrap for message -->
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Assign to Support Agent:</label>
                        <div class="flex space-x-3">
                            <select id="modal_agent_dropdown"
                                class="flex-1 rounded-lg border-gray-300 text-sm p-2 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                <!-- Options will be populated here -->
                            </select>
                            <button id="assign_agent_btn"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors text-sm">
                                Assign
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Delete Confirmation Modal -->
<div id="delete_modal" class="fixed inset-0  bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <i class="fas fa-exclamation-triangle text-red-500 text-xl mr-3"></i>
                    <h3 class="text-lg font-bold text-gray-800">Confirm Delete</h3>
                </div>
                <p class="text-gray-600 mb-6">Are you sure you want to delete this enquiry? This action cannot be
                    undone.</p>
                <div class="flex justify-end space-x-3">
                    <button id="cancel_delete_btn"
                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg transition-colors">
                        Cancel
                    </button>
                    <button id="confirm_delete_btn"
                        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
                        <i class="fas fa-trash mr-2"></i>Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- View Replies Modal -->
<dialog id="viewRepliesModal" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box relative bg-white rounded-lg shadow-xl max-w-2xl w-full p-0">
        <!-- Header -->
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 rounded-t-lg">
            <h3 class="text-lg font-semibold text-gray-800">Replies to Enquiry</h3>
            <button onclick="closeViewRepliesModal()"
                class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300 rounded-full p-1"
                aria-label="Close modal">
                <span class="text-2xl font-light">&times;</span>
            </button>
        </div>

        <!-- Replies Content -->
        <div id="repliesContent" class="p-6 space-y-4 max-h-96 overflow-y-auto text-gray-700">
            <!-- Replies will be dynamically inserted here -->
        </div>

        <!-- Footer -->
        <div class="modal-action border-t border-gray-200 px-6 py-4 text-right bg-gray-50 rounded-b-lg">
            <button onclick="closeViewRepliesModal()" class="btn btn-neutral text-white hover:bg-gray-600">
                Close
            </button>
        </div>
    </div>
</dialog>

<script>
// Ensure Axios is loaded before this script runs
if (typeof axios === 'undefined') {
    throw new Error('Axios library is not loaded. Please include it before this script.');
}
const BASE_URL = "http://localhost/nacom-computer-consults/api/admin"; // Ensure this URL is correct

function getElementOrThrow(id) {
    const el = document.getElementById(id);
    if (!el) throw new Error(`Element with id "${id}" not found in DOM.`);
    return el;
}
const enquiryTableBody = getElementOrThrow("enquiry_table_body");
const deleteModal = getElementOrThrow("delete_modal");
const viewModal = getElementOrThrow("view_modal");
const loadingElement = getElementOrThrow("loading");
const errorMessage = getElementOrThrow("error_message");
const successMessage = getElementOrThrow("success_message");
const emptyState = getElementOrThrow("empty_state");
const statusFilter = getElementOrThrow("status_filter");
let supportAgents = [];
let allEnquiries = [];
let deleteId = null;
let currentEnquiryId = null; // Store current enquiry ID for assignment

// Utility functions
function showLoading(show = true) {
    loadingElement.classList.toggle("hidden", !show);
}

function showError(message) {
    document.getElementById("error_text").textContent = message;
    errorMessage.classList.remove("hidden");
    setTimeout(() => errorMessage.classList.add("hidden"), 7000);
}

function showSuccess(message) {
    document.getElementById("success_text").textContent = message;
    successMessage.classList.remove("hidden");
    setTimeout(() => successMessage.classList.add("hidden"), 3000);
}

function hideMessages() {
    errorMessage.classList.add("hidden");
    successMessage.classList.add("hidden");
}

// Fetch support agents
async function fetchSupportAgents() {
    // console.log("1. Starting fetchSupportAgents..."); // <-- ADD THIS
    try {
        hideMessages();
        const res = await axios.get(`${BASE_URL}/enquiries.php?agents=1`);
        // console.log("2. Raw response from /enquiries.php?agents=1:", res); // <-- ADD THIS
        if (res.data && res.data.status === "success") {
            // Check what the backend actually sent under 'data'
            // console.log("3a. Backend 'data' field:", res.data.data); // <-- ADD THIS
            // The frontend code expects res.data.agents, but the backend sends the list under res.data.data
            // Let's try res.data.data first, and fallback to res.data.agents if that's empty/undefined.
            supportAgents = res.data.data || res.data.agents || [];
            // console.log("4. Processed supportAgents array:", supportAgents); // <-- ADD THIS
        } else {
            const errorMsg = res.data?.message || "Failed to load support agents";
            // console.warn("API Response (Agents):", res.data);
            showError(errorMsg);
        }
    } catch (err) {
        // console.error("Agent fetch failed:", err);
        let userMessage = "Error loading support agents.";
        if (err.response) {
            userMessage += ` Server error: ${err.response.status}`;
            if (err.response.data?.message) {
                userMessage += ` - ${err.response.data.message}`;
            }
            // console.error("Detailed server error response:", err.response.data); // <-- ADD THIS
        } else if (err.request) {
            userMessage += " No response from server. Check connection and URL.";
            // console.error("No response received. Request details:", err.request); // <-- ADD THESE
        } else {
            userMessage += ` Request error: ${err.message}`;
        }
        showError(userMessage);
    }
}

// Populate modal assignment dropdown
function populateModalDropdown(selectedId = null) {
    // console.log("5. Starting populateModalDropdown with selectedId:", selectedId); // <-- ADD THIS
    // console.log("6. Current supportAgents array:", supportAgents); // <-- ADD THIS
    const dropdown = document.getElementById("modal_agent_dropdown");
    let options = '<option value="">Select Agent (None)</option>';
    supportAgents.forEach(agent => {
        const selected = agent.id == selectedId ? "selected" : "";
        options += `<option value="${escapeHtml(agent.id)}" ${selected}>${escapeHtml(agent.name)}</option>`;
    });
    dropdown.innerHTML = options;
    // console.log("7. Final HTML set in dropdown:", options); // <-- ADD THIS
}

// Get agent name by ID
function getAgentNameById(agentId) {
    if (!agentId) return 'Unassigned';
    const agent = supportAgents.find(a => a.id == agentId);
    return agent ? agent.name : 'Unknown Agent';
}

// Escape HTML to prevent XSS
function escapeHtml(text) {
    if (typeof text !== 'string') return String(text);
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Format datetime
function formatDateTime(datetime) {
    if (!datetime) return 'N/A';
    const date = new Date(datetime);
    if (isNaN(date)) return 'Invalid Date';
    return date.toLocaleString('en-US', {
        year: 'numeric',
        month: 'short',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Get status badge HTML
function getStatusBadge(status) {
    const statusConfig = {
        'unassigned': {
            class: 'bg-yellow-100 text-yellow-800',
            text: 'Unassigned'
        },
        'assigned': {
            class: 'bg-blue-100 text-blue-800',
            text: 'Assigned'
        },
        'resolved': {
            class: 'bg-green-100 text-green-800',
            text: 'Resolved'
        }
    };
    const config = statusConfig[status] || {
        class: 'bg-gray-100 text-gray-800',
        text: status || 'Unknown'
    };
    return `<span class="${config.class} px-2 py-1 rounded-full text-xs font-medium">${config.text}</span>`;
}

// Render single enquiry row
function renderEnquiry(item) {
    if (!item || typeof item !== 'object') {
        console.error("Invalid enquiry item:", item);
        return '';
    }

    const id = item.id || 'N/A';
    const customerName = escapeHtml(item.customer_name || 'N/A');
    const customerEmail = escapeHtml(item.customer_email || 'N/A');
    const subjectRaw = item.subject || 'No Subject';
    const subjectEscaped = escapeHtml(subjectRaw);
    const subjectDisplay = subjectRaw.length > 30 ? subjectRaw.substring(0, 30) + '...' : subjectRaw;
    const messageEscaped = escapeHtml(item.message || '');
    const createdAt = formatDateTime(item.created_at);
    const statusBadge = getStatusBadge(item.status);
    const supportAgentId = item.support_agent_id || '';
    const assignedToName = getAgentNameById(supportAgentId);

    return `
        <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-4 py-3 text-sm font-medium text-gray-900">${escapeHtml(id)}</td>
            <td class="px-4 py-3 text-sm text-gray-900">${customerName}</td>
            <td class="px-4 py-3 text-sm text-gray-900" title="${subjectEscaped}">
                ${escapeHtml(subjectDisplay)}
            </td>
            <td class="px-4 py-3 text-sm text-gray-900">${customerEmail}</td>
            <td class="px-4 py-3 text-sm text-gray-500">${createdAt}</td>
            <td class="px-4 py-3 text-sm">${statusBadge}</td>
            <td class="px-4 py-3 text-sm text-gray-900">${escapeHtml(assignedToName)}</td>
            <td class="px-4 py-3 text-sm">
                <div class="flex space-x-2">
                    <button class="text-blue-600 hover:text-blue-800 p-1 rounded transition-colors"
                            title="View Enquiry"
                            onclick="openViewModal('${escapeHtml(id)}','${customerName}','${customerEmail}','${subjectEscaped}','${messageEscaped}','${escapeHtml(supportAgentId)}')">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="text-red-600 hover:text-red-800 p-1 rounded transition-colors"
                            title="Delete Enquiry"
                            onclick="openDeleteModal('${escapeHtml(id)}')">
                        <i class="fas fa-trash"></i>
                    </button>
                    <button class="text-purple-600 hover:text-purple-800 mr-2" title="View Replies" onclick="openViewRepliesModal(${escapeHtml(id)})">
                            <i class="fas fa-comments"></i>
                        </button>
                </div>
            </td>
        </tr>`;
}

// Load enquiries
async function loadEnquiries() {
    hideMessages();
    showLoading(true);
    try {
        enquiryTableBody.innerHTML = "";
        const res = await axios.get(`${BASE_URL}/enquiries.php`);
        if (res.data && res.data.status === "success") {
            allEnquiries = Array.isArray(res.data.data) ? res.data.data : [];
            applyFilters();
        } else {
            const errorMsg = res.data?.message || "Failed to load enquiries";
            console.warn("API Response (Enquiries):", res.data);
            showError(errorMsg);
            allEnquiries = [];
            applyFilters();
        }
    } catch (err) {
        console.error("Enquiries fetch failed:", err);
        let userMessage = "Error loading enquiries.";
        if (err.response) {
            userMessage += ` Server responded with status: ${err.response.status}.`;
            if (err.response.data?.message) {
                userMessage += ` Message: ${err.response.data.message}`;
            }
            console.error("Server Response Data:", err.response.data);
            console.error("Server Response Headers:", err.response.headers);
        } else if (err.request) {
            userMessage +=
                " No response received from server. Please check your connection and ensure the server is running.";
            console.error("No response received. Request details:", err.request);
        } else {
            userMessage += ` Request setup error: ${err.message}`;
            console.error("Request setup error:", err);
        }
        showError(userMessage);
        enquiryTableBody.innerHTML = "";
        allEnquiries = [];
        applyFilters();
    } finally {
        showLoading(false);
    }
}

// Apply filters to enquiries
function applyFilters() {
    if (!Array.isArray(allEnquiries)) {
        console.error("allEnquiries is not an array:", allEnquiries);
        allEnquiries = [];
    }
    const statusFilterValue = statusFilter.value;
    let filteredEnquiries = allEnquiries;

    if (statusFilterValue) {
        filteredEnquiries = allEnquiries.filter(enquiry => enquiry.status === statusFilterValue);
    }

    if (filteredEnquiries.length === 0) {
        enquiryTableBody.innerHTML = "";
        emptyState.classList.remove("hidden");
    } else {
        emptyState.classList.add("hidden");
        const rowsHtml = filteredEnquiries.map(item => {
            try {
                return renderEnquiry(item);
            } catch (e) {
                console.error("Error rendering enquiry item:", item, e);
                return `<tr><td colspan="8" class="px-4 py-3 text-center text-red-500">Error rendering enquiry</td></tr>`;
            }
        }).join('');
        enquiryTableBody.innerHTML = rowsHtml;
    }
}

// Open view modal
function openViewModal(id, name, email, subject, message, assignedTo) {
    currentEnquiryId = id; // Store the current enquiry ID
    document.getElementById("modal_customer_name").textContent = escapeHtml(name);
    document.getElementById("modal_customer_email").textContent = escapeHtml(email);
    document.getElementById("modal_subject").textContent = escapeHtml(subject);
    document.getElementById("modal_message").textContent = escapeHtml(message);
    populateModalDropdown(assignedTo);
    viewModal.classList.remove("hidden");
}

// Open delete modal
function openDeleteModal(id) {
    deleteId = id;
    deleteModal.classList.remove("hidden");
}

// Close modals
function closeModal(modal) {
    modal.classList.add("hidden");
    if (modal === viewModal) {
        currentEnquiryId = null; // Clear current enquiry ID when closing view modal
    }
}

// Delete enquiry
async function deleteEnquiry() {
    if (!deleteId) {
        console.error("No delete ID set");
        showError("Error: No enquiry selected for deletion.");
        return;
    }
    try {
        showLoading(true);
        closeModal(deleteModal);

        const res = await axios.post(`${BASE_URL}/enquiries.php`, {
            action: 'delete',
            id: deleteId
        });

        if (res.data && res.data.status === "success") {
            showSuccess("Enquiry deleted successfully");
            loadEnquiries();
        } else {
            const errorMsg = res.data?.message || "Failed to delete enquiry";
            console.warn("Delete API Response:", res.data);
            showError(errorMsg);
        }
    } catch (err) {
        console.error("Delete failed:", err);
        let userMessage = "Error deleting enquiry.";
        if (err.response) {
            userMessage += ` Server error: ${err.response.status}`;
            if (err.response.data?.message) {
                userMessage += ` - ${err.response.data.message}`;
            }
        } else if (err.request) {
            userMessage += " No response from server.";
        } else {
            userMessage += ` Request error: ${err.message}`;
        }
        showError(userMessage);
    } finally {
        showLoading(false);
        deleteId = null;
    }
}

// Assign agent - now only called from view modal
async function assignAgent() {
    const dropdown = document.getElementById("modal_agent_dropdown");
    const agentId = dropdown.value;

    if (!currentEnquiryId) {
        console.error("No enquiry ID available for assignment");
        showError("Error: No enquiry selected for assignment.");
        return;
    }

    const parsedEnquiryId = parseInt(currentEnquiryId, 10);
    const parsedAgentId = agentId === "" ? null : parseInt(agentId, 10);

    if (isNaN(parsedEnquiryId)) {
        console.error("Invalid enquiry ID format:", currentEnquiryId);
        showError("Error assigning agent: Invalid enquiry ID.");
        return;
    }
    if (agentId !== "" && isNaN(parsedAgentId)) {
        console.error("Invalid agent ID format:", agentId);
        showError("Error assigning agent: Invalid agent ID.");
        return;
    }

    try {
        const res = await axios.post(`${BASE_URL}/enquiries.php`, {
            action: 'assign',
            id: parsedEnquiryId,
            support_agent_id: parsedAgentId
        });

        if (res.data && res.data.status === "success") {
            showSuccess("Agent assigned successfully");
            closeModal(viewModal);
            loadEnquiries();
        } else {
            const errorMsg = res.data?.message || "Assignment failed";
            console.warn("Assign API Response:", res.data);
            showError(errorMsg);
        }
    } catch (err) {
        console.error("Assignment error:", err);
        let userMessage = "Error assigning agent.";
        if (err.response) {
            userMessage += ` Server error: ${err.response.status}`;
            if (err.response.data?.message) {
                userMessage += ` - ${err.response.data.message}`;
            }
        } else if (err.request) {
            userMessage += " No response from server.";
        } else {
            userMessage += ` Request error: ${err.message}`;
        }
        showError(userMessage);
    }
}

// Event listeners
document.addEventListener("DOMContentLoaded", async () => {
    await fetchSupportAgents();
    await loadEnquiries();
});

// Refresh button
document.getElementById("refresh_btn").addEventListener("click", loadEnquiries);

// Status filter
statusFilter.addEventListener("change", applyFilters);

// Modal close buttons
document.getElementById("close_view_modal").addEventListener("click", () => closeModal(viewModal));
document.getElementById("cancel_delete_btn").addEventListener("click", () => closeModal(deleteModal));

// Delete confirmation
document.getElementById("confirm_delete_btn").addEventListener("click", deleteEnquiry);

// Assign agent button in modal
document.getElementById("assign_agent_btn").addEventListener("click", assignAgent);

// Close modals when clicking outside
[viewModal, deleteModal].forEach(modal => {
    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            closeModal(modal);
        }
    });
});

// Keyboard shortcuts
document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
        if (!viewModal.classList.contains("hidden")) closeModal(viewModal);
        if (!deleteModal.classList.contains("hidden")) closeModal(deleteModal);
    }
});





function openViewRepliesModal(enquiry_reply_Id) {
    document.getElementById('viewRepliesModal').showModal();
    const repliesContent = document.getElementById('repliesContent');
    repliesContent.innerHTML = `<p class="text-gray-500">Loading replies...</p>`;

    axios.get(`${BASE_URL}/fetchBookingReplies.php?booking_id=${enquiry_reply_Id}`)
        .then(response => {
            const replies = response.data;
            if (Array.isArray(replies) && replies.length > 0) {
                repliesContent.innerHTML = '';
                replies.forEach(reply => {
                    const replyHTML = `
                        <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-gray-800">${reply.agent_name}</span>
                                <span class="text-sm text-gray-500">${new Date(reply.reply_date).toLocaleString()}</span>
                            </div>
                            <div class="text-gray-700 whitespace-pre-line">${reply.reply}</div>
                        </div>
                    `;
                    repliesContent.innerHTML += replyHTML;
                });
            } else {
                repliesContent.innerHTML = `<p class="text-gray-500">No replies yet.</p>`;
            }
        })
        .catch(error => {
            console.error(error);
            repliesContent.innerHTML = `<p class="text-red-500">Failed to load replies. Please try again.</p>`;
        });
}

function closeViewRepliesModal() {
    document.getElementById('viewRepliesModal').close();
}
</script>