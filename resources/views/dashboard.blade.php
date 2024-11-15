<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upload Excel File') }}
        </h2>
    </x-slot>

    <div class="max-w-md mx-auto rounded-lg overflow-hidden md:max-w-xl">
        @if (session('success'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">{{ session('success') }}</div>
        @endif

        <form action="{{ route('dashboard') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Choose File</label>
                <input type="file" name="file" class="block w-full p-2 border rounded">
                @error('file')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                Import
            </button>
        </form>
    </div>
    
</x-app-layout>