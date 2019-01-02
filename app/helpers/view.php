<?php
/**
 * @param $paths
 * @param $data
 * @return mixed
 *
 * Extends the View by loading another file relative the base Views Path.
 */
function extend_view($paths, $data)
{
    // Set each index of data to its named variable.
    foreach ($data as $key => $value) {
        $$key = $value;
    }

    foreach ($paths as $path) {
        include (VIEWS_PATH . $path . '.php');
    }
}

/**
 * @param $paths
 * Loads Javascripts.
 */
function load_script($paths)
{
    foreach ($paths as $path) {
        echo '<script src="' . FULL_ROOT . '/js/' . $path . '.js"></script>' . "\r\n";
    }
}

/**
 * @param $paths
 * Loads CSS Styles
 */
function load_style($paths)
{
    foreach ($paths as $path) {
        echo '<link rel="stylesheet" href="' . FULL_ROOT . '/css/' . $path . '.css" type="text/css" />' . "\r\n";
    }
}