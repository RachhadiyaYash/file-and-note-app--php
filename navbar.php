<!-- public/navbar.php -->

<nav class="navbar navbar-expand-lg navbar-light bg-primary w-full">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="welcome.php">My Sharing</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link text-white" href="welcome.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="add_note.php">Add Notes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="view_note.php">View Notes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="upload_file.php">Upload File</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="view_file.php">View Files</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="logout.php">
            <i class="bi bi-box-arrow-right"></i> Logout
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>

  .nav-link {
    color: white !important;
  }

  .nav-link:hover {
    color: #ffcc00 !important; 
  }

  .nav-link i {
    margin-right: 5px; 
  }
</style>