<?php
include './includes/db.php';  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Get user data from the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists and password matches
    if ($user && $user['password'] == $password) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin'];  // Store admin status

        // Redirect based on user role
        if ($user['is_admin'] == 1) {
            header('Location: admin_dashboard.php');  // Admin dashboard
        } else {
            header('Location: welcome.php');  // Regular user dashboard
        }
        exit();
    } else {
        // If authentication fails, redirect to login page
        header('Location: index.php?error=invalid');
        exit();
    }
}
?>
