<?php include_once './func.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SmsEdge</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        form {
            margin-top: 50px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Check for logs</h2>
    <form method="get" class="form-inline d-flex justify-content-center align-items-center">
        <input type="date" name="from" class="form-control mb-2 mr-sm-2"
               value="<?= isset($_GET['from']) ? $_GET['from'] : '' ?>">
        <input type="date" name="to" class="form-control mb-2 mr-sm-2"
               value="<?= isset($_GET['to']) ? $_GET['to'] : '' ?>">
        <select name="cnt_id" class="form-control mb-2 mr-sm-2">
            <option value="">--Choose--</option>
            <?php foreach ($countryClass->all() as $country): ?>
                <option value="<?= $country['cnt_id'] ?>"
                    <?= isset($_GET['cnt_id']) && $_GET['cnt_id'] == $country['cnt_id'] ? 'selected' : '' ?>>
                    <?= $country['cnt_title'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <select name="usr_id" class="form-control mb-2 mr-sm-2">
            <option value="">--Choose--</option>
            <?php foreach ($userClass->all() as $user): ?>
                <option value="<?= $user['usr_id'] ?>"
                    <?= isset($_GET['usr_id']) && $_GET['usr_id'] == $user['usr_id'] ? 'selected' : '' ?>>
                    <?= $user['usr_name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-primary mb-2">Search</button>
    </form>
    <?php if (isset($logs)): ?>
        <h4>Results</h4>
        <?php if (!empty($logs)): ?>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Successfully sent</th>
                    <th scope="col">Failed</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($logs as $log): ?>
                    <tr>
                        <td><?= $log['date'] ?></td>
                        <td><?= $log['success'] ? $log['success'] : '-' ?></td>
                        <td><?= $log['failed'] ? $log['failed'] : '-' ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No result found!</p>
        <?php endif; ?>
    <?php endif; ?>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>