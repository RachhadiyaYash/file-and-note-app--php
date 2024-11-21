<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 1rem;
        }

        .card-body {
            padding: 2rem;
        }

        .form-control {
            border-radius: 1rem;
        }

        .btn {
            border-radius: 1rem;
        }

        .card-title {
            font-weight: 600;
        }

        .alert {
            border-radius: 1rem;
        }

        .input-group-text {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card shadow-lg">
            <div class="card-body">
                <h5 class="card-title text-center mb-4">
                    <i class="bi bi-person-lock"></i> Login To EasyShare
                </h5>

                <form action="login_process.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <span class="input-group-text" id="togglePassword" onclick="togglePassword()">
                                <i class="bi bi-eye"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>

                <?php
                    if (isset($_GET['error'])) {
                        echo '<div class="alert alert-danger mt-3" role="alert">Invalid username or password</div>';
                    }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        // Toggle password visibility
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var toggleIcon = document.getElementById("togglePassword").children[0];

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("bi-eye");
                toggleIcon.classList.add("bi-eye-slash");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("bi-eye-slash");
                toggleIcon.classList.add("bi-eye");
            }
        }
    </script>
</body>

</html>
