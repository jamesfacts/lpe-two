
<header class="" style="margin-left: -2px;">
@if($featuredHeaderImage)
<span class="block w-full h-full" style="background-color: #c7dbe8;">
    <figure class="h-80" style="background-image: url( '{!! $featuredHeaderImage['url'] !!}' )">
    </figure>
</span>
@endif
<div class="mx-5 mb-5 max-w-md sm:mx-10 lg:mt-12 lg:ml-20">
    <h1 class="text-4xl font-bold uppercase font-rubik tracking-tighter leading-none mt-8 mb-1 lg:mt-3 lg:text-5xl">{!! get_the_title() !!}</h1>
    <div class="black-outline uppercase text-4xl font-bold">{!! get_field('school_affiliation') !!}</div>
</div>

</header>

<section class="mx-5 mb-20 flex flex-col-reverse sm:mx-10 lg:ml-20 lg:mb-40 lg:flex-row lg:mt-12">
    <div class="lg:flex lg:flex-col lg:max-w-xs lg:pr-12 ">
        @include('components.view-all-btn', ['content_type' => 'Student Groups', 'slug' => 'student-groups'])
    </div>
    <article @php post_class('max-w-md lg:max-w-3xl xl:pr-4') @endphp>
        <div class="mb-6">
        @php the_content() @endphp
        </div>
        @if(get_field('external_group_url'))
        <span class="">
            @include('components/generic-btn', ['url' => get_field('external_group_url'), 'copy' => 'Visit Website'])
        </span>
        @endif
    </article>

</section>
