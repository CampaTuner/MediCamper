<header class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
    <div class="container-fluid">
        <a href="/" class="navbar-brand d-flex align-items-center">
            <img src="public/assets/logo.png" width="40" height="40" style="object-fit: contain;" alt="Logo">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
             <?php if (isset($_SESSION['isAdmin'])) : ?>
                 <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="?home=true">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="?doctor-signup=true">Create Doctor</a></li>
                <li class="nav-item"><a class="nav-link" href="?doctors=true">All Doctors</a></li>
                <li class="nav-item"><a class="nav-link" href="?doctors=true">All Appinments</a></li>
                <li class="nav-item"><a class="nav-link" href="?doctors=true">All Patients</a></li>
            </ul>
            <?php else : ?>
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
                
            <?php endif; ?>


            <div class="d-flex align-items-center">

                <div class="d-flex align-items-center justify-content-end p-3 bg-dark text-white">
                    <?php if (isset($_SESSION['p_id'])) : ?>
                        <div class="d-flex align-items-center">
                            <span class="me-3">Welcome, <strong><?php echo $_SESSION['p_username']; ?></strong></span>
                            <a href="?patient-logout=true" class="btn btn-outline-warning">Logout</a>
                        </div>
                    <?php else : ?>
                        <div class="d-flex">
                            <a href="?admin-login=true" class="btn btn-outline-danger me-2">Admin Login</a>
                            <a href="?patient-login=true" class="btn btn-outline-light me-2">Login</a>
                            <a href="?patient-signup=true" class="btn btn-warning">Sign-up</a>
                        </div>
                    <?php endif; ?>
                </div>


                <?php if (isset($_SESSION['p_id']) && !isset($_SESSION['isAdmin'])) : ?>
                    <div class="dropdown">
                        <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src='<?php echo '././server/uploads/' . $_SESSION['p_avatar']; ?>' alt="mdo" width="32" height="32" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark text-small" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        </ul>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </div>
</header>