<?php
require_once '../vendor/autoload.php';
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
$logger = new Logger('main');
$logger->pushHandler(new StreamHandler(__DIR__ . '/../log/app.log', Logger::DEBUG));
$logger->info('First message');
print('Le message est enregistré dans le fichier ' . __DIR__ . '/../log/app.log');

// Définir le dossier où se trouvent les templates
$loader = new \Twig\Loader\FilesystemLoader('../templates');
// initialiser l'environnement de Twig et définir le dossier du cache
$twig = new \Twig\Environment($loader, [
'cache' => '../cache',
]);
// Affecter les variables du template et appeller le rendu
echo $twig->render('base.html.twig',
[
'title' => 'Essai de Twig',
'text' => 'Texte inséré dans la page.',
]
);
?>