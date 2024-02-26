@php
    $placeholderSrc = 'images/LPE_TextureRound' . random_int(2, 3) . '.png';

@endphp


<article class="workshop-item relative z-0 mx-2 border-black border-t py-5">
    <div class="flex justify-center my-5">
        <img src="{{ \Roots\asset($placeholderSrc) }}" >
    </div>
</article>
