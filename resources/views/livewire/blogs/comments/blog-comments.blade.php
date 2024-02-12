<div>
    <div class="bg-gray-100 px-4 py-0.5 rounded-lg">
        @foreach($comments as $comment)
            <div class="bg-white my-4 rounded-lg p-6">
                {{ $comment->comment }}
            </div>
        @endforeach
    </div>

    <div class="w-full mt-6">
        <form wire:submit="save">

            <input
                type="text"
                class="p-2 w-full rounded-xl text-gray-500"
                placeholder="Make a comment..."
                wire:model="comment"
            >

            <x-button.primary type="submit">
                <div class="flex">
                    Comment

                    <div wire:loading>
                        <span class="w-6 h-6 animate-spin duration-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                            </svg>
                        </span>
                    </div>
                </div>
            </x-button.primary>


            <div class="text-red-500 text-sm mt-3">
                @error('comment') <span class="comment">{{ $message }}</span> @enderror
            </div>
        </form>
    </div>

    @if($showRegisterModal)
        Showing register modal here...
    @endif
</div>
