<?php
session_start();
require('../common/db.php');


if (isset($_POST['register-submit'])) {

    if (empty($_POST['p_email']) || empty($_POST['p_username']) || empty($_POST['p_password']) || empty($_POST['p_confirm_password'])) {
        $_SESSION['patient_signup_error'] = "Please fill all fields.";
        header('location: ../?patient-signup=true');
        exit();
    }

    $p_email = $_POST['p_email'];
    $p_username = $_POST['p_username'];
    $p_password = $_POST['p_password'];
    $p_confirm_password = $_POST['p_confirm_password'];

    // Check password match
    if ($p_password !== $p_confirm_password) {
        $_SESSION['patient_signup_error'] = "Passwords do not match.";
        header('location: ../?patient-signup=true');
        exit();
    }

    // Handle avatar upload
    if (!isset($_FILES['p_avatar']) || $_FILES['p_avatar']['error'] !== 0) {
        $_SESSION['patient_signup_error'] = "Please select a valid avatar image.";
        header('location: ../?patient-signup=true');
        exit();
    }

    $p_avatar = $_FILES['p_avatar'];
    $avatarName = uniqid() . "_" . basename($p_avatar['name']);
    $targetDir = "uploads/";
    $targetFile = $targetDir . $avatarName;

    if (!move_uploaded_file($p_avatar["tmp_name"], $targetFile)) {
        $_SESSION['patient_signup_error'] = "Failed to upload profile picture!";
        header('location: ../?patient-signup=true');
        exit();
    }

    $hashedPassword = password_hash($p_password, PASSWORD_DEFAULT);

    $checkStmt = $conn->prepare("SELECT id FROM patients WHERE p_email = ?");
    $checkStmt->bind_param("s", $p_email);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        $_SESSION['patient_signup_error'] = "Email already exists! Please use a different email.";
        header('location: ../?patient-signup=true');
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO patients (p_username, p_email, p_password, p_avatar) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $p_username, $p_email, $hashedPassword, $avatarName);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registration successful! You can now login.";
        header('location: ../?patient-login=true');
    } else {
        $_SESSION['patient_signup_error'] = "Something went wrong. Please try again.";
        header('location: ../?patient-signup=true');
    }

    $stmt->close();
    $conn->close();
}

if (isset($_POST['login-submit'])) {

    if (empty($_POST['p_email']) || empty($_POST['p_password'])) {
        $_SESSION['patient_login_error'] = "Please Fill all Fields";
        header('location: ../?patient-login=true');
        exit();
    }

    $p_email = $_POST['p_email'];
    $p_password = $_POST['p_password'];

    $stmt = $conn->prepare("SELECT id, p_username, p_avatar, p_password, p_email FROM patients WHERE p_email = ?");
    $stmt->bind_param("s", $p_email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $p_username, $p_avatar, $hashedPassword, $p_email);
        $stmt->fetch();

        // ✅ Verify hashed password
        if (password_verify($p_password, $hashedPassword)) {
            $_SESSION['p_id'] = $id;
            $_SESSION['p_username'] = $p_username;
            $_SESSION['p_avatar'] = $p_avatar;
            $_SESSION['p_email'] = $p_email;
            $_SESSION['success'] = "Login successful!";
            header('location: ../?home=true');
            exit();
        } else {
            $_SESSION['patient_login_error'] = "Incorrect password!";
            header('location: ../?patient-login=true');
        }
    } else {
        $_SESSION['patient_login_error'] = "Email not found!";
        header('location: ?patient-login=true');
    }

    exit();
    $conn->close();
}
if (isset($_POST['admin-login-submit'])) {

    if (empty($_POST['a_email']) || empty($_POST['a_password'])) {
        $_SESSION['admin_login_error'] = "Please fill all fields";
        header('Location: ../?admin-login=true');
        exit();
    }

    $a_email = $_POST['a_email'];
    $a_password = $_POST['a_password'];

    $stmt = $conn->prepare("SELECT id, email, password FROM admin WHERE email = ?");
    $stmt->bind_param("s", $a_email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $email, $hashed_password);
        $stmt->fetch();

        if (password_verify($a_password, $hashed_password)) {
            $_SESSION['p_id'] = $id;
            $_SESSION['p_email'] = $email;
            $_SESSION['p_username'] = "ADMIN";
            $_SESSION['success'] = "Login successful!";
            $_SESSION['isAdmin'] = true;
            header('Location: ../?home=true');
            exit();
        } else {
            $_SESSION['admin_login_error'] = "Incorrect password!";
            header('Location: ../?admin-login=true');
            exit();
        }
    } else {
        $_SESSION['admin_login_error'] = "Email not found!";
        header('Location: ../?admin-login=true');
        exit();
    }

    $stmt->close();
    $conn->close();
}

if (isset($_POST['doctor_signup_submit'])) {


    if (empty($_POST['name']) || empty($_POST['fees']) || empty($_POST['qualification']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['times']) || empty($_POST['about']) || empty($_POST['location'])) {
        $_SESSION['doctor_signup_error'] = "Please Fill all Fields";
        header('location: ../?doctor-signup=true');
        exit();
    }

    // collect data from html
    $name = $_POST['name'];
    $fees = $_POST['fees'];
    $qualification = $_POST['qualification'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $times = $_POST['times'];
    $about = $_POST['about'];
    $location = $_POST['location'];

    // 2. Check for duplicate email
    $checkEmail = mysqli_query($conn, "SELECT id FROM doctor WHERE email='$email'");
    if (mysqli_num_rows($checkEmail) > 0) {
        $_SESSION['doctor_signup_error'] = "Email already registered!";
        header('location: ../?doctor-signup=true');
        exit();
    }

    // 3. Handle avatar upload
    $avatarName = "";
    if (!empty($_FILES['avatar']['name'])) {
        $targetDir = "uploads/";
        $fileName = time() . '_' . basename($_FILES["avatar"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        // Create uploads directory if not exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFilePath)) {
                $avatarName = $fileName;
            } else {
                $_SESSION['doctor_signup_error'] = "Failed to upload avatar.";
                header('location: ../?doctor-signup=true');
                exit();
            }
        } else {
            $_SESSION['doctor_signup_error'] = "Only JPG, PNG, GIF & WEBP files allowed.";
            header('location: ../?doctor-signup=true');
            exit();
        }

        // 4. Insert into database
        $insertQuery = "INSERT INTO doctor 
        (name, fees, qualification, email, password, times, about, location, avatar) 
        VALUES 
        ('$name', '$fees', '$qualification', '$email', '$password', '$times', '$about', '$location', '$avatarName')";

        if (mysqli_query($conn, $insertQuery)) {
            // Success
            $_SESSION['doctor_signup_success'] = "Registration successful! Please login.";
            header('location: ../?all_doctors=true');
            exit();
        } else {
            $_SESSION['doctor_signup_error'] = "Database error: " . mysqli_error($conn);
            header('location: ../?doctor-signup=true');
            exit();
        }
    } else {
        $_SESSION['doctor_signup_error'] = "An Unknown Error Occured!";
        header('location: ../?doctor-signup=true');
        exit();
    }
}

if (isset($_POST['book_appointment'])) {
    $d_id = $_POST['doctor_id'];

    if (empty($_POST['selected_day']) || empty($_POST['selected_slot'])) {
        $_SESSION['appointment_error'] = "Please select a day and a slot.";
        header("location: ../?booked-doctor=$d_id");
        exit();
    }
    $p_id = $_SESSION['p_id'];
    $day = $_POST['selected_day'];
    $slot = $_POST['selected_slot'];

    $stmt = $conn->prepare("INSERT INTO appointment (d_id, p_id, day, slot) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $d_id, $p_id, $day, $slot);

    if ($stmt->execute()) {
        $_SESSION['appointment_success'] = "Appointment booked successfully!";
        header("location: ../?booked-doctor=$d_id");
    } else {
        $_SESSION['appointment_error'] = "Something went wrong. Please try again.";
        header("location: ../?booked-doctor=$d_id");
    }

    $stmt->close();
    $conn->close();
}
