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
        }else if (isset($_GET['doctor-signup'])) {
            include('./client/auth/doctor_signup.php');
        }
        ?>

    </main>
    <?php include('./client/layout/footer.php') ?>
</body>

</html>