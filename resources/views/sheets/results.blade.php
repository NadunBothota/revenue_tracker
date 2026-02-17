<x-app-layout>linked
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Results - {{ $sheet->operator->name }} ({{ $sheet->period_month }})
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 rounded">{{ session('success') }}</div>
        @endif

        @php
            $unmatched = session('unmatched', []);
        @endphp

        @if(!empty($unmatched))
            <div class="mb-4 p-3 bg-yellow-100 rounded">
                <h3 class="font-semibold mb-2">Unmatched / Errors</h3>
                <ul class="list-disc pl-5">
                    @foreach($unmatched as $u)
                        <li>Row {{ $u['row_id'] }}: {{ $u['reason'] }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white p-4 rounded shadow">
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border">Song ID</th>
                        <th class="p-2 border">Title</th>
                        <th class="p-2 border">Owner</th>
                        <th class="p-2 border">Net Revenue</th>
                        <th class="p-2 border">Agreement %</th>
                        <th class="p-2 border">Split %</th>
                        <th class="p-2 border">Owner Amount</th>
                        <th class="p-2 border">Company Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lines as $l)
                        <tr>
                            <td class="p-2 border">{{ $l->content->song_id }}</td>
                            <td class="p-2 border">{{ $l->content->content_title }}</td>
                            <td class="p-2 border">{{ $l->owner->name }}</td>
                            <td class="p-2 border">{{ number_format($l->gross_net_revenue, 2) }}</td>
                            <td class="p-2 border">{{ $l->agreement_percentage }}%</td>
                            <td class="p-2 border">{{ $l->owner_split_percentage }}%</td>
                            <td class="p-2 border">{{ number_format($l->owner_amount, 2) }}</td>
                            <td class="p-2 border">{{ number_format($l->company_amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr><td class="p-2 border" colspan="8">No calculations yet. Click Calculate from operator page.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
