<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
</head>
<body>
    <h1>Add New User</h1>

    <?php if (isset($validation)): ?>
        <div style="color: red;">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="/users/create" method="post">
        <?= csrf_field() ?>

        <label>Username:</label><br>
        <input type="text" name="username" value="<?= set_value('username') ?>"><br><br>

        <label>Full Name:</label><br>
        <input type="text" name="full_name" value="<?= set_value('full_name') ?>"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= set_value('email') ?>"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password"><br><br>

        <button type="submit">Save User</button>
    </form>
    <br>
    <a href="/users">Back to Users</a>
</body>
</html>