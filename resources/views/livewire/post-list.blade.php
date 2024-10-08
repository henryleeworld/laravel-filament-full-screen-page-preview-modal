<div>
    <x-banner>
        @if ($activeCategory)
            <h1>{{ __('Category: ') . $activeCategory->name }}</h1>
        @else
            <h1>{{ __('All Posts') }}</h1>
        @endif
    </x-banner>

    <x-container>
        @if ($postChunks->isNotEmpty())
            <div class="mt-8 flex flex-col gap-4 lg:items-center lg:flex-row">
                <x-select name="category" wire:model.live="category">
                    <option value="">{{ __('All categories') }}</option>
                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->slug }}"
                            @if ($activeCategory && $activeCategory->slug === $category->slug) selected @endif
                        >{{ __($category->name) }}</option>
                    @endforeach
                </x-select>

                <x-select name="order" wire:model.live="order">
                    <option value="date_desc">{{ __('Show most recent') }}</option>
                    <option value="date_asc">{{ __('Show least recent') }}</option>
                </x-select>

                <div class="lg:ml-auto">
                    {{ __('Found') . ' ' . $postCount }} {{ __(Str::plural('post', $postCount)) }}
                </div>
            </div>

            <div>
                @foreach ($postChunks as $chunk)
                    @if ($currentChunk >= $loop->index)
                        @livewire('post-chunk', ['postIds' => $chunk], key("chunk-{$queryCount}-{$loop->index}"))
                    @endif
                @endforeach
            </div>

            @if ($currentChunk < count($postChunks) - 1)
                <div class="mt-16 flex justify-center">
                    <x-button label="{{ __('Load more') }}" wire:click="loadMore"></x-button>
                </div>
            @endif

        @else
            <div class="my-16 text-center">{{ __('There are no posts') }}</div>
        @endif
    </x-container>
</div>
