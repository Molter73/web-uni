<?php
include("get_posts.php");
include("add_post.php");

switch($_SERVER["REQUEST_METHOD"]) {
    case 'GET':
        $count = isset($_GET["count"]) ? $_GET["count"] : 20;
        $page = isset($_GET["page"]) ? $_GET["page"] : 0;
        $offset = $page * $count;
        echo get_posts($offset, $count);
        break;
    case 'POST':
        $title = filter_input(INPUT_POST, "title");
        $link = filter_input(INPUT_POST, "link", FILTER_VALIDATE_URL);
        $description = filter_input(INPUT_POST, "description");

        header("Location: ../index.html");
        echo add_post($title, $link, $description);
        break;
    default:
        die("Unsupported method: " . $_SERVER["REQUEST_METHOD"]);
}
?>
