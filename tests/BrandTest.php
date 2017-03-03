<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
require_once "src/Brand.php";
require_once "src/Store.php";

$server = 'mysql:host=localhost:8889;dbname=shoes_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);
class BrandTest extends PHPUnit_Framework_TestCase{
    protected function teardown()
    {
        Brand::deleteAll();
        Store::deleteAll();
    }
    function test_getName() {
        $name = 'Spooky';
        $pricing = 9;
        $test_brand = new Brand($name, $pricing);

        $result = $test_brand->getName();

        $this->assertEquals($name, $result);
    }

    function test_getPricing() {
        $name = 'Spooky';
        $pricing = 9;
        $test_brand = new Brand($name, $pricing);

        $result = $test_brand->getPricing();

        $this->assertEquals($pricing, $result);
    }

    function test_save() {
        $name = 'Spooky';
        $pricing = 9;
        $test_brand = new Brand($name, $pricing);

        $test_brand->save();
        $result = Brand::getAll();

        $this->assertEquals([$test_brand], $result);
    }

    function test_deleteAll() {
        $name = 'Spooky';
        $pricing = 9;
        $test_brand = new Brand($name, $pricing);

        $test_brand->save();
        Brand::deleteAll();
        $result = Brand::getAll();

        $this->assertEquals([], $result);
    }

    function test_getAll() {
        $name = 'Spooky';
        $pricing = 9;
        $test_brand = new Brand($name, $pricing);

        $name2 = 'Acreepas';
        $pricing2 = 4;
        $test_brand2 = new Brand($name2, $pricing2);

        $test_brand->save();
        $test_brand2->save();
        $result = Brand::getAll();

        $this->assertEquals([$test_brand, $test_brand2], $result);
    }

    function test_find() {
        $name = 'Spooky';
        $pricing = 9;
        $test_brand = new Brand($name, $pricing);

        $name2 = 'Acreepas';
        $pricing2 = 4;
        $test_brand2 = new Brand($name2, $pricing2);

        $test_brand->save();
        $test_brand2->save();
        $result = Brand::find($test_brand2->getId());

        $this->assertEquals($test_brand2, $result);
    }

    function test_addStores() {
        $name = 'Spooky';
        $pricing = 9;
        $test_brand = new Brand($name, $pricing);

        $name2 = 'Acreepas';
        $pricing2 = 4;
        $test_brand2 = new Brand($name2, $pricing2);

        $name = 'Doot Locker';
        $pricing = 7;
        $location = 'spooky dooty lane';
        $test_store = new Store($name, $pricing, $location);

        $name2 = 'Scareless Shoe Src';
        $pricing2 = 4;
        $location2 = '35 spook me';
        $test_store2 = new Store($name2, $pricing2, $location2);

        $test_brand->save();
        $test_brand2->save();
        $test_store->save();
        $test_store2->save();
        $test_brand->addStore($test_store2);
        $result = $test_brand->getStores();

        $this->assertEquals([$test_store2], $result);
    }


    function test_getStores() {
        $name = 'Spooky';
        $pricing = 9;
        $test_brand = new Brand($name, $pricing);

        $name2 = 'Acreepas';
        $pricing2 = 4;
        $test_brand2 = new Brand($name2, $pricing2);

        $name = 'Doot Locker';
        $pricing = 7;
        $location = 'spooky dooty lane';
        $test_store = new Store($name, $pricing, $location);

        $name2 = 'Scareless Shoe Src';
        $pricing2 = 4;
        $location2 = '35 spook me';
        $test_store2 = new Store($name2, $pricing2, $location2);

        $test_brand->save();
        $test_brand2->save();
        $test_store->save();
        $test_store2->save();
        $test_brand->addStore($test_store2);
        $test_brand->addStore($test_store);
        $result = $test_brand->getStores();

        $this->assertEquals([$test_store2, $test_store], $result);
    }


}



?>
