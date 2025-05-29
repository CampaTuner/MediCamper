<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow-lg" style="width: 100%; max-width: 400px;">
        <h3 class="text-center text-dark mb-3">Patient Login</h3>
        <p>
            <?php
            if (isset($_SESSION['patient_login_error'])): ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['patient_login_error'];
                unset($_SESSION['patient_login_error']); ?>
        </div>
    <?php endif; ?>
    </p>
    <form action="server/request.php" method="post">
        <div class="mb-3">
            <label for="loginEmail" class="form-label">Email address</label>
            <input type="email" name="p_email" class="form-control" id="loginEmail">
        </div>
        <div class="mb-3">
            <label for="loginPassword" class="form-label">Password</label>
            <input type="password" name="p_password" class="form-control" id="loginPassword">
        </div>
        <button type="submit" name="login-submit" class="btn btn-warning w-100">Login</button>
        <p class="text-center mt-3"><a href="#" class="text-decoration-none">Forgot password?</a></p>
        <p class="text-center mt-2 text-dark">Don't have an account? <a href="?patient-signup=true" class="text-warning">Register</a></p>
    </form>
    </div>
</div>