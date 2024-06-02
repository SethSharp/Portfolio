<div>
    <x-modals.register/>
    
    <h3 class="text-gray-500 text-xl"> Comments ({{ count($comments) }})</h3>

    <div class=" mt-4 px-2 sm:px-4 py-0.5 rounded-lg">
        @if (count($comments))
            @foreach($comments as $comment)
                <div class="bg-gray-100 p-4 my-4 rounded-lg">
                    <span class="font-bold"> {{ $comment->user->name }}</span>

                    <div class="">
                        {{ $comment->comment }}
                    </div>

                    <span class="text-gray-400 text-sm">
                    {{ $comment->created_at->diffForHumans() }}
                </span>
                </div>
            @endforeach
        @endif
    </div>

    <div class="w-full mt-6">
        <form wire:submit.prevent="save">
            <div class="sm:flex gap-x-4 gap-y-2">
                <input
                    type="text"
                    class="p-2 w-full rounded-xl text-gray-500"
                    placeholder="{{ count($comments) === 0 ? 'Be the first to comment...' : 'Make a comment...'  }}"
                    wire:model.lazy="comment"
                    wire:ignore
                >

                <x-button.primary type="submit">
                    Comment
                </x-button.primary>
            </div>

            @error('comment') <p class="text-red-500">{{ $message }}</p> @enderror
        </form>
    </div>
</div>
