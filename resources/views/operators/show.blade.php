<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $operator->name }} - Revenue Sheets</h2>
    </x-slot>

    <div class="py-8 max-w-6xl mx-auto">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 rounded">{{ session('success') }}</div>
        @endif

        <div class="mb-4">
            <a class="px-3 py-2 bg-blue-600 text-white rounded"
               href="{{ route('sheets.create', $operator) }}">
                Upload New Sheet
            </a>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border">Period</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sheets as $s)
                        <tr>
                            <td class="p-2 border">{{ $s->period_month }}</td>
                            <td class="p-2 border">{{ $s->status }}</td>
                            <td class="p-2 border flex gap-3">
                                <form method="POST" action="{{ route('sheets.calculate', $s) }}">
                                    @csrf
                                    <button class="px-3 py-1 bg-green-600 text-white rounded">
                                        Calculate
                                    </button>
                                </form>

                                <a class="text-blue-600 underline" href="{{ route('sheets.results', $s) }}">View Results</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="p-2 border" colspan="3">No sheets uploaded yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>