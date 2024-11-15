@props([
    'headers' => [],         // array of header columns
    'rows' => [],           // collection of data rows
    'routePrefix' => null,  // route prefix for row clicks
    'links' => null,        // pagination links
    'rowClickable' => true, // whether rows are clickable
    'countKey' => null,     // key for count column (if any)
    'countRelation' => null // relation to count (if any)
])

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-800 uppercase bg-gray-100">
            <tr>
                @foreach($headers as $header)
                    <th class="px-6 py-3 bg-gray-200">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $row)
                <tr @if($rowClickable && $routePrefix) 
                    onclick="window.location='{{ $routePrefix }}/{{ $row->id }}'"
                    class="bg-white border-b hover:bg-gray-100 cursor-pointer"
                    @else
                    class="bg-white border-b hover:bg-gray-100"
                    @endif
                >
                    @foreach($headers as $key => $header)
                        @if($loop->first)
                            <td class="px-6 py-4">
                                {{ $row->id }}
                            </td>
                        @elseif($loop->last && $countKey && $countRelation)
                            <td class="px-6 py-4">
                                <strong>{{ $row->{$countRelation}->count() }}</strong>
                            </td>
                        @else
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                @if(isset($row->{$key}))
                                    {{ $row->{$key} }}
                                @else
                                    {{ $row->name }}
                                @endif
                            </th>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
