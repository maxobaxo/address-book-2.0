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
        for ($i = 0; $i < count($all_contacts); $i++) {
            $all_contacts[$i]->setIndex($i);
            var_dump($all_contacts[$i]->getFirstName());
        }
        return $app['twig']->render('home.html.twig', array('contacts' => $all_contacts));
    });

    $app->post('/create_contact', function() use ($app) {
        $contact = new Contact($_POST['last_name'], $_POST['first_name'], $_POST['mid-init'], $_POST['street_num'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['mobile'], $_POST['email']);
        $contact->save();
        var_dump($contact->getFirstName());
        return $app['twig']->render('create.html.twig', array('new_contact' => $contact));
    });

    $app->post('/delete_contacts', function() use($app) {
        Contact::deleteAll();
        return $app['twig']->render('deleted.html.twig');
    });

    $app->get('/update', function() use ($app) {
        $all_contacts = Contact::getAll();

        for ($i = 0; $i < count($all_contacts); $i++) {
            if ($i == $all_contacts[$i]->getIndex()) {
                $edit_contact = $all_contacts[$i];
            };
        }
        
        return $app['twig']->render('update.html.twig', array('edit_contact' => $edit_contact));
    });

    return $app;
?>
