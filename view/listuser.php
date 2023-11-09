<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
</head>
<body>
    <h2>User List</h2>

    <?php
    include 'koneksi.php';

    // Query to retrieve user information from the 'p_userkasir' table
    $query = 'SELECT ID_Kasir, password, namaKasir FROM p_userkasir';
    $stmt = sqlsrv_query($koneksi, $query);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo '<table border="1">';
    echo '<tr><th>ID_Kasir</th><th>Username</th><th>Password</th></tr>';

    // Fetch and display the user information
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . $row['ID_Kasir'] . '</td>';
        echo '<td>' . $row['namaKasir'] . '</td>';
        echo '<td>' . $row['password'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($koneksi);
    ?>

    <br>
    <a href="../insert/user.php">Back to User Registration</a>
</body>
</html>
