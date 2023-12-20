<?php
if(file_exists('posts.json'))
{
    $filename = 'posts.json';
    $data = file_get_contents($filename); //data read from json file
    print_r($data);
}
?>
