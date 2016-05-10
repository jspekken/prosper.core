<ul class="nav nav-pills nav-stacked">
    <li><a href="{{ prosper_route('dashboard.index') }}">Dashboard</a></li>
</ul>

<ul class="nav nav-pills nav-stacked">
    <li><a href="{{ prosper_route('users.index') }}">User management</a></li>
</ul>

<ul class="nav nav-pills nav-stacked">
    <li>
        <a href="#">
            <img src="{{ app('auth')->user()->gravatar }}">
            {{ app('auth')->user()->name }}
        </a>
    </li>
    <li>
        <a href="{{ prosper_route('auth.sessions.delete') }}">
            Sign-out
        </a>
    </li>
</ul>