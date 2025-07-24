<!-- Services Content -->
<div id="services-content" class="page-content ">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <!-- <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Service Management</h3>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors"
                title="Add Service" onclick="openAddServiceModal()">
                <i class="fas fa-plus mr-2"></i>Add Service
            </button>
        </div> -->

        <div id="services_container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Dynamic cards will be injected here -->
        </div>

    </div>
</div>


<!-- Add Service Modal -->
<dialog id="add_service_modal" class="modal">
    <div class="modal-box max-w-3xl w-full p-8 bg-white rounded-xl shadow-xl">
        <h3 class="font-bold text-2xl text-gray-800 mb-6">Add Service</h3>

        <!-- Success Message -->
        <div id="service_success_message_div"
            class="hidden mb-6 p-4 bg-green-100 text-green-800 border border-green-300 rounded-lg flex items-center gap-3 text-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span id="service_success_message_text"></span>
        </div>

        <!-- Error Message -->
        <div id="service_error_message_div"
            class="hidden mb-6 p-4 bg-red-100 text-red-800 border border-red-300 rounded-lg flex items-center gap-3 text-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span id="service_error_message_text"></span>
        </div>

        <!-- Service Form -->
        <form id="service_form" class="grid md:grid-cols-2 gap-6 text-lg">
            <!-- Service Name -->
            <div>
                <label class="block font-semibold text-gray-700 mb-2">
                    Service Name / Title <span class="text-red-600">*</span>
                </label>
                <input id="service_name" name="service_name" type="text" placeholder="e.g. IT Support"
                    class="w-full border border-gray-300 p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
            </div>

            <!-- Service Price -->
            <div>
                <label class="block font-semibold text-gray-700 mb-2">
                    Service Price GH₵ <span class="text-red-600">*</span>
                </label>
                <input id="service_price" name="service_price" type="number" placeholder="GHC 0.00"
                    class="w-full border border-gray-300 p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
            </div>

            <!-- Service Description -->
            <div class="md:col-span-2">
                <label class="block font-semibold text-gray-700 mb-2">
                    Service Description <span class="text-red-600">*</span>
                </label>
                <textarea id="service_description" name="service_description" rows="4"
                    placeholder="Describe the service you offer..."
                    class="w-full border border-gray-300 p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-none"></textarea>
            </div>
        </form>

        <!-- Modal Actions -->
        <div class="modal-action mt-8 flex justify-end gap-4">
            <!-- Add Service Button -->
            <button type="button" form="service_form"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors flex items-center gap-2"
                onclick="addService()">
                <i class="fas fa-plus"></i> Add Service
            </button>

            <!-- Close Button -->
            <button type="button"
                class="bg-red-100 hover:bg-red-200 text-red-700 border border-red-300 px-6 py-3 rounded-lg transition-colors flex items-center gap-2"
                onclick="add_service_modal.close()">
                Close
            </button>
        </div>
    </div>
    </div>
</dialog>


<!-- Delete Modal  -->
<dialog id="my_modal_delete" class="modal">
    <div class="modal-box w-11/12 max-w-5xl">
        <h3 class="text-lg font-bold">Delete User</h3>
        <p class="py-4">Are you sure you want to delete Service</p>
        <input type="hidden" id="delete_service_id" />
        <div class="modal-action">
            <button type="button" onclick="deleteService()" class="btn btn-error"><i class="fa-solid fa-trash"></i>
                Delete</button>
            <form method="dialog">
                <!-- if there is a button, it will close the modal -->
                <button class="btn"> Close X</button>
            </form>
        </div>
    </div>
</dialog>


<!-- Edit Service Modal -->
<dialog id="edit_service_modal" class="modal">
    <div class="modal-box max-w-3xl w-full p-8 bg-white rounded-xl shadow-xl">
        <h3 class="font-bold text-2xl text-gray-800 mb-6">Edit Service</h3>

        <!-- Success Message -->
        <div id="edit_service_success_message_div"
            class="hidden mb-6 p-4 bg-green-100 text-green-800 border border-green-300 rounded-lg flex items-center gap-3 text-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span id="edit_service_success_message_text"></span>
        </div>

        <!-- Error Message -->
        <div id="edit_service_error_message_div"
            class="hidden mb-6 p-4 bg-red-100 text-red-800 border border-red-300 rounded-lg flex items-center gap-3 text-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span id="edit_service_error_message_text"></span>
        </div>

        <!-- Service Form -->
        <form id="edit_service_form" class="grid md:grid-cols-2 gap-6 text-lg">
            <!-- Service ID -->
            <input type="hidden" id="edit_service_id" />
            <!-- Service Name -->
            <div>
                <label class="block font-semibold text-gray-700 mb-2">
                    Service Name / Title <span class="text-red-600">*</span>
                </label>
                <input id="edit_service_name" type="text" placeholder="e.g. IT Support"
                    class="w-full border border-gray-300 p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
            </div>

            <!-- Service Price -->
            <div>
                <label class="block font-semibold text-gray-700 mb-2">
                    Service Price GH₵ <span class="text-red-600">*</span>
                </label>
                <input id="edit_service_price" type="number" placeholder="GHC 0.00"
                    class="w-full border border-gray-300 p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
            </div>

            <!-- Service Description -->
            <div class="md:col-span-2">
                <label class="block font-semibold text-gray-700 mb-2">
                    Service Description <span class="text-red-600">*</span>
                </label>
                <textarea id="edit_service_description" rows="4" placeholder="Describe the service you offer..."
                    class="w-full border border-gray-300 p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-none"></textarea>
            </div>
        </form>

        <!-- Modal Actions -->
        <div class="modal-action mt-8 flex justify-end gap-4">
            <!-- Add Service Button -->
            <button type="button" form="service_form" title="Click to update"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors flex items-center gap-2"
                onclick="editService()">
                <i class="fas fa-plus"></i> Update Service
            </button>

            <!-- Close Button -->
            <button type="button"
                class="bg-red-100 hover:bg-red-200 text-red-700 border border-red-300 px-6 py-3 rounded-lg transition-colors flex items-center gap-2"
                onclick="edit_service_modal.close()">
                Close
            </button>
        </div>
    </div>
    </div>
</dialog>


<script>
const BASE_URL = "http://localhost/nacom-computer-consults/api/admin";

const getAllServices = async () => {
    const container = document.getElementById("services_container");
    container.innerHTML = '<p class="col-span-full text-center text-gray-400">Loading services...</p>';

    try {
        const res = await axios.get(`${BASE_URL}/services.php`);
        const data = res.data;

        if (data.status === "success" && Array.isArray(data.services)) {
            container.innerHTML = "";

            if (data.services.length === 0) {
                container.innerHTML =
                    '<p class="col-span-full text-center text-gray-400">No services found.</p>';
                return;
            }

            data.services.forEach(service => {
                const card = document.createElement("div");
                card.className =
                    "border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow";

                card.innerHTML = `
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="font-medium text-gray-800">${service.name}</h4>
                        <span class="text-green-600 text-sm">Active</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">${service.description}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-blue-600 font-medium">₵${parseFloat(service.price).toLocaleString()}</span>
                                <!-- <div class="space-x-2">
                            <button class="text-blue-600 hover:text-blue-800" title="Edit Service" onclick="openEditServiceModal(${service.id},'${service.name}','${service.price}','${service.description}')"><i class="fas fa-edit"></i></button>
                            <button class="text-red-600 hover:text-red-800" title="Delete Service" onclick="openDeleteServiceModal(${service.id})"><i class="fas fa-trash"></i></button>
                        </div> -->
                    </div>
                `;

                container.appendChild(card);
            });

        } else {
            container.innerHTML =
                `<p class="col-span-full text-center text-red-600">${data.message || 'Failed to load services.'}</p>`;
        }

    } catch (error) {
        console.error("Error fetching services:", error);
        container.innerHTML = '<p class="col-span-full text-red-600 text-center">Error loading services.</p>';
    }
};

getAllServices()



//..................................................................................................
const openAddServiceModal = () => {
    document.getElementById("add_service_modal").showModal()
}

const addService = async () => {
    // Get form values
    const name = document.getElementById("service_name").value.trim();
    const price = document.getElementById("service_price").value.trim();
    const description = document.getElementById("service_description").value.trim();

    // Get message containers
    const successBox = document.getElementById("service_success_message_div");
    const successText = document.getElementById("service_success_message_text");

    const errorBox = document.getElementById("service_error_message_div");
    const errorText = document.getElementById("service_error_message_text");

    // Hide messages before starting
    successBox.classList.add("hidden");
    errorBox.classList.add("hidden");



    // Validate input
    if (!name || !price || !description) {


        errorText.innerText = "All fields are required.";
        errorBox.classList.remove("hidden");
        setTimeout(() => errorBox.classList.add("hidden"), 3000);
        return;
    }

    try {
        const response = await axios.post(`${BASE_URL}/services.php`, {
            action: "add",
            service_name: name,
            service_price: price,
            service_description: description
        });

        const data = response.data;

        if (data.status === "success") {
            getAllServices()

            successText.innerText = data.message || "Service added successfully!";
            successBox.classList.remove("hidden");
            errorBox.classList.add("hidden");

            // Reset form
            document.getElementById("service_form").reset();

            // Hide success after 3 seconds
            setTimeout(() => successBox.classList.add("hidden"), 3000);
        } else {
            errorText.innerText = data.message || "Failed to add service.";
            errorBox.classList.remove("hidden");
            successBox.classList.add("hidden");
            setTimeout(() => errorBox.classList.add("hidden"), 3000);
        }
    } catch (error) {
        errorText.innerText = error.response?.data?.message || error.message || "Something went wrong.";
        errorBox.classList.remove("hidden");
        successBox.classList.add("hidden");
        setTimeout(() => errorBox.classList.add("hidden"), 3000);
    }
}



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

const openDeleteServiceModal = (id) => {
    document.getElementById("delete_service_id").value = id
    document.getElementById("my_modal_delete").showModal()
}

const deleteService = async (id) => {
    const ID = document.getElementById("delete_service_id").value

    try {
        const response = await axios.post(`${BASE_URL}/services.php`, {
            action: "delete",
            service_id: ID
        });

        const data = response.data;

        if (data.status === "success") {
            successMess("Service deleted.");
            getAllServices()
            document.getElementById("my_modal_delete").close()
        } else {
            errorMess(data.message);
        }
    } catch (error) {
        alert("Delete failed: " + error.message);
    }
};

//..................................................................................................

const openEditServiceModal = (id, serviceName, servicePrice, serviceDescription) => {
    document.getElementById("edit_service_id").value = id
    document.getElementById("edit_service_name").value = serviceName
    document.getElementById("edit_service_price").value = servicePrice
    document.getElementById("edit_service_description").value = serviceDescription
    document.getElementById("edit_service_modal").showModal()
}
const editService = async () => {
    const id = document.getElementById("edit_service_id").value.trim();
    const name = document.getElementById("edit_service_name").value.trim();
    const price = document.getElementById("edit_service_price").value.trim();
    const description = document.getElementById("edit_service_description").value.trim();

    const errorBox = document.getElementById("edit_service_error_message_div");
    const errorText = document.getElementById("edit_service_error_message_text");
    const successBox = document.getElementById("edit_service_success_message_div");
    const successText = document.getElementById("edit_service_success_message_text");

    errorBox.classList.add("hidden");
    successBox.classList.add("hidden");

    console.log(id, name, price, description);

    if (!id || !name || !price || !description) {
        errorText.innerText = "All fields are required.";
        errorBox.classList.remove("hidden");
        setTimeout(() => errorBox.classList.add("hidden"), 3000);
        return;
    }

    try {
        const response = await axios.post(`${BASE_URL}/services.php`, {
            action: "edit",
            service_id: id,
            service_name: name,
            service_price: price,
            service_description: description
        });

        const data = response.data;

        console.log(data);

        if (data.status === "success") {
            getAllServices()
            successMess(data.message) || "Service updated successfully.";
            document.getElementById("edit_service_modal").close()
        } else {
            errorText.innerText = data.message || "Failed to update service.";
            errorBox.classList.remove("hidden");
            setTimeout(() => errorBox.classList.add("hidden"), 3000);
        }
    } catch (error) {
        errorText.innerText = error.message || "Something went wrong.";
        errorBox.classList.remove("hidden");
        setTimeout(() => errorBox.classList.add("hidden"), 3000);
    }
};
</script>