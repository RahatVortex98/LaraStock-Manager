<x-app-layout>

    {{-- Jetstream Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
            Suppliers
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

        <div class="flex justify-between items-center mb-4">
            <h2 class="font-bold text-2xl">Suppliers</h2>
            <a href="{{ route('admin.supplier.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">
               + Add Supplier
            </a>
        </div>

        <div class="bg-white dark:bg-gray-900 shadow rounded-xl overflow-hidden">
            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-700 dark:text-gray-200 font-semibold">Name</th>
                            <th class="px-6 py-3 text-left text-gray-700 dark:text-gray-200 font-semibold">Phone</th>
                            <th class="px-6 py-3 text-left text-gray-700 dark:text-gray-200 font-semibold">Address</th>
                            <th class="px-6 py-3 text-left text-gray-700 dark:text-gray-200 font-semibold">Total Products</th>
                            <th class="px-6 py-3 text-center text-gray-700 dark:text-gray-200 font-semibold">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach($suppliers as $supplier)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                            <td class="px-6 py-3 font-semibold text-gray-800 dark:text-gray-100">{{ $supplier->name }}</td>
                            <td class="px-6 py-3 text-gray-700 dark:text-gray-300">{{ $supplier->phone_no }}</td>
                            <td class="px-6 py-3 text-gray-700 dark:text-gray-300">{{ $supplier->address }}</td>
                            <td class="px-6 py-3">
                                <span class="inline-block bg-gray-300 text-gray-800 text-sm px-2 py-1 rounded-full">
                                    {{ $supplier->products->count() }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-center flex justify-center gap-2">
                                <a href="{{ route('admin.supplier.show', $supplier) }}"
                                   class="px-2 py-1 text-blue-600 border border-blue-600 rounded text-sm hover:bg-blue-50 transition">
                                   View
                                </a>

                                <a href="{{ route('admin.supplier.edit', $supplier) }}"
                                   class="px-2 py-1 text-yellow-600 border border-yellow-600 rounded text-sm hover:bg-yellow-50 transition">
                                   Edit
                                </a>

                                <form action="{{ route('admin.supplier.delete', $supplier) }}" method="POST" class="inline-block">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Delete this supplier?')"
                                            class="px-2 py-1 text-red-600 border border-red-600 rounded text-sm hover:bg-red-50 transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>

    </div>

</x-app-layout>
