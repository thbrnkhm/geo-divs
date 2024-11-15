<x-app-layout>
    <x-slot:heading>
        Polling Stations {{ $district ? "for {$district->name}" : '' }}
    </x-slot:heading>

    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Code</th>
                <th class="border border-gray-300 px-4 py-2">Station</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($stations as $station )
            <tr>
                <td class="border border-gray-300 px-4 py-2">
                    <p>{{ $station['id'] }}</p>
                </td>
                <td class="border border-gray-300 px-4 py-2">
                    <p>{{ $station->name }}</p>
                    <!-- <a class="hover:text-sky-500" href="/polling-stations/{{ $station['id'] }}">
                        {{ $station->name }}
                    </a> -->
                </td>
            </tr>
            @empty
            <strong>No polling stations available{{ $district ? " for {$district->name}" : '' }}.</strong>

            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $stations->links() }}
    </div>
</x-app-layout>