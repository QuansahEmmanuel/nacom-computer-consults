<!-- All Customer Enquiries Section -->
<div id="enquirySection" class="page-content">
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900">All Customer Enquiries</h2>
                <div class="flex space-x-2">
                    <button onclick="filterEnquiries('all')"
                        class="filter-btn px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded hover:bg-blue-200 active">All</button>
                    <button onclick="filterEnquiries('unread')"
                        class="filter-btn px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded hover:bg-gray-200">Unread</button>
                    <button onclick="filterEnquiries('resolved')"
                        class="filter-btn px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded hover:bg-gray-200">Resolved</button>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="space-y-6" id="enquiryList">
                <!-- Enquiries will be rendered here -->
            </div>
        </div>
    </div>
</div>

<!-- Reply Modal -->
<div id="replyModal" class="fixed inset-0 hidden z-50 bg-black bg-opacity-30 flex items-center justify-center">
    <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-md space-y-4">
        <div class="flex items-start justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-1">Reply to Customer</h2>
                <p class="text-sm text-gray-500">
                    <span id="clientName" class="font-medium text-gray-700"></span> |
                    <span id="clientEmail" class="text-blue-600"></span>
                </p>
            </div>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 text-lg font-bold">&times;</button>
        </div>
        <form id="replyForm">
            <input type="hidden" id="enquiryId" />
            <textarea id="replyMessage" rows="4"
                class="w-full border border-gray-300 p-3 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Type your reply here..."></textarea>

            <!-- Success Message -->
            <div id="reply_success_message_div" class="hidden mt-3 p-2 bg-green-100 text-green-700 text-sm rounded">
                <span id="reply_success_message_text"></span>
            </div>

            <!-- Error Message -->
            <div id="reply_error_message_div" class="hidden mt-3 p-2 bg-red-100 text-red-700 text-sm rounded">
                <span id="reply_error_message_text"></span>
            </div>

            <div class="flex justify-end space-x-3 pt-2">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 border rounded text-gray-700 hover:bg-gray-50">Cancel</button>
                <button id="sendBtn" type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center justify-center space-x-2">
                    <span class="send-text">Send</span>
                    <span
                        class="spinner hidden w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script Section -->
<script>
// Base URL - Update this in production
const BASE_URL = "http://localhost/nacom-computer-consults/api/support";

// Global variables
let allEnquiries = [];
let agentId;

// DOM Elements
const enquiryList = document.getElementById("enquiryList");
const replyForm = document.getElementById("replyForm");

// Toast helpers (optional, if using iziToast)
const errorMess = (message) => {
    if (typeof iziToast !== 'undefined') {
        iziToast.error({
            title: "Error",
            message,
            position: "topRight",
            timeout: 5000
        });
    } else {
        console.error("Error:", message);
    }
};

const successMess = (message) => {
    if (typeof iziToast !== 'undefined') {
        iziToast.success({
            title: "Success",
            message,
            position: "topRight",
            timeout: 5000
        });
    } else {
        console.log("Success:", message);
    }
};

// Helper: Show success message with auto-hide
function showSuccess(message, duration = 5000) {
    const successDiv = document.getElementById("reply_success_message_div");
    const successText = document.getElementById("reply_success_message_text");
    successText.textContent = message;
    successDiv.classList.remove("hidden");
    setTimeout(() => successDiv.classList.add("hidden"), duration);
}

// Helper: Show error message with auto-hide
function showError(message, duration = 5000) {
    const errorDiv = document.getElementById("reply_error_message_div");
    const errorText = document.getElementById("reply_error_message_text");
    errorText.textContent = message;
    errorDiv.classList.remove("hidden");
    setTimeout(() => errorDiv.classList.add("hidden"), duration);
}

// Get logged-in agent ID
const getLoginUserId = async () => {
    try {
        const response = await axios.get(`${BASE_URL}/getUserId.php`);
        agentId = response.data.user_id;
        sessionStorage.setItem('agent_id', agentId); // ✅ Save to session storage
        fetchEnquiries(agentId);
    } catch (error) {
        console.error("Error fetching user ID:", error);
        errorMess("Could not retrieve agent session. Please log in again.");
    }
};

// Fetch all enquiries
const fetchEnquiries = async (user_id) => {
    try {
        const response = await axios.get(`${BASE_URL}/enquiries.php?user_id=${user_id}`);
        allEnquiries = Array.isArray(response.data) ? response.data : [];
        renderEnquiries(allEnquiries);
    } catch (error) {
        console.error("Error fetching enquiries:", error);
        enquiryList.innerHTML = `<p class="text-red-500">Failed to load enquiries.</p>`;
    }
};

// Render enquiries list
const renderEnquiries = async (enquiries) => {
    enquiryList.innerHTML = '<p class="text-gray-500">Loading enquiries...</p>';

    try {
        const html = await Promise.all(enquiries.map(async (enquiry) => {
            let replies = [];
            try {
                const replyRes = await axios.get(`${BASE_URL}/getReplies.php`, {
                    params: {
                        enquiry_id: enquiry.id
                    }
                });
                replies = Array.isArray(replyRes.data) ? replyRes.data : [];
            } catch (err) {
                console.warn(`Failed to load replies for enquiry ${enquiry.id}`, err);
            }

            const replyHTML = replies.length ? replies.map(reply => `
                <div class="bg-gray-100 p-3 rounded mt-3 text-sm text-gray-800">
                    <strong>Agent Reply:</strong> ${reply.reply}<br/>
                    <span class="text-xs text-gray-500">${new Date(reply.reply_date).toLocaleString()}</span>
                </div>
            `).join('') : '';

            const statusClass = replies.length > 0 ?
                'bg-green-100 text-green-700' :
                'bg-red-100 text-red-700';

            const statusText = replies.length > 0 ?
                'Attended' :
                'Unattended';

            return `
                <div class="enquiry border border-gray-200 rounded-lg p-6 mb-4" data-status="${enquiry.status}" data-id="${enquiry.id}">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="font-semibold text-gray-900">${enquiry.customer_name}</h3>
                            <p class="text-sm text-gray-600">${enquiry.customer_email}</p>
                        </div>
                        <span class="text-sm text-gray-500">${formatDate(enquiry.enquiry_date)}</span>
                    </div>
                    <div class="mb-4">
                        <h4 class="font-medium text-gray-900 mb-2">Subject: ${enquiry.subject}</h4>
                        <p class="text-gray-700">${enquiry.message}</p>
                    </div>
                    ${replyHTML}
                    <div class="flex space-x-3 items-center mt-4">
                        <button onclick="openModal(${enquiry.id})" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm">Reply</button>
                        <span class="status-label inline-block px-3 py-1 text-xs font-semibold rounded-full ${statusClass}">
                            ${statusText}
                        </span>
                    </div>
                </div>
            `;
        }));

        enquiryList.innerHTML = html.join('');
    } catch (error) {
        console.error("Error rendering enquiries:", error);
        enquiryList.innerHTML = `<p class="text-red-500">Error rendering data. Please try again.</p>`;
    }
};

// Open reply modal
const openModal = (id) => {
    const enquiry = allEnquiries.find(e => e.id === id);
    if (!enquiry) {
        showError("Enquiry not found.");
        return;
    }

    document.getElementById("enquiryId").value = enquiry.id;
    document.getElementById("replyMessage").value = "";
    document.getElementById("clientName").innerText = enquiry.customer_name;
    document.getElementById("clientEmail").innerText = enquiry.customer_email;

    // Clear previous messages
    document.getElementById("reply_success_message_div").classList.add("hidden");
    document.getElementById("reply_error_message_div").classList.add("hidden");

    document.getElementById("replyModal").classList.remove("hidden");
};

// Close modal
const closeModal = () => {
    document.getElementById("replyModal").classList.add("hidden");
};

// Handle reply form submission
replyForm.addEventListener('submit', async function(e) {
    e.preventDefault();

    const enquiryId = parseInt(document.getElementById('enquiryId').value);
    const agentId = sessionStorage.getItem('agent_id'); // ✅ From session
    const message = document.getElementById('replyMessage').value.trim();

    const sendButton = e.target.querySelector('button[type="submit"]');
    const spinner = sendButton.querySelector('.spinner');
    const sendText = sendButton.querySelector('.send-text');

    // Validation
    if (!agentId) {
        showError("Session expired. Please log in again.");
        return;
    }
    if (isNaN(enquiryId)) {
        showError("Invalid enquiry.");
        return;
    }
    if (!message) {
        showError("Reply message cannot be empty.");
        return;
    }

    // Disable button and show spinner
    sendButton.disabled = true;
    spinner.classList.remove("hidden");
    sendText.classList.add("hidden");

    try {
        const response = await axios.post(
            `${BASE_URL}/sendReply.php`, {
                enquiry_id: enquiryId,
                agent_id: agentId,
                message: message
            }, {
                headers: {
                    'Content-Type': 'application/json'
                }
            }
        );

        const data = response.data;

        if (data.success) {
            showSuccess(data.message || "Reply sent successfully!");
            setTimeout(() => {
                closeModal();
                fetchEnquiries(agentId); // Refresh list
            }, 1000);
        } else {
            showError(data.message || "Failed to send reply.");
        }
    } catch (error) {
        console.error("API Error:", error);
        let errorMsg = "An error occurred. Please try again.";
        if (error.response?.data?.message) {
            errorMsg = error.response.data.message;
        } else if (error.message) {
            errorMsg = error.message;
        }
        showError(errorMsg);
    } finally {
        // Re-enable button
        sendButton.disabled = false;
        spinner.classList.add("hidden");
        sendText.classList.remove("hidden");
        sendText.textContent = "Send";
    }
});

// Filter enquiries
const filterEnquiries = async (status) => {
    if (status === 'all') {
        renderEnquiries(allEnquiries);
        return;
    }

    const filtered = await Promise.all(allEnquiries.map(async (enquiry) => {
        try {
            const replyRes = await axios.get(`${BASE_URL}/getReplies.php`, {
                params: {
                    enquiry_id: enquiry.id
                }
            });
            enquiry.replies = Array.isArray(replyRes.data) ? replyRes.data : [];
        } catch (err) {
            enquiry.replies = [];
        }
        return enquiry;
    }));

    const filteredList = filtered.filter(enquiry => {
        if (status === 'resolved') {
            return enquiry.status === 'resolved' && enquiry.replies.length > 0;
        } else if (status === 'unread') {
            return enquiry.status !== 'resolved' || enquiry.replies.length === 0;
        }
        return true;
    });

    renderEnquiries(filteredList);
};

// Format date
const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleString(undefined, {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: 'numeric',
        minute: '2-digit',
        hour12: true,
    });
};

// Initialize on load
getLoginUserId();
</script>