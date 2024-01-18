<?php
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

// Get posts
$count = isset($_GET["count"]) ? $_GET["count"] : 20;
$page = isset($_GET["page"]) ? $_GET["page"] : 0;
$offset = $page * $count;

$stmt = mysqli_prepare($conn, "SELECT * FROM posts LIMIT ?,?");
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

print_r(json_encode($response));

?>
