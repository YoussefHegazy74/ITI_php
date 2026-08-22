<?php
session_start();

if (!isset($_SESSION["is_logged_in"]) || $_SESSION["is_logged_in"] !== true) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["id"])) {
    $id = $_GET["id"];
    if (isset($_SESSION["usersData"][$id])) {
        unset($_SESSION["usersData"][$id]);
        $_SESSION["usersData"] = array_values($_SESSION["usersData"]);
    }
    header("Location: allUsers.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php require "./home.php"; ?>
    <div class="container mt-5">
        <h2 class="text-center mb-4">All Users Data</h2>
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>id</th>
                    <th>userName</th>
                    <th>UserEmail</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($_SESSION["usersData"]) && !empty($_SESSION["usersData"])): ?>
                    <?php foreach ($_SESSION["usersData"] as $index => $user): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($user["name"]) ?></td>
                            <td><?= htmlspecialchars($user["email"]) ?></td>
                            <td>
                                <a href="editUser.php?id=<?= $index ?>" class="btn btn-warning btn-sm">update</a>
                                <a href="allUsers.php?action=delete&id=<?= $index ?>" class="btn btn-danger btn-sm">delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No users found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>