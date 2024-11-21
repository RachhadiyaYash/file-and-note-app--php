<!-- public/welcome.php -->

<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    
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

        .card-title {
            font-weight: 600;
        }

        .icon-btn i {
            font-size: 1.5rem;
            margin-right: 10px;
        }

        .options-container .col-md-3 {
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body>
<?php include 'navbar.php'; ?>

   <div class="container text-center my-2 my-lg-5">
        <div class="card shadow-lg p-4">
        <h1 class="mb-4">
    <i class="bi bi-person-circle"></i> 
    <?php 
        // Check if the user is an admin
        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
            echo "Welcome, Yash Rachhadiya (Admin)!";
        } else {
            // Regular user welcome message
            echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "!";
        }
    ?>
</h1>
            <p class="mb-4">You have successfully logged in. What would you like to do next?</p>

            <div class="row options-container">
                <div class="col-md-3 col-sm-6 mb-4">
                    <a href="add_note.php" class="btn btn-primary btn-lg w-100 icon-btn">
                        <i class="bi bi-file-earmark-text"></i> Add Text Note
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <a href="view_note.php" class="btn btn-success btn-lg w-100 icon-btn">
                        <i class="bi bi-eye"></i> View Text Note
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <a href="upload_file.php" class="btn btn-warning btn-lg w-100 icon-btn">
                        <i class="bi bi-cloud-upload"></i> Upload File
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <a href="view_file.php" class="btn btn-info btn-lg w-100 icon-btn">
                        <i class="bi bi-folder"></i> View All Files
                    </a>
                </div>

                <!-- Admin Panel button (only shown if the user is an admin) -->
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <a href="admin_dashboard.php" class="btn btn-dark btn-lg w-100 icon-btn">
                        <i class="bi bi-shield-lock"></i> Admin Panel
                    </a>
                </div>
                <?php endif; ?>
            </div>

            <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
