<figure>
    <a href="{{ $url }}">
      <div class="aspect-ratio-wrap relative" style="padding-bottom: {{ $aspect_ratio ?? '0%' }};">
        <img src="{{ $img_url }}" @if($alt) alt="{!! $alt !!}" @endif 
             class="block absolute top-0 left-0 object-cover w-full h-full">
      </div>
    </a>
</figure>