<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow-lg" style="width: 100%; max-width: 400px;">
        <h3 class="text-center text-danger mb-3">Admin Login</h3>
        <p>
            <?php
            if (isset($_SESSION['admin_login_error'])): ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['admin_login_error'];
                unset($_SESSION['admin_login_error']); ?>
        </div>
    <?php endif; ?>
    </p>
    <form action="server/request.php" method="post">
        <div class="mb-3">
            <label for="loginEmail" class="form-label">Email address</label>
            <input type="email" name="a_email" class="form-control" id="loginEmail">
        </div>
        <div class="mb-3">
            <label for="loginPassword" class="form-label">Password</label>
            <input type="password" name="a_password" class="form-control" id="loginPassword">
        </div>
        <button type="submit" name="admin-login-submit" class="btn btn-danger w-100 mb-3">Login as a Admin</button>
    </form>
    </div>
</div>