<x-app-layout>

    {{-- HEADER --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            User Dashboard
        </h2>
    </x-slot>

    {{-- TOP NAVIGATION --}}
    <div class="bg-gray-800 text-gray-200 px-6 py-3 shadow mb-8">
        <nav class="flex space-x-8 text-lg">
            <a href="{{ route('dashboard') }}"
                class="hover:text-white transition {{ request()->routeIs('dashboard') ? 'font-semibold text-white' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('user.product') }}"
                class="hover:text-white transition {{ request()->routeIs('user.product') ? 'font-semibold text-white' : '' }}">
                Products
            </a>
            
            {{-- OPTIONAL: Link to view existing orders --}}
            {{-- <a href="{{ route('user.order.index') }}"
                class="hover:text-white transition">
                My Orders
            </a> --}}
        </nav>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Success/Error Messages --}}
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Success!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Error!</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            {{-- CARD WRAPPER --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-6">
                    Place a New Order
                </h3>

                {{-- ORDER FORM START --}}
                <form action="{{ route('user.order.store') }}" method="POST">
                    @csrf
                    
                    {{-- PRODUCT TABLE --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 bg-white dark:bg-gray-900 shadow rounded-lg" id="order-table">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Product Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Price/Unit</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Current Stock</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Quantity to Order</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($products as $index => $product)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                            {{ $product->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                            {{ $product->category->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                            ${{ number_format($product->unit_price, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">
                                            {{ $product->Qty }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            {{-- This is where the user inputs the quantity they want to order --}}
                                            <input type="hidden" name="products[{{ $index }}][product_id]" value="{{ $product->id }}">
                                            <input type="number" 
                                                   name="products[{{ $index }}][qty]" 
                                                   value="0" 
                                                   min="0"
                                                   max="{{ $product->Qty }}"
                                                   class="w-20 form-input rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200 border-gray-300 dark:border-gray-600"
                                                   onchange="updateOrderButtonState()">
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                            No products are currently available.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- SUBMIT BUTTON --}}
                    <div class="mt-6 flex justify-end">
                        <button type="submit" 
                                id="submit-order-button"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition disabled:bg-indigo-400" 
                                disabled>
                            Submit Order
                        </button>
                    </div>
                </form>
                {{-- ORDER FORM END --}}
            </div>

        </div>
    </div>
</x-app-layout>

<script>
    // Function to enable/disable the Submit Order button
    function updateOrderButtonState() {
        const qtyInputs = document.querySelectorAll('input[name^="products["][name$="[qty]"]');
        let totalQty = 0;
        
        qtyInputs.forEach(input => {
            // Check if the input value is a valid number and greater than 0
            const qty = parseInt(input.value);
            if (!isNaN(qty) && qty > 0) {
                totalQty += qty;
            }
        });

        const submitButton = document.getElementById('submit-order-button');
        if (totalQty > 0) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
    }

    // Initialize the button state on page load
    document.addEventListener('DOMContentLoaded', updateOrderButtonState);
</script>