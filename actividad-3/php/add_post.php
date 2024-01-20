<?php
include_once("db.php");

function add_post($title, $link, $description) {
    if (is_null($title) || $title === false) {
        die("Invalid title: " . $title);
    }

    if (is_null($link) || $link === false) {
        die("Invalid link: " . $link);
    }

    if (is_null($description) || $description === false) {
        die("Invalid description: " . $description);
    }

    $conn = db_connect();

    $stmt = mysqli_prepare($conn,
       "INSERT INTO posts (title, date, video, description) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $title, date("Y-m-d"), $link, $description);
    if (!mysqli_stmt_execute($stmt)) {
        die("Failed to create post");
    }

    $response = (object) [
        "error_code" => 0,
        "msg" => "Post creado correctamente",
    ];

    return json_encode($response);
}
?>
