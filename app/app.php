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

    $app->get('/', function() use ($app) {
        return $app['twig']->render('home.html.twig', array('contacts' => Contact::getAll()));
    });

    $app->post('/create_contact', function() use ($app) {
        var_dump($_POST['last_name']);
        $contact = new Contact($_POST['first_name'], $_POST['last_name'], $_POST['street_num'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['mobile'], $_POST['email']);

        var_dump($contact);
        $contact->save();
        return $app['twig']->render('create.html.twig', array('new_contact' => $contact));
    });

    $app->post('delete_contacts', function() use($app) {
        Contact::deleteAll();
        return $app['twig']->render('deleted.html.twig');
    });

    return $app;
?>
