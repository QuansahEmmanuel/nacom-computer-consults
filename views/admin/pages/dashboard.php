<!-- Dashboard Content -->
<div id="dashboard-content" class="page-content">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="stat-card">
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

        <div class="stat-card">
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

        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Services</p>
                    <p class="text-3xl font-bold text-gray-800" id="total_service"></p>
                    <p class="text-gray-600 text-sm">0% from last month</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-cog text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="stat-card">
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
                    <tbody>
                        <tr class="table-row border-b border-gray-100">
                            <td class="py-3 px-4 text-sm text-gray-800">John Doe</td>
                            <td class="py-3 px-4 text-sm text-gray-600">IT Support</td>
                            <td class="py-3 px-4 text-sm text-gray-600">2024-01-15</td>
                            <td class="py-3 px-4"><span
                                    class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Confirmed</span>
                            </td>
                        </tr>
                        <tr class="table-row border-b border-gray-100">
                            <td class="py-3 px-4 text-sm text-gray-800">Jane Smith</td>
                            <td class="py-3 px-4 text-sm text-gray-600">Network Setup</td>
                            <td class="py-3 px-4 text-sm text-gray-600">2024-01-16</td>
                            <td class="py-3 px-4"><span
                                    class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Pending</span>
                            </td>
                        </tr>
                        <tr class="table-row border-b border-gray-100">
                            <td class="py-3 px-4 text-sm text-gray-800">Mike Johnson</td>
                            <td class="py-3 px-4 text-sm text-gray-600">Security Audit</td>
                            <td class="py-3 px-4 text-sm text-gray-600">2024-01-17</td>
                            <td class="py-3 px-4"><span
                                    class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Completed</span>
                            </td>
                        </tr>
                        <tr class="table-row border-b border-gray-100">
                            <td class="py-3 px-4 text-sm text-gray-800">Sarah Wilson</td>
                            <td class="py-3 px-4 text-sm text-gray-600">Data Recovery</td>
                            <td class="py-3 px-4 text-sm text-gray-600">2024-01-18</td>
                            <td class="py-3 px-4"><span
                                    class="bg-orange-100 text-orange-800 px-2 py-1 rounded-full text-xs">In
                                    Progress</span></td>
                        </tr>
                        <tr class="table-row">
                            <td class="py-3 px-4 text-sm text-gray-800">David Brown</td>
                            <td class="py-3 px-4 text-sm text-gray-600">Cloud Migration</td>
                            <td class="py-3 px-4 text-sm text-gray-600">2024-01-19</td>
                            <td class="py-3 px-4"><span
                                    class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Confirmed</span>
                            </td>
                        </tr>
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
                            <p class="text-sm text-gray-600">View and manage customer bookings</p>
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
                            <p class="text-sm text-gray-600">Respond to customer enquiries</p>
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
                            <p class="text-sm text-gray-600">Add or edit service offerings</p>
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