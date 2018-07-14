<?php

require __DIR__ . '/vendor/autoload.php';
require 'helpers.php';

use Leafo\ScssPhp\Compiler;

$config = json_decode(file_get_contents('config.json'));

$page = $_GET['page'] ?? $config->pages->default;

// loop through pages list to check if there are some extra info for the current page
foreach ($config->pages->list as $listPage) {
    if (is_object($listPage) and $listPage->name == $page) {
        $config->title = $listPage->title ?? $config->title;

        foreach (['styles', 'js', 'common', ] as $section) {
            if (! empty($listPage->$section)) {
                $config->$section = (object) array_merge_recursive((array) $config->$section, (array) $listPage->$section);
            }
        }
    }
}

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

$cssFile = 'style/css/' . $page . '.css';

file_put_contents($cssFile, $content);

// disable browser cache 
$cssFile .= '?v=' . time();

ob_start();

require 'layout.php';

$output = ob_get_clean();

file_put_contents("production/$page.html", $output);

echo $output;