<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<nav style="background-color: #212529; padding: 15px; margin-bottom: 20px;">
    <a href="index.php?tab=users" style="color: #fff; margin-right: 15px; text-decoration: none;">Dashboard System</a>
    <a href="index.php?tab=users" style="color: #ccc; margin-right: 15px; text-decoration: none;">Users</a>
    <a href="index.php?tab=employees" style="color: #ccc; margin-right: 15px; text-decoration: none;">Employees</a>
    <a href="index.php?tab=departments" style="color: #ccc; margin-right: 15px; text-decoration: none;">Departments</a>
    <a href="index.php?tab=projects" style="color: #ccc; margin-right: 15px; text-decoration: none;">Projects</a>

    <div style="float: right;">
        <?php if (isset($_SESSION['loginID'])): ?>
            <a href="index.php?tab=profile" style="color: #4caf50; margin-right: 15px; text-decoration: none;">Profile (<?= htmlspecialchars($_SESSION['userName']); ?>)</a>
            <a href="server.php?action=logout" style="color: #f44336; text-decoration: none;">Logout</a>
        <?php else: ?>
            <a href="index.php?tab=register" style="color: #ccc; margin-right: 15px; text-decoration: none;">Register</a>
            <a href="index.php?tab=login" style="color: #ccc; text-decoration: none;">Login</a>
        <?php endif; ?>
    </div>
    <div style="clear: both;"></div>
</nav>