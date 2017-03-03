<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
require_once "src/Store.php";

$server = 'mysql:host=localhost:8889;dbname=shoes_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);
class StoreTest extends PHPUnit_Framework_TestCase{
    protected function teardown()
    {
        Store::deleteAll();
    }
    function test_getName() {
        $name = 'Doot Locker';
        $pricing = 7;
        $location = 'spooky dooty lane';
        $test_store = new Store($name, $pricing, $location);

        $result = $test_store->getName();

        $this->assertEquals($name, $result);
    }

    function test_getPricing() {
        $name = 'Doot Locker';
        $pricing = 7;
        $location = 'spooky dooty lane';
        $test_store = new Store($name, $pricing, $location);

        $result = $test_store->getPricing();

        $this->assertEquals($pricing, $result);
    }

    function test_getLocation() {
        $name = 'Doot Locker';
        $pricing = 7;
        $location = 'spooky dooty lane';
        $test_store = new Store($name, $pricing, $location);

        $result = $test_store->getLocation();

        $this->assertEquals($location, $result);
    }

    function test_save() {
        $name = 'Doot Locker';
        $pricing = 7;
        $location = 'spooky dooty lane';
        $test_store = new Store($name, $pricing, $location);

        $test_store->save();
        $result = Store::getAll();

        $this->assertEquals([$test_store], $result);
    }

    function test_deleteAll() {
        $name = 'Doot Locker';
        $pricing = 7;
        $location = 'spooky dooty lane';
        $test_store = new Store($name, $pricing, $location);

        $test_store->save();
        Store::deleteAll();
        $result = Store::getAll();

        $this->assertEquals([], $result);
    }

    function test_getAll() {
        $name = 'Doot Locker';
        $pricing = 7;
        $location = 'spooky dooty lane';
        $test_store = new Store($name, $pricing, $location);

        $name2 = 'Scareless Shoe Src';
        $pricing2 = 4;
        $location2 = '35 spook me';
        $test_store2 = new Store($name2, $pricing2, $location2);

        $test_store->save();
        $test_store2->save();
        $result = Store::getAll();

        $this->assertEquals([$test_store, $test_store2], $result);
    }


}



?>
