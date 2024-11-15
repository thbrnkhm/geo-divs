<x-app-layout>
        
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Search results for $query") }}
        </h2>
    </x-slot>

    <div class="mb-5">
        @if ($constituencies->isNotEmpty())
        <h2 class="font-bold text-lg">Constituencies</h2>
        <ul>
            @foreach ($constituencies as $constituency)
            <li>
                <a class="text-blue-500 hover:underline" href="/polling-districts/{{ $constituency->id }}">
                    {{ $constituency->name }}
                </a>
            </li>
            @endforeach
        </ul>
        @endif
    </div>

    <div class="mb-5">
        @if ($districts->isNotEmpty())
        <h2 class="font-bold text-lg">Districts</h2>
        <ul>
            @foreach ($districts as $district)
            <li>
                {{ $district->name }} - Found under constituency: 
                <a class="text-blue-500 hover:underline" href="/polling-districts/{{ $district->constituency->id }}">
                    {{ $district->constituency->name }}
                </a>
            </li>
            @endforeach
        </ul>
        @endif
    </div>

    <div class="mb-5">
        @if ($stations->isNotEmpty())
        <h2 class="font-bold text-lg">Stations</h2>
        <ul>
            @foreach ($stations as $station)
            <li>
                {{ $station->name }} - Found under constituency: 
                <a class="text-blue-500 hover:underline" href="/polling-districts/{{ $station->district->constituency->id }}">
                    {{ $station->district->constituency->name }}
                </a>
            </li>
            @endforeach
        </ul>
        @endif
    </div>

    @if ($constituencies->isEmpty() && $districts->isEmpty() && $stations->isEmpty())
    <p>No results found for "{{ $query }}".</p>
    @endif
</x-app-layout>