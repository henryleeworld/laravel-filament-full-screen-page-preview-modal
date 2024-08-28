<x-layouts.main :title="__($page->title)">
    <x-banner>
        <h1>{{ __($page->title) }}</h1>
    </x-banner>

    <x-container>
        <div class="prose mt-8 mx-auto text-black">
            {!! $page->content !!}
        </div>
    </x-container>
</x-layouts.main>
