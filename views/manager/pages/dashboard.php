<!-- Dashboard Content -->
<div id="dashboard-content" class="page-content">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div
            class="stat-card border border-gray-200 rounded-lg p-4 transition transform hover:bg-blue-100 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Bookings</p>
                    <p class="text-3xl font-bold text-gray-800" id="total_booking"></p>
                    <p class="text-green-600 text-sm">+12% from last month</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div
            class="stat-card border border-gray-200 rounded-lg p-4 transition transform hover:bg-green-100 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Enquiries</p>
                    <p class="text-3xl font-bold text-gray-800" id="total_enquiries"></p>
                    <p class="text-green-600 text-sm">+8% from last month</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-question-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div
            class="stat-card border border-gray-200 rounded-lg p-4 transition transform hover:bg-purple-100 hover:-translate-y-1 ">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Services</p>
                    <p class="text-3xl font-bold text-gray-800" id="total_service"></p>
                    <p class="text-gray-600 text-sm">18% from last month</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-cog text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div
            class="stat-card border border-gray-200 rounded-lg p-4 transition transform hover:bg-orange-100 hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Revenue</p>
                    <p class="text-3xl font-bold text-gray-800">₵2.4M</p>
                    <p class="text-green-600 text-sm">+15% from last month</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>



    <!-- Recent Bookings and Quick Actions Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Bookings</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">CUSTOMER</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">SERVICE</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">DATE</th>
                            <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">STATUS</th>
                        </tr>
                    </thead>
                    <tbody id="recent_bookings_table_body">
                        <!-- Will be populated by JS -->
                    </tbody>

                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <div
                    class="flex items-center p-3 bg-blue-50 rounded-lg cursor-pointer hover:bg-blue-100 transition-colors">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-calendar-plus text-white"></i>
                    </div>
                    <div>
                        <a href="index.php?page=bookings">
                            <p class="font-medium text-gray-800">Manage Bookings</p>
                            <p class="text-sm text-gray-600">View and Assign customer bookings</p>
                        </a>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto"></i>
                </div>

                <div
                    class="flex items-center p-3 bg-green-50 rounded-lg cursor-pointer hover:bg-green-100 transition-colors">
                    <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-question-circle text-white"></i>
                    </div>
                    <div>
                        <a href="index.php?page=enquiries">
                            <p class="font-medium text-gray-800">Review Enquiries</p>
                            <p class="text-sm text-gray-600"> View And Assign customer enquiries</p>
                        </a>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto"></i>
                </div>

                <div
                    class="flex items-center p-3 bg-purple-50 rounded-lg cursor-pointer hover:bg-purple-100 transition-colors">
                    <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-cogs text-white"></i>
                    </div>
                    <div>
                        <a href="index.php?page=services">
                            <p class="font-medium text-gray-800">Manage Services</p>
                            <p class="text-sm text-gray-600">View All services</p>
                        </a>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
const BASE_URL = "http://localhost/nacom-computer-consults/api/admin";


const loadRecentBookings = async () => {
    const tbody = document.getElementById("recent_bookings_table_body");

    try {
        const res = await axios.get(`${BASE_URL}/dashboard.php`);
        const data = res.data;

        if (data.status === "success" && Array.isArray(data.recent_bookings)) {
            tbody.innerHTML = ""; // clear existing rows

            data.recent_bookings.forEach(booking => {
                const row = document.createElement("tr");
                row.className = "table-row border-b border-gray-100";

                // Choose badge color by status
                let statusColor = "gray";
                switch (booking.status.toLowerCase()) {
                    case "confirmed":
                        statusColor = "green";
                        break;
                    case "pending":
                        statusColor = "yellow";
                        break;
                    case "completed":
                        statusColor = "blue";
                        break;
                    case "in progress":
                        statusColor = "orange";
                        break;
                }

                row.innerHTML = `
                    <td class="py-3 px-4 text-sm text-gray-800">${booking.customer}</td>
                    <td class="py-3 px-4 text-sm text-gray-600">${booking.service}</td>
                    <td class="py-3 px-4 text-sm text-gray-600">${booking.booking_date}</td>
                    <td class="py-3 px-4">
                        <span class="bg-${statusColor}-100 text-${statusColor}-800 px-2 py-1 rounded-full text-xs">
                            ${booking.status}
                        </span>
                    </td>
                `;

                tbody.appendChild(row);
            });
        } else {
            tbody.innerHTML =
                `<tr><td colspan="4" class="py-3 px-4 text-center text-sm text-gray-500">No bookings found.</td></tr>`;
        }
    } catch (error) {
        console.error("Failed to load recent bookings:", error);
        tbody.innerHTML =
            `<tr><td colspan="4" class="py-3 px-4 text-center text-sm text-red-500">Error loading data.</td></tr>`;
    }
};

// Run on page load
loadRecentBookings();


const getTotalBookinds = async () => {
    const totalBookingEl = document.getElementById("total_booking");

    try {
        const res = await axios.get(`${BASE_URL}/dashboard.php`);
        const data = res.data;

        if (data.status === "success" && data.total_bookings !== undefined) {
            totalBookingEl.innerText = data.total_bookings;
        } else {
            totalBookingEl.innerText = "0";
            console.error("No booking data received.");
        }
    } catch (error) {
        console.error("Failed to fetch total bookings:", error);
        totalBookingEl.innerText = "0";
    }
};

getTotalBookinds();

const getTotalEnquires = async () => {
    const totalEnquiresEl = document.getElementById("total_enquiries");

    try {
        const res = await axios.get(`${BASE_URL}/dashboard.php`);
        const data = res.data;

        if (data.status === "success" && data.total_enquiries !== undefined) {
            totalEnquiresEl.innerText = data.total_enquiries;
        } else {
            totalEnquiresEl.innerText = "0";
            console.error("No Enquiries data received.");
        }
    } catch (error) {
        console.error("Failed to fetch total Enquiries:", error);
        totalEnquiresEl.innerText = "0";
    }
};
getTotalEnquires()


const getTotalServices = async () => {
    const totalServiceEl = document.getElementById("total_service");

    try {
        const res = await axios.get(`${BASE_URL}/dashboard.php`);
        const data = res.data;

        if (data.status === "success" && data.total_service !== undefined) {
            totalServiceEl.innerText = data.total_service;
        } else {
            totalServiceEl.innerText = "0";
            console.error("No Service data received.");
        }
    } catch (error) {
        console.error("Failed to fetch total Service:", error);
        totalServiceEl.innerText = "0";
    }
};

getTotalServices()
</script>