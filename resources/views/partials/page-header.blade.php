<div class="page-header" style="margin-left: -2px;">
  @if(!empty($featuredHeaderImage))
    <figure class="h-[300px] bg-center bg-no-repeat bg-cover " style="background-image: url( '{!! $featuredHeaderImage['url'] !!}' )">
    </figure>
  @else
    <span class="featured-image"></span>
  @endif
</div>