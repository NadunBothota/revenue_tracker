<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 rounded">{{session('success')}}</div>
            @endif

            <div class="bg-white p-4 rounded shadow">
                <h3 class="font-semibold mb-3">Recent Revenue Sheets</h3>

                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-2 border">Operator</th>
                            <th class="p-2 border">Period</th>
                            <th class="p-2 border">Status</th>
                            <th class="p-2 border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentSheets as $s)
                            <tr>
                                <td class="p-2 border">{{ $s->operator->name }}</td>
                                <td class="p-2 border">{{ $s->period_month }}</td>
                                <td class="p-2 border">{{ $s->status }}</td>
                                <td class="p-2 border">
                                    <a class="text-blue-600 underline" href="{{ route('sheets.results', $s) }}">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="p-2 border" colspan="4">No sheets yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
