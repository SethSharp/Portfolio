@props(['open' => false])

<div
    x-data="{

        showModal: {{ $open === '1' ? 'true' : 'false' }},
        openModal() {
        console.log('action')
            this.showModal = true
        },
        closeModal() {
        console.log('action')
            this.showModal = false
        },
    }"
    x-init="$watch('showModal', value => console.log(value))"
>
    <div x-show="showModal" x-cloak class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white w-1/2 p-6 rounded shadow-lg">
                <!-- Modal content goes here -->
                <h2 class="text-2xl font-bold mb-4">Modal Title</h2>
                <p>This is a basic modal example.</p>

                <!-- Close button -->
                <button @click="closeModal()" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded">Close</button>
            </div>
        </div>
    </div>
</div>
