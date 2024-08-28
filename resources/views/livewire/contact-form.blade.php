<div>
    @if ($isSent)
        <div class="text-center">{{ __('Thank you, we\'ll be in touch!') }}</div>
    @else
        <form wire:submit="submit">
            <div class="mt-4">
                <x-input wire:model="name" name="name" label="{{ __('Name') }}" required />
            </div>

            <div class="mt-4">
                <x-input wire:model="email" name="email" label="{{ __('Email') }}" type="email" required />
            </div>

            <div class="mt-4">
                <x-textarea wire:model="message" name="message" label="{{ __('Message') }}" rows="8" required />
            </div>

            <div class="mt-4">
                <x-input wire:model="quiz" name="quiz" label="{{ __('What is 8-1?') }}" required />
            </div>

            <div class="mt-4">
                <x-button label="{{ __('Send') }}" />
            </div>
        </form>
    @endif
</div>
