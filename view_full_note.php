<!-- public/view_full_notes.php -->
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
include './includes/db.php';

if (isset($_GET['note_id'])) {
    $note_id = $_GET['note_id'];
    $stmt = $pdo->prepare("SELECT * FROM notes WHERE id = :id AND username = :username");
    $stmt->bindParam(':id', $note_id);
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->execute();
    $note = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$note) {
        header('Location: view_note.php');
        exit();
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $deleteStmt = $pdo->prepare("DELETE FROM notes WHERE id = :id AND username = :username");
    $deleteStmt->bindParam(':id', $delete_id);
    $deleteStmt->bindParam(':username', $_SESSION['username']);
    $deleteStmt->execute();
    header('Location: view_note.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Full Note</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .note-actions button {
            margin-left: 10px;
        }
        .note-content {
            white-space: pre-wrap; /* Ensures that the content respects line breaks */
            word-wrap: break-word;
        }
    </style>
</head>
<body>  <?php include 'navbar.php'; ?>
    <div class="container my-5">
        <h2>Full Note</h2>
      
        <a href="view_note.php" class="btn btn-secondary mt-3">Back to Notes</a>

        <div class="note-actions mt-4">
            <!-- Copy Button with icon -->
            <button class="btn btn-info" onclick="copyToClipboard()">
                <i class="bi bi-clipboard"></i> Copy to Clipboard
            </button>

            <!-- Delete Button with icon -->
            <a href="?delete_id=<?php echo urlencode($note['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this note?')">
                <i class="bi bi-trash"></i> Delete Note
            </a>
        </div>

        <div class="mt-4">
            <h5>Created On: <?php echo htmlspecialchars($note['created_at']); ?></h5>
            <div class="note-content">
                <pre id="noteContent"><?php echo nl2br(htmlspecialchars($note['content'])); ?></pre>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        // Function to copy the note content to the clipboard
        function copyToClipboard() {
            const noteContent = document.getElementById('noteContent').innerText;
            const textarea = document.createElement('textarea');
            textarea.value = noteContent;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);

            alert('Note content copied to clipboard!');
        }
    </script>
</body>
</html>