<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Service Scheduling Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Filter Section -->
        <div class="bg-white shadow-md rounded-lg p-5">
            <h3 class="text-lg font-semibold mb-4 text-gray-800">Filter Bookings</h3>

            <!-- Status Filter -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Schedule Status:</label>
                <select id="statusFilter"
                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All</option>
                    <option value="Pending">Awaiting Schedule</option>
                    <option value="Contacted">Customer Contacted</option>
                    <option value="Scheduled">Date Scheduled</option>
                    <option value="Confirmed">Schedule Confirmed</option>
                    <option value="Completed">Service Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>

            <!-- Priority Filter -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Priority:</label>
                <select id="priorityFilter"
                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All</option>
                    <option value="urgent">Urgent</option>
                    <option value="normal">Normal</option>
                    <option value="low">Low Priority</option>
                </select>
            </div>

            <!-- Date Range Filter -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Booking Date:</label>
                <div class="flex space-x-2">
                    <input type="date" id="startDate"
                        class="w-1/2 border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <input type="date" id="endDate"
                        class="w-1/2 border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Search Filter -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Search:</label>
                <div class="flex">
                    <input type="text" id="searchInput" placeholder="Name, ID, Service..."
                        class="w-full border border-gray-300 rounded-l px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button onclick="filterBookings()"
                        class="bg-blue-600 text-white px-4 py-2 text-sm font-semibold rounded-r hover:bg-blue-700">Search</button>
                </div>
            </div>
        </div>

        <!-- Booking Table -->
        <div class="md:col-span-3 bg-white shadow-md rounded-lg p-5 overflow-x-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Assigned Services</h3>
                <div class="text-sm text-gray-600">
                    <span id="totalBookings" class="font-medium">0</span> total bookings
                </div>
            </div>

            <table class="w-full text-sm text-left border-collapse" id="bookingsTable">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-2 font-semibold">ID</th>
                        <th class="px-4 py-2 font-semibold">Customer</th>
                        <th class="px-4 py-2 font-semibold">Service</th>
                        <th class="px-4 py-2 font-semibold">Booked Date</th>
                        <th class="px-4 py-2 font-semibold">Schedule Status</th>
                        <th class="px-4 py-2 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody id="bookingsBody">
                    <!-- Bookings loaded via JS -->
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-6 flex justify-center" id="paginationContainer">
                <!-- Pagination loaded via JS -->
            </div>
        </div>
    </div>

    <!-- Scheduling Email Modal -->
    <div id="emailModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <h3 class="text-xl font-semibold mb-4">Schedule Service with Customer</h3>
            <input type="hidden" id="modalBookingId">
            <input type="hidden" id="customerName">

            <!-- Email Template Selector -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Template:</label>
                <select id="emailTemplate" onchange="loadEmailTemplate()"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="initial">Initial Contact - Schedule Request</option>
                    <option value="followup">Follow-up - Awaiting Response</option>
                    <option value="confirm">Schedule Confirmation</option>
                    <option value="reschedule">Reschedule Request</option>
                    <option value="reminder">Service Reminder</option>
                    <option value="custom">Custom Message</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">To:</label>
                <input type="text" id="customerEmail" disabled
                    class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Subject:</label>
                <input type="text" id="emailSubject"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter email subject">
            </div>

            <!-- Proposed Schedule Section -->
            <div class="mb-4 bg-blue-50 p-4 rounded">
                <h4 class="text-sm font-semibold text-gray-700 mb-2">Proposed Schedule (Optional):</h4>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-gray-600 mb-1">Preferred Date:</label>
                        <input type="date" id="proposedDate"
                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-600 mb-1">Preferred Time:</label>
                        <input type="time" id="proposedTime"
                            class="w-full border border-gray-300 rounded px-2 py-1 text-sm">
                    </div>
                </div>
                <button type="button" onclick="insertScheduleInfo()"
                    class="mt-2 text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded hover:bg-blue-200">
                    Insert Schedule into Message
                </button>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Message:</label>
                <textarea id="emailMessage" rows="8"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Write your message here..."></textarea>
            </div>

            <div class="flex justify-between items-center">
                <div class="text-xs text-gray-500">
                    💡 Tip: Use professional, friendly language and offer 2-3 time options
                </div>
                <div class="flex space-x-3">
                    <button onclick="closeModal()"
                        class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-100">Cancel</button>
                    <button onclick="sendEmail()"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center">
                        <span
                            class="spinner hidden w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></span>
                        Send Email
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Email Replies Modal -->
    <div id="emailRepliesModal"
        class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-40 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative">
            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b pb-2 mb-4">
                <h2 class="text-lg font-semibold">Email Replies</h2>
                <button onclick="closeRepliesModal()" class="text-gray-500 hover:text-red-500 text-xl">&times;</button>
            </div>

            <!-- Replies Content -->
            <div id="repliesContent" class="space-y-4 max-h-[400px] overflow-y-auto">
                <!-- Replies will be injected here -->
            </div>

            <!-- Modal Footer -->
            <div class="mt-4 text-right">
                <button onclick="closeRepliesModal()"
                    class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Close
                </button>
            </div>
        </div>
    </div>


    <script>
    const BASE_URL = "http://localhost/nacom-computer-consults/api/support";
    let allBookings = [];
    let currentPage = 1;
    const itemsPerPage = 8;

    // Email templates for different scheduling scenarios
    const emailTemplates = {
        initial: {
            subject: "Let's Schedule Your {SERVICE} - Booking #{ID}",
            message: `Dear {CUSTOMER},

Thank you for choosing our services! I've been assigned to help schedule your {SERVICE}.

To provide you with the best service experience, I'd like to coordinate a convenient time for your appointment. 

Could you please let me know your preferred:
• Day of the week
• Time of day (morning/afternoon/evening)
• Any specific dates that work best for you

I'm available to work around your schedule and will do my best to accommodate your preferences.

Please reply to this email or call us at your earliest convenience so we can finalize the appointment details.

Looking forward to serving you!

Best regards,
[Your Name]
Customer Service Team`
        },
        followup: {
            subject: "Following Up - Schedule Your {SERVICE} (Booking #{ID})",
            message: `Dear {CUSTOMER},

I hope this email finds you well. I'm following up on my previous message regarding scheduling your {SERVICE}.

I understand you may be busy, but I wanted to ensure you received my email about coordinating your service appointment.

To help expedite the process, here are some available time slots:
• [Option 1: Date/Time]
• [Option 2: Date/Time]  
• [Option 3: Date/Time]

If none of these work for you, please suggest alternative times that would be more convenient.

I'm here to make this as easy as possible for you. Please reply at your earliest convenience.

Best regards,
[Your Name]
Customer Service Team`
        },
        confirm: {
            subject: "Service Appointment Confirmed - {SERVICE} on {DATE}",
            message: `Dear {CUSTOMER},

Great news! Your {SERVICE} appointment has been confirmed for:

📅 Date: {DATE}
🕒 Time: {TIME}
📍 Location: [Address/Details]

Please note:
• Arrive 10 minutes early if visiting our location
• Have your booking reference #{ID} ready
• Contact us immediately if you need to reschedule

If you have any questions or need to make changes, please don't hesitate to reach out.

We look forward to providing you with excellent service!

Best regards,
[Your Name]
Customer Service Team`
        },
        reschedule: {
            subject: "Reschedule Request - {SERVICE} (Booking #{ID})",
            message: `Dear {CUSTOMER},

I hope you're doing well. I need to reach out regarding your scheduled {SERVICE} appointment.

Due to [reason], we need to reschedule your current appointment. I sincerely apologize for any inconvenience this may cause.

I have the following alternative slots available:
• [Option 1: Date/Time]
• [Option 2: Date/Time]
• [Option 3: Date/Time]

Please let me know which option works best for you, or suggest alternative times if these don't suit your schedule.

Thank you for your understanding and flexibility.

Best regards,
[Your Name]
Customer Service Team`
        },
        reminder: {
            subject: "Reminder: Your {SERVICE} Appointment Tomorrow",
            message: `Dear {CUSTOMER},

This is a friendly reminder about your {SERVICE} appointment:

📅 Date: {DATE}
🕒 Time: {TIME}
📍 Location: [Address/Details]
🎫 Booking Reference: #{ID}

What to expect:
• [Brief description of the service]
• Estimated duration: [Time]
• What to bring: [Any requirements]

If you need to cancel or reschedule, please contact us as soon as possible.

We're looking forward to serving you!

Best regards,
[Your Name]
Customer Service Team`
        },
        custom: {
            subject: "Regarding Your Service Booking #{ID}",
            message: `Dear {CUSTOMER},

I hope this message finds you well.

[Your custom message here]

If you have any questions or concerns, please don't hesitate to contact me.

Best regards,
[Your Name]
Customer Service Team`
        }
    };

    // Fetch bookings on load
    window.onload = () => {
        fetchBookings();
    };

    async function fetchBookings() {
        try {
            const res = await axios.get(`${BASE_URL}/bookings.php`);
            const data = res.data;

            if (data.success) {
                allBookings = data.bookings;
                renderBookings();
                updateBookingCount();
            } else {
                Swal.fire("Error", data.message, "error");
            }
        } catch (err) {
            Swal.fire("Error", "Failed to load bookings.", "error");
            console.error("Fetch Error:", err);
        }
    }

    function updateBookingCount() {
        document.getElementById('totalBookings').textContent = allBookings.length;
    }

    function renderBookings() {
        const filtered = filterAndSearchBookings();
        const totalPages = Math.ceil(filtered.length / itemsPerPage);
        const start = (currentPage - 1) * itemsPerPage;
        const paginated = filtered.slice(start, start + itemsPerPage);

        const tbody = document.getElementById("bookingsBody");
        tbody.innerHTML = paginated.length ? '' : `
                    <tr><td colspan="6" class="px-4 py-6 text-center text-gray-500">No bookings found.</td></tr>
                `;

        paginated.forEach(booking => {
            const statusColor = {
                'Pending': 'bg-yellow-100 text-yellow-800',
                'Contacted': 'bg-blue-100 text-blue-700',
                'Scheduled': 'bg-purple-100 text-purple-700',
                'Confirmed': 'bg-green-100 text-green-700',
                'Completed': 'bg-gray-100 text-gray-700',
                'Cancelled': 'bg-red-100 text-red-700'
            } [booking.booking_status] || 'bg-gray-100 text-gray-700';

            const urgencyIndicator = isUrgent(booking.booking_date) ?
                '<span class="inline-block w-2 h-2 bg-red-500 rounded-full mr-2" title="Urgent"></span>' :
                '';

            tbody.innerHTML += `
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3">${urgencyIndicator}#${booking.id}</td>
                            <td class="px-4 py-3">
                                <div class="font-medium">${booking.customer_name}</div>
                                <div class="text-xs text-gray-500">${booking.customer_email}</div>
                            </td>
                            <td class="px-4 py-3">${booking.service_name}</td>
                            <td class="px-4 py-3">${formatDate(booking.booking_date)}</td>
                            <td class="px-4 py-3">
                                <span class="inline-block text-xs font-semibold px-2 py-1 rounded-full ${statusColor}">
                                    ${booking.booking_status}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex flex-col sm:flex-row gap-2">
                                    <!-- 📧 Email button -->
<button class="text-xs bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600"
    onclick="openEmailModal(${booking.id}, '${booking.customer_name}', '${booking.customer_email}', '${booking.service_name}')">
    📧 Email
</button>

<!-- 📨 Email Replies button -->
<button class="text-xs bg-purple-500 text-white px-3 py-1 rounded hover:bg-purple-600 ml-2"
    onclick="openRepliesModal(${booking.id})">
    📨 Email Replies
</button>
                                    <select class="text-xs border rounded px-2 py-1" 
                                        onchange="updateStatus(${booking.id}, this.value)" 
                                        onclick="this.value=this.defaultValue;">
                                        <option disabled selected>Update Status</option>
                                        <option value="Pending">Awaiting Schedule</option>
                                        <option value="Contacted">Customer Contacted</option>
                                        <option value="Scheduled">Date Scheduled</option>
                                        <option value="Confirmed">Schedule Confirmed</option>
                                        <option value="Completed">Service Completed</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    `;
        });

        renderPagination(totalPages);
    }

    function isUrgent(bookingDate) {
        const today = new Date();
        const booking = new Date(bookingDate);
        const diffTime = booking.getTime() - today.getTime();
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        return diffDays <= 3; // Consider urgent if booked within 3 days
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
    }

    function filterAndSearchBookings() {
        let filtered = allBookings;

        const status = document.getElementById('statusFilter').value;
        if (status) {
            filtered = filtered.filter(b => b.booking_status === status);
        }

        const priority = document.getElementById('priorityFilter').value;
        if (priority) {
            filtered = filtered.filter(b => b.priority === priority);
        }

        const start = document.getElementById('startDate').value;
        const end = document.getElementById('endDate').value;
        if (start) filtered = filtered.filter(b => b.booking_date >= start);
        if (end) filtered = filtered.filter(b => b.booking_date <= end);

        const query = document.getElementById('searchInput').value.toLowerCase();
        if (query) {
            filtered = filtered.filter(b =>
                b.customer_name.toLowerCase().includes(query) ||
                b.service_name.toLowerCase().includes(query) ||
                b.id.toString().includes(query)
            );
        }

        return filtered;
    }


    function filterBookings() {
        currentPage = 1;
        renderBookings();
    }

    function renderPagination(totalPages) {
        const container = document.getElementById('paginationContainer');
        if (totalPages <= 1) {
            container.innerHTML = '';
            return;
        }

        let html = `<nav class="inline-flex shadow-sm rounded-md">`;

        for (let i = 1; i <= totalPages; i++) {
            html += `
                        <button class="pagination-btn px-3 py-1 ${i === currentPage 
                            ? 'bg-blue-500 text-white' 
                            : 'bg-white border border-gray-300 hover:bg-gray-100'}"
                                onclick="goToPage(${i})">
                            ${i}
                        </button>`;
        }

        html += `</nav>`;
        container.innerHTML = html;
    }

    function goToPage(page) {
        currentPage = page;
        renderBookings();
    }

    function openEmailModal(id, name, email, service) {
        document.getElementById('modalBookingId').value = id;
        document.getElementById('customerName').value = name;
        document.getElementById('customerEmail').value = email;

        // Set default template
        document.getElementById('emailTemplate').value = 'initial';
        loadEmailTemplate();

        document.getElementById('emailModal').classList.remove('hidden');
    }

    function loadEmailTemplate() {
        const templateKey = document.getElementById('emailTemplate').value;
        const template = emailTemplates[templateKey];
        const bookingId = document.getElementById('modalBookingId').value;
        const customerName = document.getElementById('customerName').value;
        const customerEmail = document.getElementById('customerEmail').value;

        // Find the booking to get service name
        const booking = allBookings.find(b => b.id == bookingId);
        const serviceName = booking ? booking.service_name : 'Service';

        // Replace placeholders
        let subject = template.subject
            .replace('{SERVICE}', serviceName)
            .replace('{ID}', bookingId)
            .replace('{CUSTOMER}', customerName);

        let message = template.message
            .replace(/{SERVICE}/g, serviceName)
            .replace(/{ID}/g, bookingId)
            .replace(/{CUSTOMER}/g, customerName);

        document.getElementById('emailSubject').value = subject;
        document.getElementById('emailMessage').value = message;
    }

    function insertScheduleInfo() {
        const date = document.getElementById('proposedDate').value;
        const time = document.getElementById('proposedTime').value;
        const messageArea = document.getElementById('emailMessage');

        if (date && time) {
            const formattedDate = new Date(date).toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            const formattedTime = new Date(`2000-01-01T${time}`).toLocaleTimeString('en-US', {
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });

            const scheduleText =
                `\n\nProposed Schedule:\n📅 ${formattedDate}\n🕒 ${formattedTime}\n\nPlease confirm if this works for you or suggest an alternative.\n`;
            messageArea.value += scheduleText;
        } else {
            Swal.fire("Info", "Please select both date and time first.", "info");
        }
    }

    function closeModal() {
        document.getElementById('emailModal').classList.add('hidden');
        // Reset form
        document.getElementById('proposedDate').value = '';
        document.getElementById('proposedTime').value = '';
    }

    const successMess = (message) => {
        iziToast.success({
            title: "Success",
            message,
            position: "topRight",
            timeout: 5000
        });
    };

    async function sendEmail() {
        const bookingId = document.getElementById('modalBookingId').value;
        const subject = document.getElementById('emailSubject').value.trim();
        const message = document.getElementById('emailMessage').value.trim();
        const btn = document.querySelector('#emailModal .bg-blue-600');
        const spinner = btn.querySelector('.spinner');

        if (!subject || !message) {
            Swal.fire("Error", "Subject and message are required.", "warning");
            return;
        }

        btn.disabled = true;
        spinner.classList.remove('hidden');

        try {
            const response = await axios.post(
                `${BASE_URL}/sendBookingEmail.php`, {
                    booking_id: bookingId,
                    subject: subject,
                    message: message
                }, {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }
            );

            const data = response.data;

            if (data.status === 'success') {
                successMess("Email sent successfully!");

                // Update status to "Contacted" if it was "Pending"
                const booking = allBookings.find(b => b.id == bookingId);
                if (booking && booking.booking_status === 'Pending') {
                    await updateStatus(bookingId, 'Contacted');
                }

                closeModal();
            } else {
                Swal.fire("Error", data.message || "Failed to send email.", "error");
            }
        } catch (err) {
            let errorMsg = "Network error. Please try again.";
            if (err.response?.data?.message) {
                errorMsg = err.response.data.message;
            }
            Swal.fire("Error", errorMsg, "error");
            console.error("Axios Error:", err);
        } finally {
            btn.disabled = false;
            spinner.classList.add('hidden');
        }
    }



    async function updateStatus(bookingId, status) {
        try {
            // You'll need to implement this endpoint
            const response = await axios.post(
                `${BASE_URL}/updateBookingStatus.php`, {
                    booking_id: bookingId,
                    status: status
                }, {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }
            );

            if (response.data.success) {
                // Update local data
                const booking = allBookings.find(b => b.id == bookingId);
                if (booking) {
                    booking.booking_status = status;
                }
                renderBookings();

                Swal.fire({
                    title: "Status Updated",
                    text: `Booking #${bookingId} status changed to ${status}`,
                    icon: "success",
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                Swal.fire("Error", response.data.message, "error");
            }
        } catch (err) {
            console.error("Status update error:", err);
            Swal.fire("Error", "Failed to update status.", "error");
        }
    }



    function openRepliesModal(bookingId) {
        const modal = document.getElementById("emailRepliesModal");
        const repliesContent = document.getElementById("repliesContent");
        repliesContent.innerHTML = '<p class="text-gray-500">Loading replies...</p>';
        modal.classList.remove("hidden");

        axios.get(`${BASE_URL}/getBookingReplies.php?booking_id=${bookingId}`)
            .then(response => {
                const replies = response.data.replies;
                if (replies.length === 0) {
                    repliesContent.innerHTML = '<p class="text-gray-500">No replies yet.</p>';
                    return;
                }

                repliesContent.innerHTML = '';
                replies.forEach(reply => {
                    repliesContent.innerHTML += `
                    <div class="border rounded p-3 shadow-sm">
                        <div class="text-sm text-gray-600 mb-1"><strong>Subject:</strong> ${reply.subject}</div>
                        <div class="text-sm text-gray-600 mb-1"><strong>From:</strong> ${reply.agent_name}</div>
                        <div class="text-sm text-gray-600 mb-1"><strong>Date:</strong> ${reply.reply_date}</div>
                        <div class="text-gray-800 mt-2">${reply.message}</div>
                    </div>
                `;
                });
            })
            .catch(error => {
                repliesContent.innerHTML = '<p class="text-red-500">Failed to load replies.</p>';
                console.error("Fetch Replies Error:", error);
            });
    }

    function closeRepliesModal() {
        document.getElementById("emailRepliesModal").classList.add("hidden");
    }
    </script>