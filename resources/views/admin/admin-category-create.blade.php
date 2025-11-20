<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Create Category</h2>
    </x-slot>

    <div class="py-6">
        <form action="{{ route('admin.category.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="border px-2 py-1 rounded w-full">
            </div>
            <div>
                <label>Description</label>
                <textarea name="description" class="border px-2 py-1 rounded w-full">{{ old('description') }}</textarea>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Create</button>
        </form>
    </div>
</x-app-layout>
