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

    $app->get('/store/{id}', function($id) use($app) {
        $store = Store::find($id);
        $brands = Brand::getAll();
        return $app['twig']->render('store.html.twig', ['store'=>$store,'brands'=>$brands]);
    });

    $app->patch('/store/{id}/edit', function($id) use($app) {
        $store = Store::find($id);
        $store->deleteBrands();
        foreach($_POST['brands'] as $brand_id){
            $new_brand = Brand::find($brand_id);
            $store->addBrand($new_brand);
        }
        return $app->redirect('/store/'.$id);
    });

    $app->delete('/store/{id}/delete', function($id) use($app) {
        $store = Store::find($id);
        $store->delete();
        return $app->redirect('/');
    });


    $app->get('/brand/{id}', function($id) use($app) {
        $brand = Brand::find($id);
        $stores = Store::getAll();
        return $app['twig']->render('brand.html.twig', ['brand'=>$brand,'stores'=>$stores]);
    });

    $app->patch('/brand/{id}/edit', function($id) use($app) {
        $brand = Brand::find($id);
        $brand->deleteStores();
        foreach($_POST['stores'] as $store_id){
            $new_store = Store::find($store_id);
            $brand->addStore($new_store);
        }
        return $app->redirect('/brand/'.$id);
    });

    $app->delete('/brand/{id}/delete', function($id) use($app) {
        $brand = Brand::find($id);
        $brand->delete();
        return $app->redirect('/');
    });


    return $app;
?>
