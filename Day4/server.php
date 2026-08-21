<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $db->create('users', [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        header("Location: index.php?tab=login");
        exit();
    }

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $db->findByColumn('users', 'email', $email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['loginID'] = $user['id'];
            $_SESSION['userName'] = $user['name'];
            header("Location: index.php?tab=profile");
            exit();
        } else {
            header("Location: index.php?tab=login&error=1");
            exit();
        }
    }

    if (isset($_POST['add_employee'])) {
        $db->create('employees', [
            'name' => $_POST['name'],
            'position' => $_POST['position'],
            'salary' => $_POST['salary']
        ]);
        header("Location: index.php?tab=employees");
        exit();
    }

    if (isset($_POST['add_department'])) {
        $db->create('departments', [
            'name' => $_POST['name']
        ]);
        header("Location: index.php?tab=departments");
        exit();
    }

    if (isset($_POST['add_project'])) {
        $db->create('projects', [
            'title' => $_POST['title'],
            'budget' => $_POST['budget']
        ]);
        header("Location: index.php?tab=projects");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    if ($_GET['action'] === 'logout') {
        session_destroy();
        header("Location: index.php?tab=login");
        exit();
    }

    if ($_GET['action'] === 'delete' && isset($_GET['table']) && isset($_GET['id'])) {
        $db->delete($_GET['table'], $_GET['id']);
        header("Location: index.php?tab=" . $_GET['table']);
        exit();
    }
}