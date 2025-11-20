<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
            Order Management
        </h2>
    </x-slot>

    {{-- Admin Navbar (Ensure this is updated with the 'Orders' link) --}}
    <div class="bg-gray-800 text-gray-200 px-6 py-3 shadow mb-6">
        <nav class="flex space-x-8 text-lg">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition">Dashboard</a>
            <a href="{{ route('admin.order.index') }}" class="font-semibold text-white transition">Orders</a>
            <a href="{{ route('admin.product.create') }}" class="hover:text-white transition">Add Product</a>
            <a href="{{ route('admin.supplier.index') }}" class="hover:text-white transition">Suppliers</a>
            <a href="{{ route('admin.category.index') }}" class="hover:text-white transition">Categories</a>
        </nav>
    </div>

    {{-- Page Content --}}
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-500 text-white rounded shadow">
                {{ session('success') }}
            </div>
        @endif
        
        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Customer Orders</h3>

        <div class="bg-white dark:bg-gray-900 shadow rounded-xl p-6 overflow-x-auto">

            <table class="min-w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-left text-sm text-gray-600 dark:text-gray-300 uppercase">
                        <th class="p-3">Order ID</th>
                        <th class="p-3">Customer</th>
                        <th class="p-3">Total Amount</th>
                        <th class="p-3">Date</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($orders as $order)
                    <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                        <td class="p-3 font-semibold">{{ $order->id }}</td>
                        <td class="p-3 text-gray-700 dark:text-gray-200">{{ $order->user->name ?? 'N/A' }}</td>
                        <td class="p-3 font-medium text-gray-800 dark:text-gray-100">${{ number_format($order->total_price, 2) }}</td>
                        <td class="p-3 text-sm">{{ $order->created_at->format('M d, Y H:i') }}</td>
                        <td class="p-3">
                            {{-- Status styling based on value --}}
                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                   ($order->status == 'processing' ? 'bg-blue-100 text-blue-800' : 
                                   ($order->status == 'completed' ? 'bg-green-100 text-green-800' : 
                                   'bg-gray-100 text-gray-800')) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="p-3">
                            <a href="{{ route('admin.order.show', $order) }}"
                                class="px-3 py-1 bg-indigo-600 text-white rounded text-sm hover:bg-indigo-700 transition">
                                View Details
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-6 text-center text-gray-500 dark:text-gray-400">No orders have been placed yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </div>

</x-app-layout>