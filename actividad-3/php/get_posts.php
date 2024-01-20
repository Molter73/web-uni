<?php
include_once("db.php");

function get_posts($offset, $count) {
    $conn = db_connect();

    $stmt = mysqli_prepare($conn, "SELECT * FROM posts ORDER BY date DESC LIMIT ?,?");
    mysqli_stmt_bind_param($stmt, "ii", $offset, $count);
    if (!mysqli_stmt_execute($stmt)) {
        die("Failed to get posts");
    }

    $res = mysqli_stmt_get_result($stmt);
    $rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

    // Get count of posts
    $res = mysqli_query($conn, "SELECT COUNT(*) FROM posts");
    $total = (int)mysqli_fetch_column($res);

    mysqli_close($conn);

    $response = (object) [
        'metadata' => (object) [
            'page' => $page,
            'entries' => count($rows),
            'total_entries' => $total,
        ],
        'data' => $rows,
    ];

    return json_encode($response);
}

?>
