<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Order Review
        </h2>
    </x-slot>

    {{-- TOP NAVIGATION (Adjusted to highlight Cart) --}}
    <div class="bg-gray-800 text-gray-200 px-6 py-3 shadow mb-8">
        <nav class="flex space-x-8 text-lg">
            <a href="{{ route('dashboard') }}" class="hover:text-white transition">Dashboard</a>
            <a href="{{ route('user.product') }}" class="hover:text-white transition">Products</a>
            <a href="{{ route('user.cart.index') }}" class="font-semibold text-white relative">
                My Order ({{ count($cart) }})
            </a>
        </nav>
    </div>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Success!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-6">
                    Review and Submit Your Order
                </h3>

                @if (empty($cart))
                    <div class="text-gray-500 dark:text-gray-400">
                        Your order is currently empty. Please add products from the <a href="{{ route('user.product') }}" class="text-indigo-500 hover:underline">Products page</a>.
                    </div>
                @else
                    <form action="{{ route('user.order.store') }}" method="POST">
                        @csrf
                        {{-- NOTE: This form will post the final order, but the data submission 
                           logic must be updated in UserController::userStoreOrder 
                           to use Session::get('cart') instead of Request data. --}}

                        <div class="overflow-x-auto mb-6">
                            <table class="min-w-full divide-y divide-gray-200 bg-white dark:bg-gray-900 shadow rounded-lg">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Product Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Quantity</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Unit Price</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Subtotal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @php $totalPrice = 0; @endphp
                                    @foreach ($cart as $id => $details)
                                        @php
                                            $subtotal = $details['price'] * $details['qty'];
                                            $totalPrice += $subtotal;
                                        @endphp
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">{{ $details['name'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">{{ $details['qty'] }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">${{ number_format($details['price'], 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">${{ number_format($subtotal, 2) }}</td>
                                            
                                            <td class="px-6 py-4 whitespace-nowrap">
                             <form action="{{ route('user.cart.remove', ['productId' => $product_id_of_item]) }}" method="POST">
                                        @csrf
                                        @method('DELETE') 
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded">
                                            Remove Item
                                        </button>
                                    </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gray-50 dark:bg-gray-700 font-bold">
                                        <td colspan="3" class="px-6 py-3 text-right text-base text-gray-800 dark:text-gray-200">Total Order Price:</td>
                                        <td class="px-6 py-3 text-base text-gray-800 dark:text-gray-200">${{ number_format($totalPrice, 2) }}</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" 
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition">
                                Place Final Order
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>