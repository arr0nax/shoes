<?php
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
            $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE store_id = {$this->getId()};");
        }


        function addBrand($brand)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$this->getId()}, {$brand->getId()});");
        }

        function getBrands()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores JOIN stores_brands ON (stores.id = stores_brands.store_id) JOIN brands ON (stores_brands.brand_id = brands.id) WHERE stores.id = {$this->getId()};");
            $brands = [];
            foreach($returned_brands as $brand)
            {
                $name = $brand['name'];
                $pricing = $brand['pricing'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $pricing, $id);
                array_push($brands, $new_brand);
            }
            return $brands;

        }

        function deleteBrands()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE store_id = {$this->getId()};");
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
            $GLOBALS['DB']->exec("DELETE FROM stores_brands");

        }

    }


?>
