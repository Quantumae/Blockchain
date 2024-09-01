<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>申请表单</title>
</head>
<body>
    <h2>申请表单</h2>
    <form action="submit.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="public_key">Public Key:</label>
        <input type="text" id="public_key" name="public_key" required><br><br>

        <label for="year">Year:</label>
        <input type="number" id="year" name="year" required><br><br>

        <input type="submit" value="提交">
    </form>
</body>
</html>
