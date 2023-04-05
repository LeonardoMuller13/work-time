<?php

if (! function_exists('asset_path')) {
    /**
     * Get the path to a versioned Mix file.
     *
     * @param  string  $path
     * @param  string  $manifestDirectory
     * @return \Illuminate\Support\HtmlString|string
     *
     * @throws \Exception
     */
    function asset_path($path, $manifestDirectory = '')
    {
        $mixPath = mix($path, $manifestDirectory);
        return $mixPath;
    }
}