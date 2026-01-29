<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <?php include 'csslink.php';?>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-rc3/dist/js/adminlte.min.js" crossorigin="anonymous">
    </script>

    <div class="app-wrapper">

        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>
        <?php
          ini_set('display_errors', 1);
          ini_set('display_startup_errors', 1);
          error_reporting(E_ALL);

          require_once "controllers/UserController.php";
          $controller = new UserController();
          $action = $_GET['action'] ?? 'index';

          if ($action == 'store') $controller->store();
          elseif ($action == 'edit') $controller->edit($_GET['id']);
          elseif ($action == 'update') $controller->update($_GET['id']);
          elseif ($action == 'delete') $controller->delete($_GET['id']);
          else $controller->index();
        ?>
        <?php include 'footer.php'; ?>

    </div>
</body>

</html>