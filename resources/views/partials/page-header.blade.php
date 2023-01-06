<div class="page-header">
  @if($featuredPageImage)
    <figure class="featured-image img-fill"
      style="background-image: url( {!! $featuredPageImage->url !!} ); height: 300px;">
    </figure>
  @else
    <span class="featured-image"></span>
  @endif
</div>