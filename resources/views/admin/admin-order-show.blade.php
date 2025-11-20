<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
            Order #{{ $order->id }} Details
        </h2>
    </x-slot>

    {{-- Admin Navbar (Ensure this is updated with the 'Orders' link) --}}
    <div class="bg-gray-800 text-gray-200 px-6 py-3 shadow mb-6">
        <nav class="flex space-x-8 text-lg">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition">Dashboard</a>
            <a href="{{ route('admin.order.index') }}" class="font-semibold text-white transition">Orders</a>
            {{-- Add other necessary admin links --}}
        </nav>
    </div>

    {{-- Page Content --}}
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-500 text-white rounded shadow">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-500 text-white rounded shadow">
                {{ session('error') }}
            </div>
        @endif

        {{-- Order Status and Customer Info --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            
            {{-- Status Update Card --}}
            <div class="md:col-span-1 bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6 h-fit">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">Update Status</h3>
                
                <form action="{{ route('admin.order.update.status', $order) }}" method="POST">
                    @csrf
                    @method('PATCH') {{-- Use PATCH method as defined in your routes --}}
                    
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Current Status:
                        </label>
                        <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:text-gray-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition">
                        Update Order Status
                    </button>
                </form>
            </div>

            {{-- Customer and Order Totals Card --}}
            <div class="md:col-span-2 bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">Order Summary</h3>
                <p class="text-gray-700 dark:text-gray-300">
                    <span class="font-semibold">Customer:</span> {{ $order->user->name ?? 'N/A' }} ({{ $order->user->email ?? 'N/A' }})
                </p>
                <p class="text-gray-700 dark:text-gray-300">
                    <span class="font-semibold">Order Date:</span> {{ $order->created_at->format('M d, Y H:i A') }}
                </p>
                <div class="mt-4 pt-4 border-t dark:border-gray-700">
                    <p class="text-xl font-bold text-gray-800 dark:text-gray-100">
                        Total Price: ${{ number_format($order->total_price, 2) }}
                    </p>
                </div>
            </div>

        </div>

        {{-- Order Items Table --}}
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6 mt-4">
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">Items Ordered</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Unit Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($order->items as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                {{ $item->product->name ?? 'Product Deleted' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                {{ $item->product->category->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                {{ $item->Qty }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                ${{ number_format($item->price, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800 dark:text-gray-200">
                                ${{ number_format($item->price * $item->Qty, 2) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>