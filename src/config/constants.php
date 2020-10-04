<?php

$apiPublicIndexFolder = dirname(__FILE__, 3);

$folderName = str_replace(['\\'], '/', $apiPublicIndexFolder);

$documentRoot = str_replace(['\\'], '/', $_SERVER['DOCUMENT_ROOT']);
$diretorioApi = str_replace($documentRoot, '', $folderName);

defined('BASEPATH') or define('BASEPATH', $diretorioApi);
