<?php

$root = __DIR__;

if (empty($_GET['component']) === true) {
    die('Invalid component');
}

$file = $root . '/'. $_GET['component'] . '.vue';
$load = $_GET['load'] ?? 'script';

if (is_file($file) === false) {
    die('Component could not be found');
}

$contents = file_get_contents($file);
$template = null;
$script   = null;
$style    = null;

if (preg_match('!<template>(.*?)</template>!s', $contents, $templateMatch)) {
    $template = $templateMatch[1];
}

// template string for the component code
$templateString = 'template: `' . $template . '`';

if (preg_match('!<script>(.*?)</script>!s', $contents, $scriptMatch)) {
    $script = $scriptMatch[1];
    $script = preg_replace_callback('!export default {(.*)}!s', function ($js) use ($template, $templateString) {

        $componentCode  = trim($js[1]);

        if (empty($componentCode) === true) {
            $componentCode = $templateString;
        } else {
            $componentCode = trim(trim($componentCode, ',')) . ', ' . $templateString;
        }

        return 'export default {' . $componentCode . '}';
    }, $script);
} else {
    $script = 'export default {' . $templateString . '}';
}

if (preg_match('!<style.*?>(.*?)</style>!s', $contents, $styleMatch)) {
    $style = $styleMatch[1];
}

if ($load === 'css') {
    header("Content-Type: text/css");
    echo trim($style);
} else {
    header("Content-Type: application/javascript");
    echo trim($script);
}
