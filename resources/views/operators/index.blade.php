<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Operators</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto">
        <div class="bg-white p-4 rounded shadow">
            <ul class="list-disc pl-5">
                @foreach ($operators as $op)
                    <li class="mb-2">
                        <a class="text-blue-600 underline" href="{{ route('operators.show', $op) }}">{{ $op->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>