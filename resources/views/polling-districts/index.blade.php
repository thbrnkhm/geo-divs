<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Polling Districts " . ($constituency ? "for {$constituency->name}" : '')) }}
        </h2>
    </x-slot>

    <x-table 
        :headers="['Code', 'District', 'Count']"
        :rows="$districts"
        routePrefix="/polling-districts"
        countKey="station_count"
        countRelation="station"
    />

    <div class="mt-4">
        {{ $districts->links() }}
    </div>
</x-app-layout>