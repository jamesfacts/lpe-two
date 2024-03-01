@php
$texture_img = 'images/big-texture-' . rand(1, 4) . '.png';
@endphp

<div class="grid-placeholder rounded-panel"
    style="background-color: black; background-image: url({{ \Roots\asset($texture_img) }});
           background-size: cover;">
</div>
