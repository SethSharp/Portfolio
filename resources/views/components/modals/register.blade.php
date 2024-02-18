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
                    to be more likely to be actual people.
                </p>

                <div class=" mt-5">
                    <x-button.secondary @click="closeModal()">
                        Close
                    </x-button.secondary>

                    <a href="{{route('register')}}" class="p-2 bg-primary-500 text-white rounded">
                        Register
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
