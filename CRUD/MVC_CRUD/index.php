<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start(); 
if (!isset($_SESSION['user_id'])) {
    header('Location: login_form.php');
    exit(); 
}

require_once "controllers/UserController.php";

$controller = new UserController();
$action = $_GET['action'] ?? 'index';
$id     = $_GET['id'] ?? null;

if ($action === 'store') {
    $controller->store();
    exit;
}

if ($action === 'update' && $id) {
    $controller->update($id);
    exit;
}

if ($action === 'delete' && $id) {
    $controller->delete($id);
    exit;
}


include(__DIR__ . '/../ADMIN/header.php');
include(__DIR__ . '/../ADMIN/csslink.php');
include(__DIR__ . '/../ADMIN/sidebar.php');


if ($action === 'add') {
    $controller->add();
} elseif ($action === 'edit' && $id) {
    $controller->edit($id);
} else {
    $controller->index();
}

include(__DIR__ . '/../ADMIN/footer.php');