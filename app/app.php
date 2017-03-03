<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app['debug']=true;

    $app->get("/", function() use ($app) {
        $stores = Store::getAll();
        $brands = Brand::getAll();
        return $app['twig']->render('root.html.twig', ['stores'=>$stores, 'brands'=>$brands]);
    });

    $app->post('/addstore', function() use ($app) {
        $new_store = new Store($_POST['name'], $_POST['pricing'], $_POST['location']);
        $new_store->save();
        return $app->redirect('/');
    });

    $app->post('/addbrand', function() use ($app) {
        $new_brand = new Brand($_POST['name'], $_POST['pricing']);
        $new_brand->save();
        return $app->redirect('/');
    });

    $app->delete('/deletestores', function() use($app) {
        Store::deleteAll();
        return $app->redirect('/');
    });

    $app->delete('/deletebrands', function() use($app) {
        Brand::deleteAll();
        return $app->redirect('/');
    });


    return $app;
?>
