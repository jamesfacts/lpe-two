<div class="speaker-topic-dropdown flex flex-row justify-center w-100 border border-black cursor-pointer hover:bg-black hover:text-white xl:w-60">
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
        class="relative w-full mx-0 pl-2 mr-auto"
    >
        <!-- Button -->
        <button
            x-ref="button"
            x-on:click="toggle()"
            :aria-expanded="open"
            :aria-controls="$id('dropdown-button')"
            type="button"
            class="flex w-full justify-between gap-2 px-1 py-1 text-sm uppercase"
        >
            Speaker Topics
 
            <!-- Heroicon: chevron-down -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
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
            class="absolute left-0 w-100 bg-white border border-gray-300"
        >
            @foreach($topics as $topic)
                <a href="{!! $topic->url !!}" class="topic-item flex items-center gap-2 w-full px-4 py-1 uppercase text-left text-black text-sm underline hover:bg-gray-300 ">
                    {!! $topic->name !!}
                </a>
            @endforeach
 
        </div>
    </div>
</div>