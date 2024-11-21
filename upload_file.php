<!-- public/upload_file.php -->
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
$uploadDir = './uploads/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$maxFileSize = 500 * 1024 * 1024;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fileToUpload'])) {
    $file = $_FILES['fileToUpload'];
    $fileName = basename($file['name']);
    $filePath = $uploadDir . $fileName;
    $fileType = $file['type'];
    $fileSize = $file['size'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        if ($fileSize > $maxFileSize) {
            echo "<div class='alert alert-danger'>File is too large. Max size is 500 MB.</div>";
        } else {
            $fileName = preg_replace("/[^a-zA-Z0-9\._-]/", "_", $fileName);
            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                echo "<div class='alert alert-success'>File uploaded successfully!</div>";
            } else {
                echo "<div class='alert alert-danger'>Failed to move the uploaded file.</div>";
            }
        }
    } else {
        echo "<div class='alert alert-danger'>Error uploading file. Please try again.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
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
        .btn-custom {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .file-upload-label {
            font-weight: bold;
        }
        .file-icon {
            font-size: 3rem;
            color: #007bff;
            margin-right: 10px;
        }
        .file-upload-btn {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
        }
        .file-upload-btn:hover {
            background-color: #218838;
        }
        @media (max-width: 576px) {
            .container {
                padding: 20px;
            }
            .btn-custom {
                width: 100%;
            }
        }
    </style>
</head>
<body><?php include 'navbar.php'; ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Upload a File <i class="fas fa-upload"></i></h2>
        <form action="upload_file.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fileToUpload" class="form-label file-upload-label">Choose File to Upload </label>
                <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" required>
            </div>
            <button type="submit" class="file-upload-btn">Upload File <i class="fas fa-arrow-right"></i></button>
        </form>

        <a href="welcome.php" class="btn btn-custom mt-3">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>