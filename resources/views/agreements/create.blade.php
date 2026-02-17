<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Create Agreement + Content + Owner Splits</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 rounded">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 rounded">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white p-4 rounded shadow">
            <form method="POST" action="{{ route('agreements.store') }}">
                @csrf

                <h3 class="font-semibold mb-2">Agreement</h3>
                <input class="w-full border p-2 mb-2" name="agreement_number" placeholder="EV000189" value="{{ old('agreement_number') }}">
                <input class="w-full border p-2 mb-2" name="subcategory" placeholder="Evoke" value="{{ old('subcategory') }}">

                <select class="w-full border p-2 mb-2" name="payment_term">
                    <option value="Revenue Share">Revenue Share</option>
                    <option value="Advance Recovered">Advance Recovered</option>
                </select>

                <input class="w-full border p-2 mb-4" name="artist_revenue_percentage" placeholder="60" value="{{ old('artist_revenue_percentage') }}">

                <h3 class="font-semibold mb-2">Content (Song)</h3>
                <input class="w-full border p-2 mb-2" name="song_id" placeholder="408631" value="{{ old('song_id') }}">
                <input class="w-full border p-2 mb-2" name="content_title" placeholder="Boho Kalak Oya" value="{{ old('content_title') }}">
                <input class="w-full border p-2 mb-4" name="artist_name" placeholder="Athula Adikari" value="{{ old('artist_name') }}">

                <h3 class="font-semibold mb-2">Owners + Splits (must total 100%)</h3>

                <div class="grid grid-cols-2 gap-2 mb-2">
                    <input class="border p-2" name="owners[]" placeholder="Owner 1 name">
                    <input class="border p-2" name="splits[]" placeholder="Split % (e.g., 50)">
                </div>
                <div class="grid grid-cols-2 gap-2 mb-2">
                    <input class="border p-2" name="owners[]" placeholder="Owner 2 name (optional)">
                    <input class="border p-2" name="splits[]" placeholder="Split % (e.g., 50)">
                </div>
                <div class="grid grid-cols-2 gap-2 mb-4">
                    <input class="border p-2" name="owners[]" placeholder="Owner 3 name (optional)">
                    <input class="border p-2" name="splits[]" placeholder="Split % (e.g., 0)">
                </div>

                <textarea class="w-full border p-2 mb-4" name="remarks" placeholder="Remarks (optional)">{{ old('remarks') }}</textarea>

                <button class="px-3 py-2 bg-blue-600 text-white rounded">Save Agreement</button>
            </form>
        </div>
    </div>
</x-app-layout>
