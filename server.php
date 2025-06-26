<?php

// File: server.php
// Jika ada file fisik di public/, tampilkan langsung
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false; // biar PHP serve file itu langsung
}

require_once __DIR__.'/public/index.php';
