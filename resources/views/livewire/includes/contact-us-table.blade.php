<div>
    <!-- Table (Right Side) -->
<div class="bg-gray-100 p-6 rounded-lg shadow-md w-auto">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Recent Messages</h2>
    <div class="overflow-x-auto">
        <table class="bg-white border border-gray-200 rounded-lg table-auto w-auto">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border">#</th>
                    <th class="py-2 px-4 border">Name</th>
                    <th class="py-2 px-4 border">Email</th>
                    <th class="py-2 px-4 border">Subject</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $index => $message)
                    <tr class="text-center">
                        <td class="py-2 px-4 border">{{ $index + 1 }}</td>
                        <td class="py-2 px-4 border">{{ $message->name }}</td>
                        <td class="py-2 px-4 border">{{ $message->email }}</td>
                        <td class="py-2 px-4 border">{{ $message->subject }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



</div>