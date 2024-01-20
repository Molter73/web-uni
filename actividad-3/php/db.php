<?php
function db_connect() {
    $db_conf_file = 'db.ini';
    if(!file_exists($db_conf_file)) {
        die("DB configuration not found");
    }

    $db_conf = parse_ini_file($db_conf_file);

    $conn = mysqli_connect(
        $db_conf["url"],
        $db_conf["user"],
        $db_conf["password"],
        $db_conf["database"],
        $db_conf["port"],
    );

    if (!$conn) {
        die('Unable to connect to database: ' . mysqli_error());
    }

    return $conn;
}
?>
