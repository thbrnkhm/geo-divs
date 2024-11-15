<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Excel File') }}
        </h2>
    </x-slot>

    <div class="max-w-md mx-auto rounded-lg overflow-hidden md:max-w-xl">
        @if (session('success'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">{{ session('success') }}</div>
        @endif

        <form action="{{ route('dashboard') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" >Choose File</label>
                <div class="relative" >
                    <input type="file" name="file" class="block w-full p-3 border rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required style="border: 2px dashed gray; background-color:white;">

                    <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" >
                        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 2m0 0l-2-2m2 2V9"  />
                        </svg>
                    </span>
                </div>
                @error('file')
                <span class="text-red-500 mt-2 inline-block" >{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Import
            </button>
        </form>
    </div>


</x-app-layout>