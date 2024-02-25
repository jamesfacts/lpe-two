<div class="page-header" style="margin-left: -2px;">
  @if(!empty($featuredHeaderImage))
    <figure class="h-[420px] bg-center bg-no-repeat bg-cover xl:h-[39vh]" style="background-image: url( '{!! $featuredHeaderImage['url'] !!}' )">
    </figure>
  @else
    <span class="featured-image"></span>
  @endif
</div>