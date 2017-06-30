<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Class.php';

    session_start();

    if (empty($_SESSION['list_of_contacts'])) {
        $_SESSION['list_of_contacts'] = array();
    }

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'
    ));

    $app->get('/', function() use ($app) {
        $all_contacts = Contact::getAll();
        sort($all_contacts);
        return $app['twig']->render('home.html.twig', array('contacts' => $all_contacts));
    });

    $app->post('/create_contact', function() use ($app) {
        $contact = new Contact($_POST['first_name'], $_POST['last_name'], $_POST['street_num'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['mobile'], $_POST['email']);

        $contact->save();
        return $app['twig']->render('create.html.twig', array('new_contact' => $contact));
    });

    $app->post('delete_contacts', function() use($app) {
        Contact::deleteAll();
        return $app['twig']->render('deleted.html.twig');
    });

    return $app;
?>
