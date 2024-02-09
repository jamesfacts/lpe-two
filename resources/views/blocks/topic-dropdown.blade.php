<div class="{{ $block->classes }}">
  @if($topics)

  <div class="dropdown">
  <label class="screen-reader-text" for="archive-tax-dropdown">Speaker Topics</label>
    Speaker Topics
    <select name="" id="archive-tax-dropdown">
        @foreach($topics as $taxItem)
            <option class="level-0" value="{!! $taxItem->url !!}">{!! $taxItem->name !!}</option>
        @endforeach
      </select>
    </div>
  @endif

  <div>
    <InnerBlocks />
  </div>
</div>
