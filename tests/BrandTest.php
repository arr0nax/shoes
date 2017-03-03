<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
require_once "src/Brand.php";

$server = 'mysql:host=localhost:8889;dbname=shoes_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);
class BrandTest extends PHPUnit_Framework_TestCase{
    protected function teardown()
    {
        // Brand::deleteAll();
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
}



?>
