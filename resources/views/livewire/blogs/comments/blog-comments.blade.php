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

    {{ $showRegisterModal }}
    {{ $showRegisterModal === 1 ? 'true' : 'false' }}

    <div class="w-full mt-6">
        <form wire:submit.prevent="save">
            <input type="text" wire:ignore wire:model.lazy="comment">
            @error('comment') <span class="comment">{{ $message }}</span> @enderror

            <button type="submit">Save</button>
        </form>
    </div>

    <x-modals.register open="{{$showRegisterModal}}"/>
</div>
