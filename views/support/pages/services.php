<!-- Services Section -->
<div class="bg-white rounded-lg shadow-sm">
  <div class="p-6 border-b border-gray-200">
    <h2 class="text-lg font-semibold text-gray-900">Available Services</h2>
  </div>
  <div class="p-6">
   <div id="service_container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

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
          <i id="modalServiceIcon" class="text-xl"></i>
        </div>
        <h3 id="modalServiceName" class="text-xl font-semibold text-gray-900">Service Name</h3>
      </div>
      <button onclick="closeServiceModal()" class="text-gray-400 hover:text-gray-600">
        <i class="ri-close-line text-2xl"></i>
      </button>
    </div>

    <!-- Modal Body -->
    <div class="p-6 space-y-6">
      <div>
        <h4 class="font-medium text-gray-900 mb-2">Service Description</h4>
        <p id="modalServiceDescription" class="text-gray-700">Full description of the service goes here.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <h4 class="font-medium text-gray-900 mb-2">Pricing & Duration</h4>
          <div class="space-y-2">
            <div class="flex justify-between">
              <span class="text-sm text-gray-600">Price:</span>
              <span id="modalPrice" class="text-sm font-medium text-green-600">GHS 100</span>
            </div>
            <div class="flex justify-between">
              <span class="text-sm text-gray-600">Duration:</span>
              <span id="modalDuration" class="text-sm font-medium text-gray-900">1 hour</span>
            </div>
            <div class="flex justify-between">
              <span class="text-sm text-gray-600">Availability:</span>
              <span id="modalAvailability" class="text-sm font-medium text-blue-600">Weekdays</span>
            </div>
          </div>
        </div>

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

      <div class="bg-blue-50 rounded-lg p-4">
        <div class="flex items-start space-x-3">
          <i class="ri-information-line text-blue-600 text-lg mt-0.5"></i>
          <div>
            <h5 class="font-medium text-blue-900 mb-1">Need Help?</h5>
            <p class="text-sm text-blue-800">
              Contact our support team for more information about this service or to schedule a consultation.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Footer -->
    <div class="p-6 border-t border-gray-200 flex flex-wrap gap-3">
      <button onclick="closeServiceModal()" class="flex-1 md:flex-none border border-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-50">Close</button>
      <button class="flex-1 md:flex-none bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Book Service</button>
      <button class="flex-1 md:flex-none border border-blue-600 text-blue-600 py-2 px-4 rounded-lg hover:bg-blue-50">Contact Support</button>
    </div>
  </div>
</div>

<!-- Modal Script -->
<script>
  function openServiceModal(serviceName, iconClass, description, price, duration, availability, iconColor) {
    document.getElementById('modalServiceName').textContent = serviceName;

    const icon = document.getElementById('modalServiceIcon');
    icon.className = '';
    icon.classList.add(...iconClass.split(' '), iconColor, 'text-xl');

    document.getElementById('modalServiceDescription').textContent = description;
    document.getElementById('modalPrice').textContent = price;
    document.getElementById('modalDuration').textContent = duration;
    document.getElementById('modalAvailability').textContent = availability;

    document.getElementById('serviceModal').classList.remove('hidden');
  }

  function closeServiceModal() {
    document.getElementById('serviceModal').classList.add('hidden');
  }




  const fetchServiceData = async () => {
    try {
      const response = await axios.get('http://localhost/nacom-computer-consults/api/support/services.php');
     
      const services = await response.data;

      const data = services.data;

      const serviceContainer = document.getElementById('service_container');
      serviceContainer.innerHTML = ''; 
      const display = (service)=>{
        return`
        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition cursor-pointer"
        onclick="openServiceModal(
          '${service.name}',
          'fa-solid fa-screwdriver-wrench',
          '${service.description}',
          '${service.price}',
          '1 hour',
          'Weekdays & Weekends',
          'text-blue-600'
        )">
        <div class="flex items-center space-x-3 mb-3">
          <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
            <i class="fa-solid fa-screwdriver-wrench text-blue-600 text-lg"></i>
          </div>
          <h3 class="font-medium text-gray-900 text-lg">${service.name}</h3>
        </div>
        <p class="text-sm text-gray-600 mb-4">${service.description}</p>
        <button class="text-sm bg-purple-100 text-purple-700 px-3 py-1 rounded hover:bg-purple-200">View Details</button>
      </div>
        `
      }// Clear existing content

      data.map(service => {
         serviceContainer.innerHTML += display(service);
      });


     
      
    } catch (error) {
      console.error('Error fetching service data:', error);
    }
  };

  fetchServiceData();
</script>
