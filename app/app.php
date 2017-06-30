<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/class.php';

    session_start();

    if (empty($_SESSION['contacts'])) {
        $_SESSION['contacts'] = array();
    }

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'
    ));

    $app->get('/', function() {
        return $app['twig']-render('home.html.twig');
    });

    return $app;
?>
