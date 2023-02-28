<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand nav-link col-lg-2 me-0 fs-6 align-text-center" href="/">
        <span data-feather="home" class="align-text-center"></span>
        Home
    </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="" aria-label="Search">
    <div class="navbar-nav">
        <div class="nav-item px-3 ">
            <form action="/logout" method="POST" class="pt-1">
                @csrf
                <button type="submit" class="btn btn-transparent text-light nav-link border-0 d-flex align-items-center" href="#">
                    Logout
                    <span data-feather="log-out"></span>
                </button>
            </form>
        </div>
    </div>
</header>