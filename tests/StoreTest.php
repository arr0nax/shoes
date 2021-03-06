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

    function test_find() {
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
        $result = Store::find($test_store2->getId());

        $this->assertEquals($test_store2, $result);
    }

    function test_update() {
        $name = 'Doot Locker';
        $pricing = 7;
        $location = 'spooky dooty lane';
        $test_store = new Store($name, $pricing, $location);

        $name2 = 'Scareless Shoe Src';
        $pricing2 = 4;
        $location2 = '35 spook me';

        $test_store->save();
        $test_store->update($name2, $pricing2, $location2);
        $test_store->setName($name2);
        $test_store->setPricing($pricing2);
        $test_store->setLocation($location2);
        $result = Store::getAll();

        $this->assertEquals([$test_store], $result);
    }

    function test_delete() {
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
        $test_store->delete();
        $result = Store::getAll();

        $this->assertEquals([$test_store2], $result);
    }


    function test_addBrands() {
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
        $test_store->addBrand($test_brand2);
        $result = $test_store->getBrands();

        $this->assertEquals([$test_brand2], $result);
    }


    function test_getBrands() {
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
        $test_store->addBrand($test_brand2);
        $test_store->addBrand($test_brand);
        $result = $test_store->getBrands();

        $this->assertEquals([$test_brand2, $test_brand], $result);
    }

    function test_deleteBrands() {
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
        $test_store->addBrand($test_brand2);
        $test_store->addBrand($test_brand);
        $test_store->deleteBrands();
        $result = $test_store->getBrands();

        $this->assertEquals([], $result);
    }
}



?>
