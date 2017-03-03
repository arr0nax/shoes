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

        function update($name, $pricing, $location)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET name = '{$name}', pricing = {$pricing}, location = '{$location}' WHERE id = {$this->getId()};");
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()}");
        }

        static function find($search_id)
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM stores WHERE id = {$search_id};");
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $name = $result['name'];
            $pricing = $result['pricing'];
            $location = $result['location'];
            $id = $result['id'];
            $new_store = new Store($name, $pricing, $location, $id);
            return $new_store;
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
