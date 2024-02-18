<div
    x-data="{
        showModal: @entangle('showRegisterModal'),
        openModal() {
        console.log('action')
            this.showModal = true
        },
        closeModal() {
            console.log('action')
            this.showModal = false
        }
    }"
>
    <div x-show="showModal" @click="closeModal()" x-cloak
         class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white w-1/2 p-6 rounded shadow-lg">
                <!-- Modal content goes here -->
                <h2 class="text-2xl font-bold mb-4">You need to register an account to comment</h2>
                <p>
                    This is an easy process and allows the comments within these blogs
                    to be mor elikely to be actualy people.
                </p>

                <!-- Close button -->
                <button @click="closeModal()" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded">Close</button>
            </div>
        </div>
    </div>
</div>
