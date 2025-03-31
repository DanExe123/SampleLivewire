  <!-- Stats Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
    <div class="bg-white p-6 rounded-xl shadow-md flex items-center">
        <div class="p-4 bg-black text-white rounded-full">
            🛒 
        </div>
        <div class="ml-4">
            <h2 class="text-lg font-semibold text-gray-700">Ordered</h2>
            <p class="text-2xl font-bold text-gray-900">{{ $orderedCount }}</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md flex items-center">
        <div class="p-4 bg-black text-white rounded-full">
            📦
        </div>
        <div class="ml-4">
            <h2 class="text-lg font-semibold text-gray-700">Delivered</h2>
            <p class="text-2xl font-bold text-gray-900">{{ $deliveredCount }}</p>
        </div>
    </div>


    <div class="bg-white p-6 rounded-xl shadow-md flex items-center">
        <div class="p-4 bg-black text-white rounded-full">
            ✔️   
        </div>
        <div class="ml-4">
            <h2 class="text-lg font-semibold text-gray-700">Completed</h2>
            <p class="text-2xl font-bold text-gray-900">0</p>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-md flex items-center">
        <div class="p-4 bg-black text-white rounded-full">
            ❌
        </div>
        <div class="ml-4">
            <h2 class="text-lg font-semibold text-gray-700">Cancelled</h2>
            <p class="text-2xl font-bold text-gray-900">0</p>
        </div>
    </div>
</div>