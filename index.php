<?php

require __DIR__ . '/vendor/autoload.php';
require 'helpers.php';

use Leafo\ScssPhp\Compiler;

$config = json_decode(file_get_contents('config.json'));

$page = $_GET['page'] ?? $config->pages->default;

$scss = new Compiler();
$scss->setImportPaths('style/scss');

try {
    $files = ['app'];

    foreach ($config->common as $sections) {
        foreach ($sections as $section) {
            if (! file_exists($file = 'style/scss/common/_' . $section . '.scss')) {
                touch($file);
            }
        }

        $files[] = 'common/' . $section;
    }

    if (! file_exists($file = 'style/scss/pages/_' . $page . '.scss')) {
        touch($file);
    }

    $files[] = 'pages/_' . $page;
       
    $content = $scss->compile(implode(PHP_EOL, array_map(function ($file) {
        return "@import '$file.scss';";
    }, $files)));
} catch (Exception $e) {
    die($e->getMessage());
}

$cssFile = 'style/css/' . $page . '.css?v=' . time();

file_put_contents($cssFile, $content);

ob_start();

require 'layout.php';

$output = ob_get_clean();

file_put_contents("production/$page.html", $output);

echo $output;