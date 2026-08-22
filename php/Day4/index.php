<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'connection.php';
include 'navbar.php';

$tab = $_GET['tab'] ?? 'users';
$edit_id = $_GET['edit_id'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard System</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f4f4f4; }
        .container { width: 80%; margin: auto; background: #fff; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #333; color: #fff; }
        form { margin-top: 20px; }
        input { margin-bottom: 10px; padding: 8px; width: 100%; box-sizing: border-box; }
        button { padding: 10px 15px; background: #28a745; color: #fff; border: none; cursor: pointer; }
        .btn-danger { background: #dc3545; color: #fff; padding: 5px 10px; text-decoration: none; border-radius: 3px; }
        .btn-warning { background: #ffc107; color: #000; padding: 5px 10px; text-decoration: none; border-radius: 3px; margin-right: 5px; }
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>

<div class="container">

    <?php if ($tab === 'users'): ?>
        <h2>Users List</h2>
        <table>
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Action</th></tr>
            <?php foreach ($db->index('users') as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td>
                        <a href="index.php?tab=users&edit_id=<?= $user['id'] ?>" class="btn-warning">Edit</a>
                        <a href="server.php?action=delete&table=users&id=<?= $user['id'] ?>" class="btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <?php if ($edit_id): $editUser = $db->show('users', $edit_id); ?>
            <h3>Edit User</h3>
            <form action="server.php" method="POST">
                <input type="hidden" name="id" value="<?= $editUser['id'] ?>">
                <input type="text" name="name" value="<?= htmlspecialchars($editUser['name']) ?>" required>
                <input type="email" name="email" value="<?= htmlspecialchars($editUser['email']) ?>" required>
                <button type="submit" name="update_user">Update User</button>
            </form>
        <?php endif; ?>

    <?php elseif ($tab === 'employees'): ?>
        <h2>Employees List</h2>
        <table>
            <tr><th>ID</th><th>Name</th><th>Position</th><th>Salary</th><th>Action</th></tr>
            <?php foreach ($db->index('employees') as $emp): ?>
                <tr>
                    <td><?= $emp['id'] ?></td>
                    <td><?= htmlspecialchars($emp['name']) ?></td>
                    <td><?= htmlspecialchars($emp['position']) ?></td>
                    <td>$<?= $emp['salary'] ?></td>
                    <td>
                        <a href="index.php?tab=employees&edit_id=<?= $emp['id'] ?>" class="btn-warning">Edit</a>
                        <a href="server.php?action=delete&table=employees&id=<?= $emp['id'] ?>" class="btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <?php if ($edit_id): $editEmp = $db->show('employees', $edit_id); ?>
            <h3>Edit Employee</h3>
            <form action="server.php" method="POST">
                <input type="hidden" name="id" value="<?= $editEmp['id'] ?>">
                <input type="text" name="name" value="<?= htmlspecialchars($editEmp['name']) ?>" required>
                <input type="text" name="position" value="<?= htmlspecialchars($editEmp['position']) ?>" required>
                <input type="number" step="0.01" name="salary" value="<?= $editEmp['salary'] ?>" required>
                <button type="submit" name="update_employee">Update Employee</button>
            </form>
        <?php else: ?>
            <h3>Add Employee</h3>
            <form action="server.php" method="POST">
                <input type="text" name="name" placeholder="Employee Name" required>
                <input type="text" name="position" placeholder="Position" required>
                <input type="number" step="0.01" name="salary" placeholder="Salary" required>
                <button type="submit" name="add_employee">Add Employee</button>
            </form>
        <?php endif; ?>

    <?php elseif ($tab === 'departments'): ?>
        <h2>Departments List</h2>
        <table>
            <tr><th>ID</th><th>Department Name</th><th>Action</th></tr>
            <?php foreach ($db->index('departments') as $dept): ?>
                <tr>
                    <td><?= $dept['id'] ?></td>
                    <td><?= htmlspecialchars($dept['name']) ?></td>
                    <td>
                        <a href="index.php?tab=departments&edit_id=<?= $dept['id'] ?>" class="btn-warning">Edit</a>
                        <a href="server.php?action=delete&table=departments&id=<?= $dept['id'] ?>" class="btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <?php if ($edit_id): $editDept = $db->show('departments', $edit_id); ?>
            <h3>Edit Department</h3>
            <form action="server.php" method="POST">
                <input type="hidden" name="id" value="<?= $editDept['id'] ?>">
                <input type="text" name="name" value="<?= htmlspecialchars($editDept['name']) ?>" required>
                <button type="submit" name="update_department">Update Department</button>
            </form>
        <?php else: ?>
            <h3>Add Department</h3>
            <form action="server.php" method="POST">
                <input type="text" name="name" placeholder="Department Name" required>
                <button type="submit" name="add_department">Add Department</button>
            </form>
        <?php endif; ?>

    <?php elseif ($tab === 'projects'): ?>
        <h2>Projects List</h2>
        <table>
            <tr><th>ID</th><th>Project Title</th><th>Budget</th><th>Action</th></tr>
            <?php foreach ($db->index('projects') as $proj): ?>
                <tr>
                    <td><?= $proj['id'] ?></td>
                    <td><?= htmlspecialchars($proj['title']) ?></td>
                    <td>$<?= $proj['budget'] ?></td>
                    <td>
                        <a href="index.php?tab=projects&edit_id=<?= $proj['id'] ?>" class="btn-warning">Edit</a>
                        <a href="server.php?action=delete&table=projects&id=<?= $proj['id'] ?>" class="btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <?php if ($edit_id): $editProj = $db->show('projects', $edit_id); ?>
            <h3>Edit Project</h3>
            <form action="server.php" method="POST">
                <input type="hidden" name="id" value="<?= $editProj['id'] ?>">
                <input type="text" name="title" value="<?= htmlspecialchars($editProj['title']) ?>" required>
                <input type="number" step="0.01" name="budget" value="<?= $editProj['budget'] ?>" required>
                <button type="submit" name="update_project">Update Project</button>
            </form>
        <?php else: ?>
            <h3>Add Project</h3>
            <form action="server.php" method="POST">
                <input type="text" name="title" placeholder="Project Title" required>
                <input type="number" step="0.01" name="budget" placeholder="Budget" required>
                <button type="submit" name="add_project">Add Project</button>
            </form>
        <?php endif; ?>

    <?php elseif ($tab === 'register'): ?>
        <h2>Register User</h2>
        <form action="server.php" method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="register">Register</button>
        </form>

    <?php elseif ($tab === 'login'): ?>
        <h2>User Login</h2>
        <?php if (isset($_GET['error'])): ?>
            <div class="error">Invalid email or password!</div>
        <?php endif; ?>
        <form action="server.php" method="POST">
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>

    <?php elseif ($tab === 'profile'): ?>
        <?php 
        if (!isset($_SESSION['loginID'])) {
            header("Location: index.php?tab=login");
            exit();
        }
        $currentUser = $db->show('users', $_SESSION['loginID']); 
        ?>
        <h2>User Profile</h2>
        <p><strong>ID:</strong> <?= $currentUser['id'] ?></p>
        <p><strong>Name:</strong> <?= htmlspecialchars($currentUser['name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($currentUser['email']) ?></p>

    <?php endif; ?>

</div>

</body>
</html>