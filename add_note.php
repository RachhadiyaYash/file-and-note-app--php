<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

include './includes/db.php';
$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 
    $note_content = $_POST['note'];
    
    if (!empty($note_content)) {
       
        $stmt = $pdo->prepare("INSERT INTO notes (username, content) VALUES (:username, :content)");
        $stmt->bindParam(':username', $_SESSION['username']);
        $stmt->bindParam(':content', $note_content);

        if ($stmt->execute()) {
            $message = "<div class='alert alert-success text-center'>Note added successfully!</div>";
            $button_disabled = "true";  // Disable the button on success
        } else {
            $message = "<div class='alert alert-danger text-center'>Failed to add note. Please try again.</div>";
        }
    } else {
        $message = "<div class='alert alert-warning text-center'>Please enter a note.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Text Note</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 1rem;
        }

        .btn {
            border-radius: 1rem;
        }

        .alert {
            margin-top: 20px;
        }

        .icon-btn i {
            font-size: 1.5rem;
            margin-right: 10px;
        }

        textarea {
            resize: none;
        }
    </style>
</head>

<body>
<?php include 'navbar.php'; ?>
    <div class="container my-5"> 
        <div class="card shadow-lg p-4">
            <h2 class="mb-4 text-center"><i class="bi bi-pencil-square"></i> Add a New Note</h2>
            <form action="add_note.php" method="POST" id="noteForm">
                <div class="mb-3">
                    <textarea class="form-control" name="note" rows="5" placeholder="Enter your note here..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100" id="saveNoteButton" <?php echo isset($button_disabled) ? 'disabled' : ''; ?>>Save Note</button>
            </form>
            
            <?php
            if ($message != '') {
                echo $message;
            }
            ?>

            <div class="text-center mt-3">
                <a href="welcome.php" class="btn btn-secondary"><i class="bi bi-arrow-left-circle"></i> Back to Dashboard</a>
            </div>
        </div>
    </div>

    <!-- JavaScript to disable and re-enable the button -->
    <script>
        // Disable the button for 5 seconds after the form is successfully submitted
        <?php if (isset($button_disabled)): ?>
            document.getElementById("saveNoteButton").disabled = true;
            setTimeout(function() {
                document.getElementById("saveNoteButton").disabled = false;
            }, 5000); // Re-enable button after 5 seconds
        <?php endif; ?>
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
