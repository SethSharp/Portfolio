<div x-data="{
        showModal: $wire.entangle('showRegisterModal'),
        openModal() {
            this.showModal = true
        },
        closeModal() {
            this.showModal = false
        }
    }"
     x-show="showModal"
     @click.self="closeModal()"
     x-cloak
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
>
    <div class="bg-white sm:w-1/2 p-6 rounded shadow-xl">
        <h1 class="text-2xl font-bold mb-4">You need to register an account first!</h1>

        <p>
            This is an easy process and allows the comments within these blogs
            to be more likely to be actual people.
        </p>

        <div class="mt-5 flex gap-x-4">
            <a href="{{ route('login') }}"
               class="text-primary-600 border-2 border-primary-600 hover:border-transparent hover:text-white hover:bg-primary-600 transition rounded-lg p-2">
                Login
            </a>
            <a href="{{ route('register') }}"
               class="bg-primary-600 hover:bg-white text-white hover:text-primary-600 border-2 border-transparent hover:border-primary-600 transition rounded-lg p-2">
                Register
            </a>

            <span class="my-auto text-gray-400"> or </span>

            <button @click="closeModal()"
                    class="bg-white text-gray-600 border-2 border-transparent hover:border-gray-600 transition rounded-lg p-2">
                Close
            </button>
        </div>
    </div>
</div>
