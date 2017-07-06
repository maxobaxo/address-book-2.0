<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Contact.php';

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
        }

        return $app['twig']->render('home.html.twig', array('contacts' => $all_contacts));
    });

    $app->post('/create_contact', function() use ($app) {
        $contact = new Contact($_POST['last_name'], $_POST['first_name'], $_POST['mid-init'], $_POST['street_num'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['mobile'], $_POST['email']);
        $contact->save();

        return $app['twig']->render('create.html.twig', array('new_contact' => $contact));
    });

    $app->post('/delete_contacts', function() use ($app) {
        Contact::deleteAll();
        return $app['twig']->render('deleted.html.twig');
    });

    $app->get('/update', function() use ($app) {
        $all_contacts = Contact::getAll();
        sort($all_contacts);
        $edit_contact_index = $_GET['edit_contact'];
        $edit_contact = $all_contacts[$edit_contact_index];

        return $app['twig']->render('update.html.twig', array('edit_contact' => $edit_contact));
    });

    $app->get('/update_confirm', function() use ($app) {
        $all_contacts = Contact::getAll();
        sort($all_contacts);
        $edited_contact_index = $_GET['edited_contact'];
        $edited_contact = $all_contacts[$edited_contact_index];

        if (!(empty($_GET['new_first_name']))) {
            $edited_contact->setFirstName($_GET['new_first_name']);
        }
        if (!(empty($_GET['new_last_name']))) {
            $edited_contact->setLastName($_GET['new_last_name']);
        }
        if (!(empty($_GET['new_mid_init']))) {
            $edited_contact->setMidInit($_GET['new_mid_init']);
        }
        if (!(empty($_GET['new_street_num']))) {
            $edited_contact->setStreet($_GET['new_street_num']);
        }
        if (!(empty($_GET['new_city']))) {
            $edited_contact->setCity($_GET['new_city']);
        }
        if (!(empty($_GET['new_state']))) {
            $edited_contact->setState($_GET['new_state']);
        }
        if (!(empty($_GET['new_zip']))) {
            $edited_contact->setZip($_GET['new_zip']);
        }
        if (!(empty($_GET['new_email']))) {
            $edited_contact->setEmail($_GET['new_email']);
        }
        if (!(empty($_GET['new_mobile']))) {
          $edited_contact->setMobile($_GET['new_mobile']);
        }

        var_dump("NEW LAST NAME: ");
        var_dump($edited_contact->getLastName());

        return $app['twig']->render('update_confirmed.html.twig', array('edited_contact' => $edited_contact));
    });

    return $app;
?>
