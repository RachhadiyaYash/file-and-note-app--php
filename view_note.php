<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

include './includes/db.php';

$username = $_SESSION['username'];
$stmt = $pdo->prepare("SELECT * FROM notes WHERE username = :username ORDER BY created_at DESC");
$stmt->bindParam(':username', $username);
$stmt->execute();
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle Note Deletion (POST request to prevent form resubmission)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $note_id = $_POST['delete_id'];
    $deleteStmt = $pdo->prepare("DELETE FROM notes WHERE id = :id AND username = :username");
    $deleteStmt->bindParam(':id', $note_id);
    $deleteStmt->bindParam(':username', $username);
    $deleteStmt->execute();
    // Redirect to prevent resubmission on page refresh
    header("Location: view_note.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Notes</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .note-actions button {
            margin-left: 10px;
        }
        .note-preview {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 250px;
        }
        .table-responsive {
            overflow-x: auto;
        }
    </style>
</head>
<body>
<?php if (count($notes) > 0): ?>
    <?php include 'navbar.php'; ?>
    <div class="container my-5">
        <h2>Your Notes</h2>
        <a href="welcome.php" class="btn btn-secondary mt-3">Back to Dashboard</a>

        <div class="table-responsive mx-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SID</th> 
                        <th>Note Preview</th>
                        <th>Created On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sid = 1;
                    ?>
                    <?php foreach ($notes as $note): ?>
                        <tr>
                            <td><?php echo $sid++; ?></td>
                            <td class="note-preview">
                                <?php 
                                    $preview = explode("\n", $note['content']);
                                    $preview = array_slice($preview, 0, 5);
                                    echo nl2br(htmlspecialchars(implode("\n", $preview)));
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($note['created_at']); ?></td>
                            <td class="note-actions flex">
                                <a href="view_full_note.php?note_id=<?php echo urlencode($note['id']); ?>" class="btn btn-info">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <!-- Delete Form (POST method to prevent resubmission) -->
                                <form action="view_note.php" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this note?')">
                                    <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($note['id']); ?>">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            You have no notes yet.
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
