<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-gray-800">Grades</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto space-y-6 bg-white p-6 shadow rounded">
        @php
            $grade = 90;
            $equivalent = null;

            if ($grade >= 97) $equivalent = "1.0";
            elseif ($grade >= 94) $equivalent = "1.25";
            elseif ($grade >= 91) $equivalent = "1.5";
            elseif ($grade >= 88) $equivalent = "1.75";
            elseif ($grade >= 85) $equivalent = "2.0";
            elseif ($grade >= 82) $equivalent = "2.25";
            elseif ($grade >= 79) $equivalent = "2.5";
            elseif ($grade >= 76) $equivalent = "2.75";
            elseif ($grade >= 75) $equivalent = "3.0";
            else $equivalent = "5.0";
        @endphp

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
    </div>
</x-app-layout>
