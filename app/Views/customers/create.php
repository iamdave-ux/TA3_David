<!DOCTYPE html>
<html>
<head>
    <title>Add Customer</title>
</head>
<body>
    <h1>Add New Customer</h1>

    <?php if (isset($validation)): ?>
        <div style="color: red;">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="/customers/create" method="post">
        <?= csrf_field() ?>

        <label>Name:</label><br>
        <input type="text" name="name" value="<?= set_value('name') ?>"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= set_value('email') ?>"><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone" value="<?= set_value('phone') ?>"><br><br>

        <label>Type:</label><br>
        <select name="type">
            <option value="Regular" <?= set_select('type', 'Regular') ?>>Regular</option>
            <option value="VIP" <?= set_select('type', 'VIP') ?>>VIP</option>
        </select><br><br>

        <button type="submit">Save Customer</button>
    </form>
    <br>
    <a href="/customers">Back to Customers</a>
</body>
</html>