@props(['post'])

@if ($post->published_at)
    {{ __('Published on :published_on', ['published_on' => $post->published_at->format('Y-m-d')]) }} —
    {!! __('in :in', ['in' => '<a href="' . route('post.index', ['category' => $post->category->slug]) . '">' . __($post->category->name) . '</a>']) !!}
@else
    {{ __('[Not published]') }}
@endif
