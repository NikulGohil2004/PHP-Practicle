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