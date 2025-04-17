<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Symfony\Component\Filesystem\Filesystem;

require_once dirname(__DIR__) . '/vendor/autoload.php'; // Corrige le chemin vers "vendor/"

$filesystem = new Filesystem();
$cacheDir = dirname(__DIR__) . '/var/cache/prod';

if ($filesystem->exists($cacheDir)) {
    try {
        $filesystem->remove($cacheDir);
        echo 'Le cache Symfony en mode production a été vidé avec succès.';
    } catch (\Exception $e) {
        echo 'Erreur lors du vidage du cache : ' . $e->getMessage();
    }
} else {
    echo 'Le cache en mode production est déjà vide ou le répertoire n\'existe pas.';
}
