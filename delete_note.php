<?php
session_start();

// Ensure user is logged in and is an admin
if (!isset($_SESSION['username']) || $_SESSION['is_admin'] != 1) {
    header('Location: index.php');  // Redirect to login if not logged in or not an admin
    exit();
}

include './includes/db.php';

// Check if the note ID is set in the URL
if (isset($_GET['id'])) {
    $note_id = $_GET['id'];

    // Prepare the SQL statement to delete the note
    $stmt = $pdo->prepare("DELETE FROM notes WHERE id = :id");
    $stmt->bindParam(':id', $note_id, PDO::PARAM_INT);

    // Execute the deletion
    if ($stmt->execute()) {
        // Redirect back to the admin dashboard with a success message
        header('Location: admin_dashboard.php?message=Note deleted successfully');
        exit();
    } else {
        // Redirect back with an error message
        header('Location: admin_dashboard.php?message=Error deleting note');
        exit();
    }
} else {
    // Redirect to the admin page if no ID is provided
    header('Location: admin.php');
    exit();
}
?>
