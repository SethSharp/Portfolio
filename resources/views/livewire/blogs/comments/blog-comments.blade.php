<div>
    <div class="bg-gray-100 px-4 py-0.5 rounded-lg">
        @foreach($comments as $comment)
            <div class="bg-white p-4 my-4 rounded-lg">
                <span class="font-bold"> {{ $comment->user->name }}</span>

                <div class="">
                    {{ $comment->comment }}
                </div>

                <span class="text-gray-400 text-sm">
                    @if($comment->posted)
                        {{ $comment->posted }}
                    @else
                        Now
                    @endif
                </span>
            </div>
        @endforeach
    </div>

    <div class="w-full mt-6">
        <form wire:submit.prevent="save">
            <div class="flex gap-x-4">
                <input
                    type="text"
                    class="p-2 w-full rounded-xl text-gray-500"
                    placeholder="Make a comment..."
                    wire:model.lazy="comment"
                    wire:ignore
                >

                <x-button.primary type="submit">
                    Comment
                </x-button.primary>
            </div>

            @error('comment') <span class="comment">{{ $message }}</span> @enderror
        </form>
    </div>

    <x-modals.register/>
</div>
