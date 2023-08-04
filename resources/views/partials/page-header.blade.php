<div class="page-header" style="margin-left: -2px;">
  @if(!empty($featuredHeaderImage))
    <figure class="featured-image img-fill"
      style="background-image: url( {!! $featuredHeaderImage['url'] !!} ); height: 300px;">
    </figure>
  @else
    <span class="featured-image"></span>
  @endif
</div>