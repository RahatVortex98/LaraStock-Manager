<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
            Categories
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

        {{-- Add Category Button --}}
        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.category.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
               + Add Category
            </a>
        </div>

        {{-- Categories Table --}}
        <div class="bg-white dark:bg-gray-900 shadow rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-700 dark:text-gray-200 font-semibold">Name</th>
                            <th class="px-6 py-3 text-left text-gray-700 dark:text-gray-200 font-semibold">Description</th>
                            <th class="px-6 py-3 text-center text-gray-700 dark:text-gray-200 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($categories as $category)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                <td class="px-6 py-3">{{ $category->name }}</td>
                                <td class="px-6 py-3">{{ $category->description }}</td>
                                <td class="px-6 py-3 text-center flex justify-center gap-2">
                                    <a href="{{ route('admin.category.show', $category) }}" 
                                       class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded shadow transition text-sm">
                                       View
                                    </a>
                                    <a href="{{ route('admin.category.edit', $category) }}" 
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded shadow transition text-sm">
                                       Edit
                                    </a>
                                    <form action="{{ route('admin.category.delete', $category) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Are you sure you want to delete this category?')" 
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow transition text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-gray-50 dark:bg-gray-800">
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>
