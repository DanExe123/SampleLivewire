<x-layouts.app>
   
   @role('admin')
   <div x-data="dashboard()" class="max-w-6xl mx-auto">
      <h1 class="text-2xl font-semibold text-gray-800">Sales & Order Analytics</h1>

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
          <div class="bg-white p-6 rounded-xl shadow-md flex items-center">
              <div class="p-4 bg-blue-500 text-white rounded-full">
                  💰
              </div>
              <div class="ml-4">
                  <h2 class="text-lg font-semibold text-gray-700">Total Sales</h2>
                  <p class="text-2xl font-bold text-gray-900" x-text="'$' + totalSales"></p>
              </div>
          </div>

          <div class="bg-white p-6 rounded-xl shadow-md flex items-center">
              <div class="p-4 bg-green-500 text-white rounded-full">
                  📦
              </div>
              <div class="ml-4">
                  <h2 class="text-lg font-semibold text-gray-700">Orders Shipped</h2>
                  <p class="text-2xl font-bold text-gray-900" x-text="shippedOrders"></p>
              </div>
          </div>
      </div>

    <!-- Sales & Shipments Chart -->
    <div class="mt-6 bg-white p-6 rounded-xl shadow-md">
      <h2 class="text-lg font-semibold text-gray-700">Sales & Shipments This Month</h2>
      <div class="w-full">
          <canvas id="salesChart" style="max-height: 250px;"></canvas>
      </div>
   </div>
   


      <!-- Recent Transactions Table -->
      <div class="mt-6 bg-white p-6 rounded-xl shadow-md">
          <h2 class="text-lg font-semibold text-gray-700">Recent Transactions</h2>
          <table class="w-full mt-4 border-collapse">
              <thead>
                  <tr class="bg-gray-200">
                      <th class="p-2 text-left">Date</th>
                      <th class="p-2 text-left">Customer</th>
                      <th class="p-2 text-left">Amount</th>
                      <th class="p-2 text-left">Status</th>
                  </tr>
              </thead>
              <tbody>
                  <template x-for="transaction in recentTransactions">
                      <tr class="border-b">
                          <td class="p-2" x-text="transaction.date"></td>
                          <td class="p-2" x-text="transaction.customer"></td>
                          <td class="p-2" x-text="'$' + transaction.amount"></td>
                          <td class="p-2">
                              <span class="px-2 py-1 rounded-lg text-white"
                                  :class="transaction.status == 'Shipped' ? 'bg-green-500' : 'bg-yellow-500'"
                                  x-text="transaction.status">
                              </span>
                          </td>
                      </tr>
                  </template>
              </tbody>
          </table>
      </div>
  </div>

  <!-- Alpine.js Dashboard Logic -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
   function dashboard() {
       return {
           totalSales: 0,
           shippedOrders: 0,
           recentTransactions: [],
           salesData: [],
           shippedData: [],
           chart: null,

           fetchData() {
               // Mock Data (Static)
               this.totalSales = 12540;
               this.shippedOrders = 78;
               this.recentTransactions = [
                   { date: "Mar 01, 2025", customer: "Alice Johnson", amount: 350, status: "Shipped" },
                   { date: "Mar 02, 2025", customer: "Bob Smith", amount: 120, status: "Pending" },
                   { date: "Mar 03, 2025", customer: "Charlie Brown", amount: 540, status: "Shipped" },
                   { date: "Mar 04, 2025", customer: "David Lee", amount: 260, status: "Pending" },
                   { date: "Mar 05, 2025", customer: "Eve Adams", amount: 410, status: "Shipped" }
               ];

               this.salesData = [500, 700, 1200, 900, 1500, 2000, 2500, 1900, 2300, 1700, 2200, 2600];
               this.shippedData = [8, 12, 18, 20, 22, 30, 40, 35, 25, 30, 40, 50];

               this.renderChart();
           },

           renderChart() {
               const ctx = document.getElementById('salesChart').getContext('2d');
               if (this.chart) this.chart.destroy();

               this.chart = new Chart(ctx, {
                   type: 'line',
                   data: {
                       labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                       datasets: [
                           {
                               label: 'Sales ($)',
                               data: this.salesData,
                               borderColor: 'rgba(54, 162, 235, 1)',
                               backgroundColor: 'rgba(54, 162, 235, 0.2)',
                               borderWidth: 2,
                               tension: 0.4,
                               fill: true
                           },
                           {
                               label: 'Orders Shipped',
                               data: this.shippedData,
                               borderColor: 'rgba(75, 192, 192, 1)',
                               backgroundColor: 'rgba(75, 192, 192, 0.2)',
                               borderWidth: 2,
                               tension: 0.4,
                               fill: true
                           }
                       ]
                   },
                   options: { 
                       responsive: true, 
                       scales: { 
                           y: { beginAtZero: true } 
                       } 
                   }
               });
           },

           init() {
               this.fetchData();
           }
       };
   }
</script>
  @endrole
</x-layouts.app>
