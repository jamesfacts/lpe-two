@if($block->preview)
    <h3 style="font-family: Rubik, sans-serif; margin-top: 2rem;">Symposia Dropdown</h3>
    <select name="" id="">
        <option value="">Blog symposia will appear here...</option>
    </select>
@else
<div class="mt-3">
@if($topics)
<span class="uppercase block mb-1">Sort By Symposia</span>
<div class="flex {{ $block->classes }} relative inline-block text-left">
    <div
        x-data="{
            open: false,
            toggle() {
                if (this.open) {
                    return this.close()
                }

                this.$refs.button.focus()

                this.open = true
            },
            close(focusAfter) {
                if (! this.open) return

                this.open = false

                focusAfter && focusAfter.focus()
            }
        }"
        x-on:keydown.escape.prevent.stop="close($refs.button)"
        x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
        x-id="['dropdown-button']"
        class="relative w-full border border-black hover:border-tahini-500 hover:text-tahini-500"
        :class="open ? 'border-tahini-700 !bg-black text-white' : ''"
    >

        <!-- Button -->
        <button
            x-ref="button"
            x-on:click="toggle()"
            :aria-expanded="open"
            :aria-controls="$id('dropdown-button')"
            type="button"
            class="flex justify-between gap-2 bg-white px-2 pt-1.5 w-full shadow uppercase text-sm"
            :class="open ? '!bg-black text-white' : ''"
        >
            Blog Symposia
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" class="h-6 w-6" fill="currentColor" 
                 viewBox="0 0 841.9 744.125" style="enable-background:new 0 0 841.9 595.3;" xml:space="preserve">
                 <path d="M528.9,297.2"/><path d="M215.5,189.5c-2,0-3.8,1.2-4.6,3.1c-0.8,1.9-0.3,4,1.1,5.4l205.6,205.6c1,1,2.3,1.5,3.5,1.5s2.6-0.5,3.5-1.5l205.5-205.5  c1.4-1.3,1.9-3.5,1.1-5.5c-0.8-1.9-2.6-3.1-4.6-3.1L215.5,189.5z"/>
          </svg>
        </button>

        <!-- Panel -->
        <div
            x-ref="panel"
            x-show="open"
            x-transition.origin.top.left
            x-on:click.outside="close($refs.button)"
            :id="$id('dropdown-button')"
            style="display: none;"
            class="absolute left-0 mt-2 w-full bg-white shadow-md border-gray-200 border-2 z-20"
        >

        @foreach($topics as $taxItem)
            <a href="{!! $taxItem->url !!}" 
               class="uppercase w-full block first-of-type:pt-2 text-tahini-700 underline relative z-30 bg-white
                  px-4 py-1 text-left text-sm hover:bg-gray-50 hover:no-underline disabled:text-gray-500">
              {!! $taxItem->name !!}
            </a>  
        @endforeach
        </div>
    </div>

  @endif
</div>
@endif