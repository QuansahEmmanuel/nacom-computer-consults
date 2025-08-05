<!-- Booking & Enquiry Oversight -->
<div class="page-content">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <!-- <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Bookings Oversight</h3>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors"
                onclick="openAddBookingModal()" title="Add Booking">
                <i class="fas fa-plus mr-2"></i>New Booking
            </button>
        </div> -->

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
                        <!--  <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Resolution</th> -->
                        <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Assign Agent Modal -->
<dialog id="assign_agent_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">Assign Support Agent</h3>

        <form>
            <div class="form-control mb-4">
                <label class="label"><span class="label-text">Select Agent</span></label>
                <select class="select select-bordered w-full" id="agentSelect" required>
                    <option disabled selected>Select agent</option>

                </select>
            </div>
        </form>
        <div class="modal-action">
            <button type="button" class="btn btn-primary">Assign</button>
            <form method="dialog">
                <!-- if there is a button, it will close the modal -->
                <button class="btn"> Close X</button>
            </form>
        </div>
    </div>
</dialog>


<!-- Delete  Booking Modal -->
<dialog id="delete_booking_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">Assign Support Agent</h3>
        <p>Are You sure you want to delete Booking?</p>

        <div class="modal-action">
            <button type="button" class="btn btn-error"><i class="fa-solid fa-trash"></i>
                Delete</button>
            <form method="dialog">
                <!-- if there is a button, it will close the modal -->
                <button class="btn"> Close X</button>
            </form>
        </div>
    </div>
</dialog>

<!-- Edit Agent Modal -->
<dialog id="edit_assigned_agent_modal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">Edit Support Assigned Agent </h3>

        <form>
            <div class="form-control mb-4">
                <label class="label"><span class="label-text">Select New Agent</span></label>
                <select class="select select-bordered w-full" id="edit_agentSelect" required>
                    <option disabled selected>Select agent</option>

                </select>
            </div>
        </form>
        <div class="modal-action">
            <button type="submit" class="btn btn-primary">Assign</button>
            <form method="dialog">
                <!-- if there is a button, it will close the modal -->
                <button class="btn"> Close X</button>
            </form>
        </div>
    </div>
</dialog>

<!-- Add Booking Modal -->
<dialog id="add_booking_modal" class="modal">
    <div class="modal-box max-w-3xl w-full p-8 bg-white rounded-xl shadow-xl">
        <h3 class="font-bold text-2xl text-gray-800 mb-6">Add Booking</h3>

        <!-- Success Message -->
        <div id="booking_success_message_div"
            class="hidden mb-6 p-4 bg-green-100 text-green-800 border border-green-300 rounded-lg flex items-center gap-3 text-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span id="booking_success_message_text"></span>
        </div>

        <!-- Error Message -->
        <div id="booking_error_message_div"
            class="hidden mb-6 p-4 bg-red-100 text-red-800 border border-red-300 rounded-lg flex items-center gap-3 text-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span id="booking_error_message_text"></span>
        </div>

        <!-- Booking Form -->
        <form id="book_our_service_form" class="grid md:grid-cols-2 gap-6 text-lg">
            <!-- Full Name -->
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Full Name *</label>
                <input id="bks_coustomer_name" type="text" placeholder="Enter your full name"
                    class="w-full border border-gray-300 p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
            </div>

            <!-- Email -->
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Email Address *</label>
                <input type="email" id="bks_coustomer_email" placeholder="your.email@example.com"
                    class="w-full border border-gray-300 p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
            </div>

            <!-- Phone -->
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Phone Number *</label>
                <input type="tel" id="bks_coustomer_phone_number" placeholder="+233 546 973 655"
                    class="w-full border border-gray-300 p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
            </div>

            <!-- Service Type -->
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Service Type *</label>
                <select id="bks_coustomer_service_name"
                    class="w-full border border-gray-300 p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="">Select Service Type</option>
                    <option value="IT Support & Troubleshooting">IT Support & Troubleshooting</option>
                    <option value="Network Setup & Configuration">Network Setup & Configuration</option>
                    <option value="Custom Software Development">Custom Software Development</option>
                    <option value="Data Recovery Services">Data Recovery Services</option>
                    <option value="System Maintenance">System Maintenance</option>
                    <option value="IT Consultation">IT Consultation</option>
                </select>
            </div>

            <!-- Preferred Date -->
            <div class="md:col-span-2">
                <label class="block font-semibold text-gray-700 mb-2">Preferred Date *</label>
                <input type="date" id="bks_coustomer_date"
                    class="w-full border border-gray-300 p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
            </div>
        </form>

        <!-- Modal Actions -->
        <div class="modal-action mt-8 flex justify-end gap-4">

            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors"
                onclick="addNewBooking()"><i class="fas fa-plus mr-2"></i>
                Add Booking
            </button>
            <form method="dialog">
                <button class="btn btn-outline btn-error rounded-lg px-6 py-3">X Close</button>
            </form>
        </div>
    </div>
</dialog>


<!-- View Replies Modal -->
<dialog id="viewRepliesModal" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box relative bg-white rounded-lg shadow-xl max-w-2xl w-full p-0">
        <!-- Header -->
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 rounded-t-lg">
            <h3 class="text-lg font-semibold text-gray-800">Replies to Bookings</h3>
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
const BASE_URL = "http://localhost/nacom-computer-consults/api/admin";

// Filter booking data
const applyBookingFilters = () => {
    const customer = document.getElementById("searchBookingInput").value.trim();
    const status = document.getElementById("statusFilter").value;

    const filters = {};
    if (customer) filters.customer = customer;
    if (status) filters.status = status;

    viewBookings(filters);
};

// Event listeners
document.getElementById("searchBookingInput").addEventListener("input", debounce(applyBookingFilters, 300));
document.getElementById("statusFilter").addEventListener("change", applyBookingFilters);

// Clear filters
const clearBookingFilters = () => {
    document.getElementById("searchBookingInput").value = "";
    document.getElementById("statusFilter").value = "";
    viewBookings(); // Reload all
};

// Debounce helper to reduce rapid input calls
function debounce(fn, delay) {
    let timeout;
    return (...args) => {
        clearTimeout(timeout);
        timeout = setTimeout(() => fn(...args), delay);
    };
}

// Load bookings and render in table
const viewBookings = async (filters = {}) => {
    try {
        const params = new URLSearchParams(filters).toString();
        const response = await axios.get(`${BASE_URL}/booking.php?action=view&${params}`);
        const bookings = response.data.data;

        const tbody = document.querySelector("table tbody");
        if (!tbody) {
            console.error("No tbody element found.");
            return;
        }

        tbody.innerHTML = ""; // Clear existing rows

        if (bookings.length === 0) {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td colspan="8" class="py-4 px-4 text-center text-gray-500 text-sm">
                    No bookings found.
                </td>`;
            tbody.appendChild(row);
            return;
        }

        bookings.forEach((booking) => {
            const row = document.createElement("tr");
            row.classList.add("border-b", "border-gray-100");

            row.innerHTML = `
                <td class="py-3 px-4 text-sm text-gray-800">#${booking.id}</td>
                <td class="py-3 px-4 text-sm text-gray-800">${booking.customer_name}</td>
                <td class="py-3 px-4 text-sm text-gray-600">${booking.service_name}</td>
                <td class="py-3 px-4 text-sm text-gray-600">${booking.booking_date}</td>
                <td class="py-3 px-4">
                  <span class="bg-${booking.booking_status === 'Confirmed' ? 'green' : booking.booking_status === 'Pending' ? 'yellow' : 'gray'}-100 text-${booking.booking_status === 'Confirmed' ? 'green' : booking.booking_status === 'Pending' ? 'yellow' : 'gray'}-800 px-2 py-1 rounded-full text-xs">
                    ${booking.booking_status}
                  </span>
                </td>
                <td class="py-3 px-4 text-sm text-gray-800">${booking.assigned_agent_name || 'Unassigned'}</td>
              <!--  <td class="py-3 px-4">
                  <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">${booking.resolution_status}</span>
                </td> -->
                <td class="py-3 px-4">
                <button class="text-blue-600 hover:text-blue-800 mr-2" title="Edit Agent" onclick="openEditAgentModal(${booking.id})">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="text-green-600 hover:text-green-800 mr-2" title="Assign Agent" onclick="openAssignAgentModal(${booking.id})">
                    <i class="fas fa-user-check"></i>
                </button>
                <button class="text-purple-600 hover:text-purple-800 mr-2" title="View Replies" onclick="openViewRepliesModal(${booking.id})">
                    <i class="fas fa-comments"></i>
                </button>
                <!--<button class="text-red-600 hover:text-red-800" title="Delete Booking" onclick="openDeleteModal(${booking.id})">
                    <i class="fas fa-trash"></i>
                </button>-->
</td>

            `;

            tbody.appendChild(row);
        });

    } catch (error) {
        console.error("Failed to load bookings:", error);
    }
};

// Initial load
viewBookings();


//.................................................................................................

// Error Message plogin function 
const errorMess = (messeage) => {
    iziToast.error({
        title: "Error",
        message: messeage,
        position: "topRight", // Matches your div class
    });
};
const successMess = (message) => {
    iziToast.success({
        title: "Success",
        message: message,
        position: "topRight", // Matches your div class
    });
};

//.................................................................................................

// Assign User 

let currentBookingId = null;

const openAssignAgentModal = async (bookingId) => {
    currentBookingId = bookingId;

    // Show the modal
    const modal = document.getElementById("assign_agent_modal");
    modal.showModal();

    // Get the dropdown
    const agentSelect = document.getElementById("agentSelect");

    // Clear existing options (except placeholder)
    agentSelect.innerHTML = `
    <option disabled selected>Select agent</option>
  `;

    try {
        const response = await axios.get(`${BASE_URL}/users.php?action=support_agents`);
        const agents = response.data.data;

        agents.forEach(agent => {
            const option = document.createElement("option");
            option.value = agent.id;
            option.textContent = agent.username;
            agentSelect.appendChild(option);
        });

    } catch (error) {
        console.error("Failed to load agents:", error);
    }
};

// Assign button logic
document.querySelector("#assign_agent_modal .btn-primary").addEventListener("click", async () => {
    const agentId = document.getElementById("agentSelect").value;

    if (!agentId || !currentBookingId) return;

    try {
        await axios.post(`${BASE_URL}/booking.php?action=assign_agent`, {
            booking_id: currentBookingId,
            agent_id: agentId
        });

        successMess("Agent assigned successfully.");
        document.getElementById("assign_agent_modal").close();
        viewBookings(); // Refresh the list

    } catch (error) {
        console.error("Failed to assign agent:", error);
        errorMess("Failed to assign agent.");
    }
});

//..............................................................................................................


let currentDeleteBookingId = null;

const openDeleteModal = (bookingId) => {
    currentDeleteBookingId = bookingId;
    document.getElementById("delete_booking_modal").showModal();
};


document.querySelector("#delete_booking_modal .btn-error").addEventListener("click", async () => {
    if (!currentDeleteBookingId) return;

    try {
        await axios.post(`${BASE_URL}/booking.php?action=delete`, {
            booking_id: currentDeleteBookingId
        });

        successMess("Booking deleted successfully");
        document.getElementById("delete_booking_modal").close();
        viewBookings(); // Refresh list

    } catch (error) {
        console.error("Delete failed:", error);
        errorMess("Failed to delete booking");
    }
});

//...................................................................................

// edit assign user  
let currentEditBookingId = null;

const openEditAgentModal = async (bookingId) => {
    currentEditBookingId = bookingId;

    // Show modal
    const modal = document.getElementById("edit_assigned_agent_modal");
    modal.showModal();

    const agentSelect = document.getElementById("edit_agentSelect");
    agentSelect.innerHTML = `<option disabled selected>Select agent</option>`;

    try {
        const response = await axios.get(`${BASE_URL}/users.php?action=support_agents`);
        const agents = response.data.data;

        agents.forEach(agent => {
            const option = document.createElement("option");
            option.value = agent.id;
            option.textContent = agent.username;
            agentSelect.appendChild(option);
        });

    } catch (error) {
        console.error("Failed to load support agents:", error);
    }
};
//..................................................................................................................

// Assign button handler
document.querySelector("#edit_assigned_agent_modal .btn-primary").addEventListener("click", async () => {
    const agentId = document.getElementById("edit_agentSelect").value;

    if (!agentId || !currentEditBookingId) return;

    try {
        await axios.post(`${BASE_URL}/booking.php?action=edit_assigned_agent`, {
            booking_id: currentEditBookingId,
            agent_id: agentId
        });

        successMess("Assigned agent updated.");
        document.getElementById("edit_assigned_agent_modal").close();
        viewBookings(); // Refresh list

    } catch (error) {
        console.error("Failed to update assigned agent:", error);
        errorMess("Failed to update agent.");
    }
});

// ....................................................................................

// Add Booking Functionality 

// open add booking modal
const openAddBookingModal = () => {
    document.getElementById("add_booking_modal").showModal();
}

// add Booking 
const addNewBooking = async () => {
    // Get form values
    const name = document.getElementById("bks_coustomer_name").value.trim();
    const email = document.getElementById("bks_coustomer_email").value.trim();
    const phone = document.getElementById("bks_coustomer_phone_number").value.trim();
    const service_name = document.getElementById("bks_coustomer_service_name").value.trim();
    const date = document.getElementById("bks_coustomer_date").value;

    // Message elements
    const successMessageText = document.getElementById("booking_success_message_text");
    const errorMessageText = document.getElementById("booking_error_message_text");
    const errorMessageDiv = document.getElementById("booking_error_message_div");
    const successMessageDiv = document.getElementById("booking_success_message_div");

    // Hide all message boxes first
    successMessageDiv.classList.add("hidden");
    errorMessageDiv.classList.add("hidden");

    // Validation
    if (!name || !email || !phone || !service_name || !date) {
        errorMessageText.innerHTML = "All fields are required.";
        errorMessageDiv.classList.remove("hidden");
        setTimeout(() => errorMessageDiv.classList.add("hidden"), 3000);
        return;
    }

    if (!validateEmail(email)) {
        errorMessageText.innerHTML = "Please enter a valid email address.";
        errorMessageDiv.classList.remove("hidden");
        setTimeout(() => errorMessageDiv.classList.add("hidden"), 3000);
        return;
    }

    if (!validatePhone(phone)) {
        errorMessageText.innerHTML = "Please enter a valid phone number.";
        errorMessageDiv.classList.remove("hidden");
        setTimeout(() => errorMessageDiv.classList.add("hidden"), 3000);
        return;
    }

    try {
        const response = await axios.post(`http://localhost/nacom-computer-consults/api/user/booking.php`, {
            name,
            email,
            phone,
            service_name,
            date,
            status: "pending",
        });

        const data = response.data;

        if (data && data.status === "success") {
            viewBookings();

            // Show success message
            successMessageText.innerText = data.message || "Booking successful!";
            successMessageDiv.classList.remove("hidden");
            errorMessageDiv.classList.add("hidden");

            // Reset form
            document.getElementById("book_our_service_form").reset();

            // Hide success after 3 seconds
            setTimeout(() => successMessageDiv.classList.add("hidden"), 3000);
        } else {
            // Show error message
            errorMessageText.innerText = data.message || "Something went wrong.";
            errorMessageDiv.classList.remove("hidden");
            successMessageDiv.classList.add("hidden");
            setTimeout(() => errorMessageDiv.classList.add("hidden"), 3000);
        }
    } catch (error) {
        console.error("Error:", error);

        // Hide success message and show error
        successMessageDiv.classList.add("hidden");
        errorMessageText.innerText =
            error.response?.data?.message ||
            error.message ||
            "An unexpected error occurred.";
        errorMessageDiv.classList.remove("hidden");
        setTimeout(() => errorMessageDiv.classList.add("hidden"), 3000);
    }
}

// Email validation regex
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Phone validation (basic example)
function validatePhone(phone) {
    const re = /^\+?[0-9\s\-()]{7,}$/;
    return re.test(phone);
}




function openViewRepliesModal(bookingId) {
    const modal = document.getElementById('viewRepliesModal');
    const repliesContainer = document.getElementById('repliesContent');

    repliesContainer.innerHTML = '<p class="text-gray-400 text-sm">Loading replies...</p>';

    axios.get(`${BASE_URL}/getReplies.php`, {
            params: {
                booking_id: bookingId
            }
        })
        .then(response => {
            const data = response.data;
            repliesContainer.innerHTML = '';

            if (Array.isArray(data) && data.length === 0) {
                repliesContainer.innerHTML =
                    '<p class="text-gray-500 text-sm">No replies found for this enquiry.</p>';
            } else if (Array.isArray(data)) {
                data.forEach(reply => {
                    const replyElement = document.createElement('div');
                    replyElement.classList.add('bg-blue-50', 'p-4', 'rounded', 'border-l-4',
                        'border-blue-400');

                    replyElement.innerHTML = `
                    <p class="text-sm text-gray-800"><strong>Agent ${reply.agent_name}:</strong> ${reply.message}</p>
                    <span class="text-xs text-gray-500">${formatDate(reply.reply_date)}</span>
                `;
                    repliesContainer.appendChild(replyElement);
                });
            } else {
                repliesContainer.innerHTML = '<p class="text-red-500 text-sm">Invalid data received.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching replies:', error);
            repliesContainer.innerHTML = '<p class="text-red-500 text-sm">Failed to load replies.</p>';
        });

    modal.showModal();
}

function closeViewRepliesModal() {
    const modal = document.getElementById('viewRepliesModal');
    modal.close();
}

function formatDate(dateStr) {
    const date = new Date(dateStr);
    return date.toLocaleDateString(undefined, {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}
</script>