<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Upload Sheet - {{ $operator->name }}</h2>
    </x-slot>

    <div class="py-8 max-w-xl mx-auto">
        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 rounded">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white p-4 rounded shadow">
            <form method="POST" action="{{ route('sheets.store', $operator) }}" enctype="multipart/form-data">
                @csrf

                <label class="block mb-2">Period Month (YYYY-MM)</label>
                <input class="w-full border p-2 mb-4" name="period_month" placeholder="2026-01" value="{{ old('period_month') }}">

                <label class="block mb-2">File (CSV or XLSX)</label>
                <input type="file" class="w-full border p-2 mb-4" name="file">

                <button class="px-3 py-2 bg-blue-600 text-white rounded">Upload & Import</button>
            </form>
        </div>
    </div>
</x-app-layout>
