<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow-lg" style="width: 100%; max-width: 500px;">
        <h3 class="text-center text-dark mb-3">Patient Registration</h3>

        <?php if (isset($_SESSION['patient_signup_error'])): ?>
            <div class="alert alert-danger">
                <?php
                echo $_SESSION['patient_signup_error'];
                unset($_SESSION['patient_signup_error']);
                ?>
            </div>
        <?php endif; ?>

        <form action="server/request.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="regEmail" class="form-label">Email address</label>
                <input type="email" name="p_email" class="form-control" id="regEmail" required>
            </div>
            <div class="mb-3">
                <label for="regUsername" class="form-label">Username</label>
                <input type="text" name="p_username" class="form-control" id="regUsername" required>
            </div>
            <div class="mb-3">
                <label for="regPassword" class="form-label">Password</label>
                <input type="password" name="p_password" class="form-control" id="regPassword" required>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" name="p_confirm_password" class="form-control" id="confirmPassword" required>
            </div>
            <div class="mb-3">
                <label for="avatar" class="form-label">Avatar Image</label>
                <input type="file" name="p_avatar" class="form-control" id="avatar" accept="image/*" required>
            </div>
            <button type="submit" name="register-submit" class="btn btn-warning w-100">Register</button>
            <p class="text-center mt-3 text-dark">Already have an account?
                <a href="?patient-login=true" class="text-warning">Login</a>
            </p>
        </form>
    </div>
</div>