<x-app-layout>

    {{-- Jetstream Header (Only Title) --}}
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
            Admin Dashboard
        </h2>
    </x-slot>


    {{-- Admin Navbar --}}
    <div class="bg-gray-800 text-gray-200 px-6 py-3 shadow mb-6">
        <nav class="flex space-x-8 text-lg">

            <a href="{{ route('admin.dashboard') }}"
                class="hover:text-white transition">Dashboard</a>
            {{-- NEW ORDERS LINK --}}
            <a href="{{ route('admin.order.index') }}" 
                class="hover:text-white transition">Orders</a>    

            <a href="{{ route('admin.product.create') }}"
                class="hover:text-white transition">Add Product</a>

            <a href="{{ route('admin.supplier.index') }}"
                class="hover:text-white transition">Suppliers</a>

            <a href="{{ route('admin.category.index') }}"
                class="hover:text-white transition">Categories</a>

        </nav>
    </div>


    {{-- Page Content --}}
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-500 text-white rounded shadow">
                {{ session('success') }}
            </div>
        @endif


        <div class="bg-white dark:bg-gray-900 shadow rounded-xl p-6">

            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-left">
                        <th class="p-3">Name</th>
                        <th class="p-3">Qty</th>
                        <th class="p-3">Unit Price</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Supplier</th>
                        <th class="p-3">Category</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($products as $product)
                    <tr class="border-b dark:border-gray-700">
                        <td class="p-3">{{ $product->name }}</td>
                        <td class="p-3">{{ $product->Qty }}</td>
                        <td class="p-3">{{ $product->unit_price }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded 
                                {{ $product->status ? 'bg-green-600 text-white' : 'bg-red-600 text-white' }}">
                                {{ $product->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="p-3">{{ $product->supplier->name }}</td>
                        <td class="p-3">{{ $product->category->name }}</td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('admin.product.show', $product) }}"
                                class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">View</a>

                            <a href="{{ route('admin.product.edit', $product) }}"
                                class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>

                            <form action="{{ route('admin.product.delete', $product) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700"
                                    onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>

</x-app-layout>
