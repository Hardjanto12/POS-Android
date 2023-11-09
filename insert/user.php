<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration</h2>
    
    <?php
    include('koneksi.php'); // Include the database connection

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "INSERT INTO p_userkasir (namaKasir, password) VALUES (?, ?)";
        $params = array($username, $password);
        $stmt = sqlsrv_query($koneksi, $sql, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        echo "Registration successful. Your username is: " . $username;
        sqlsrv_free_stmt($stmt);
    }

    sqlsrv_close($koneksi);
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Register">
    </form>
    <br>
    <a href="../view/listuser.php">Back to User List</a>
</body>
</html>
