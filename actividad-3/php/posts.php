<?php
include("get_posts.php");
include("add_post.php");

switch($_SERVER["REQUEST_METHOD"]) {
    case 'GET':
        $count = filter_input(INPUT_GET, "count", FILTER_VALIDATE_INT, [
            "options" => [
                "default" => 20
        ]]);
        $page = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT, [
            "options" => [
                "default" => 0
        ]]);
        echo get_posts($page, $count);
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
