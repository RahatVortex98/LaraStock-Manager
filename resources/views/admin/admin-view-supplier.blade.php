<x-app-layout>

    {{-- Jetstream Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
            Supplier Details
        </h2>
    </x-slot>

    {{-- Admin Navbar --}}
    <div class="bg-gray-800 text-gray-200 px-6 py-3 shadow mb-6">
        <nav class="flex space-x-8 text-lg">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-white transition">Dashboard</a>
            <a href="{{ route('admin.product.create') }}" class="hover:text-white transition">Add Product</a>
            <a href="{{ route('admin.supplier.index') }}" class="hover:text-white transition">Suppliers</a>
            <a href="{{ route('admin.category.index') }}" class="hover:text-white transition">Categories</a>
        </nav>
    </div>

    {{-- Page Content --}}
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Supplier Info Card --}}
        <div class="bg-white dark:bg-gray-900 shadow rounded-xl p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Supplier Information</h3>
            <ul class="divide-y divide-gray-200">
                <li class="py-2 flex justify-between"><span class="font-semibold">Name:</span> {{ $supplier->name }}</li>
                <li class="py-2 flex justify-between"><span class="font-semibold">Phone:</span> {{ $supplier->phone_no }}</li>
                <li class="py-2 flex justify-between"><span class="font-semibold">Address:</span> {{ $supplier->address }}</li>
            </ul>
        </div>

        {{-- Supplier Products --}}
        <div class="bg-white dark:bg-gray-900 shadow rounded-xl p-6">
            <h3 class="text-xl font-semibold mb-4">Products from this Supplier</h3>

            @if($supplier->products->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse divide-y divide-gray-200">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Name</th>
                                <th class="px-4 py-2 text-right text-gray-700 dark:text-gray-200">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($supplier->products as $product)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                    <td class="px-4 py-2">{{ $product->name }}</td>
                                    <td class="px-4 py-2 text-right">
                                        <a href="{{ route('admin.product.show', $product) }}" 
                                           class="bg-blue-600 text-white text-sm px-3 py-1 rounded shadow hover:bg-blue-700 transition">
                                           View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500">No products found for this supplier.</p>
            @endif

            <div class="mt-6">
                <a href="{{ route('admin.supplier.index') }}" 
                   class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600 transition">
                   Back
                </a>
            </div>
        </div>

    </div>

</x-app-layout>
