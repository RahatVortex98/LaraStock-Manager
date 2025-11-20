<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Supplier
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

                <form 
                    action="{{ route('admin.supplier.update', $supplier) }}" 
                    method="POST"
                    class="space-y-6"
                >
                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Name
                        </label>
                        <input
                            name="name"
                            value="{{ $supplier->name }}"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white 
                                   dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow-sm 
                                   focus:ring-2 focus:ring-blue-500"
                            required
                        >
                    </div>

                    {{-- Phone No --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Phone No
                        </label>
                        <input
                            name="phone_no"
                            value="{{ $supplier->phone_no }}"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white 
                                   dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow-sm 
                                   focus:ring-2 focus:ring-blue-500"
                            required
                        >
                        @error('phone_no')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Address
                        </label>
                        <input
                            name="address"
                            value="{{ $supplier->address }}"
                            class="mt-1 w-full rounded-lg border-gray-300 dark:border-gray-700 bg-white 
                                   dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow-sm 
                                   focus:ring-2 focus:ring-blue-500"
                            required
                        >
                    </div>

                    {{-- Buttons --}}
