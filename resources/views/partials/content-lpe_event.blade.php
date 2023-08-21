@if($event)
<article class="max-w-sm mx-auto px-5 lg:px-0">
    @include('components/thumb-figure', [
        'aspect_ratio' => '65%', 
        'img_url' => $event->img_url, 
        'url' => $event->url,
        'alt' => $event->alt
    ])

@else
    <article @php(post_class('max-w-sm mx-auto px-5 lg:px-0'))>
        @if(@isset($postImage))
            @include('components/thumb-figure', [
            'aspect_ratio' => '65%', 
            'img_url' => $postImage->src, 
            'url' => get_permalink(), 
            'alt' => $postImage->alt
            ])
        @endif
        
@endif

</header>

<h2 class="entry-title my-3">
    <a href="{{ $event->url ?? get_permalink() }}" class="text-2xl font-bold uppercase leading-none {{ is_paged() ? 'hover:text-tahini-500' : 'hover:text-white' }} font-rubik tracking-tighter my-3 lg:leading-none lg:text-3xl">
    {!! $event->title ?? $title !!}
    </a>
</h2>

<span class="block font-necto">{{ $event->event_start_date ?? get_field('event_start_date') }}</span>
<span class="block font-necto">{{ $event->venue_title ?? get_field('venue_title') }}</span>


<div class="entry-summary">
  @php(the_excerpt())
</div>
</article>