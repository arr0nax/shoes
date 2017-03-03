s<?php
    class Store {
        private $name;
        private $pricing;
        private $location;
        private $id;

        function __construct($name, $pricing, $location, $id = null) {
            $this->name = $name;
            $this->pricing = $pricing;
            $this->location = $location;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($name)
        {
            $this->name = $name;
        }

        function getPricing()
        {
            return $this->pricing;
        }

        function setPricing($pricing)
        {
            $this->pricing = $pricing;
        }

        function getLocation()
        {
            return $this->location;
        }

        function setLocation($location)
        {
            $this->location = $location;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (name, pricing, location) VALUES ('{$this->getName()}', {$this->getPricing()}, '{$this->getLocation()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = [];
            foreach($returned_stores as $store)
            {
                $name = $store['name'];
                $pricing = $store['pricing'];
                $location = $store['location'];
                $id = $store['id'];
                $new_store = new Store($name, $pricing, $location, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores");
        }

    }


?>
