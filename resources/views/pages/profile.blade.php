<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-gray-800">Profile</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto space-y-6">
        <!-- User Profile Card -->
        <div class="bg-white p-6 shadow rounded">
            <h3 class="text-xl font-bold mb-2">User Profile</h3>
            <p>Username: {{ Auth::user()->username }}</p>
        </div>

        <!-- About Me Section -->
        <div class="bg-white p-6 shadow rounded">
            <h3 class="text-2xl font-semibold mb-2">About Me</h3>
            <p class="text-gray-700">
                Hi, I'm Riza Poquiz, a student in the BSIT-3b program. I'm passionate about technology, problem-solving,
                and the ever-evolving world of IT. I'm currently working on developing my skills and knowledge to pursue
                a career in the IT industry.
            </p>
        </div>

        <!-- My Goals Section -->
        <div class="bg-white p-6 shadow rounded">
            <h3 class="text-2xl font-semibold mb-2">My Goals</h3>
            <p class="text-gray-700">
                My goal is to apply what I learn in my courses to real-world problems and grow into a skilled IT
                professional. I strive to contribute to the field through hard work and dedication, and I’m excited about
                the opportunities ahead!
            </p>
        </div>
    </div>
</x-app-layout>
