<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$uploadDir = './uploads/';
$files = array_diff(scandir($uploadDir), array('.', '.')); 

// Check if user is admin and handle file deletion
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1 && isset($_GET['delete'])) {
    $fileToDelete = basename($_GET['delete']);
    $filePath = $uploadDir . $fileToDelete;
    
    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            echo "<div class='alert alert-success'>File deleted successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Failed to delete file.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Uploaded Files</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .alert {
            margin-bottom: 20px;
        }
        .file-name {
            font-weight: 600;
            color: #495057;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .btn-danger-custom {
            background-color: #dc3545;
            color: white;
            padding: 6px 9px;
            border-radius: 5px;
        }
        .btn-danger-custom:hover {
            background-color: #c82333;
        }
        .file-actions i {
            font-size: 1.25rem;
        }
        .file-actions a {
            margin-right: 10px;
        }
        @media (max-width: 576px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body><?php include 'navbar.php'; ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Uploaded Files <i class="fas fa-file-upload"></i></h2>
        
        <?php if (count($files) > 0): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>File Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($files as $file): ?>
                        <tr>
                            <td class="file-name"><?php echo htmlspecialchars($file); ?></td>
                            <td class="file-actions">
                                <div class="d-flex justify-content-start flex-wrap">
                                    <a href="<?php echo $uploadDir . $file; ?>" class="btn btn-sm btn-success me-2 mb-2" download><i class="fas fa-download"></i> Download</a>

                                    <!-- Show Delete button only if the user is admin -->
                                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                                        <a href="?delete=<?php echo urlencode($file); ?>" class="btn-danger-custom btn-sm mb-2" onclick="return confirm('Are you sure you want to delete this file?')"><i class="fas fa-trash-alt"></i> Delete</a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">
                No files uploaded yet.
            </div>
        <?php endif; ?>

        <a href="welcome.php" class="btn btn-secondary mt-3 w-100"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
