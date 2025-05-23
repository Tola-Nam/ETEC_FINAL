<?php
// function for uploader file image production 
function image_uploader($image_uploader): string
{
    if (!isset($image_uploader['name']) || !isset($image_uploader['tmp_name'])) {
        return '';
    }

    $filename = rand(0, 99999999) . date('y-m-d_H-i-s') . '.' . pathinfo($image_uploader['name'], PATHINFO_EXTENSION);
    $destination = __DIR__ . '/../../assets/images/' . $filename;

    if (move_uploaded_file($image_uploader['tmp_name'], $destination)) {
        return $filename;
    }

    return '';
}


?>