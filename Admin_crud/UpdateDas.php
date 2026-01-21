<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <?php include 'csslink.php';?> 
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-rc3/dist/js/adminlte.min.js" crossorigin="anonymous">
    </script>
         <?php
        session_start();
        if (!isset($_SESSION['user']) || $_SESSION['user'] === null) { 
        header('Location: login.html');
        exit(); 
          }
        ?>
        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>
        <?php include 'Update.php';?>
</body>
</html>