<x-app-layout>
    <x-slot:heading>
        Polling Districts {{ $constituency ? "for {$constituency->name}" : '' }}
    </x-slot:heading>

    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Code</th>
                <th class="border border-gray-300 px-4 py-2">District</th>
                <th class="border border-gray-300 px-4 py-2">Count</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($districts as $district )
            <tr>
                <td class="border border-gray-300 px-4 py-2">
                    <p>{{ $district['id'] }}</p>
                </td>
                <td class="border border-gray-300 px-4 py-2">
                    <a class="hover:text-sky-500" href="/polling-stations/{{ $district['id'] }}">
                        {{ $district['name'] }}
                    </a>
                </td>
                <td class="border border-gray-300 px-4 py-2">
                    <p>{{ $district->station->count() }}</p>
                </td>
            </tr>
            @empty
            <p>No polling districts available{{ $constituency ? " for {$constituency->name}" : '' }}.</p>
            @endforelse
        </tbody>
    </table>

    <div>{{ $districts->links() }}</div>
</x-app-layout>