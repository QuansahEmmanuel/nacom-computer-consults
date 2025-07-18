
<!-- Bookings Content -->
<div  class="page-content ">
  <div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
      <h3 class="text-lg font-semibold text-gray-800">All Bookings</h3>
      <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
        <i class="fas fa-plus mr-2"></i>New Booking
      </button>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="border-b border-gray-200">
            <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">ID</th>
            <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">CUSTOMER</th>
            <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">SERVICE</th>
            <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">DATE</th>
            <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">STATUS</th>
            <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">ACTIONS</th>
          </tr>
        </thead>
        <tbody>
          <tr class="table-row border-b border-gray-100">
            <td class="py-3 px-4 text-sm text-gray-800">#001</td>
            <td class="py-3 px-4 text-sm text-gray-800">John Doe</td>
            <td class="py-3 px-4 text-sm text-gray-600">IT Support</td>
            <td class="py-3 px-4 text-sm text-gray-600">2024-01-15</td>
            <td class="py-3 px-4"><span
                class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Confirmed</span></td>
            <td class="py-3 px-4">
              <button class="text-blue-600 hover:text-blue-800 mr-2"><i class="fas fa-edit"></i></button>
              <button class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
            </td>
          </tr>
          <tr class="table-row border-b border-gray-100">
            <td class="py-3 px-4 text-sm text-gray-800">#002</td>
            <td class="py-3 px-4 text-sm text-gray-800">Jane Smith</td>
            <td class="py-3 px-4 text-sm text-gray-600">Network Setup</td>
            <td class="py-3 px-4 text-sm text-gray-600">2024-01-16</td>
            <td class="py-3 px-4"><span
                class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Pending</span></td>
            <td class="py-3 px-4">
              <button class="text-blue-600 hover:text-blue-800 mr-2"><i class="fas fa-edit"></i></button>
              <button class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
