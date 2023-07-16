<div class="page-hed-wrap col-lg-12">
    <h1 class="page-hed">{!! $title !!}</h1>
    @isset($our_team_title)
        <span class="necto our-team-title d-block">{!! $our_team_title !!}</span>
    @endisset
</div>
<div class="menu col-lg-4">
    <div class="menu-wrap">
    @if (has_nav_menu('about_navigation') && $showMenu)
        <h2>{!! wp_get_nav_menu_name('about_navigation') !!}</h2>
        {!! wp_nav_menu(['theme_location' => 'about_navigation', 'menu_class' => 'page-navbar-nav']) !!}
    @endif
    </div>
</div>
<section class="page-content col-lg-8">
    @php(the_content())
</section>
