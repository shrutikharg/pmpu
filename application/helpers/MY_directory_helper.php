<?php

defined('BASEPATH') OR exit('No direct script access allowed.');

function create_directory($directory_path) {

    if (!is_dir($directory_path)) {

        mkdir($directory_path, 0755, true);
    }
    return $directory_path;
}

function get_directory_size($dir) {
    $size = 0;
    foreach (glob(rtrim($dir, '/') . '/*', GLOB_NOSORT) as $each) {
        $size += is_file($each) ? filesize($each) : get_directory_size($each);
       
    }

    return $size;
}
