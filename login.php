<?php

// Create a connection
$conn = mysqli_connect('localhost','root', '', 'db_login');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();

if(isset($_POST['submit2'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phno = $_POST['phno'];

    // Insert user details into the database
    $query = "INSERT INTO login_details1 (username,password , email,phno) VALUES ('$username', '$password','$email', '$phno')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $_SESSION['success'] = "User registered successfully!";
        header('Location: loginindex.html');
    } else {
        $_SESSION['error'] = "User registration failed!";
        header('Location: signupindex.html');
    }
}
if(isset($_POST['submit1'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve user details from the database
    $query = "SELECT username,password FROM login_details1 WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if ($password===$user['password']) {
            $_SESSION['user_id'] = $user['username'];
            $_SESSION['username'] = $user['username'];
            header('Location: index.html');
        } else {
            $_SESSION['error'] = "Invalid email or password!";
            header('Location: loginindex.html');
        }
    } else {
        $_SESSION['error'] = "User not found!";
        header('Location: signupindex.html');
    }
}
?>
