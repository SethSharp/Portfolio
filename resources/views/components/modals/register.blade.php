<div
    x-data="{
        showModal: @entangle('showRegisterModal'),
        openModal() {
            this.showModal = true
        },
        closeModal() {
            this.showModal = false
        }
    }"
>
    <div x-show="showModal" @click="closeModal()" x-cloak
         class="fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white sm:w-1/2 p-6 rounded shadow-lg">
                <h2 class="text-2xl font-bold mb-4">You need to register an account to comment</h2>
                <p>
                    This is an easy process and allows the comments within these blogs
                    to be more likely to be actual people.
                </p>

                <div class=" mt-5 flex gap-x-4">
                    <button @click="closeModal()"
                            class="bg-white text-secondary-600 border-2 border-transparent hover:border-secondary-600 transition rounded-lg p-2">
                        Close
                    </button>

                    <a href="{{route('register')}}"
                       class="bg-primary-600 hover:bg-primary-400 text-white transition rounded-lg p-2">
                        Register
                    </a>

                    <span class="my-auto text-secondary-400"> or </span>

                    <a href="{{route('login')}}"
                       class="text-primary-600 border-2 border-primary-600 hover:border-transparent hover:text-primary-400 transition rounded-lg p-2">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
