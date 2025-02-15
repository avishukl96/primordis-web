<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('shortText')) {
    function shortText($text, $limit = 30) {
        return (strlen($text) > $limit) ? substr($text, 0, $limit) . "..." : $text;
    }
}