<x-app-layout>
    {{-- ... HEADER and NAVIGATION slots remain the same ... --}}

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
            
            {{-- NEW: Cart Link --}}
            <a href="{{ route('user.cart.index') }}"
                class="hover:text-white transition relative">
                My Order ({{ count(Session::get('cart', [])) }})
                {{-- This shows how many distinct items are in the cart session --}}
            </a>
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
                    Available Products
                </h3>

                {{-- PRODUCT TABLE --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 bg-white dark:bg-gray-900 shadow rounded-lg">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Product Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Unit Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">In Stock (Qty)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider">Order Qty</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 dark:text-gray-300 uppercase tracking-wider text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($products as $product)
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

                                    {{-- FORM FOR ADDING TO CART --}}
                                    <form action="{{ route('user.cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="number" 
                                                   name="qty" 
                                                   value="1" 
                                                   min="1"
                                                   max="{{ $product->Qty }}"
                                                   class="w-20 form-input rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200 border-gray-300 dark:border-gray-600">
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-center space-x-2">
                                            <button type="submit"
                                                class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 font-medium transition disabled:opacity-50"
                                                @if ($product->Qty == 0) disabled @endif>
                                                Add to Order
                                            </button>
                                            
                                            <a href="{{ route('user.product.show', $product->id) }}"
                                                class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium transition">
                                                View Details
                                            </a>
                                        </td>
                                    </form>
                                    {{-- END FORM --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>