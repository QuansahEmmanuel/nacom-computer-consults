<!-- Navbar -->
<div class="navbar bg-base-100 shadow-lg">
    <div class="flex-1">
        <h1 class="text-xl font-bold">User Management Dashboard</h1>
    </div>
    <div class="flex-none">
        <button class="btn btn-primary" onclick="my_modal_adduser.showModal()" class=" w-4 h-4">
            <i class="fa-solid fa-user-plus"></i>
            Add User
        </button>
    </div>
</div>

<!-- Main Content -->
<div class="container mx-auto mt-8">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="stat bg-base-100 shadow-lg rounded-lg">
            <div class="stat-figure text-primary">
                <i data-lucide="users" class="w-8 h-8"></i>
            </div>
            <div class="stat-title">Total Users</div>
            <div class="stat-value text-primary">4</div>
        </div>
        <div class="stat bg-base-100 shadow-lg rounded-lg">
            <div class="stat-figure text-secondary">
                <i data-lucide="shield" class="w-8 h-8"></i>
            </div>
            <div class="stat-title">Administrators</div>
            <div class="stat-value text-secondary">1</div>
        </div>
        <div class="stat bg-base-100 shadow-lg rounded-lg">
            <div class="stat-figure text-accent">
                <i data-lucide="headphones" class="w-8 h-8"></i>
            </div>
            <div class="stat-title">Support Agents</div>
            <div class="stat-value text-accent">2</div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-base-100 shadow-lg rounded-lg p-6 mb-6">
        <div class="flex flex-wrap gap-4 items-center">
            <div class="form-control">
                <input type="text" placeholder="Search users..." class="input input-bordered w-full max-w-xs"
                    id="searchInput">
            </div>
            <div class="form-control">
                <select class="select select-bordered" id="roleFilter">
                    <option value="">All Roles</option>
                    <option value="admin">Administrator</option>
                    <option value="support">Support Agent</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="form-control">
                <select class="select select-bordered" id="statusFilter">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <button class="btn btn-outline">Clear Filters</button>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-base-100 shadow-lg rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead class="bg-base-200">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="usersTableBody">
                    <!-- Sample Row -->


                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<dialog id="my_modal_adduser" class="modal">
    <div class="modal-box w-11/12 max-w-2xl p-6 rounded-2xl shadow-lg">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-semibold text-gray-800">Add New User</h3>
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost hover:bg-gray-200">✕</button>
            </form>
        </div>

        <!-- Alerts -->
        <div class="space-y-2 mb-4">
            <div id="error_div" class="hidden">
                <div class="alert alert-error shadow-sm text-sm py-2 px-4">
                    <span id="error_text"></span>
                </div>
            </div>
            <div id="success_div" class="hidden">
                <div class="alert alert-success shadow-sm text-sm py-2 px-4">
                    <span id="success_text"></span>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form id="userForm" class="space-y-5">
            <!-- Username -->
            <div>
                <label class="label font-medium text-sm text-gray-700" for="username">Username</label>
                <input type="text" id="username" name="username" class="input input-bordered w-full"
                    placeholder="Enter username" autocomplete="username" />
            </div>

            <!-- Email -->
            <div>
                <label class="label font-medium text-sm text-gray-700" for="email">Email</label>
                <input type="email" id="email" name="email" class="input input-bordered w-full"
                    placeholder="Enter email" autocomplete="email" />
            </div>

            <!-- Role & Status -->
            <div class="flex flex-col md:flex-row gap-4">
                <div class="w-full">
                    <label class="label font-medium text-sm text-gray-700" for="role">Role</label>
                    <select id="role" name="role" class="select select-bordered w-full">
                        <option value="">Select Role</option>
                        <option value="admin">Administrator</option>
                        <option value="support">Support Agent</option>
                        <option value="customer">Customer</option>
                    </select>
                </div>

                <div class="w-full">
                    <label class="label font-medium text-sm text-gray-700" for="status">Status</label>
                    <select id="status" name="status" class="select select-bordered w-full">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Password -->
            <div>
                <label class="label font-medium text-sm text-gray-700" for="password">Password</label>
                <input type="password" id="password" name="password" class="input input-bordered w-full"
                    placeholder="Create a secure password" autocomplete="new-password" />
            </div>

            <!-- Actions -->
            <div class="modal-action mt-6 flex justify-end gap-2">
                <button type="button" id="submitBtn" class="btn btn-primary">+ Add User</button>
                <form method="dialog">
                    <button class="btn btn-outline">Cancel</button>
                </form>
            </div>
        </form>
    </div>
</dialog>


<!-- Delete Modal  -->
<dialog id="my_modal_4" class="modal">
    <div class="modal-box w-11/12 max-w-5xl">
        <h3 class="text-lg font-bold">Delete User</h3>
        <p class="py-4">Are you sure you want to delete User</p>
        <div class="modal-action">
            <button type="button" id="deleteBtn" class="btn btn-error"><i class="fa-solid fa-trash"></i>
                Delete</button>
            <form method="dialog">
                <!-- if there is a button, it will close the modal -->
                <button class="btn"> Close X</button>
            </form>
        </div>
    </div>
</dialog>


<script>
//Base Url
const BASE_URL = "http://localhost/nacom-computer-consults/api/auth"


// Get All Users from Backend 
const viewUsers = async () => {
    try {
        const res = await axios.get(`${BASE_URL}/viewUser.php`);
        const {
            status,
            data
        } = res.data;

        const tableBody = document.getElementById("usersTableBody");
        tableBody.innerHTML = ""; // Clear previous content

        if (status === "success") {
            data.forEach((user, index) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                                <td>
                                    <div class= "p-3">
                                        <span class="text-xs">${index + 1}</span>
                                    </div>
                                    </td>
                                <td>
                                    <div class="font-bold">${user.username}</div>
                                </td>
                                <td>${user.email}</td>
                                <td><span class="badge badge-primary">${user.role}</span></td>
                                <td><span class="badge ${user.status === "active" ? "badge-success" : "badge-error"}">${user.status}</span></td>
                                <td>${new Date(user.created_at).toLocaleDateString()}</td>
                                <td>
                                    <div class="flex gap-2">
                                        <button class="btn btn-sm btn-outline" onclick="openEditUserModal(${user.id})">
                                            <i class="fa-solid fa-user-pen"></i>
                                        </button>
                                        <button class="btn btn-sm btn-error btn-outline" onclick="my_modal_4.showModal(${user.id})">
                                            <i class="fa-solid fa-user-xmark"></i>
                                        </button>
                                    </div>
                                </td>
                            `;
                tableBody.appendChild(row);
            });

        } else {
            tableBody.innerHTML =
                `<tr><td colspan="6" class="text-center text-red-500">No users found</td></tr>`;
        }
    } catch (error) {
        console.error("Error loading users:", error);
        document.getElementById("usersTableBody").innerHTML =
            `<tr><td colspan="6" class="text-center text-red-500">Server error</td></tr>`;
    }
};

viewUsers();
// ......................................

// Add Users  
document.getElementById("submitBtn").addEventListener("click", async () => {
    const userName = document.getElementById("username").value.trim();
    const email = document.getElementById("email").value.trim();
    const role = document.getElementById("role").value.trim();
    const status = document.getElementById("status").value.trim();
    const password = document.getElementById("password").value.trim();

    const error_div = document.getElementById("error_div");
    const error_text = document.getElementById("error_text");
    const success_div = document.getElementById("success_div");
    const success_text = document.getElementById("success_text");

    // Reset messages
    error_div.classList.add("hidden");
    success_div.classList.add("hidden");

    // Validation
    if (!userName || !email || !role || !status || !password) {
        error_text.textContent = "All fields are required.";
        error_div.classList.remove("hidden");

        // Auto-hide error after 5 seconds
        setTimeout(() => {
            error_div.classList.add("hidden");
        }, 5000);

        return;
    }

    try {
        const res = await axios.post(`${BASE_URL}/addUser.php`, {
            username: userName,
            email: email,
            role: role,
            status: status,
            password: password
        });

        const data = res.data;

        if (data.status === "success") {
            success_text.textContent = data.message || "User added successfully!";
            success_div.classList.remove("hidden");

            // Auto-hide success after 5 seconds
            setTimeout(() => {
                success_div.classList.add("hidden");
            }, 5000);

            // Optionally, reset form fields
            document.getElementById("username").value = "";
            document.getElementById("email").value = "";
            document.getElementById("role").value = "";
            document.getElementById("status").value = "";
            document.getElementById("password").value = "";

            // Refresh table (if needed)
            if (typeof viewUsers === "function") viewUsers();
        } else {
            error_text.textContent = data.message || "Failed to add user.";
            error_div.classList.remove("hidden");

            // Auto-hide error after 5 seconds
            setTimeout(() => {
                error_div.classList.add("hidden");
            }, 5000);
        }

    } catch (err) {
        console.error(err);
        error_text.textContent = "Server error. Please try again.";
        error_div.classList.remove("hidden");

        // Auto-hide error after 5 seconds
        setTimeout(() => {
            error_div.classList.add("hidden");
        }, 5000);
    }
});


// Delete User 
</script>