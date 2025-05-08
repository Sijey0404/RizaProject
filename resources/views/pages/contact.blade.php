<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-gray-800">Contact Us</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto space-y-6">
        <!-- Intro Text -->
        <div class="bg-white p-6 shadow rounded">
            <p class="text-gray-700">
                If you have any questions or need assistance, please don't hesitate to reach out. We're here to help!
            </p>
        </div>

        <!-- Contact Information -->
        <div class="bg-white p-6 shadow rounded">
            <h3 class="text-xl font-semibold mb-4">Contact Information:</h3>
            <p><strong>Email:</strong> <a href="mailto:rizapoquiz8@gmail.com" class="text-blue-600 hover:underline">rizapoquiz8@gmail.com</a></p>
            <p><strong>Phone:</strong> 09121124410</p>
            <p><strong>Address:</strong> Urbiztondo, Pangasinan</p>
        </div>

        <!-- Contact Form -->
        <div class="bg-white p-6 shadow rounded">
            <h3 class="text-xl font-semibold mb-4">Contact Form</h3>
            <p class="mb-4 text-gray-700">If you'd prefer to send us a message directly, please use the form below:</p>

            <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block font-medium">Full Name:</label>
                    <input type="text" id="name" name="name" required class="w-full border-gray-300 rounded shadow-sm">
                </div>

                <div>
                    <label for="email" class="block font-medium">Email Address:</label>
                    <input type="email" id="email" name="email" required class="w-full border-gray-300 rounded shadow-sm">
                </div>

                <div>
                    <label for="message" class="block font-medium">Message:</label>
                    <textarea id="message" name="message" rows="4" required class="w-full border-gray-300 rounded shadow-sm"></textarea>
                </div>

                <div>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
