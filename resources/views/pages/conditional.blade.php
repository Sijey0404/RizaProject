<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-gray-800">Grade Evaluation</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto space-y-6 bg-white p-6 shadow rounded">
        @if (is_null($grade))
            <p class="text-red-600 text-lg font-medium">Invalid grades</p>
        @else
            <div>
                <p class="text-lg font-medium">Your grade {{ $grade }} = {{ $equivalent }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-md mt-4">Star Pattern</h3>
                <pre class="font-mono text-sm mt-2">
@php
    for ($i = 1; $i <= 11; $i++) {
        if ($i == 1) {
            echo "*\n";
        } elseif ($i == 2) {
            echo "* *\n";
        } elseif ($i < 11) {
            echo "* ";
            for ($j = 1; $j <= $i - 2; $j++) {
                echo "- ";
            }
            echo "*\n";
        } else {
            for ($k = 1; $k <= 11; $k++) {
                echo "* ";
            }
            echo "\n";
        }
    }
@endphp
                </pre>
            </div>
        @endif
    </div>
</x-app-layout>
