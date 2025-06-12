<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediCamper || A complete guide to Your Health</title>
    <?php include('./client/common_file.php') ?>
</head>

<body>
    <?php session_start(); ?>
    <?php include('./client/layout/header.php') ?>
    <main id="main">
        <?php
        require('./common/db.php');
        if (isset($_GET['patient-login'])) {
            include('./client/auth/patient_login.php');
        } else if (isset($_GET['patient-signup'])) {
            include('./client/auth/patient_signup.php');
        } else if (isset($_GET['patient-logout'])) {
            session_destroy();
            header('location: ?patient-login=true');
        } else if (isset($_GET['admin-login'])) {
            include('./client/auth/admin_login.php');
        } else if (isset($_GET['doctor-signup'])) {
            include('./client/auth/doctor_signup.php');
        } else if (isset($_GET['all_doctors'])) {
            include('./client/all_doctors.php');
        } else if (isset($_GET['all_patients'])) {
            include('./client/all_patients.php');
        } else if (isset($_GET['home'])) {
            include('./client/home.php');
        } else if (isset($_GET['booked-doctor'])) {
            include('./client/booked-doctor.php');
        } else if (isset($_GET['my-appointments'])) {
            include('./client/my_appointments.php');
        } else if (isset($_GET['all_appointments'])) {
            include('./client/all_appointments.php');
        }
        ?>

    </main>
    <?php include('./client/layout/footer.php') ?>
</body>

</html>