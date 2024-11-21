<?php
session_start();


if (!isset($_SESSION['username']) || $_SESSION['is_admin'] != 1) {
    header('Location: index.php');
    exit();
}

include './includes/db.php';


$stmt = $pdo->prepare("SELECT * FROM notes");
$stmt->execute();
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center mb-4">Admin Dashboard</h1>
        <div class="d-flex justify-content-between">
    <a href="welcome.php" class="btn btn-danger btn-lg">Other Tasks</a>
    <a href="logout.php" class="btn btn-danger btn-lg">Logout</a>
</div>


    
        <div class="table-responsive m-4">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Note ID</th>
                        <th>Username</th>
                        <th>Content</th>
                        <th>Created At</th>
                        <th>Actions</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($notes as $note): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($note['id']); ?></td>
                            <td><?php echo htmlspecialchars($note['username']); ?></td>
                            <td><?php echo htmlspecialchars($note['content']); ?></td>
                            <td><?php echo htmlspecialchars($note['created_at']); ?></td>
                            <td>
                        
                                <a href="delete_note.php?id=<?php echo $note['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this note?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
