<!-- Header section -->
<header class="header-section clearfix">
    <a href="{{ route('pages.home') }}" class="site-logo">
        <h4><span>Dryas</span> Library</h4>
    </a>
    <div class="header-right">
        <div class="user-panel">
            @if (Auth::user() != null)
            <a href="{{ route('home') }}" class="register">Hy, {{ Auth::user()->name }}</a>
            @else
            <a href="{{ route('login') }}" class="login">Login</a>
            <span>|</span>
            <a href="{{ route('register') }}" class="register">Create an account</a>
            @endif
        </div>
    </div>
    <ul class="main-menu">
        <li><a href="{{ route('pages.home') }}">Home</a></li>
        <li><a href="{{ route('pages.catalog') }}">Catalog</a></li>
        <li><a href="{{ route('pages.about') }}">About</a></li>
        <li><a href="{{ route('pages.team') }}">Our Team</a></li>
    </ul>
</header>