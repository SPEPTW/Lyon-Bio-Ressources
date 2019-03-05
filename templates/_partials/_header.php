<header>
    <nav class=" navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">

        <img alt="logo" class="navbar-brand col-sm-3 col-md-2 mr-0" src="{{ asset('dist/img/logo.jpg') }}" />

        <div>
            <ul class=" navbar-nav px-3">
                <li id="menu" class="position-fixed d-md-none">
                    <img src="{{ asset('dist/img/menu.png') }}" alt="Menu" />
                </li>
                <li class="nav-item text-nowrap ">
                    <a class="nav-link text-muted" href="{{ path('logout')}}"><span data-feather="log-out"></span> Se déconnecter</a>
                </li>

            </ul>
        </div>
    </nav>
</header> 