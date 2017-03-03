s<?php
    class Brand {
        private $name;
        private $pricing;
        private $id;

        function __construct($name, $pricing, $id = null) {
            $this->name = $name;
            $this->pricing = $pricing;
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

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (name, pricing) VALUES ('{$this->getName()}', {$this->getPricing()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function addStore($store)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$store->getId()}, {$this->getId()});");
        }

        function getStores()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands JOIN stores_brands ON (brands.id = stores_brands.brand_id) JOIN stores ON (stores_brands.store_id = stores.id) WHERE brand.id = {$this->getId()};");
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

        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
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

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands");
        }


    }


?>
