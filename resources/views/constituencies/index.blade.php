<x-app-layout>
    <x-slot:heading>
        Constituencies and District Counts
    </x-slot:heading>

    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Code</th>
                <th class="border border-gray-300 px-4 py-2">Constituency</th>
                <th class="border border-gray-300 px-4 py-2">District Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($constituencies as $constituency)
            <tr>
                <td class="border border-gray-300 px-4 py-2">
                    <p >
                        {{ $constituency['id'] }}
                    </p>
                </td>
                <td class="border border-gray-300 px-4 py-2">
                    <a class="hover:text-sky-500" href="/constituency/{{ $constituency['id'] }}">
                        {{ $constituency->name }}
                    </a>
                </td>
                <td class="border border-gray-300 px-4 py-2">

                    <strong>{{ $constituency->district->count() }}</strong>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">{{ $constituencies->links() }}</div>
</x-app-layout>