<header class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
    <div class="container-fluid">
        <a href="/" class="navbar-brand d-flex align-items-center">
            <img src="public/assets/logo.png" width="40" height="40" style="object-fit: contain;" alt="Logo">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="?home=true">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="?my-appointments=true">My Appointments</a></li>
                <li class="nav-item"><a class="nav-link" href="?doctors=true">Doctors</a></li>
                <li class="nav-item"><a class="nav-link" href="?membership=true">Membership</a></li>
                <li class="nav-item"><a class="nav-link" href="?about=true">About</a></li>
            </ul>

            <form class="d-flex me-3" role="search">
                <input class="form-control form-control-dark me-2" type="search" placeholder="Search Doctors..." aria-label="Search">
            </form>

            <div class="d-flex align-items-center">
                <a href="?patient-login=true">
                    <button class="btn btn-outline-light me-2">Login</button>
                </a>
                <a href="?patient-signup=true">
                    <button class="btn btn-warning me-3">Sign-up</button>
                </a>

                <div class="dropdown">
                    <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark text-small" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="#">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>