<?php
session_start();
include 'config.php'; // DB connection

// Logged-in user id (set this during login)
$user_id = $_SESSION['user_id'] ?? 1; // fallback for testing

$sql = "SELECT name, profile_image FROM users WHERE id = '$user_id'";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);

// Default image if not uploaded
$profileImg = (!empty($user['profile_image']))
    ? "uploads/profile/" . $user['profile_image']
    : "assets/img/default-user.png";

$userName = $user['name'] ?? 'Admin';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>AdminLTE | Dashboard</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="./css/adminlte.css">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
<div class="app-wrapper">

<!-- ================= HEADER ================= -->
<nav class="app-header navbar navbar-expand bg-body">
<div class="container-fluid">

<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link" data-lte-toggle="sidebar" href="#">
      <i class="bi bi-list"></i>
    </a>
  </li>
</ul>

<ul class="navbar-nav ms-auto">

<!-- ===== USER MENU ===== -->
<li class="nav-item dropdown user-menu">
<a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">

  <!-- NAVBAR PROFILE IMAGE -->
  <img src="<?= $profileImg ?>"
       class="user-image rounded-circle shadow"
       alt="User Image">

  <span class="d-none d-md-inline">
    <?= htmlspecialchars($userName) ?>
  </span>
</a>

<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">

<!-- USER IMAGE DROPDOWN -->
<li class="user-header text-bg-primary text-center">
  <img src="<?= $profileImg ?>"
       class="rounded-circle shadow mb-2"
       alt="User Image">
  <p><?= htmlspecialchars($userName) ?></p>
</li>

<!-- MENU FOOTER -->
<li class="user-footer">
  <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
  <a href="logout.php" class="btn btn-default btn-flat float-end">Sign out</a>
</li>

</ul>
</li>
<!-- ===== END USER MENU ===== -->

</ul>
</div>
</nav>
<!-- ================= END HEADER ================= -->

</div>
</body>
</html>
