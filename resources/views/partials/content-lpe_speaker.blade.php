<article @php(post_class('border-b border-black mb-5 pb-2'))>
  <header>
    
    <h2 class="text-2xl font-bold uppercase leading-none hover:text-tahini-500 font-rubik tracking-tighter my-3 lg:leading-none lg:text-3xl">
      <a href="{{ get_permalink() }}">
        {!! $title !!}
      </a>
    </h2>

    <span class="font-necto block mb-6">{!! $homeBase !!}</span>
  </header>

</article>
