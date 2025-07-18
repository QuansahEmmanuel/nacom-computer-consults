<!-- Navbar -->
<div class="navbar bg-base-100 shadow-lg">
    <div class="flex-1">
        <h1 class="text-xl font-bold">User Management Dashboard</h1>
    </div>
    <div class="flex-none">
        <button class="btn btn-primary" onclick="openAddUserModal()">
            <i data-lucide="user-plus" class="w-4 h-4"></i>
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
            <button class="btn btn-outline" onclick="clearFilters()">Clear Filters</button>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-base-100 shadow-lg rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead class="bg-base-200">
                    <tr>
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
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar placeholder">
                                    <div class="bg-neutral text-neutral-content rounded-full w-12">
                                        <span class="text-xs">JD</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold">John Doe</div>
                                </div>
                            </div>
                        </td>
                        <td>john.doe@example.com</td>
                        <td><span class="badge badge-primary">Administrator</span></td>
                        <td><span class="badge badge-success">Active</span></td>
                        <td>Jan 15, 2024</td>
                        <td>
                            <div class="flex gap-2">
                                <button class="btn btn-sm btn-outline" onclick="openEditUserModal()">
                                    <i class="fa-solid fa-user-pen"></i>
                                </button>
                                <button class="btn btn-sm btn-error btn-outline" onclick="openDeleteModal()">
                                    <i class="fa-solid fa-user-xmark"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Add more rows as needed -->
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar placeholder">
                                    <div class="bg-neutral text-neutral-content rounded-full w-12">
                                        <span class="text-xs">JS</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold">Jane Smith</div>
                                </div>
                            </div>
                        </td>
                        <td>jane.smith@example.com</td>
                        <td>
                            <span class="badge badge-secondary">Support Agent</span>
                        </td>
                        <td>
                            <span class="badge badge-success">Active</span>
                        </td>
                        <td>Feb 20, 2024</td>
                        <td>
                            <div class="flex gap-2">
                                <button class="btn btn-sm btn-outline">
                                    <i class="fa-solid fa-user-pen"></i>

                                </button>
                                <button class="btn btn-sm btn-error btn-outline">
                                    <i class="fa-solid fa-user-xmark"></i>
                                </button>
                            </div>
                        </td>
                    </tr>



                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Responsive Add/Edit User Modal -->
<dialog id="userModal" class="modal">
    <div class="modal-box w-full sm:w-11/12 md:max-w-xl px-4 py-6">
        <!-- Close Button -->
        <form method="dialog" class="absolute right-4 top-4">
            <button class="btn btn-sm btn-circle btn-ghost">✕</button>
        </form>

        <!-- Modal Title -->
        <h3 class="font-bold text-xl mb-6 text-center" id="modalTitle">
            Add New User
        </h3>

        <!-- Main Form -->
        <form id="userForm" class="space-y-4">
            <!-- Username -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Username</span>
                </label>
                <input type="text" class="input input-bordered w-full" id="username" name="username" required
                    autocomplete="username" />
            </div>

            <!-- Email -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Email</span>
                </label>
                <input type="email" class="input input-bordered w-full" id="email" name="email" required
                    autocomplete="email" />
            </div>

            <!-- Responsive 2-Column for Role/Status on md+, stacked on mobile -->
            <div class="flex flex-col md:flex-row gap-4">
                <!-- Role -->
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Role</span>
                    </label>
                    <select class="select select-bordered w-full" id="role" name="role" required>
                        <option value="">Select Role</option>
                        <option value="admin">Administrator</option>
                        <option value="support">Support Agent</option>
                        <option value="customer">Customer</option>
                    </select>
                </div>

                <!-- Status -->
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Status</span>
                    </label>
                    <select class="select select-bordered w-full" id="status" name="status" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Password -->
            <div class="form-control w-full" id="passwordSection">
                <label class="label">
                    <span class="label-text">Password</span>
                </label>
                <input type="password" class="input input-bordered w-full" id="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-2 mt-6 modal-action">
                <button type="button" class="btn btn-ghost" onclick="closeUserModal()">Cancel</button>
                <button type="submit" class="btn btn-primary" id="submitBtn">Add User</button>
            </div>
        </form>
    </div>
</dialog>

<!-- Delete Confirmation Modal -->
<dialog id="deleteModal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Confirm Delete</h3>
        <p class="py-4">Are you sure you want to delete this user? This action cannot be undone.</p>
        <div class="modal-action">
            <button class="btn btn-ghost" onclick="closeDeleteModal()">Cancel</button>
            <button class="btn btn-error" id="confirmDeleteBtn">Delete</button>
        </div>
    </div>
</dialog>

<!-- JavaScript for Modal Functionality -->
<script>
// Open Add User Modal
function openAddUserModal() {
    document.getElementById('modalTitle').textContent = 'Add New User';
    document.getElementById('submitBtn').textContent = 'Add User';
    document.getElementById('passwordSection').style.display = 'block'; // Show password field for add
    document.getElementById('userForm').reset();
    document.getElementById('userModal').showModal();
}

// Open Edit Modal (Example)
function openEditUserModal() {
    document.getElementById('modalTitle').textContent = 'Edit User';
    document.getElementById('submitBtn').textContent = 'Save Changes';
    document.getElementById('passwordSection').style.display = 'none'; // Hide password for edit
    document.getElementById('userForm').reset();
    document.getElementById('userModal').showModal();
}

// Open Delete Modal (Example)
function openDeleteModal() {
    document.getElementById('deleteModal').showModal();
}

// Close Modals
function closeUserModal() {
    document.getElementById('userModal').close();
}

function closeDeleteModal() {
    document.getElementById('deleteModal').close();
}

// Handle form submission
document.getElementById('userForm').addEventListener('submit', function(e) {
    e.preventDefault();
    closeUserModal();
    // Add your save logic here
});

// Clear filters (example)
function clearFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('roleFilter').value = '';
    document.getElementById('statusFilter').value = '';
}
</script>