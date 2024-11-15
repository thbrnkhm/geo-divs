<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Polling Stations " . ($district ? "for {$district->name}" : '')) }}
        </h2>
    </x-slot>

    <x-table 
        :headers="['Code', 'Station']"
        :rows="$stations"
        :rowClickable="false"
    />

    <div class="mt-4">
        {{ $stations->links() }}
    </div>
</x-app-layout>