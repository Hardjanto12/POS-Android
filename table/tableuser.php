<!DOCTYPE html>
<html>
<head>
    <title>User Information</title>
</head>
<body>
    <h2>User Information</h2>

    <?php
    include 'koneksi.php';

    // Query to retrieve table information for 'p_userkasir'
    $query = 'SELECT COLUMN_NAME, DATA_TYPE, CHARACTER_MAXIMUM_LENGTH
              FROM INFORMATION_SCHEMA.COLUMNS
              WHERE TABLE_NAME = \'p_userkasir\'';

    $stmt = sqlsrv_query($koneksi, $query);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    echo '<table border="1">';
    echo '<tr><th>Column Name</th><th>Data Type</th><th>Character Maximum Length</th></tr>';

    // Fetch and display the table information
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . $row['COLUMN_NAME'] . '</td>';
        echo '<td>' . $row['DATA_TYPE'] . '</td>';
        echo '<td>' . ($row['CHARACTER_MAXIMUM_LENGTH'] ?? 'N/A') . '</td>';
        echo '</tr>';
    }

    echo '</table>';

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($koneksi);
    ?>

    <br>
    <a href="index.html">Back to User Registration</a>
</body>
</html>

