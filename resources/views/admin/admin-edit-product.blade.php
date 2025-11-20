<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Product
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="mb-4 px-4 py-3 bg-green-600 text-white rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Errors --}}
                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded">
                        <ul class="text-sm text-red-700 dark:text-red-300 list-disc pl-5">
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form action="{{ route('admin.product.update', $product) }}" 
                      method="POST" 
                      class="space-y-6">

                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Name
                        </label>
                        <input
                            name="name"
                            value="{{ $product->name }}"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white 
                                   dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow-sm 
                                   focus:ring-2 focus:ring-blue-500"
                            required
                        >
                    </div>

                    {{-- Quantity --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Quantity
                        </label>
                        <input
                            name="Qty"
                            type="number"
                            value="{{ $product->Qty }}"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white 
                                   dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow-sm 
                                   focus:ring-2 focus:ring-blue-500"
                        >
                    </div>

                    {{-- Unit Price --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Unit Price
                        </label>
                        <input
                            name="unit_price"
                            type="number"
                            step="0.01"
                            value="{{ $product->unit_price }}"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white 
                                   dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow-sm 
                                   focus:ring-2 focus:ring-blue-500"
                        >
                    </div>

                    {{-- Supplier --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Supplier
                        </label>
                        <select
                            name="supplier_id"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white 
                                   dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow-sm 
                                   focus:ring-2 focus:ring-blue-500"
                        >
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    @selected($supplier->id == $product->supplier_id)>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Category --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Category
                        </label>
                        <select
                            name="category_id"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white 
                                   dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow-sm 
                                   focus:ring-2 focus:ring-blue-500"
                        >
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    @selected($cat->id == $product->category_id)>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Status
                        </label>
                        <select
                            name="status"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white 
                                   dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow-sm 
                                   focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="1" @selected($product->status == 1)>Active</option>
                            <option value="0" @selected($product->status == 0)>Inactive</option>
                        </select>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.dashboard') }}"
                           class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 
                                  text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-900">
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="px-6 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 
                                   text-white font-semibold focus:ring-2 focus:ring-blue-500">
                            Update Product
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
