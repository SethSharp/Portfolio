<div>
    <form wire:submit.prevent="send" class="space-y-2">
        @if (session()->has('success'))
            <div class="text-green-500">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-2 gap-2">
            <div>
                <input
                    type="text"
                    class="p-2 w-full rounded-xl text-primary-700 placeholder-primary-700 border-primary-800 focus:border-primary-800 focus:ring-offset-2 !ring-transparent"
                    placeholder="Name"
                    wire:model.lazy="name"
                    wire:ignore
                    required
                >
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <input
                    type="text"
                    class="p-2 w-full rounded-xl text-primary-700 placeholder-primary-700 border-primary-800 focus:border-primary-800 focus:ring-offset-2 !ring-transparent"
                    placeholder="Email"
                    wire:model.lazy="email"
                    wire:ignore
                    required
                >
                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <textarea
                type="text"
                class="p-2 h-28 w-full rounded-xl text-primary-700 placeholder-primary-700 border-primary-800 focus:border-primary-800 focus:ring-offset-2 !ring-transparent"
                placeholder="Your message..."
                wire:model.lazy="message"
                wire:ignore
                required
            ></textarea>

            @error('message') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <x-button.primary type="submit">
                Send
            </x-button.primary>
        </div>
    </form>
</div>
