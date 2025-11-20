<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
            Product Details
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
    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">

        {{-- Product Card --}}
        <div class="bg-white dark:bg-gray-900 shadow rounded-xl p-6 mb-6">
            <h2 class="text-2xl font-bold mb-4">{{ $product->name }}</h2>

            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                <li class="py-2 flex justify-between"><span class="font-semibold">Quantity:</span> {{ $product->Qty }}</li>
                <li class="py-2 flex justify-between"><span class="font-semibold">Unit Price:</span> {{ $product->unit_price }}</li>
                <li class="py-2 flex justify-between">
                    <span class="font-semibold">Status:</span>
                    <span class="{{ $product->status ? 'text-green-600' : 'text-red-600' }}">
                        {{ $product->status ? 'Active' : 'Inactive' }}
                    </span>
                </li>
                <li class="py-2 flex justify-between"><span class="font-semibold">Supplier:</span> {{ $product->supplier->name }}</li>
                <li class="py-2 flex justify-between"><span class="font-semibold">Category:</span> {{ $product->category->name }}</li>
            </ul>
        </div>

        {{-- Action Buttons --}}
        <div class="flex space-x-3">
            <a href="{{ route('admin.product.edit', $product) }}" 
               class="bg-yellow-400 text-white px-4 py-2 rounded shadow hover:bg-yellow-500 transition">
               Edit
            </a>
            <a href="{{ route('admin.dashboard') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600 transition">
               Back
            </a>
        </div>

    </div>

</x-app-layout>
