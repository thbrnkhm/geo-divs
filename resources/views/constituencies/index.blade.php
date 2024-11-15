<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Constituencies and District Counts') }}
        </h2>
    </x-slot>

    <x-table 
        :headers="['Code', 'Constituency', 'District Count']"
        :rows="$constituencies"
        routePrefix="/constituency"
        countKey="district_count"
        countRelation="district"
    />

    <div class="mt-4">
        {{ $constituencies->links() }}
    </div>
</x-app-layout>