<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Category Details
        </h2>
    </x-slot>

    {{-- Page Content --}}
    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">

        {{-- Category Card --}}
        <div class="bg-white shadow rounded-xl p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4">Category Information</h3>

            <ul class="divide-y divide-gray-200">
                <li class="py-2 flex justify-between">
                    <span class="font-semibold">Name:</span>
                    <span>{{ $category->name }}</span>
                </li>
                <li class="py-2 flex justify-between">
                    <span class="font-semibold">Description:</span>
                    <span>{{ $category->description ?? '-' }}</span>
                </li>
            </ul>
        </div>

        {{-- Back Button --}}
        <a href="{{ route('admin.category.index') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
            Back
        </a>

    </div>

</x-app-layout>
