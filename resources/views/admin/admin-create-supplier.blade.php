<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add Supplier
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

                {{-- Error List --}}
                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded">
                        <ul class="text-sm text-red-700 dark:text-red-300 list-disc pl-5">
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.supplier.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Name
                        </label>
                        <input
                            name="name"
                            value="{{ old('name') }}"
                            required
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white 
                                   dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow-sm focus:ring-2 
                                   focus:ring-blue-500"
                            type="text"
                            placeholder="Supplier name">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Phone Number
                        </label>
                        <input
                            name="phone_no"
                            value="{{ old('phone_no') }}"
                            required
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white 
                                   dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow-sm focus:ring-2 
                                   focus:ring-blue-500"
                            type="text"
                            placeholder="01XXXXXXXXX">

                        @error('phone_no')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Address
                        </label>
                        <input
                            name="address"
                            value="{{ old('address') }}"
                            required
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white 
                                   dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow-sm focus:ring-2 
                                   focus:ring-blue-500"
                            type="text"
                            placeholder="Supplier address">
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.dashboard') }}"
                           class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-300 
                                  dark:border-gray-700 text-sm font-medium text-gray-700 dark:text-gray-200 
                                  hover:bg-gray-50 dark:hover:bg-gray-900">
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center px-6 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 
                                   text-white font-semibold text-sm focus:ring-2 focus:ring-blue-500">
                            Save Supplier
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
