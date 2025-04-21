<?php
// function for uploader file image production 
function image_uploader($image_uploader): string
{
    $filename = rand(0, 99999999) . date('y-m-d H-i-s') . '.' . pathinfo($image_uploader['name'], PATHINFO_EXTENSION);
    move_uploaded_file($filename['tmp'], '/servers/assets/images/' . $filename);
    return $filename;
}

?>