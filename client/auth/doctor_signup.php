<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    <h3 class="text-center text-warning mb-4">Doctor Registration</h3>

                    <?php if (isset($_SESSION['doctor_signup_error'])): ?>
                        <div class="alert alert-danger">
                            <?php
                            echo $_SESSION['doctor_signup_error'];
                            unset($_SESSION['doctor_signup_error']);
                            ?>
                        </div>
                    <?php endif; ?>

                    <form action="server/request.php" method="POST" enctype="multipart/form-data">
                        <div class="row g-3">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Dr. John Doe">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="fees" class="form-label">Fees (₹)</label>
                                    <input type="number" name="fees" step="0.01" class="form-control" placeholder="500.00">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="qualification" class="form-label">Qualification</label>
                                    <input type="text" name="qualification" class="form-control" placeholder="MBBS, MD">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="doctor@example.com">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="******">
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="times" class="form-label">Available Times</label>
                                    <input type="text" name="times" class="form-control" placeholder="Mon-Fri, 10 AM - 4 PM">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="about" class="form-label">About</label>
                                    <textarea name="about" class="form-control" rows="1" placeholder="Write something about yourself..."></textarea>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" name="location" class="form-control" placeholder="Kolkata, India">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="avatar" class="form-label">Profile Avatar</label>
                                    <input type="file" name="avatar" accept="image/*" class="form-control">
                                </div>
                                <div class="d-grid" style="margin-top: 45px;">
                                    <button type="submit" name="doctor_signup_submit" class="btn btn-warning">
                                        Register as Doctor
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>