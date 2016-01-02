<header id="page-header">
    <div class="container-fluid">
        <div class="header-content">
            <div class="header-controls navbar-collapse collapse">
                <ul class="nav navbar-nav pull-right">
                    <li>
                        <a class="link-tooltip" title="New Transaction" href="{{ url('transactions/create') }}"
                           data-toggle="tooltip" data-placement="bottom"><i class="fa fa-plus fa-fw"></i>
                        </a>
                    </li>
                    <li>
                        <a title="Sign out" rel="nofollow" href="{{ url('auth/logout') }}"
                           data-toggle="tooltip" data-placement="bottom" data-method="delete"
                           class="logout link-tooltip"><i class="fa fa-sign-out"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <h1 class="title">{!! Theme::get('title') !!}</h1>
        </div>
    </div>
</header>