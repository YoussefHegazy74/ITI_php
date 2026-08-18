<?php
session_start();

if (!isset($_SESSION["is_logged_in"]) || $_SESSION["is_logged_in"] !== true) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET["id"]) || !isset($_SESSION["usersData"][$_GET["id"]])) {
    header("Location: allUsers.php");
    exit;
}

$id = $_GET["id"];
$user = $_SESSION["usersData"][$id];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["usersData"][$id] = [
        "name" => $_POST["name"],
        "email" => $_POST["email"],
        "password" => $_POST["password"]
    ];
    header("Location: allUsers.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php require "./home.php"; ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Edit User Data</h3>
                        <form action="editUser.php?id=<?= $id ?>" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user["name"]) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user["email"]) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?= htmlspecialchars($user["password"]) ?>" required>
                            </div>
                            <button type="submit" class="btn btn-warning w-100">Update User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>