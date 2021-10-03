<?php
    require_once "connect.php";

    $connection = new mysqli($host, $db_user, $db_password, $db_name);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $result = $connection->query("SELECT * FROM `payment_method_default`");

    if (is_bool($result)) {
        echo "Error" . $connection->error;
    } else {
        while ($row = $result->fetch_assoc()) {
            echo "<option value=\"" . $row["id"] . "\">" . $row["name"] . "</option>";
        }
    }

    $connection->close();
