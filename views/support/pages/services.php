<!-- Services Section -->
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900">Available Services</h2>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Service Card -->
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow cursor-pointer"
                onclick="openServiceModal()">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="ri-tools-line text-blue-600 text-lg"></i>
                    </div>
                    <h3 class="font-medium text-gray-900">Service Name</h3>
                </div>
                <p class="text-sm text-gray-600 mb-4">Short description of the service.</p>
                <div class="flex space-x-2">
                    <button class="text-sm bg-blue-100 text-blue-700 px-3 py-1 rounded hover:bg-blue-200">
                        View Details
                    </button>
                </div>
            </div>
            <!-- End Service Card -->

            <!-- Repeat this block for each service -->
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow cursor-pointer"
                onclick="openServiceModal()">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="ri-shield-check-line text-purple-600 text-lg"></i>
                    </div>
                    <h3 class="font-medium text-gray-900">Security Audit</h3>
                </div>
                <p class="text-sm text-gray-600 mb-4">Comprehensive system security checks and recommendations.</p>
                <div class="flex space-x-2">
                    <button class="text-sm bg-purple-100 text-purple-700 px-3 py-1 rounded hover:bg-purple-200">
                        View Details
                    </button>
                </div>
            </div>
            <!-- End Service Card -->

            <!-- Add more cards as needed -->

        </div>
    </div>
</div>


<!-- Service Modal -->
<div id="serviceModal" class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center px-4 py-4">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="ri-tools-line text-blue-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900">Service Name</h3>
            </div>
            <button onclick="closeServiceModal()" class="text-gray-400 hover:text-gray-600">
                <i class="ri-close-line text-2xl"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6 space-y-6">
            <!-- Description -->
            <div>
                <h4 class="font-medium text-gray-900 mb-2">Service Description</h4>
                <p class="text-gray-700">Full description of the service goes here.</p>
            </div>

            <!-- Pricing & Features -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Pricing Info -->
                <div>
                    <h4 class="font-medium text-gray-900 mb-2">Pricing & Duration</h4>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Price:</span>
                            <span class="text-sm font-medium text-green-600">GHS 100</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Duration:</span>
                            <span class="text-sm font-medium text-gray-900">1 hour</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Availability:</span>
                            <span class="text-sm font-medium text-blue-600">Weekdays</span>
                        </div>
                    </div>
                </div>

                <!-- Features -->
                <div>
                    <h4 class="font-medium text-gray-900 mb-2">Features Included</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center space-x-2">
                            <i class="ri-check-line text-green-600"></i>
                            <span class="text-sm text-gray-700">Feature One</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <i class="ri-check-line text-green-600"></i>
                            <span class="text-sm text-gray-700">Feature Two</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Info Banner -->
            <div class="bg-blue-50 rounded-lg p-4">
                <div class="flex items-start space-x-3">
                    <i class="ri-information-line text-blue-600 text-lg mt-0.5"></i>
                    <div>
                        <h5 class="font-medium text-blue-900 mb-1">Need Help?</h5>
                        <p class="text-sm text-blue-800">
                            Contact our support team for more information about this service or to schedule a
                            consultation.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="p-6 border-t border-gray-200 flex flex-wrap gap-3">
            <button onclick="closeServiceModal()"
                class="flex-1 md:flex-none border border-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-50">
                Close
            </button>
            <button class="flex-1 md:flex-none bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
                Book Service
            </button>
            <button
                class="flex-1 md:flex-none border border-blue-600 text-blue-600 py-2 px-4 rounded-lg hover:bg-blue-50">
                Contact Support
            </button>
        </div>
    </div>
</div>


<script>
function closeServiceModal() {
    document.getElementById('serviceModal').classList.add('hidden');
}

function openServiceModal() {
    document.getElementById('serviceModal').classList.remove('hidden');
}
</script>