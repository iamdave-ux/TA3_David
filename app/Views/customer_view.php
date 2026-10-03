<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Accounts</title>
</head>
<body>
    <h1>Customer Accounts</h1>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($customers)): ?>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?= esc($customer['id']); ?></td>
                        <td><?= esc($customer['full_name']); ?></td>
                        <td><?= esc($customer['email']); ?></td>
                        <td><?= esc($customer['phone']); ?></td>
                        <td><?= esc($customer['created_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">No customers found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>