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
        $test_store = new Store($name);

        $result = $test_store->getName();

        $this->assertEquals($name, $result);
    }
}



?>
