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
            <div class="stat-value text-primary" id="total_users"></div>
        </div>
        <div class="stat bg-base-100 shadow-lg rounded-lg">
            <div class="stat-figure text-secondary">
                <i data-lucide="shield" class="w-8 h-8"></i>
            </div>
            <div class="stat-title">Administrators</div>
            <div class="stat-value text-secondary" id="admin_users"></div>
        </div>
        <div class="stat bg-base-100 shadow-lg rounded-lg">
            <div class="stat-figure text-accent">
                <i data-lucide="headphones" class="w-8 h-8"></i>
            </div>
            <div class="stat-title">Support Agents</div>
            <div class="stat-value text-accent" id="support_users"></div>
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
<dialog id="my_modal_delete" class="modal">
    <div class="modal-box w-11/12 max-w-5xl">
        <h3 class="text-lg font-bold">Delete User</h3>
        <p class="py-4">Are you sure you want to delete User</p>
        <input type="hidden" id="delete_user_id" />
        <div class="modal-action">
            <button type="button" onclick="deleteUser()" class="btn btn-error"><i class="fa-solid fa-trash"></i>
                Delete</button>
            <form method="dialog">
                <!-- if there is a button, it will close the modal -->
                <button class="btn"> Close X</button>
            </form>
        </div>
    </div>
</dialog>

<!-- Edit User Modal -->
<dialog id="my_modal_edit_user" class="modal">
    <div class="modal-box w-11/12 max-w-2xl p-6 rounded-2xl shadow-lg">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-semibold text-gray-800">Edit User</h3>
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost hover:bg-gray-200">✕</button>
            </form>
        </div>

        <!-- Error Message -->
        <div class="space-y-2 mb-4">
            <div id="edit_error_div" class="hidden">
                <div class="alert alert-error shadow-sm text-sm py-2 px-4">
                    <span id="edit_error_text"></span>
                </div>
            </div>

        </div>

        <!-- Form -->
        <form class="space-y-5">

            <input type="hidden" id="edit_user_id" />
            <!-- Username -->
            <div>
                <label class="label font-medium text-sm text-gray-700" for="edit_username">Username</label>
                <input type="text" id="edit_username" class="input input-bordered w-full" placeholder="Enter username"
                    autocomplete="username" />
            </div>

            <!-- Email -->
            <div>
                <label class="label font-medium text-sm text-gray-700" for="edit_email">Email</label>
                <input type="email" id="edit_email" class="input input-bordered w-full" placeholder="Enter email"
                    autocomplete="email" />
            </div>

            <!-- Role & Status -->
            <div class="flex flex-col md:flex-row gap-4">
                <div class="w-full">
                    <label class="label font-medium text-sm text-gray-700" for="edit_role">Role</label>
                    <select id="edit_role" class="select select-bordered w-full">
                        <option value="">Select Role</option>
                        <option value="admin">Administrator</option>
                        <option value="support">Support Agent</option>
                        <option value="customer">Customer</option>
                    </select>
                </div>

                <div class="w-full">
                    <label class="label font-medium text-sm text-gray-700" for="edit_status">Status</label>
                    <select id="edit_status" class="select select-bordered w-full">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Password -->
            <div>
                <label class="label font-medium text-sm text-gray-700" for="edit_password">Password</label>
                <input type="password" id="edit_password" class="input input-bordered w-full"
                    placeholder="Create a secure password" autocomplete="new-password" />
            </div>

            <!-- Actions -->
            <div class="modal-action mt-6 flex justify-end gap-2">
                <button type="button" onclick="editUser()" class="btn btn-primary"> Edit User</button>
                <form method="dialog">
                    <button class="btn btn-outline">X Cancel</button>
                </form>
            </div>
        </form>
    </div>
</dialog>



<script>
    //Base Url
    const BASE_URL = "http://localhost/nacom-computer-consults/api/auth"

    // Total User Fuctionality 
    const totalUsers = async () => {
        try {
            const res = await axios.get(`${BASE_URL}/viewUser.php`);
            const data = res.data;

            if (data.status === "success") {
                const count = data.data.length;
                document.getElementById("total_users").innerHTML = count;
            } else {
                console.error("Failed to fetch user count.");
                document.getElementById("total_users").innerHTML = 0;
            }
        } catch (error) {
            console.error("Error fetching users:", error);
            document.getElementById("total_users").innerHTML = 0;
        }
    };
    totalUsers();

    // Admin User Functionality
    const adminUsers = async () => {
        try {
            const res = await axios.get(`${BASE_URL}/viewUser.php`);
            const data = res.data;

            if (data.status === "success") {
                // Filter users with role === "admin" and count them
                const adminCount = data.data.filter(user => user.role === "admin").length;
                document.getElementById("admin_users").innerHTML = adminCount;
            } else {
                console.error("Failed to fetch user count.");
                document.getElementById("admin_users").innerHTML = 0;
            }
        } catch (error) {
            console.error("Error fetching users:", error);
            document.getElementById("admin_users").innerHTML = 0;
        }
    };

    adminUsers(); // Run on page load


    // Support User Functionality
    const supportUsers = async () => {
        try {
            const res = await axios.get(`${BASE_URL}/viewUser.php`);
            const data = res.data;

            if (data.status === "success") {
                // Count how many users have role = "support"
                const supportCount = data.data.filter(user => user.role === "support").length;
                document.getElementById("support_users").innerHTML = supportCount;
            } else {
                console.error("Failed to fetch support user count.");
                document.getElementById("support_users").innerHTML = 0;
            }
        } catch (error) {
            console.error("Error fetching support users:", error);
            document.getElementById("support_users").innerHTML = 0;
        }
    };

    supportUsers(); // Run it on page load

    //...........................................................................
    // Get All Users from Backend 

    let allUsers = []; // Store all users globally

    // Render Users Function (called on initial load and filter)
    const renderUsers = (users) => {
        const tableBody = document.getElementById("usersTableBody");
        tableBody.innerHTML = ""; // Clear previous content

        if (users.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="7" class="text-center text-red-500">No users match your filters</td></tr>`;
            return;
        }

        users.forEach((user, index) => {
            const row = document.createElement("tr");
            row.innerHTML = `
            <td>
                <div class="p-3">
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
                    <button class="btn btn-sm btn-outline" onclick="openEditModal(
                        ${user.id}, 
                        '${user.username}', 
                        '${user.email}', 
                        '${user.role}', 
                        '${user.status}', 
                        '${user.password}'
                    )">
                        <i class="fa-solid fa-user-pen"></i>
                    </button>

                    <button class="btn btn-sm btn-error btn-outline" onclick="openDeleteModal(${user.id})">
                        <i class="fa-solid fa-user-xmark"></i>
                    </button>
                </div>
            </td>
        `;
            tableBody.appendChild(row);
        });
    };

    // Fetch all users
    const viewUsers = async () => {
        try {
            const res = await axios.get(`${BASE_URL}/viewUser.php`);
            const { status, data } = res.data;

            if (status === "success") {
                allUsers = data;
                renderUsers(allUsers);
            } else {
                document.getElementById("usersTableBody").innerHTML =
                    `<tr><td colspan="7" class="text-center text-red-500">No users found</td></tr>`;
            }
        } catch (error) {
            console.error("Error loading users:", error);
            document.getElementById("usersTableBody").innerHTML =
                `<tr><td colspan="7" class="text-center text-red-500">Server error</td></tr>`;
        }
    };

    // Filter logic
    const filterUsers = () => {
        const searchText = document.getElementById("searchInput").value.toLowerCase();
        const role = document.getElementById("roleFilter").value;
        const status = document.getElementById("statusFilter").value;

        const filtered = allUsers.filter(user => {
            const matchSearch = user.username.toLowerCase().includes(searchText) ||
                user.email.toLowerCase().includes(searchText);
            const matchRole = role ? user.role === role : true;
            const matchStatus = status ? user.status === status : true;

            return matchSearch && matchRole && matchStatus;
        });

        renderUsers(filtered);
    };

    // Clear filters
    const clearFilters = () => {
        document.getElementById("searchInput").value = "";
        document.getElementById("roleFilter").value = "";
        document.getElementById("statusFilter").value = "";
        renderUsers(allUsers);
    };

    // Event listeners
    document.getElementById("searchInput").addEventListener("input", filterUsers);
    document.getElementById("roleFilter").addEventListener("change", filterUsers);
    document.getElementById("statusFilter").addEventListener("change", filterUsers);
    document.querySelector(".btn.btn-outline").addEventListener("click", clearFilters);

    // Load users initially
    viewUsers();


    //..................................................
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
                if (typeof viewUsers === "function") viewUsers(); totalUsers(); adminUsers(); supportUsers();
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
    //...................................................................

    // Delete User 

    // opens and assigns id to to delete user modal
    const openDeleteModal = (id) => {
        const ID = document.getElementById("delete_user_id").value = id;
        document.getElementById("my_modal_delete").showModal();
        // console.log(ID);
    }

    // delets the user 
    const deleteUser = async () => {
        const userId = document.getElementById("delete_user_id").value;

        try {
            const res = await axios.post(`${BASE_URL}/deleteUser.php`, {
                user_id: userId
            });

            const data = res.data;

            if (data.status === "success") {
                viewUsers(); totalUsers(); adminUsers(); supportUsers();

                document.getElementById("my_modal_delete").close();
                successMess(data.message) || "User deleted successfully.";
                // Refresh user list

            } else {
                errorMess(data.message) || "Failed to delete user.";

            }

        } catch (err) {
            console.error(err);

            error_text.textContent = "Server error. Please try again.";
            error_div.classList.remove("hidden");

            setTimeout(() => {
                error_div.classList.add("hidden");
            }, 3000);
        }
    }

    // opens and assigns id to to edit user modal
    const openEditModal = (id, user_name, user_email, user_role, user_status, user_password) => {

        const user_id = document.getElementById("edit_user_id").value = id;
        const username = document.getElementById("edit_username").value = user_name;
        const email = document.getElementById("edit_email").value = user_email;
        const role = document.getElementById("edit_role").value = user_role;
        const status = document.getElementById("edit_status").value = user_status;
        const password = document.getElementById("edit_password").value = user_password;

        document.getElementById("my_modal_edit_user").showModal();

    }

    //Edit user 
    const editUser = async () => {
        const user_id = document.getElementById("edit_user_id").value.trim();
        const username = document.getElementById("edit_username").value.trim();
        const email = document.getElementById("edit_email").value.trim();
        const role = document.getElementById("edit_role").value.trim();
        const status = document.getElementById("edit_status").value.trim();
        const password = document.getElementById("edit_password").value.trim();


        // error message 
        const error_div = document.getElementById("edit_error_div");
        const error_text = document.getElementById("edit_error_text");

        // Reset messages
        error_div.classList.add("hidden");



        // Optional: basic validation
        if (!username || !email || !role || !status) {
            error_text.innerHTML = "Please fill in all required fields.", "error"
            error_div.classList.remove("hidden");
            return
        } else {
            // Reset messages
            error_div.classList.add("hidden");

        }

        try {
            const res = await axios.post(`${BASE_URL}/editUser.php`, {
                user_id,
                username,
                email,
                role,
                status,
                password
            });

            const data = res.data;

            if (data.status === "success") {
                error_div.classList.add("hidden");
                viewUsers(); totalUsers(); adminUsers(); supportUsers();
                successMess(data.message) || "User updated successfully.";
                document.getElementById("my_modal_edit_user").close();

            } else {
                error_text.innerHTML = "Failed to update user.", "error"
                error_div.classList.remove("hidden");
            }
        } catch (err) {
            console.error(err);
            error_text.innerHTML = "Server error while updating user.", "error"
            error_div.classList.remove("hidden");
        }
    };


</script>