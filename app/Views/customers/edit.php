<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
</head>
<body>
    <h1>Edit Customer</h1>

    <?php if (isset($validation)): ?>
        <div style="color: red;">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="/customers/update/<?= $customer['id'] ?>" method="post">
        <?= csrf_field() ?>

        <label>Name:</label><br>
        <input type="text" name="name" value="<?= old('name', $customer['name']) ?>"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= old('email', $customer['email']) ?>"><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone" value="<?= old('phone', $customer['phone']) ?>"><br><br>

        <label>Type:</label><br>
        <select name="type">
            <option value="Regular" <?= (old('type', $customer['type']) == 'Regular') ? 'selected' : '' ?>>Regular</option>
            <option value="VIP" <?= (old('type', $customer['type']) == 'VIP') ? 'selected' : '' ?>>VIP</option>
        </select><br><br>

        <button type="submit">Update Customer</button>
    </form>
    <br>
    <a href="/customers">Back to Customers</a>
</body>
</html>